<?php 
$host = 'localhost';
$port = '3306';
$dbname = 'product_crud';
$user = 'root';
$password = '';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname";
$pdo = new PDO($dsn,$user,$password);
$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


$id = $_POST['id'] ?? null;

if(!$id){
    header('Location:index.php');
}

$statement = $pdo -> prepare("DELETE FROM products WHERE id = :id");
$statement -> bindValue(':id' , $id);
$statement -> execute();
header('Location:index.php');
?>