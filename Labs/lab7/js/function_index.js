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
        columnDefs: columnDefs,
        rowData: null,
        rowSelection: 'single', //-->multiple
        suppressRowClickSelection: true,
        onGridSizeChanged: onGridSizeChanged
    };


    $.ajax({
        type: "GET",
        url: "api/getProducts.php",
        dataType: "json",
        data: {},
        success: function(data, status) {
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

        Swal.fire({
            type: 'success',
            title: 'Items have been deleted',
            showConfirmButton: false,
            timer: 1500
        })
        //delete

        $.ajax({
            type: "DELETE",
            url: "api/getProducts.php",
            dataType: "json",
            data: {
                "productId": selectedDataStringID,
            },
            success: function(data, status) {
                
                console.log("Deleted sql sent out");
                //refresh the page for updated table
                window.location.reload();

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

}); //Document ready Event


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

function addNewProduct(){
    window.location = "add.php";
}
