
<?php 

use Core\App;
use Core\Database;
$db= App::resolve(Database::class);

$db->query('delete FROM orders where id = :id ' ,[
  'id' => $_POST['id']
]);

header('location: /order');
exit;