<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/login.php';

class LoginRepository extends Repository
{
    public function getUser(string $username, string $password): ?Login
    {
        try {
            // Prepare the statement
            $stmt = $this->connection->prepare("SELECT `id`, `username`, `email`, `created_datetime`, `password` FROM `users` WHERE username = :username OR email = :email");

            // Bind the parameters
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $username, PDO::PARAM_STR);

            // Execute the statement
            $stmt->execute();

            // Fetch the result
            $user = $stmt->fetchObject('Login');

            // Check if the provided password matches the hashed password in the database
            if ($user && password_verify($password, $user->getPasswordHash())) {
                return $user;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function insert(string $username, string $email, string $password): bool
    {
        try {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $created_datetime = date('Y-m-d H:i:s');

            // Prepare the statement
            $stmt = $this->connection->prepare("INSERT INTO `users` (username, email, created_datetime, password) VALUES (:username, :email, :created_datetime, :password)");

            // Bind the parameters
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':created_datetime', $created_datetime, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);

            // Execute the statement
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}