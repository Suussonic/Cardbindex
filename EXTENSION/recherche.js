document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("submit-button").addEventListener("click", function(event) {
        document.getElementById("card-container").innerHTML = "";
        event.preventDefault();
        let pokemon = document.getElementById("search").value.trim();

        fetch("https://api.pokemontcg.io/v1/cards?name=" + pokemon)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erreur lors de la récupération des données de la carte : " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                data.cards.forEach(card => {
                    let pokemonCard = document.createElement("img");
                    pokemonCard.classList.add("pkmn-card");
                    pokemonCard.src = card.imageUrlHiRes;
                    pokemonCard.dataset.cardId = card.id;
                    document.getElementById("card-container").appendChild(pokemonCard);
                });
            })
            .catch(error => {
                console.error("Erreur lors de la requête :", error);
            });
    });
});
