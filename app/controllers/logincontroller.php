<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/loginservice.php';

class LoginController extends Controller
{

    private $loginservice;

    // initialize services
    function __construct()
    {
        $this->loginservice = new LoginService();
    }

    public function index()
    {
        require __DIR__ . '/../views/login/index.php';
    }

    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $user = $this->loginservice->getUser($username, $password);
                if ($user) {
                    if (password_verify($password, $user->getPasswordHash())) {
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $user->getId();
                        require __DIR__ . '/../views/home/index.php';
                    }
                } else {
                    $this->index();
                    echo '<p style="color:white;">Invalid username or password</p>';
                }
            } else {
                $this->index();
                echo '<p style="color:white;">Invalid username or password</p>';
            }
        }
    }
}
?>