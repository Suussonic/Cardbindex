//RECHERCHE DES CARTES

//$("#submit-button").on("click", function(event) {
//  $("#card-container").empty();
//  event.preventDefault();
//  var pokemon = $("#search")
//    .val()
//    .trim();
//
//  $.ajax({
//    method: "GET",
//    url: "https://api.pokemontcg.io/v1/cards?name=" + pokemon
//  }).then(function(response) {
//    for (var i = 0; i < response.cards.length; i++) {
//      var pokemonCard = $("<img class='pkmn-card'>");
//      pokemonCard.attr("src", response.cards[i].imageUrlHiRes);
//      $("#card-container").append(pokemonCard);
//    }
//  });
//});


//GET https://api.pokemontcg.io/v2/cards?q=name:gardevoir (subtypes:mega OR subtypes:vmax)
//url: "https://api.pokemontcg.io/v1/cards?id=" + pokemon
//https://docs.pokemontcg.io/api-reference/cards/card-object#id-string


//RECUPERATION DE L'ID DANS LA CONSOLE
//
//$(document).ready(function() {
//    $("#submit-button").on("click", function(event) {
//        $("#card-container").empty();
//        event.preventDefault();
//        var pokemon = $("#search").val().trim();
//
//        $.ajax({
//            method: "GET",
//            url: "https://api.pokemontcg.io/v1/cards?name=" + pokemon
//        }).then(function(response) {
//            for (var i = 0; i < response.cards.length; i++) {
//                var pokemonCard = $("<img class='pkmn-card'>");
//                pokemonCard.attr("src", response.cards[i].imageUrlHiRes);
//                pokemonCard.data("card-id", response.cards[i].id);
//                $("#card-container").append(pokemonCard);
//            }
//            $(".pkmn-card").on("click", function() {
//                console.log("Clic détecté !");
//                var cardId = $(this).data("card-id");
//                console.log("ID de la carte :", cardId);
//                // Ajoutez ici le code pour envoyer l'ID de la carte à votre backend
//            });
//        });
//    });
//});


$(document).ready(function() {
    $("#submit-button").on("click", function(event) {
        $("#card-container").empty();
        event.preventDefault();
        var pokemon = $("#search").val().trim();

        $.ajax({
            method: "GET",
            url: "https://api.pokemontcg.io/v2/cards?q=set.name=" + pokemon
        }).then(function(response) {
            for (var i = 0; i < response.cards.length; i++) {
                var pokemonCard = $("<img class='pkmn-card'>");
                pokemonCard.attr("src", response.cards[i].imageUrlHiRes);
                pokemonCard.data("card-id", response.cards[i].id);
                $("#card-container").append(pokemonCard);
            }
            
            // Ajouter un gestionnaire d'événements clic pour chaque carte Pokémon après qu'elles soient chargées
            $(".pkmn-card").on("click", function() {
                var cardId = $(this).data("card-id");
                $.ajax({
                    method: "POST",
                    url: "recherche.php",
                    data: { cardId: cardId },
                    success: function(response) {
                        console.log("ID de la carte stocké avec succès !");
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur lors du stockage de l'ID de la carte :", error);
                    }
                });
            });
        });
    });
});