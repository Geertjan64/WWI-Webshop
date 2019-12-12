<?php
include '../incl/header.php';
//include '../incl/ConnectieFunctie.php';
?>
<?php
$productid = $_GET['item'];
?>

<?php
// database connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "wideworldimporters";
$conn1 = mysqli_connect($server, $username, $password, $dbname);
$sql1 = "SELECT * FROM stockitems WHERE StockItemID = $productid";
$result = mysqli_query($conn1, $sql1);
while ($row = mysqli_fetch_assoc($result)) {
    $itemname = $row['StockItemName'];
    ?>
<body>
<!-- beetje style om de text en images op de goeie plek te zetten -->
<style>
    .img {
        height: 600px;
        width: auto;
        float:left;
        border: 1px solid #021a40;
    }
    .text {
        padding: 0px 10px;
    }
    .featured {
        font-size: 100px;
        padding: 0px 300px;
    }
    .starimage {
        height: 20px;
        width: auto;
    }
    .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
    }
    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
    }
    .carousel-indicators li {
        background-color: grey;
    }
</style>
<div class="container" style="margin-top:200px; margin-bottom:50px; text-align: center">
    <div class="row">

<!-- de image -->
<div>
</div>
    <div id="carouselExampleIndicators" class="carousel slide col-md-6 col-sm-6" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../recources/voorbeeld fotos/<?php echo "$itemname" ?>1.jpg" class="img">
            </div>
            <div class="carousel-item">
                <img src="../recources/voorbeeld fotos/<?php echo "$itemname" ?>2.jpg" class="img">
            </div>
            <div class="carousel-item">
                <img src="../recources/voorbeeld fotos/<?php echo "$itemname" ?>3.jpg" class="img">
            </div>
            <div class="carousel-item">
                <?php include 'video.php'?>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<!-- Data printen op site -->
<div class="text col-md-6 col-sm-6">
    <?php
        echo "<p>". $row['StockItemName'] ."<br> €" . $row['RecommendedRetailPrice'] . "<br>" .  $row['MarketingComments'] . "<br>" . $row['TypicalWeightPerUnit']. " KG <br>" . $row['Size']."</p>";
    }
    ?>


<?php

function addToCart ($productid, $amount) {

    $addItem = array (
      $productid => $amount
    );
    if(isset ($_SESSION['cart'][$productid])) {
        print("Dit product staat al in uw winkelman!");
        }
        elseif ($addItem[$productid] != null) {
            $_SESSION['cart']=$addItem;
        }
}

?>

<form method="post">
    <input type="submit" name="addToCart" value="Add to cart" />
    <input type="text" name="Amount" value="1">
</form>

<?php
if(isset($_POST['Amount'])) {
    $amount = $_POST['Amount'];
}

if(isset($_POST['addToCart'])) {

    addToCart($productid, $amount);

    echo "<p> The item " . $itemname . " has been added to your shopping cart! </p>";
}
?>
            <br>
            <br>
            <?php
            $productid = $_GET['item'];

            $_SESSION['ProductID'] = $productid;

            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "onzedbwwi";
            $conn2 = mysqli_connect($server, $username, $password, $dbname);
            $sql1 = "SELECT * FROM reviews WHERE ID_Product = $productid";
            $result1 = mysqli_query($conn2, $sql1);


            while ($row = mysqli_fetch_assoc($result1)) {
                $stars = $row['Stars'];
            }

            $i = 0;
            while($i < $stars ) {
                echo '<img src="../incl/star3.png" class="starimage" alt="icon" />';
                $i++;
            }

            ?>

            <div>
                Dit product heeft een rating van <?php echo $stars . "/5" ?> ontvangen!
            </div>
            <div>
                <?php include 'Reviews.php' ?>
            </div>
    </div>
</div>
</div>
</body>
<?php
include '../incl/footer.php';
?>