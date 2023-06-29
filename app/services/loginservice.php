<?php
require __DIR__ . '/../repositories/loginrepository.php';


class LoginService
{
    private $loginRepository;

    function __construct()
    {
        $this->loginRepository = new LoginRepository();
    }

    public function getUser($username, $password)
    {
        // retrieve data
        return $this->loginRepository->getUser($username, $password);
    }

    public function insert($username, $email, $password)
    {
        // retrieve data
        return $this->loginRepository->insert($username, $email, $password);
    }
}

?>