<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/biditem.php';

class CollectionRepository extends Repository
{
    public function placeItem(int $user_id, string $title, string $image_url, string $artist_name, float $current_offer): bool
    {
        try {
            $local_time = date('Y-m-d H:i:s');
            $deadline = date("Y-m-d H:i:s", strtotime("+60 minutes"));

            $stmt = $this->connection->prepare("INSERT INTO `biditems` (`title`, `image_url`, `current_offer`, `artist_name`, `user_id`, `created_datetime`, `deadline`) VALUES ( :title, :image_url, :current_offer, :artist_name, :user_id, :created_datetime, :deadline)");


            // Bind the parameters
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
            $stmt->bindParam(':current_offer', $current_offer, PDO::PARAM_INT);
            $stmt->bindParam(':artist_name', $artist_name, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':created_datetime', $local_time, PDO::PARAM_STR);
            $stmt->bindParam(':deadline', $deadline, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function filterByUserId(int $user_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT `id`, `title`, `image_url`, `current_offer`, `artist_name`, `user_id`, `created_datetime`, `deadline` FROM `biditems` WHERE user_id = :user_id");

            // Bind the user_id parameter
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch all the results
            $filtered_items = $stmt->fetchAll();

            return $filtered_items;
        } catch (PDOException $e) {
            return false;
        }
    }

}