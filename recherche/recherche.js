document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("submit-button").addEventListener("click", function(event) {
        document.getElementById("card-container").innerHTML = "";
        event.preventDefault();
        let pokemon = document.getElementById("search").value.trim();

        let xhr = new XMLHttpRequest();
        xhr.open("GET", "https://api.pokemontcg.io/v1/cards?name=" + pokemon, true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                let response = JSON.parse(xhr.responseText);
                for (let i = 0; i < response.cards.length; i++) {
                    let pokemonCard = document.createElement("img");
                    pokemonCard.classList.add("pkmn-card");
                    pokemonCard.src = response.cards[i].imageUrlHiRes;
                    pokemonCard.dataset.cardId = response.cards[i].id;
                    document.getElementById("card-container").appendChild(pokemonCard);
                }

                let cardElements = document.querySelectorAll(".pkmn-card");
                cardElements.forEach(function(cardElement) {
                    cardElement.addEventListener("click", function() {
                        let cardId = this.dataset.cardId;
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "recherche.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log("ID de la carte stocké avec succès !");
                                } else {
                                    console.error("Erreur lors du stockage de l'ID de la carte :", xhr.statusText);
                                }
                            }
                        };
                        xhr.send("cardId=" + cardId);
                    });
                });
            } else {
                console.error("Erreur lors de la récupération des données de la carte :", xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error("Erreur lors de la requête AJAX.");
        };
        xhr.send();
    });
});