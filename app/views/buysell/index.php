<?php require_once('/app/sessionstart.php') ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/buysellstyle/style.css">
    <link rel="stylesheet" href="css/navbarstyle/style.css">
    <link rel="stylesheet" href="css/mainstyle/style.css">
    <title>Buy/Sell</title>
</head>

<body onload="saveOriginalHTMLView()">
    <header class="p-3 text-bg-dark sticky-top">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <?php require('/app/sessionuser.php') ?>
                    <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="/buysell" class="nav-link px-2 text-warning">Buy/Sell</a></li>
                    <li><a href="/collection" class="nav-link px-2 text-white">Collection</a></li>
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
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <h3 class="sidebar-title text-center">
                    Price
                </h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sortCheckLowToHigh"
                        onclick="sortLowToHigh()">
                    <label class="form-check-label" for="sortCheck">
                        Price (Low to High)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sortCheckHighToLow"
                        onclick="sortHighToLow()">
                    <label class="form-check-label" for="flexCheckDefault">
                        Price (High to Low)
                    </label>
                </div>

                <h3 class="sidebar-title text-center">
                    Artist Name
                </h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sortCheckArtistNameAToZ"
                        onclick="sortAToZArtist()">
                    <label class="form-check-label" for="flexCheckDefault">
                        Artist (A To Z)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sortCheckArtistNameZToA"
                        onclick="sortZToAArtist()">
                    <label class="form-check-label" for="flexCheckDefault">
                        Artist (Z To A)
                    </label>
                </div>

                <h3 class="sidebar-title text-center">
                    Title
                </h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sortCheckTitleAToZ"
                        onclick="sortAToZTitle()">
                    <label class="form-check-label" for="flexCheckDefault">
                        Title (A To Z)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sortCheckTitleZToA"
                        onclick="sortZToATitle()">
                    <label class="form-check-label" for="flexCheckDefault">
                        Title (Z To A)
                    </label>
                </div>

                <h3 class="sidebar-title text-center">
                    API Biditems
                </h3>
                <div class="row">
                    <a href="/buysell/api" target="_blank" class="text-center">JSON for Biditems</a>
                </div>
            </ul>
        </div>

        <div class="py-5">
            <div class="container" id="artworkContainer">
                <div class="row row-cols-1 row-cols-sm-2 g-3">
                    <?php foreach ($filtered_biditems as $biditem): ?>
                        <div class="col">
                            <div class="card mb-4 rounded-3 shadow-sm" style="width: 500px; height: 650px;">
                                <div class="card-header py-3">
                                    <h4 class="my-0 fw-normal text-center">
                                        <?= $biditem->getTitle() ?>
                                    </h4>
                                </div>
                                <div class="card-body text-center flex-column d-flex">
                                    <img src="<?= $biditem->getImage_url() ?>" class="card-picture" width="467"
                                        height="300">
                                    <p class="card-text text-danger">
                                        Remaining Time:
                                        <span data-deadline="<?= $biditem->getDeadline() ?>"
                                            data-id="<?= $biditem->getId() ?>" data-title="<?= $biditem->getTitle() ?>"
                                            data-artist-name="<?= $biditem->getArtist_name() ?>"
                                            data-current-user="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>"
                                            data-placed-by-user="<?= $biditem->getUser_id() ?>"
                                            data-current-offer="<?= number_format($biditem->getCurrent_offer(), 2) ?>"
                                            id="countdown"></span>
                                    </p>
                                    <p class="card-text">Placed By User:
                                        <?= $biditem->getPlaced_by_username() ?>
                                    </p>
                                    <p class="card-text">Current Offer: €
                                        <?= number_format($biditem->getCurrent_offer(), 2) ?>
                                    </p>
                                    <p class="card-text">
                                        <?= $biditem->getArtist_name() ?>
                                    </p>
                                    <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
                                        <?php if (strtotime(date('Y-m-d H:i:s')) < strtotime($biditem->getDeadline())): ?>
                                            <button type="button"
                                                class="btn-default btn-lg btn-outline-primary mt-auto btn-place-bid"
                                                data-id="<?= $biditem->getId() ?>" data-title="<?= $biditem->getTitle() ?>"
                                                data-image-url="<?= $biditem->getImage_url() ?>"
                                                data-artist-name="<?= $biditem->getArtist_name() ?>" data-toggle="modal"
                                                data-target="#placeBidModal" onclick="updateModal(event)">Place Bid</button>
                                        <?php elseif (strtotime(date('Y-m-d H:i:s')) > strtotime($biditem->getDeadline()) && $biditem->getUser_id() == $_SESSION['user_id']): ?>
                                            <form action="/buysell" method="post">
                                                <input type="hidden" name="id" value="<?= $biditem->getId() ?>">
                                                <input type="hidden" name="user_id" value="<?= $biditem->getUser_id() ?>">
                                                <button type="submit" name="remove-button"
                                                    class="btn-default btn-lg btn-outline-primary mt-auto btn-remove"
                                                    id="remove-button">
                                                    Remove</button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="placeBidModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Place bid for
                        <?= $biditem->getTitle() ?>
                    </h5>
                    <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= $biditem->getImage_url() ?>" class="modal-image-url" id="modal-image-url" width="400"
                        height="300">
                    <form action="/buysell" method="post">
                        <input type="hidden" name="id" id="biditem-id">
                        <div class="form-floating mb-3">
                            <input class="form-control rounded-3" type="text" id="bidAmount" name="current_offer"
                                placeholder="Enter your bid amount">
                            <label for="bidAmount">Enter your bid amount</label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="updateBid()">Place Bid</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal when item is sold -->
    <div id="itemSoldModal" class="itemSoldModal">
        <div class="modal-content-sold">
            <span class="close-modal-sold">&times;</span>
            <p id="modal-message"></p>
        </div>
    </div>

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
                    <p>Bid changed successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal removed -->
    <div class="modal fade" id="successRemoveModal" tabindex="-1" role="dialog"
        aria-labelledby="successRemoveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successRemoveModalLabel">Removed</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Bid has been removed successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bid must be higher success -->
    <div class="modal fade" id="higherBidModal" tabindex="-1" role="dialog" aria-labelledby="higherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="higherModalLabel">Must be higher</h5>
                    <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Bid must be higher then current value.</p>
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
                    <p>There was a error while processing the bid.</p>
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
    <script src="javascript/biditemjs/bidfuntions.js"></script>
    <script src="javascript/sorting/sorting.js"></script>
    <script src="javascript/deadlinefunction/deadlinefunction.js"></script>
    <script src="javascript/sortitems/sortitems.js"></script>
</body>

</html>