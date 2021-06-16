<div id="nav">
    <a id="logo-container" href="./index.php">
        <img id="logo" src="./images/carWeb.png" />
    </a>
    <nav>
        <ul id="main-nav">
            <a href="add-car.php">
                Add
            </a>
            <?php 
                if(!isset($_SESSION['name'])){
                    session_start();
                }
                
                if (isset($_SESSION['name'])) {
                    echo "<a href='./logout.php'>Logout</a>";
                    echo "<a href=''>  Welcome ".$_SESSION['name']."</a>";
                }else{
                    echo "<a href='login.php'>Login</a>";
                }
            ?>

        </ul>
    </nav>
</div>
<style>
    #nav{
    width: 100%;
    height: 8vh;
    position: relative;
    top: 0;
    left: 0;
    background-color: #fdcb6e;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 1px 1px 10px 2px rgba(77, 77, 77, 0.671);
    z-index: 10;
}
#logo-container{
    height: 70%;
    border-radius: 25px;
    margin-left: 15px;
    background-color: rgb(231, 231, 231);
    width: 15%;
    display: flex;
    justify-content: center;
    box-shadow: 5px 5px 5px 2px rgba(78, 78, 78, 0.438)
}
#logo-container:hover{
    cursor: pointer;
    background-color: rgb(184, 184, 184)
}
#logo{
    width: auto;
    height: 100%;
    margin: 0 auto;
}
#main-nav{
    display: flex;
    list-style: none;
    margin-right: 15px;
}
#main-nav > a{
    display: inline-block;
    margin-left: 15px;
    display: flex;
    align-items: center;

    text-decoration: none;
    color: black;

    background-color: #fff;
    padding: 10px;
    border-radius: 20px;
    border: 2px solid black;
}
</style>