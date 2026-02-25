"use strict"

let toGuessNum = Math.floor(Math.random() * 10);
let guessBtn = document.getElementById("guessButton");

function guess(){
    let supposeNum = document.getElementById("userInput").value;
    let attempts = document.getElementById("attempts");
    let feedback = document.getElementById("feedback");
    if(parseInt(supposeNum) == toGuessNum){
        console.log("gg")
        feedback.textContent = "Bravo! Vous avez deviné le nombre.";
        feedback.className = "success";
    }else{
        feedback.textContent = "Essayez encore!";
        feedback.className = "error";
        let currentAttempts = parseInt(attempts.textContent.split(": ")[1]);
        if (currentAttempts > 1) {
            attempts.textContent = "Essais restants: " + (currentAttempts - 1);
        } else {
            feedback.textContent = "Jeu terminé! Le nombre était " + toGuessNum + ".";
            guessBtn.disabled = true;
        }
    }
}

guessBtn.addEventListener("click", guess);

