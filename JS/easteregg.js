document.addEventListener("DOMContentLoaded", function() {
    // Séquence du Konami Code
    const konamiCode = [
        "ArrowUp", "ArrowUp", "ArrowDown", "ArrowDown",
        "ArrowLeft", "ArrowRight", "ArrowLeft", "ArrowRight",
        "b", "a", "Enter"
    ];

    let konamiCodePosition = 0;

    // Fonction pour envoyer une requête AJAX
    function sendKonamiCode() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../PHP/easteregg.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Réponse du serveur:", xhr.responseText);
                } else {
                    console.error("Erreur lors de la requête AJAX:", xhr.statusText);
                }
            }
        };

        let data = "badge_value=good";
        xhr.send(data);
    }

    // Écouteur d'événements pour les touches du clavier
    document.addEventListener("keydown", function(event) {
        if (event.key === konamiCode[konamiCodePosition]) {
            konamiCodePosition++;
            if (konamiCodePosition === konamiCode.length) {
                sendKonamiCode();
                konamiCodePosition = 0;
            }
        } else {
            konamiCodePosition = 0;
        }
    });
});
