<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>carweb</title>
</head>
<body>

<?php
    include 'navbar.php';
?>

<div class="container">
    <?php
        
        $host ='localhost';
        $user = 'root';
        $pass = '';
        $db = 'carweb';
        $con = mysqli_connect($host,$user,$pass,$db);

        $sql = 'select * from cars';

        $result = mysqli_query($con, $sql);        
        while($row = mysqli_fetch_array($result)){
            echo "<a href='./car-detail.php?id=".$row['car_id']."' class='item-card'>";
            echo '<div class="img-container" style="background-image: url(data:image/jpeg;base64,'.base64_encode( $row['primary_image'] ).')"></div>';
            echo '<div class="content-container">';
                echo '<p class="first-title"<span>'.$row['year'].'</span> <span>'.$row['location'].'</span></p>';
                echo '<h2 class="car_model" style="color: black;">'.$row['brand'].' '.$row['model'].'</h2>';
                echo '<p class="tags"> <span>'.$row['fuel_type'].'</span> <span>'.$row['category'].'</span> </p>';
                echo '<h3 class="car_price">'.$row['price'].'$</h3></div>';
            echo "</a>";
                // echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
        }
        // if(isset($_POST['uplo'])){
        //     $car_id = $_POST['car_id'];
        //     $image_id = $_POST['image_id'];
        //     $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));;
        //     $temp = "insert into cars
        //      (brand, model, year, location, price, category, fuel_type, primary_image, description)
        //       values ('b','m','12','tbil', '2500', 'sedan', 'diesel', '$photo', 'savage')";
        //     mysqli_query($con, $temp);
        // }
    ?>
     <!-- <form method="post" action="index.php" enctype="multipart/form-data">
            <input type="text" id="image" name="car_id"/>
            <input type="text" id="image1" name="image_id"/>
            <input type="file" value="image upload" name="photo"/>
            <input type="submit" name="uplo"/>
    </form> -->

</div>
</body>
</html>