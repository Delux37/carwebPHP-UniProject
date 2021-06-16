<?php 

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: ./login.php");
}else{
    $host ='localhost';
    $user = 'root';
    $pass = '';
    $db = 'carweb';
    $con = mysqli_connect($host,$user,$pass,$db);

    // $user_id = $_SESSION['id'];

    if(isset($_POST['uplo'])){
        

        $car_id = mt_rand();
        $brand = $_POST["brand"];
        $user_id = $_SESSION['id'];
        $model = $_POST["model"];
        $year = $_POST["year"];
        $location = $_POST["location"];
        $price = $_POST["price"];
        $fuel_type = $_POST["fuel_type"];
        $category = $_POST["category"];
        $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name'][0]));
        $description = $_POST["description"];

        $upload = "insert into cars
         (car_id,user_id,brand, model, year, location, price, category, fuel_type, primary_image, description)
          values ('$car_id','$user_id','$brand','$model','$year','$location', '$price', '$category', '$fuel_type', '$photo', '$description')";
        mysqli_query($con, $upload);

        $countfiles = count($_FILES['photo']['name']);

        for($i=0;$i<$countfiles;$i++){
            $photo =  addslashes(file_get_contents($_FILES['photo']['tmp_name'][$i]));
            $upload_photos = "insert into images
            (car_id, image)
            values ('$car_id','$photo')";

            mysqli_query($con, $upload_photos);
        }
    }


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add-page-style.css">
    <title>carweb</title>
</head>
<body>
    <?php include './navbar.php';?>
    <div class="bground">
    </div>
    <div class="container"> 
     <form method="post" id="my-form" action="" enctype="multipart/form-data">
     <div class="form-group">
            <label for="brand">brand: </label>
            <input type="text" id="brand" name="brand"/>
        </div>
        <div class="form-group">
            <label for="model" >model: </label>
            <input type="text" id="model" name="model"/>
        </div>
        <div class="form-group">
            <label for="year">year: </label>
            <input type="text" id="year" name="year"/>
        </div>
        <div class="form-group">
            <label for="location">location: </label>
            <input type="text" id="location" name="location"/>
        </div>
        <div class="form-group">
            <label for="price">price: </label>
            <input type="text" id="price" name="price"/>
        </div>
        <div class="form-group">
            <label for="fuel_type">fuel_type: </label>
            <input type="text" id="fuel_type" name="fuel_type"/>
        </div>
        <div class="form-group">
            <label for="category">category: </label>
            <input type="text" id="category" name="category"/>
        </div>
        <div class="form-group">
            <label for="description">description: </label>
            <textarea type="text" rows="5" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="photo[]" id="file" multiple="">
        </div>
        <!-- <input name="userfile[]" type="file" multiple=""/><br /> -->
        <div class="form-group">
            <input class="submit" id="submit" type="submit" name="uplo"/>
        </div>            
    </form>
    </div>

        <?php


    ?>
</body>
</html>
