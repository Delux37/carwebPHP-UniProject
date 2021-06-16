<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carweb</title>
</head>
<body>
    <div class="container">
    <div class="slider_container"></div>
    <a href="./index.php" class="back-arrow">
        Home
        <i class="fas fa-home"></i>
   </a>
    <?php 
        if (!empty($_GET['id'])) {
            $host ='localhost';
            $user = 'root';
            $pass = '';
            $db = 'carweb';
            $con = mysqli_connect($host,$user,$pass,$db);

            // $sql = 'SELECT * FROM cars WHERE id=' . $_GET['id'];

            $sql = 'SELECT * FROM images WHERE car_id=' . $_GET['id'];
            $sqlForData = 'Select * from cars where car_id=' .$_GET['id'];
            

            $result = mysqli_query($con, $sql); // car images
            $resultCarData =  mysqli_query($con, $sqlForData); // car general data
            $resultCarCopyData = mysqli_query($con, $sqlForData);

            $carArr = mysqli_fetch_array($resultCarCopyData);
            $user_id = $carArr['user_id'];

            $sqlForUserData = 'Select * from users where user_id=' .$user_id;
            $resultUserData = mysqli_query($con, $sqlForUserData);

            $int_count=0;
            $images_arr = array();
            while($row = mysqli_fetch_array($result)){
                $images_arr[$int_count] = "data:image/jpeg;base64,".base64_encode(  $row['image'] );
                $int_count++;
            }

            while($row = mysqli_fetch_array($resultCarData)){
                echo '<div class="general_detail">';
                    echo '<div class="left-section">';
                    echo '<span class="price">'.$row['price'].'$</span>';
                    echo '<span class="title">'.$row['brand'].'</span>';
                    echo '<span class="sub_title">'.$row['model'].'</span>';
                    echo '</div>';
                    while($row1 = mysqli_fetch_array($resultUserData)){
                    echo '<div class="right-section">';
                    echo    '<div class="user"><span>L</span>'.$row1['name'].'</div>';
                    echo    '<div class="phone"><i class="fas fa-phone-alt"></i>'.$row1['phone'].'</div>';
                    echo    '<div class="location"><i class="fas fa-map-marker-alt"></i>'.$row['location'].'</div>';
                    echo    '<div class="contact"><i class="fas fa-paper-plane"></i>Contact</div>';
                    echo '</div>';
                    }
                echo '</div>';
                echo '<div class="description">';
                echo '<div class="description_general"><p>Selling  |  '.$row['category'].'   |   '.$row['fuel_type'].'</p></div>';
                echo '<div class="description_text"><p>'.$row['description'].'</p></div>';
            }
        }


    ?>

    

    </div>
    <script type="text/javascript">
        var arr = new Array();
        <?php foreach($images_arr as $temp){ ?>
        arr.push('<?php echo $temp; ?>');
        <?php } ?>

        const temp = document.querySelector('.slider_container');
        temp.innerHTML += '<div class="slideshow-container">';
        for(let i in arr){
            temp.innerHTML += 
            `
            <div class="mySlides fade">
                <img src="${arr[i]}">
            </div>
            `
            // temp.innerHTML += `<img src="${arr[i]}"/>`
        }
        temp.innerHTML += 
        `
            <a class="prev" onclick="{plusSlides(-1)}">&#10094;</a>
            <a class="next" onclick="{plusSlides(1)}">&#10095;</a>
            </div>
            <br>

            <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        `
        var slideIndex = 1;
            showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
    </script>
    <script src="https://kit.fontawesome.com/9a6fc9be1d.js" crossorigin="anonymous"></script>
    <style>
    * {box-sizing:border-box;
margin: 0;
padding:0;}
.back-arrow{
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 5px;
    border: 1px solid black;
    background-color: #fff;
    text-decoration: none;
    color: black;
    border-radius: 5px;
}
/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.slider_container{
    width: 100%;
    position: relative;
    background-color: #717171;
}
.mySlides {
  display: none;
  margin: 0 auto;
  width: 70%;
}
.mySlides img{
    width: 100%;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: calc(50%);
  transform: translateY(-50%);
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}


.general_detail{
    width: 70%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    padding: 20px 0;
    background-color: #adadad;
}
/*DATA*/
.left-section{
    width: 25%;
    background-color: white;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    text-align: center;
    border: 1px solid rgb(167, 167, 167);
    padding: 20px 0;
}
.price{
    color: orange;
    font-size: 32px;
    font-weight: bold;
}
.title{
    font-size: 24px;
    color: black;
}
.sub_title{
    font-weight: 18px;
    font-style: italic;
    color: gray;
}
.right-section{
    width: 60%;
    /* background-color: white; */
    border-radius: 10px;
    display: flex;
    /* align-items: center; */
    justify-content: space-between;

    /* align-items: stretch; */
}
.right-section > div{
    border-radius: 10px;
    border: 1px solid gray;
    display: flex;
    align-items: center;
    padding: 0 20px;
    background-color: #fff;
}
.user span{
    background-color: orange;
    width: 70px;
    height: 70px;
    font-size: 30px;
    color: white;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 5px;
}

.description {
    width: 70%;
    display: flex;
    flex-direction: column;
    margin: 0 auto;
    align-items: center;
}

.description_general{
    font-size: 18px;
}

.description_text{
    align-self: flex-start;
}
    </style>
</body>
</html>