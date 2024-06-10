document.addEventListener("DOMContentLoaded", function() {
    let cardContainer = document.getElementById("card-container");
    if (cardContainer) {le
        console.log("Identifiant de carte :", test);
        cardContainer.innerHTML = "";
        fetch("https://api.pokemontcg.io/v1/cards?id=" + test)
            .then(response => response.json())
            .then(data => {
                if (data && data.cards) {
                    data.cards.forEach(card => {
                        let pokemonCard = document.createElement("img");
                        pokemonCard.className = "pkmn-card";
                        pokemonCard.src = card.imageUrlHiRes;
                        cardContainer.appendChild(pokemonCard);
                    });
                } else {
                    console.error("Aucune carte trouvée dans la réponse.");
                }
            })
            .catch(error => console.error("Erreur lors de la requête :", error));
    } else {
    }
});