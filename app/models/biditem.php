<?php

class BidItem
{
    private int $id;
    private string $title;
    private string $image_url;
    private float $current_offer;
    private string $artist_name;
    // user_id FOREIGN KEY users
    private int $user_id;
    // username users table JOIN
    private string $placed_by_username;
    private string $created_datetime;
    private string $deadline;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id 
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title 
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }


    /**
     * @return string
     */
    public function getImage_url(): string
    {
        return $this->image_url;
    }

    /**
     * @param string $image_url 
     * @return self
     */
    public function setImage_url(string $image_url): self
    {
        $this->image_url = $image_url;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrent_offer(): float
    {
        return $this->current_offer;
    }

    /**
     * @param float $current_offer 
     * @return self
     */
    public function setCurrent_offer(float $current_offer): self
    {
        $this->current_offer = $current_offer;
        return $this;
    }

    /**
     * @return string
     */
    public function getArtist_name(): string
    {
        return $this->artist_name;
    }

    /**
     * @param string $artist_name 
     * @return self
     */
    public function setArtist_name(string $artist_name): self
    {
        $this->artist_name = $artist_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getUser_id(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id 
     * @return self
     */
    public function setUser_id(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated_datetime(): string
    {
        return $this->created_datetime;
    }

    /**
     * @param string $created_datetime 
     * @return self
     */
    public function setCreated_datetime(string $created_datetime): self
    {
        $this->created_datetime = $created_datetime;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaced_by_username(): string
    {
        return $this->placed_by_username;
    }

    /**
     * @param string $placed_by_username 
     * @return self
     */
    public function setPlaced_by_username(string $placed_by_username): self
    {
        $this->placed_by_username = $placed_by_username;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeadline(): string
    {
        return $this->deadline;
    }

    /**
     * @param string $deadline 
     * @return self
     */
    public function setDeadline(string $deadline): self
    {
        $this->deadline = $deadline;
        return $this;
    }
}

?>