document.addEventListener("DOMContentLoaded", function() {
    // Séquence du Konami Code
    const konamiCode = [
        "ArrowUp", "ArrowUp", "ArrowDown", "ArrowDown",
        "ArrowLeft", "ArrowRight", "ArrowLeft", "ArrowRight",
        "b", "a", "Enter"
    ];

    let konamiCodePosition = 0;

    // Fonction pour envoyer une requête AJAX
    function sendKonamiCode(userId) {
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

        let data = "user_id=" + encodeURIComponent(userId) + "&badge_value=good";
        xhr.send(data);
    }

    // Fonction pour récupérer l'ID de l'utilisateur
    function getUserId() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "get_user_id.php", true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                let response = JSON.parse(xhr.responseText);
                let userId = response.user_id;

                // Écouteur d'événements pour les touches du clavier
                document.addEventListener("keydown", function(event) {
                    if (event.key === konamiCode[konamiCodePosition]) {
                        konamiCodePosition++;
                        if (konamiCodePosition === konamiCode.length) {
                            sendKonamiCode(userId);
                            konamiCodePosition = 0;
                        }
                    } else {
                        konamiCodePosition = 0;
                    }
                });
            } else {
                console.error("Erreur lors de la récupération de l'ID de l'utilisateur:", xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error("Erreur lors de la requête AJAX.");
        };
        xhr.send();
    }

    // Récupérer l'ID de l'utilisateur une fois le DOM chargé
    getUserId();
});