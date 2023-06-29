function searchFunction() {
    var searchValue = document.querySelector('.form-control').value;
    var artworks = document.querySelectorAll('.card');

    if (searchValue === '') {
        artworks.forEach(function(artwork) {
            artwork.style.display = 'flex';
        });
    } else {
        var filteredArtworks = Array.from(artworks).filter(function(artwork) {
            return artwork.querySelector('.title-name').innerText.toLowerCase().includes(searchValue.toLowerCase()) 
            || artwork.querySelector('.artist-name').innerText.toLowerCase().includes(searchValue.toLowerCase());
        });
    }

    filteredArtworks.forEach(function(artwork) {
        artwork.style.display = 'flex';
    });

    var nonFilteredArtwork = Array.from(artworks).filter(function(artwork) {
        return !filteredArtworks.includes(artwork);
    });

    nonFilteredArtwork.forEach(function(artwork) {
        artwork.style.display = 'none';
    });
}
