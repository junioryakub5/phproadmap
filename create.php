<?php
$host = 'localhost';
$port = '3306';
$dbname = 'product_crud';
$user = 'root';
$password ='';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname";
$pdo = new PDO($dsn,$user,$password);
$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// echo "<pre>";
// echo var_dump($_FILES);
// echo "</pre>";

//  exit();
$title ='';
$description ='';
$price ='';
$date ='';
$errors = [];

function RandomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) -1);
        $str .= $characters[$index];
    }
    return $str;

}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    // $image = $_POST['image'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = date("Y-m-d H:i:s");
    if(!$title){
        $errors[] = "title is required";
    }

    // if(!$image){
    //     $errors[] = "image is required";
    // }

    if(!$price){
        $errors[] = "price is required";
    }

    if(!is_dir('image')){
        mkdir('image');
    }


    if(empty($errors)){
        $image = $_FILES['image'] ?? null;
            if($image){
                $imagePath = 'image/'.RandomString(8).'/'.$image['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($image["tmp_name"],$imagePath);
            }
        $statement = $pdo -> prepare("INSERT INTO products(title ,image,describtion,price,create_date) 
        VALUES(:title, :image, :description, :price, :date)");
        $statement -> bindValue(':title', $title);
        $statement -> bindValue(':image', $imagePath);
        $statement -> bindValue(':description', $description);
        $statement -> bindValue(':price', $price);
        $statement -> bindValue(':date', $date);
        $statement -> execute();
            header("Location: index.php");

    }

}

// $statement = $pdo -> prepare('SELECT * FROM products ORDER BY create_date DESC');
// $statement -> execute();
// $products = $statement -> fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- custom css -->
     <link href="style/app.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>PRODUCTS CRUD</title>
  </head>
  <body>
    <h1> CREATE PRODUCTS </h1>
    <form action="" method="POST" enctype="multipart/form-data">

    <?php foreach($errors as $error) :?>
    <div class = "alert alert-danger">
        <div><?php echo $error?></div>
    </div>
    <?php endforeach; ?>
    <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Image</label> <br>
    <input type="file" namE="image">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Product title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $title?>">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Description</label>
    <textarea class="form-control" name="description" value="<?php echo $description?>"></textarea>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label" name="price">price</label>
    <input type="number" step=".01" class="form-control" name="price"value="<?php echo $price?>" >
  </div>
  <button type="submit" class="btn btn-primary" >Submit</button>
</form>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>