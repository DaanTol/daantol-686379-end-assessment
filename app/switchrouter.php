<?php
class SwitchRouter
{
    public function route($uri)
    {
        require_once('sessionstart.php');
        date_default_timezone_set('Europe/Amsterdam');
        // using a simple switch statement to route URL's to controller methods
        switch ($uri) {

            case '':
                require __DIR__ . '/controllers/homecontroller.php';
                $controller = new HomeController();
                $controller->index();
                break;

            case 'signup':
                require __DIR__ . '/controllers/signupcontroller.php';
                $controller = new SignUpController();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->signup();
                } else {
                    $controller->index();
                }
                break;

            case 'login':
                require __DIR__ . '/controllers/logincontroller.php';
                $controller = new LoginController();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->checkLogin();
                } else {
                    $controller->index();
                }
                break;

            case 'logout':
                require __DIR__ . '/controllers/logincontroller.php';
                unset($_SESSION['username']);
                unset($_SESSION['user_id']);
                $controller = new LoginController();
                $controller->index();
                break;

            case 'buysell':
                require __DIR__ . '/controllers/biditemcontroller.php';
                $controller = new BidItemController();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['remove-button'])) {
                        $controller->deleteBid();
                    } else {
                        $controller->updateBid();
                    }
                } else {
                    $controller->index();
                }
                break;

            case 'buysell/api':
                require __DIR__ . '/controllers/biditemcontroller.php';
                $controller = new BidItemController();
                $controller->getBidItemsJson();
                break;

            case 'collection':
                require __DIR__ . '/controllers/collectioncontroller.php';
                $controller = new CollectionController();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->placeItem();
                } else {
                    $controller->index();
                }
                break;

            default:
                http_response_code(404);
                break;
        }
    }
}
?>