const mots = ["ANANAS", "MONTAGNE", "DRAMATIQUE", "DIGITAL", "CHOCOLAT" , "ELEPHANT", "BIBLIOTHEQUE", "PROGRAMMATION", "JOURNAL", "INTERNET", "TELEPHONE", "AVION", "VOITURE", "MUSIQUE", "THEATRE"];

let motChoisi = "";
let lettresTrouvees = [];
let lettresEssayees = [];
let essaisRestants = 8;

document.addEventListener("DOMContentLoaded", () => {
    const button2 = document.getElementById('nextWord');
    const wordDisplay = document.getElementById("wordToFind");
    const proposition = document.getElementById("props");
    const button1 = document.getElementById("testButton");
    const triesDisplay = document.getElementById("tries");
    const messageDisplay = document.getElementById("message");

    function start() {
        button2.textContent = "Next Word";
        gameOn();
    }

    function gameOn() {
        motChoisi = mots[Math.floor(Math.random() * mots.length)];
        lettresTrouvees = [];
        lettresEssayees = [];
        essaisRestants = 8;
        
        triesDisplay.textContent = essaisRestants;
        messageDisplay.textContent = "";
        proposition.disabled = false;
        button1.disabled = false;
    
        
        dessinerPendu(0);
    
        
        let motAffiche = "";
        for (let i = 0; i < motChoisi.length; i++) {
            if (i === 0 || i === motChoisi.length - 1) {
                motAffiche += motChoisi[i] + " ";
                
                if (!lettresTrouvees.includes(motChoisi[i])) {
                    lettresTrouvees.push(motChoisi[i]);
                }
            } else {
                motAffiche += "_ ";
            }
        }
    
        
        wordDisplay.textContent = motAffiche.trim();
        proposition.value = "";
        proposition.focus();
    }

    
    function afficherMessage(message, duree = 2000) {
        messageDisplay.textContent = message;
        setTimeout(() => {
            if (messageDisplay.textContent === message) {
                messageDisplay.textContent = "";
            }
        }, duree);
    }

    function testerLettre() {
        const lettre = proposition.value.toUpperCase();
    
        
        if (lettre.length !== 1 || !lettre.match(/[A-Z]/)) {
            afficherMessage("Veuillez entrer une lettre valide!");
            proposition.value = "";
            return;
        }
    
        
        if (lettresEssayees.includes(lettre)) {
            afficherMessage("Vous avez déjà essayé cette lettre!");
            proposition.value = "";
            return;
        }
    
       
        lettresEssayees.push(lettre);
    
        
        if (motChoisi.includes(lettre)) {
            lettresTrouvees.push(lettre);
            afficherMessage("Bonne lettre!");
        } else {
            essaisRestants--;
            triesDisplay.textContent = essaisRestants;
            
            
            dessinerPendu(8 - essaisRestants);
            
            afficherMessage("Lettre incorrecte!");
            
            if (essaisRestants === 0) {
                
                dessinerPendu(10);
                finPartie(false);
                return;
            }
        }
    
        
        let motAffiche = "";
        for (let i = 0; i < motChoisi.length; i++) {
            
            if (i === 0 || i === motChoisi.length - 1 || lettresTrouvees.includes(motChoisi[i])) {
                motAffiche += motChoisi[i] + " ";
            } else {
                motAffiche += "_ ";
            }
        }
    
        wordDisplay.textContent = motAffiche.trim();
        
        
        const toutesLettresTrouvees = motChoisi.split('').every(lettre => 
            lettresTrouvees.includes(lettre)
        );
        
        if (toutesLettresTrouvees) {
            finPartie(true);
        }
        
        proposition.value = "";
        proposition.focus();
    }

    function finPartie(gagne) {
        if (gagne) {
            messageDisplay.textContent = "Félicitations! Vous avez trouvé le mot!";
        } else {
            messageDisplay.textContent = `Dommage! Le mot était: ${motChoisi}`;
            wordDisplay.textContent = motChoisi;
        }
        
        
        proposition.disabled = true;
        button1.disabled = true;
    }

    
function dessinerPendu(etape) {
    const canvas = document.getElementById('pendu-canvas');
    const ctx = canvas.getContext('2d');
    const stepsDisplay = document.getElementById('pendu-steps');
    
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = 'rgb(0, 0, 0)';
    ctx.lineWidth = 3;
    
    stepsDisplay.textContent = `Étape: ${etape}/8`;
    
    
    switch(etape) {
        case 1:
           
            ctx.beginPath();
            ctx.moveTo(50, 350);
            ctx.lineTo(150, 350);
            ctx.stroke();
            break;
            
        case 2:
            
            dessinerPendu(1);
            ctx.beginPath();
            ctx.moveTo(100, 350);
            ctx.lineTo(100, 50);
            ctx.stroke();
            break;
            
        case 3:
            
            dessinerPendu(2);
            ctx.beginPath();
            ctx.moveTo(100, 50);
            ctx.lineTo(200, 50);
            ctx.stroke();
            break;
            
        case 4:
            
            dessinerPendu(3);
            ctx.beginPath();
            ctx.moveTo(200, 50);
            ctx.lineTo(200, 100);
            ctx.stroke();
            break;
            
        case 5:
            
            dessinerPendu(4);
            ctx.beginPath();
            ctx.arc(200, 120, 20, 0, Math.PI * 2);
            ctx.stroke();
            break;
            
        case 6:
            
            dessinerPendu(5);
            ctx.beginPath();
            ctx.moveTo(200, 140);
            ctx.lineTo(200, 240);
            ctx.stroke();
            break;
            
        case 7:
            
            dessinerPendu(6);
            ctx.beginPath();
            ctx.moveTo(200, 160);
            ctx.lineTo(170, 200);
            ctx.stroke();
            break;
            
        case 8:
            
            dessinerPendu(7);
            ctx.beginPath();
            ctx.moveTo(200, 160);
            ctx.lineTo(230, 200);
            ctx.stroke();
            break;
            
        case 9:
            
            dessinerPendu(8);
            ctx.beginPath();
            ctx.moveTo(200, 240);
            ctx.lineTo(170, 300);
            ctx.stroke();
            break;
            
        case 10:
        
            dessinerPendu(9);
            ctx.beginPath();
            ctx.moveTo(200, 240);
            ctx.lineTo(230, 300);
            ctx.stroke();
            
            
            ctx.beginPath();
            ctx.arc(195, 115, 3, 0, Math.PI * 2);
            ctx.fill();
            ctx.beginPath();
            ctx.arc(205, 115, 3, 0, Math.PI * 2);
            ctx.fill();
            ctx.beginPath();
            ctx.arc(200, 125, 8, 0, Math.PI);
            ctx.stroke();
            break;
    }
}

function dessinerPenduDetaille(etape) {
    const canvas = document.getElementById('pendu-canvas');
    const ctx = canvas.getContext('2d');
    
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = '#19138bff';
    ctx.lineWidth = 4;
    ctx.lineCap = 'round';
    
    
    const etapes = [
        () => { /* Étape 0: rien */ },
        () => { // Base
            ctx.moveTo(50, 350); ctx.lineTo(150, 350);
        },
        () => { // Poteau vertical
            ctx.moveTo(100, 350); ctx.lineTo(100, 50);
        },
        () => { // Poteau horizontal
            ctx.moveTo(100, 50); ctx.lineTo(200, 50);
        },
        () => { // Corde
            ctx.moveTo(200, 50); ctx.lineTo(200, 100);
        },
        () => { // Tête
            ctx.beginPath(); ctx.arc(200, 120, 20, 0, Math.PI * 2); ctx.stroke();
        },
        () => { // Corps
            ctx.beginPath(); ctx.moveTo(200, 140); ctx.lineTo(200, 240); ctx.stroke();
        },
        () => { // Bras gauche
            ctx.beginPath(); ctx.moveTo(200, 160); ctx.lineTo(170, 200); ctx.stroke();
        },
        () => { // Bras droit
            ctx.beginPath(); ctx.moveTo(200, 160); ctx.lineTo(230, 200); ctx.stroke();
        },
        () => { // Jambe gauche
            ctx.beginPath(); ctx.moveTo(200, 240); ctx.lineTo(170, 300); ctx.stroke();
        },
        () => { // Jambe droite + visage
            ctx.beginPath(); ctx.moveTo(200, 240); ctx.lineTo(230, 300); ctx.stroke();
            // Visage triste
            ctx.beginPath(); ctx.arc(195, 115, 3, 0, Math.PI * 2); ctx.fill();
            ctx.beginPath(); ctx.arc(205, 115, 3, 0, Math.PI * 2); ctx.fill();
            ctx.beginPath(); ctx.arc(200, 130, 8, 0.1, Math.PI - 0.1); ctx.stroke();
        }
    ];
    
    
    ctx.beginPath();
    for (let i = 1; i <= etape; i++) {
        etapes[i]();
    }
    ctx.stroke();
    
    
    document.getElementById('pendu-steps').textContent = `Étape: ${etape}/10`;
}

    button2.addEventListener("click", start);
    button1.addEventListener("click", testerLettre);
    
    
    gameOn();
});