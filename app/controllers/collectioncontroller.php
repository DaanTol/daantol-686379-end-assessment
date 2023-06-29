<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/collectionservice.php';

class CollectionController extends Controller
{
    private $collectionservice;

    function __construct()
    {
        $this->collectionservice = new CollectionService();
    }

    public function index()
    {
        require __DIR__ . '/../views/collection/index.php';
    }

    public function placeItem()
    {
        $user_id = intval($_POST['user_id']);
        $title = htmlspecialchars($_POST['title']);
        $image_url = htmlspecialchars($_POST['image_url']);
        $artist_name = htmlspecialchars($_POST['artist_name']);
        $current_offer = htmlspecialchars($_POST['current_offer']);

        $result = $this->collectionservice->placeItem($user_id, $title, $image_url, $artist_name, $current_offer);

        if ($result) {
            // return succes response
            $this->index();
            echo "<script>$('#successModal').modal('show')</script>";
        } else {
            // return error response
            $this->index();
            echo "<script>$('#errorBidModal').modal('show')</script>";
        }
    }
}
?>