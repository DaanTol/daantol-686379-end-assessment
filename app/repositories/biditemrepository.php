<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/biditem.php';

class BidItemRepository extends Repository
{
    public function getBids()
    {
        $biditems = array();
        $query = "SELECT b.id, b.title, b.image_url, b.current_offer, b.artist_name, b.user_id, b.created_datetime, b.deadline , u.username as placed_by_username FROM `biditems` b JOIN `users` u ON b.user_id = u.id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $row) {
            $biditem = new BidItem();
            $biditem->setId($row['id']);
            $biditem->setTitle($row['title']);
            $biditem->setImage_url($row['image_url']);
            $biditem->setCurrent_offer($row['current_offer']);
            $biditem->setArtist_name($row['artist_name']);
            $biditem->setUser_id($row['user_id']);
            $biditem->setPlaced_by_username($row['placed_by_username']);
            $biditem->setCreated_datetime($row['created_datetime']);
            $biditem->setDeadline($row['deadline']);
            array_push($biditems, $biditem);
        }
        return $biditems;
    }

    public function updateBid(int $id, float $current_offer): bool
    {
        try {
            // Prepare the statement
            $stmt = $this->connection->prepare("UPDATE `biditems` SET current_offer = :current_offer WHERE id = :id");

            // Bind the parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':current_offer', $current_offer, PDO::PARAM_INT);

            // Execute the statement
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteBid(int $id, int $user_id)
    {
        try {
            // Prepare the statement
            $stmt = $this->connection->prepare("SELECT `id`, `user_id` FROM `biditems` WHERE id = :id AND user_id = :user_id");

            // Bind the parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            // Execute the statement
            $stmt->execute();
            $item = $stmt->fetch();

            if (!$item || $item['user_id'] != $user_id) {
                return false;
            }

            $stmt = $this->connection->prepare("DELETE FROM `biditems` WHERE id = :id AND user_id = :user_id LIMIT 1");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getCurrentOffer(int $id)
    {
        $stmt = $this->connection->prepare("SELECT `current_offer` FROM `biditems` WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}