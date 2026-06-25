<?php 
define('ROOT_PATH', dirname(__DIR__));
define('BASE_URL', 'http://localhost/Ondacom/'); #Alterar na hora de subir

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); #Não precisa colocar o caminho de pastas
$dotenv->load();
?>