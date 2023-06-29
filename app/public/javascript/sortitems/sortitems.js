var originalView;

var checkboxChecked = false;

var checkboxLowToHigh = document.getElementById("sortCheckLowToHigh");
var checkboxHighToLow = document.getElementById("sortCheckHighToLow");

var checkboxAToZArtist = document.getElementById("sortCheckArtistNameAToZ");
var checkboxZToAArtist = document.getElementById("sortCheckArtistNameZToA");

var checkboxAToZTitle = document.getElementById("sortCheckTitleAToZ");
var checkboxZToATitle = document.getElementById("sortCheckTitleZToA");

function saveOriginalHTMLView() {
  var cardContainer = document.getElementById("artworkContainer");
  originalView = cardContainer.innerHTML;
}

function sortLowToHigh() {
  if (!checkboxLowToHigh.checked) {
    resetCards();
  } else {
    checkboxChecked = true;
    var cardContainer = document.getElementById("artworkContainer");
    var cards = cardContainer.getElementsByClassName("card");
  
    var cardsArray = [].slice.call(cards);
  
    cardsArray.sort(function (cardA, cardB) {
      var currentOfferA = parseFloat(cardA.getElementsByClassName("card-text")[2].innerText.split("€ ")[1]);
      var currentOfferB = parseFloat(cardB.getElementsByClassName("card-text")[2].innerText.split("€ ")[1]);
      return currentOfferA - currentOfferB;
    });
    updateCards(cardsArray);
    checkboxHighToLow.checked = false;
    checkboxAToZTitle.checked = false;
    checkboxZToATitle.checked = false;
    checkboxAToZArtist.checked = false;
    checkboxZToAArtist.checked = false;
  }
}

function sortHighToLow() {
  if (!checkboxHighToLow.checked) {
    resetCards();
  } else {
    checkboxChecked = true;
    var cardContainer = document.getElementById("artworkContainer");
    var cards = cardContainer.getElementsByClassName("card");
  
    var cardsArray = [].slice.call(cards);
  
    cardsArray.sort(function (cardA, cardB) {
      var currentOfferA = parseFloat(cardA.getElementsByClassName("card-text")[2].innerText.split("€ ")[1]);
      var currentOfferB = parseFloat(cardB.getElementsByClassName("card-text")[2].innerText.split("€ ")[1]);
      return currentOfferB - currentOfferA;
    });
    updateCards(cardsArray);
    checkboxLowToHigh.checked = false;
    checkboxAToZTitle.checked = false;
    checkboxZToATitle.checked = false;
    checkboxAToZArtist.checked = false;
    checkboxZToAArtist.checked = false;
  }
}

function sortAToZArtist() {
  if (!checkboxAToZArtist.checked) {
    resetCards();
  } else {
    checkboxChecked = true;
    var cardContainer = document.getElementById("artworkContainer");
    var cards = cardContainer.getElementsByClassName("card");
  
    var cardsArray = [].slice.call(cards);
  
    cardsArray.sort(function (cardA, cardB) {
      var artistNameA = cardA.getElementsByClassName("card-text")[3].innerText;
      var artistNameB = cardB.getElementsByClassName("card-text")[3].innerText;
      return artistNameA.localeCompare(artistNameB);
    });
    updateCards(cardsArray);
    checkboxZToAArtist.checked = false;
    checkboxAToZTitle.checked = false;
    checkboxZToATitle.checked = false;
    checkboxHighToLow.checked = false;
    checkboxLowToHigh.checked = false;
  }
}

function sortZToAArtist() {
  if (!checkboxZToAArtist.checked) {
    resetCards();
  } else {
    checkboxChecked = true;
    var cardContainer = document.getElementById("artworkContainer");
    var cards = cardContainer.getElementsByClassName("card");
  
    var cardsArray = [].slice.call(cards);
  
    cardsArray.sort(function (cardA, cardB) {
      var artistNameA = cardA.getElementsByClassName("card-text")[3].innerText;
      var artistnameB = cardB.getElementsByClassName("card-text")[3].innerText;
      return artistnameB.localeCompare(artistNameA);
    });
    updateCards(cardsArray);
    checkboxAToZArtist.checked = false;
    checkboxAToZTitle.checked = false;
    checkboxZToATitle.checked = false;
    checkboxHighToLow.checked = false;
    checkboxLowToHigh.checked = false;
  }
}

function sortAToZTitle() {
  if (!checkboxAToZTitle.checked) {
    resetCards();
  } else {
    checkboxChecked = true;
    var cardContainer = document.getElementById("artworkContainer");
    var cards = cardContainer.getElementsByClassName("card");
  
    var cardsArray = [].slice.call(cards);
  
    cardsArray.sort(function (cardA, cardB) {
      var titleNameA = cardA.getElementsByClassName("card-header")[0].innerText;
      var titleNameB = cardB.getElementsByClassName("card-header")[0].innerText;
      return titleNameA.localeCompare(titleNameB);
    });
    updateCards(cardsArray);

    checkboxZToATitle.checked = false;
    checkboxAToZArtist.checked = false;
    checkboxZToAArtist.checked = false;
    checkboxHighToLow.checked = false;
    checkboxLowToHigh.checked = false;
  }
}

function sortZToATitle() {
  if (!checkboxZToATitle.checked) {
    resetCards();
  } else {
    checkboxChecked = true;
    var cardContainer = document.getElementById("artworkContainer");
    var cards = cardContainer.getElementsByClassName("card");
  
    var cardsArray = [].slice.call(cards);
  
    cardsArray.sort(function (cardA, cardB) {
      var titleNameA = cardA.getElementsByClassName("card-header")[0].innerText;
      var titleNameB = cardB.getElementsByClassName("card-header")[0].innerText;
      return titleNameB.localeCompare(titleNameA);
    });
    updateCards(cardsArray);

    checkboxAToZTitle.checked = false;
    checkboxAToZArtist.checked = false;
    checkboxAToZArtist.checked = false;
    checkboxHighToLow.checked = false;
    checkboxLowToHigh.checked = false;
  }
}

function updateCards(cardsArray) {
  var cardContainer = document.getElementById("artworkContainer");

    // Clear the container element
    while (cardContainer.firstChild) {
      cardContainer.removeChild(cardContainer.firstChild);
  }

    // Create a new row element for every two cards and append the cards to that row
    for (var i = 0; i < cardsArray.length; i += 2) {
      var row = document.createElement("div");
      row.classList.add("row", "row-cols-1", "row-cols-sm-2", "g-3");

      for (var j = i; j < i + 2 && j < cardsArray.length; j++) {
          var col = document.createElement("div");
          col.classList.add("col");
          col.appendChild(cardsArray[j]);
          row.appendChild(col);
      }
      cardContainer.appendChild(row);
  }
}

function resetCards() {
  if (checkboxChecked) {
    var cardContainer = document.getElementById("artworkContainer");
    cardContainer.innerHTML = originalView;
    saveOriginalHTMLView();
    checkboxChecked = false;
  }
}
