const konamiCode = [
    "ArrowUp", "ArrowUp", "ArrowDown", "ArrowDown",
    "ArrowLeft", "ArrowRight", "ArrowLeft", "ArrowRight",
    "b", "a", "Enter"
];

let konamiCodePosition = 0;

// Supposons que l'ID de l'utilisateur connecté soit stocké dans une variable globale
const userId = <?php echo json_encode($_SESSION['user_id']); ?>; // Assurez-vous que cette ligne PHP est exécutée côté serveur

// Fonction pour envoyer une requête AJAX
function sendKonamiCode() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../PHP/easteregg.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log("Réponse du serveur:", xhr.responseText);
        }
    };

    // Données à envoyer au serveur
    const data = JSON.stringify({
        user_id: userId,
        badge_value: "good"
    });

    xhr.send(data);
}

// Écouteur d'événements pour les touches du clavier
document.addEventListener("keydown", function(event) {
    // Vérifiez si la touche appuyée est la bonne dans la séquence
    if (event.key === konamiCode[konamiCodePosition]) {
        konamiCodePosition++;
        // Si toute la séquence est saisie, envoyer les données au serveur
        if (konamiCodePosition === konamiCode.length) {
            sendKonamiCode();
            konamiCodePosition = 0; // Réinitialisez la position pour une future utilisation
        }
    } else {
        konamiCodePosition = 0; // Réinitialisez si la séquence est incorrecte
    }
});