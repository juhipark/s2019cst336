/*global $*/

$(document).ready(function() {
    console.log("js file connected success");
    var columnDefs = [
        { headerName: "Select", field: "pDelete", checkboxSelection: true, width: 25 },
        { headerName: "Product ID", field: "pId", width: 30, hide: true, suppressToolPanel: true },
        { headerName: "Product Name", field: "pName", width: 100 },
        { headerName: "Product Description", field: "pDescription", width: 200 },
        { headerName: "Price", field: "pPrice", width: 70 },
    ];

    // gridOptions.columnApi.setColumnVisible('pId', false);

    var gridOptions = {
        defaultColDef: {
            editable: true,
        },
        columnDefs: columnDefs,
        rowData: null,
        rowSelection: 'single', //-->multiple
        suppressRowClickSelection: true,
        onGridSizeChanged: onGridSizeChanged,
        onCellValueChanged: function(data) {
            updateBug(data);
        }
    };


    $.ajax({
        type: "GET",
        url: "./api/getProducts.php",
        dataType: "json",
        data: {},
        success: function(data, status) {
            console.log(data);
            console.log("ajax call for every products");

            var counter = 1;
            var rowData = [];

            data.forEach(function(key) {
                //insert data
                var eachData = {
                    pId: key['productId'],
                    pName: key['productName'],
                    pDescription: key['productDescription'],
                    pPrice: key['price']
                };

                rowData.push(eachData);
            });

            var gridDiv = document.querySelector('#myGrid');
            new agGrid.Grid(gridDiv, gridOptions);

            gridOptions.api.setRowData(rowData);
        },
        error:function(data, status){
            console.log("All products load failed");
            
        }
    }); //ajax call for loading list of all products in the beginning

    $("#infoBtn").on('click', function() {
        const selectedNodes = gridOptions.api.getSelectedNodes()
        const selectedData = selectedNodes.map(function(node) { return node.data })

        var selectedDataStringID = selectedData.map(function(node) { return node.pId }).join('&')

        console.log('Selected nodes: ' + parseInt(selectedDataStringID));

        $("#purchaseHistoryModal").modal("show");
        $.ajax({
            type: "POST",
            url: "api/getProducts.php",
            dataType: "json",
            data: {
                "productId": parseInt(selectedDataStringID)
            },
            success: function(data, status) {
                console.log(data);

                if (data.length != 0) {
                    $("#history").html("");
                    $("#history").append(data[0]['productName'] + "<br />");
                    $("#history").append("<img src='" + data[0]['productImage'] + "' width='200' /> <br />");
                    data.forEach(function(key) {
                        $("#history").append("Product Name: " + key['productName'] + "<br />");
                        $("#history").append("Product Description: " + key['productDescription'] + "<br />");
                        $("#history").append("Unit Price: $" + key['price'] + "<br />");
                    });
                }
                else {
                    $("#history").html("No product information for this item.");
                }
            }
        });


    }); //Information Button Click Event


    $("#logoutBtn").on('click', function() {
        console.log("Redirect to logout page");
        window.location = "auth/logout.php";

    }); //Logout Button Click Event

    $("#deleteBtn").on('click', function() {

        const selectedNodes = gridOptions.api.getSelectedNodes()
        const selectedData = selectedNodes.map(function(node) { return node.data })

        const selectedDataStringID = selectedData.map(function(node) { return node.pId })

        console.log('Delete - Selected nodes: ' + selectedDataStringID);


        $.ajax({
            type: "DELETE",
            url: "api/getProducts.php",
            dataType: "",
            data: {
                "productId": selectedDataStringID,
            },
            success: function(data, status) {
                //delete
                console.log(data);
                Swal.fire({
                    type: 'success',
                    title: 'Items have been deleted',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    console.log("Deleted sql sent out");

                    onRemoveSelected();

                })

                // var counter = 1;
                // var rowData = [];

                // data.forEach(function(key) {
                //     //insert data
                //     var eachData = {
                //         pName: key['productName'],
                //         pDescription: key['productDescription'],
                //         pPrice: key['price']
                //     };

                //     rowData.push(eachData);
                // });

                // var gridDiv = document.querySelector('#myGrid');
                // new agGrid.Grid(gridDiv, gridOptions);

                // gridOptions.api.setRowData(rowData);
            }
        }); //ajax call for loading list of all products in the beginning



    }); //Delete Button Click Event




    //AG-Grid resize
    function onGridSizeChanged(params) {
        // get the current grids width
        var gridWidth = document.getElementById('myGrid').offsetWidth;

        // keep track of which columns to hide/show
        var columnsToShow = [];
        var columnsToHide = [];

        // iterate over all columns (visible or not) and work out
        // now many columns can fit (based on their minWidth)
        var totalColsWidth = 0;
        var allColumns = params.columnApi.getAllColumns();
        for (var i = 0; i < allColumns.length; i++) {
            let column = allColumns[i];
            totalColsWidth += column.getMinWidth();
            if (totalColsWidth > gridWidth) {
                columnsToHide.push(column.colId);
            }
            else {
                columnsToShow.push(column.colId);
            }
        }

        // show/hide columns based on current grid width
        params.columnApi.setColumnsVisible(columnsToShow, true);
        params.columnApi.setColumnsVisible(columnsToHide, false);

        // fill out any available space to ensure there are no gaps
        params.api.sizeColumnsToFit();
    }

    function addNewProduct() {
        window.location = "add.php";
    }

    function onRemoveSelected() {
        var selectedData = gridOptions.api.getSelectedRows();
        var res = gridOptions.api.updateRowData({ remove: selectedData });
    }

    function updateBug(data) {
        data = data.data;
        console.log("Editable data below: ");
        console.log(data);


        console.log("product ID:");
        console.log(data["pId"]);
        console.log(data["pName"]);
        console.log(data["pDescription"]);
        console.log(data["pPrice"]);

        $.ajax({
            url: 'api/editProducts.php',
            type: 'GET',
            data: {
                'id': data['pId'],
                'pName': data['pName'],
                'pDescription': data['pDescription'],
                'pPrice': data['pPrice']
            },
            success: function(data) {
                Swal.fire({
                    type: 'success',
                    title: 'Items have been edited',
                    showConfirmButton: false,
                    timer: 1000
                });
            },
            error: function(data) {
                Swal.fire({
                    title: 'Error',
                    type: 'error',
                    text: data.responseText
                })
            }
        });


    }



}); //Document ready Event
