<?php
$host = 'localhost';
$port = '3306';
$dbname = 'product_crud';
$user = 'root';
$password = '';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname";
$pdo = new PDO($dsn,$user,$password);
$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$statement = $pdo -> prepare('SELECT * FROM products ORDER BY create_date DESC');
$statement -> execute();
$products = $statement -> fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- custom css -->
     <link href="style/app.css" rel="stylesheet" >

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
 


    <title>PRODUCTS CRUD</title> <br>
  </head>
  <body>
    <h1>PRODUSCTS CRUD</h1>
    <a href="create.php" class="btn btn-sm btn-warning">create</a>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">image</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">price</th>
      <th scope="col">create_date</th>
      <th scope="col">action</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($products as $i => $product):?>
    <tr>
      <th scope="row"><?php echo $i + 1  ?></th>
      <td>
      <img src="<?php echo $product['image']; ?>" alt="image" class="thumb-image">
      </td>
      <td><?php echo $product['title']; ?></td>
      <td><?php echo $product['describtion']; ?></td>
      <td><?php echo $product['price']; ?></td>
      <td><?php echo $product['create_date']; ?></td>
      <td>
      <a href="update.php?id=<?php echo $product['id']?>" class="btn btn-sm btn-warning">edit</a>

      <form action="delete.php" method="post" style="display: inline-block">
          <input type="hidden" name="id" value="<?php echo $product['id']?>">
          <button type="submit"  class="btn btn-sm btn-danger">delete</button>
      </form>

      </td>

    </tr>

 <?php endforeach ?>

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