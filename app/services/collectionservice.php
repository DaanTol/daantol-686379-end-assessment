<?php
require __DIR__ . '/../repositories/collectionrepository.php';


class CollectionService
{
    private $collectionRepository;

    function __construct()
    {
        $this->collectionRepository = new CollectionRepository();
    }

    public function placeItem(int $user_id, string $title, string $image_url, string $artist_name, float $current_offer): bool
    {
        return $this->collectionRepository->placeItem($user_id, $title, $image_url, $artist_name, $current_offer);
    }

    public function filterByUserId($user_id)
    {
        return $this->collectionRepository->filterByUserId($user_id);
    }
}

?>