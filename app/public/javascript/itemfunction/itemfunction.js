function updateModal(event) {
    let button = event.target;
    let title = button.dataset.title;
    let imageUrl = button.dataset.imageUrl;
    let artistName = button.dataset.artistName;
    document.getElementById("modal-title").innerHTML = `Start auction for ${title}`;
    document.getElementById("modal-image-url").src = `${imageUrl}`;

    document.getElementById("modal-title-input").value = title;
    document.getElementById("modal-image-url-input").value = imageUrl;
    document.getElementById("modal-artist-name-input").value = artistName;
}