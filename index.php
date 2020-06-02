<?PHP
include_once 'app/Loader.php';

spl_autoload_register('Loader::loadClass');

//$bunny = new app\Bunny();

session_start();
// Set session variables
$router = new app\Router();
$router->start();