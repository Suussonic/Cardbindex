$(document).ready(function() {
    console.log("Identifiant de carte :", test);
    $("#card-container").empty();
    $.ajax({
        method: "GET",
        url: "https://api.pokemontcg.io/v1/cards?id=" + test
    }).then(function(response) {
        for (var i = 0; i < response.cards.length; i++) {
        var pokemonCard = $("<img class='pkmn-card'>");
        pokemonCard.attr("src", response.cards[i].imageUrlHiRes);
        $("#card-container").append(pokemonCard);
        }
    });
});