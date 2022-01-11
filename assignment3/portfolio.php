<html>
<link href="style.css" rel="stylesheet">
<a href="index.php" class="return">return</a>
<br>
<br>
</html>
<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "assignment3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
session_start();

if (isset($_GET['portfstock'])){
    include_once('loginfile.php');
    $conn = new mysqli($hn, $un, $pw, $db); //anslut till databas
   if ($conn->connect_error) {
    die("Connection failed");            //om svaret misslyckades ska anslutning avbrytas

   }; 
    $sql = "INSERT INTO `portfolio` (`user_id`, `stock_id`) VALUES ('". $_SESSION['id']."', '".$_GET['portfstock']."');
    ";//sträng för förfrågan som ska göras till databasen.

    if($conn->query($sql) == TRUE) {
    echo "<br>Stock has been added to your portfolio!<br>";
    }else {
    echo "Multiple portfolio entries<br>";
    }; 
}
//"select avg(stock.stockprice/nullif(stock.stockprice1day, 0)) from stock, portfolio, user WHERE "
$sql = "SELECT avg(stock.stockprice-stock.stockprice1day) AS avg from stock, portfolio WHERE portfolio.user_id=". $_SESSION['id']." AND stock.stock_id=portfolio.stock_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo("<br><h3 id='money'>Avrage gain/loss for your stocks: " .round($row['avg'], 2). "$</h3>");

$sql = "SELECT stock.stock_id, stockname, stockprice, stockprice1day, user.username FROM portfolio, stock, user WHERE portfolio.user_id=". $_SESSION['id']." AND stock.stock_id = portfolio.stock_id AND user.id=".$_SESSION['id']."";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 echo("<div id=stock>");
  while($row = $result->fetch_assoc()) {
    if($row["stockprice"] > $row["stockprice1day"]){
        $percentColor = 'green';
      }else {
        $percentColor = 'red';
      };
      $percentageInit =  ((($row["stockprice"] -  $row["stockprice1day"]) / $row["stockprice1day"]) * 100);
      $percentage = round($percentageInit, 2);
      echo "<br>". $row["stockname"]. " - stockprice: " . $row["stockprice"]. "$ <span style='color:$percentColor;'>". $percentage. "% </span><br>";
      echo ("<a href='solostock.php?stock_id=".$row['stock_id']."'> View stock </a><br>");
  }
} else {
  echo "0 results";
}
echo("</div>");



?>