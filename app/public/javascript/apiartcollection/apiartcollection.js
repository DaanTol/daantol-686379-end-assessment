function fetchArtworkData() {
    $.ajax({
        url: "https://api.artic.edu/api/v1/artworks?page=1&limit=42",
        type: "GET",
        success: function(data) {
            data.data.forEach(artwork => {
                $.ajax({
                    url: `https://api.artic.edu/api/v1/artworks/${artwork.id}/manifest.json`,
                    type: "GET",
                    success: function(manifestData) {
                        let artworkTitle = manifestData.label || 'Artwork title not found';
                        let artistName = manifestData.metadata[0].value || 'Artist name not found';
                        let imageUrl = manifestData.sequences[0].canvases && manifestData.sequences[0].canvases.length > 0 && manifestData.sequences[0].canvases[0].images && manifestData.sequences[0].canvases[0].images.length > 0 && manifestData.sequences[0].canvases[0].images[0].resource['@id'] || 'img/Image_not_available.png';
                        displayArtworkData(artworkTitle, artistName, imageUrl);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function displayArtworkData(artworkTitle, artistName, imageUrl) {
    // Create the HTML elements to display the data 
    let col = document.createElement('div');
    col.classList.add('col-sm-4', 'g-3');

    let card = document.createElement('div');
    card.classList.add('card', 'mb-4', 'rounded-3', 'shadow-sm');
    card.style.width = '500px';
    card.style.height = '650px';

    let cardHeader = document.createElement('div');
    cardHeader.classList.add('card-header', 'py-3');

    let artworkTitleElement = document.createElement('h4');
    artworkTitleElement.classList.add('title-name', 'my-0', 'fw-normal', 'text-center');
    artworkTitleElement.textContent = artworkTitle;

    let cardBody = document.createElement('div');
    cardBody.classList.add('card-body', 'text-center', 'flex-column', 'd-flex');

    let image = document.createElement('img');
    image.src = imageUrl;
    image.classList.add('card-picture');
    image.style.width = '390px';
    image.style.height = '300px';

    let artistNameElement = document.createElement('p');
    artistNameElement.classList.add('artist-name', 'my-0', 'fw-normal', 'text-center');
    artistNameElement.textContent = `Artist name: ${artistName}`;

    let startAuction = document.createElement('button');
    startAuction.classList.add('bidButton', 'btn-default', 'btn-lg', 'btn-outline-primary', 'mt-auto');
    startAuction.textContent = "Start Bid On Artwork";
    startAuction.setAttribute('data-title', artworkTitle);
    startAuction.setAttribute('data-image-url', imageUrl);
    startAuction.setAttribute('data-artist-name', artistName);
    startAuction.setAttribute('data-toggle', 'modal');
    startAuction.setAttribute('data-target', '#placeItemModal');
    startAuction.addEventListener('click', updateModal);

    // Append the elements to the web page
    cardHeader.appendChild(artworkTitleElement);
    cardBody.appendChild(image);
    cardBody.appendChild(artistNameElement);

    if(userLoggedIn) {
        cardBody.appendChild(startAuction);
    }

    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    col.appendChild(card);
    document.querySelector("#artworks-container").appendChild(col);
}
// Call the fetchArtworkData function on page load
window.onload = fetchArtworkData();