<html>
<link href="style.css" rel="stylesheet">

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
if(isset($_SESSION['id'])) {
  echo('<a href="logout.php" id="logout">logout</a><br>');
}
//login formulär som skickar användaren till login.php
if(!isset($_SESSION['id'])) {
    $login = <<<XYZ
    <h2> Login to comment and rate stocks!</h2>
    <form action="login.php" method="post">

    <input placeholder="username" type="text" name="username" />
    <input placeholer="password" type="password" name="password"/>
    <input type="submit" value="Login"></form>
    </form>
    XYZ;
    echo $login;
    echo("Have you not signed up? <br>Click here to <a href='createAccount.php'>Register and join</a>");
}

if(isset($_SESSION['id'])){
  echo ("<a href='portfolio.php'> Your portfolio </a><br>");
}

echo "<div id='stocks'";
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 
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
$conn->close();
?>