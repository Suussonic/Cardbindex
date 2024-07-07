document.addEventListener("DOMContentLoaded", function() {
    fetch("https://api.pokemontcg.io/v1/cards?setCode=swsh1")
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur lors de la récupération des données de la carte : " + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const cardContainer = document.getElementById("card-container");
            data.cards.forEach(card => {
                let pokemonCard = document.createElement("img");
                pokemonCard.classList.add("card");
                pokemonCard.src = card.imageUrlHiRes;
                pokemonCard.dataset.cardId = card.id;
                cardContainer.appendChild(pokemonCard);
            });

            document.querySelectorAll(".card").forEach(cardElement => {
                cardElement.addEventListener("click", function() {
                    let cardId = this.dataset.cardId;
                    fetch("recherche.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: new URLSearchParams({ cardId: cardId })
                    })
                    .then(response => {
                        if (response.ok) {
                            console.log("ID de la carte stocké avec succès !");
                            alert("ID de la carte " + cardId + " stocké avec succès !");
                        } else {
                            console.error("Erreur lors du stockage de l'ID de la carte :", response.statusText);
                        }
                    })
                    .catch(error => {
                        console.error("Erreur lors de la requête POST :", error);
                    });
                });
            });
        })
        .catch(error => {
            console.error("Erreur lors de la requête :", error);
        });
});