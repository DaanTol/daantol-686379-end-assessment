<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/biditemservice.php';

class BidItemController extends Controller
{
    private $biditemservice;

    function __construct()
    {
        $this->biditemservice = new BidItemService();
    }

    public function index()
    {
        $biditems = $this->biditemservice->getBids();
        $filtered_biditems = $this->bidItemFilter($biditems);
        require __DIR__ . '/../views/buysell/index.php';
    }

    public function getBidItemsJson()
    {
        $biditems = $this->biditemservice->getBids();
        $data = [];
        foreach ($biditems as $biditem) {
            $data[] = [
                'painting_title' => $biditem->getTitle(),
                'artist' => $biditem->getArtist_name(),
                'placed by user' => $biditem->getPlaced_by_username(),
                'current offer' => $biditem->getCurrent_offer()
            ];
        }
        $json = json_encode($data);
        header('Content-Type: application/json');
        echo $json;
    }


    public function updateBid()
    {
        $id = intval($_POST['id']);
        $new_offer = htmlspecialchars($_POST['current_offer']);

        $current_offer = $this->biditemservice->getCurrentOffer($id);

        if ($new_offer > $current_offer) {
            $result = $this->biditemservice->updateBid($id, $new_offer);

            if ($result) {
                // return succes response
                $this->index();
                echo "<script>$('#successModal').modal('show')</script>";
            } else {
                // return error response
                $this->index();
                echo "<script>$('#errorBidModal').modal('show')</script>";
            }
        } else {
            $this->index();
            echo "<script>$('#higherBidModal').modal('show')</script>";
        }
    }

    public function deleteBid()
    {
        $id = intval($_POST['id']);
        $user_id = intval($_POST['user_id']);

        $result = $this->biditemservice->deleteBid($id, $user_id);

        if ($result) {
            // return succes response
            $this->index();
            echo "<script>$('#successRemoveModal').modal('show')</script>";
        } else {
            // return error response
            $this->index();
            echo "<script>$('#higherBidModal').modal('show')</script>";
        }
    }

    public function bidItemFilter($biditems)
    {
        $grouped_biditems = [];

        foreach ($biditems as $biditem) {
            $title = $biditem->getTitle();
            if (!isset($grouped_biditems[$title])) {
                $grouped_biditems[$title] = [];
            }
            $grouped_biditems[$title][] = $biditem;
        }

        $filteredBidItems = [];
        foreach ($grouped_biditems as $title => $items) {
            usort($items, function ($bidItemA, $bidItemB) {
                return $bidItemA->getCurrent_offer() - $bidItemB->getCurrent_offer();
            });
            $filteredBidItems[$title] = array_slice($items, 0, 1)[0];
        }

        return $filteredBidItems;
    }
}
?>