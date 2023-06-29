<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/loginservice.php';

class SignUpController extends Controller
{
    private $loginservice;

    function __construct()
    {
        $this->loginservice = new LoginService();
    }

    public function index()
    {
        require __DIR__ . '/../views/signup/index.php';
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                // redirect or add an error message
                $this->index();
                echo '<p style="color:white;"> All fields must be filled out </p>';
            } else {
                if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
                    $username = htmlspecialchars($_POST['username']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    if ($this->loginservice->insert($username, $email, $password)) {
                        $this->index();
                        echo '<p style="color:white;">Account created successfully</p>';
                    } else {
                        $this->index();
                        echo '<p style="color:white;">Error creating account</p>';
                    }
                }
            }
        }
    }
}
?>