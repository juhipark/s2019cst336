$("document").ready(function(){
    var randomNum = Math.floor(Math.random() * 99) + 1;
    console.log(randomNum); 
    var guesses = document.querySelector('#guesses');
    var lastResult = document.querySelector('#lastResult');
    var lowOrHi = document.querySelector('#lowOrHi');
    
    var guessSubmit = document.querySelector('.guessSubmit');
    var guessField = document.querySelector('.guessField');
    
    var guessCount = 1;
    var resetButton = document.querySelector('#reset');
    resetButton.style.display = 'none';
    guessField.focus();
    
    var wonNum = 0;
    var lostNum = 0;
    // var resetButton;
    
    
    $(".guessSubmit").click(function() {
        var userGuess = Number(guessField.value);
        if((userGuess > 0 && userGuess < 100) && !isNaN(userGuess)){
            if (guessCount == 1) {
                guesses.innerHTML = "Previous guesses: ";
            }
            guesses.innerHTML += userGuess + ' ';
        
            if (userGuess == randomNum) {
                $('#lastResult').html('Congratulations! You got it right!');
                // lastResult.innerHTML = 'Congratulations! You got it right!';
                lastResult.style.backgroundColor = 'green';
                 $('#lowOrHi').html('');
                // lowOrHi.innerHTML = '';
                wonNum++;
                setGameOver();
        
            }
            else if (guessCount == 7) {
                $('#lastResult').html('Sorry, you lost!');
                // lastResult.innerHTML = 'Sorry, you lost!';
                lostNum++;
                setGameOver();
            }
            else {
                $('#lastResult').html('Wrong!');
                // lastResult.innerHTML = 'Wrong!';
                lastResult.style.backgroundColor = 'red';
                if (userGuess < randomNum) {
                    $('#lowOrHi').html('Last guess was too low!');
                    // lowOrHi.innerHTML = 'Last guess was to low!';
                }
                else if (userGuess > randomNum) {
                    $('#lowOrHi').html('Last guess was too high!');
                    // lowOrHi.innerHTML = 'Last guess was to high!';
                }
            }
            guessCount++;
        } else {
            console.log("Wrong input");
        
        }
        guessField.value = '';
        guessField.focus();
    })
    // guessSubmit.addEventListener('click', checkGuess);
    
    function setGameOver() {
        $("#scoreBoard #won").html("Won: " + wonNum);
        $("#scoreBoard #lost").html("Lost: " + lostNum);
        guessField.disabled = true;
        guessSubmit.disabled = true;
        resetButton.style.display = 'inline';
        resetButton.addEventListener('click', resetGame);
    }
    
    function resetGame() {
        guessCount = 1;
        var resetParas = document.querySelectorAll('.resultParas p');
        for (var i = 0; i < resetParas.length; i++) {
            resetParas[i].textContent = '';
        }
        resetButton.style.display = 'none';
        guessField.disabled = false;
        guessSubmit.disabled = false;
        guessField.value = '';
        guessField.focus();
    
        lastResult.style.backgroundColor = 'white';
        randomNum = Math.floor(Math.random() * 99) + 1;
    
        }

})
