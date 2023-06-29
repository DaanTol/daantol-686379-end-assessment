let shownAlerts = {};

setInterval(function(){

    var elements = document.querySelectorAll("[data-deadline]");


    for(var i=0; i < elements.length; i++) {

        var deadline = new Date(elements[i].getAttribute("data-deadline"));

        var now = new Date();

        var remainingTime = deadline - now;
        if(remainingTime > 0) {

            var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            elements[i].innerHTML =  minutes + "m " + seconds + "s ";
        } else {
             if(elements[i].getAttribute("data-current-user") == elements[i].getAttribute("data-placed-by-user") && !shownAlerts[elements[i].getAttribute("data-id")]) {

                var modal = document.getElementById("itemSoldModal");
                var modalMessage = document.getElementById("modal-message");

                modalMessage.innerHTML = "Auction Ended. The artwork you posted: '" + elements[i].getAttribute("data-title") + "' has been sold for: €" + elements[i].getAttribute("data-current-offer") + " congrats! <br> You are now able to remove your artwork please refresh the page if it isn't visible yet.";
                var closeModal = document.getElementsByClassName("close-modal-sold")[0];

                modal.style.display = "block";

                closeModal.onclick = function() {
                    modal.style.display = "none";
                }
                shownAlerts[elements[i].getAttribute("data-id")] = true;
            }
            elements[i].innerHTML =  "Auction Ended";
        }
    }
}, 1000);
