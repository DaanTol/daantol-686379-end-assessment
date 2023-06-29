function updateModal(event) {
    let button = event.target;
    let bidItemId= event.target.dataset.id;
    let title = button.dataset.title;
    let imageUrl = button.dataset.imageUrl;

    document.getElementById("biditem-id").value = bidItemId;
    document.getElementById("modal-title").innerHTML = `Place bid for ${title}`;
    document.getElementById("modal-image-url").src = `${imageUrl}`;
}