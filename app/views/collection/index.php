<?php require_once('/app/sessionstart.php') ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/collectionstyle/style.css">
    <link rel="stylesheet" href="css/navbarstyle/style.css">
    <link rel="stylesheet" href="css/mainstyle/style.css">
    <title>Collection</title>
</head>

<body>
    <header class="p-3 text-bg-dark sticky-top">
        <div class="container">
            <div class="d-flex sticky-top flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <?php require('/app/sessionuser.php') ?>
                    <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="/buysell" class="nav-link px-2 text-white">Buy/Sell</a></li>
                    <li><a href="/collection" class="nav-link px-2 text-warning">Collection</a></li>
                </ul>

                <div class="text-end">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="/logout" class="btn btn-outline-primary text-white">Logout</a>
                    <?php else: ?>
                        <a href="/login" class="btn btn-outline-primary text-white">Login</a>
                        <a href="/signup" class="btn btn-outline-primary text-white">Sign-up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light text-white">Our wonderfull art collection!</h1>
                    <p class="lead text-white">Please select one of our artpieces and start a auction on it based on the
                        collection below.</p>
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" />
                        <button type="button" class="search btn btn-outline-primary text-white"
                            onclick="searchFunction()">search</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light">
            <div class="container">
                <div class="row d-flex" id="artworks-container"></div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="placeItemModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Place bid for
                            artworkTitle
                        </h5>
                        <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <img src="imageUrl" class="modal-image-url" id="modal-image-url" width="400" height="300">

                        <form action="/collection" method="post">
                            <input type="hidden" name="title" class="modal-title-input" id="modal-title-input"
                                value="artworkTitle">
                            <input type="hidden" name="artist_name" class="modal-artist-name-input"
                                id="modal-artist-name-input" value="artworkName">
                            <input type="hidden" name="image_url" class="modal-image-url-input"
                                id="modal-image-url-input" width="400" height="300" value="imageUrl">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                            <div class="form-floating mb-3">
                                <input name="current_offer" class="form-control rounded-3" type="text" id="bidAmount"
                                    placeholder="Enter the start amount to begin the auction">
                                <label for="bidAmount">Enter the start amount to begin the auction</label>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" onclick="placeItem()">Start Auction On
                                    Artwork</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal success -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Item has been successfully added to the Buy/Sell page.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Error Bid modal -->
    <div class="modal fade" id="
    errorBidModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>There went something wrong with placing your artpiece.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="javascript/itemfunction/itemfunction.js"></script>
    <script src="javascript/apiartcollection/apiartcollection.js"></script>
    <script src="javascript/searchfunction/searchfunction.js"></script>
    <script>
        var userLoggedIn = <?php echo (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) ? 'true' : 'false'; ?>;
    </script>
</body>

</html>