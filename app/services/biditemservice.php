<?php
require __DIR__ . '/../repositories/biditemrepository.php';


class BidItemService
{
    private $bidItemRepository;

    function __construct()
    {
        $this->bidItemRepository = new BidItemRepository();
    }

    public function getBids()
    {
        return $this->bidItemRepository->getBids();
    }

    public function updateBid(int $id, float $current_offer): bool
    {
        return $this->bidItemRepository->updateBid($id, $current_offer);
    }

    public function deleteBid(int $id, int $user_id)
    {
        return $this->bidItemRepository->deleteBid($id, $user_id);
    }

    public function getCurrentOffer(int $id)
    {
        return $this->bidItemRepository->getCurrentOffer($id);
    }

}

?>