<?php

class Login
{

    private int $id;
    private string $username;
    private string $email;
    private string $created_datetime;
    private string $password;

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username 
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email 
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
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
    public function getPasswordHash(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return self
     */
    public function setPasswordHash(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }
}

?>