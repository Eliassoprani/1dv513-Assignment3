<html>
<link href="style.css" rel="stylesheet">
<script type="text/javascript" src="script.js"></script>

<a href="index.php" class="return">return</a>

</html>
<?php
session_start();
if(isset($_SESSION['id'])) {
    echo('<a href="logout.php" id="logout">logout</a><br>');
}
function showpostfromlink() {
    $postid=$_GET['stock_id'];
    /*----------------------------------------------------------------------------------------------------*/
    /*---Kod som hämtar ett inlägg baserat på vilket post_id som skickats med från index.php--------------*/
    /*----------------------------------------------------------------------------------------------------*/
    if(isset($postid)){ 
        require_once 'loginfile.php';
        //$postid = $_SESSION['postid'];
        $conn = new mysqli($hn, $un, $pw, $db); //anslut till databas
        $query = "SELECT * FROM stock WHERE stock_id=$postid"; //sträng för förfrågan som ska göras till databasen, sortera inlägg på senast.
        $result =$conn->query($query); //returnerar svar från förfrågan till databasen och sparas i $result
         if (!$result) die($conn->error); //om svaret misslyckades ska anslutning avbrytas

        $rows = $result->num_rows;

            $result->data_seek(1); //1 eftersom endast en tuppel returneras
            $row = $result->fetch_array(MYSQLI_ASSOC); //hämtar enskild rad inom tabellen eftersom varje rad representerar varsit inlägg
            if($row["stockprice"] > $row["stockprice1day"]){
                $percentColor = 'green';
              }else {
                $percentColor = 'red';
              };
              $percentageInit =  ((($row["stockprice"] -  $row["stockprice1day"]) / $row["stockprice1day"]) * 100);
              $percentage = round($percentageInit, 2);
            echo "<div id='stock'";
            echo ("<b>". $row['stockname'] ."</b><br><br>" );
            echo ("Today: ".$row['stockprice']."$ Yesterday: ");
            echo ($row['stockprice1day']."$  <br><span style='color:$percentColor;'>". $percentage. "% </span><br><br><br>" );
            if($row['stockrating'] > 0) {
            $ratingBefore = ($row['stockrating'] / $row['ammountrated']);
            $rating = round($ratingBefore, 1);

            echo("Rating: <span id='rating'>". $rating. "</span>/5");
            } else echo("Rating: <span id='rating'>0</span>/5");
            

            echo("<br><br><a href='portfolio.php?portfstock=$postid'>Add to portfolio</a><br><br>");
//rösta---
            if (isset($_SESSION['id']) && !isset($_POST['candidate'])){
                $vote = <<<XYZ
                <form action="solostock.php?stock_id=$postid" method="post">
    
                Rate this stock:
    
                <select name="candidate">
    
                <option value=1 selected>1</option>        
    
                <option value=2>2</option>
    
                <option value=3>3</option>
    
                <option value=4>4</option>
    
                <option value=5>5</option>
    
                </select>
                
    
                <br>
    
                <input type="submit" value="Rate">                  
    
                </form>
                XYZ;
                    echo $vote; //sluta rösta--- 
            };
            echo("</div>");
    //lägg till röst i databas
            if (isset($_POST['candidate'])){
               // echo($_POST['candidate']);
                $query = "UPDATE `stock` SET `stockrating` = stockrating + ". $_POST['candidate']. " WHERE `stock`.`stock_id` = $postid;";
                $result =$conn->query($query); //returnerar svar från förfrågan till databasen och sparas i $result
                 if (!$result) die($conn->error); //om svaret misslyckades ska anslutning avbrytas

                 $query = "UPDATE `stock` SET `ammountrated` = ammountrated + 1 WHERE `stock`.`stock_id` = $postid;";
                $result =$conn->query($query); //returnerar svar från förfrågan till databasen och sparas i $result
                 if (!$result) die($conn->error); //om svaret misslyckades ska anslutning avbrytas
    
            };
            //sluta lägg till röst i databas
        /*---------------------------------------------------------------------------------------------------------------------------------*/
        /*--Formulär för att skapa en kommentar forumläret skickar användaren till commentedpost där den kan navigera tillbaka hit---------*/
        /*---------------------------------------------------------------------------------------------------------------------------------*/  
        echo("<div id='commentSection'");
            if (isset($_SESSION['id'])){
                $comment = <<<XYZ
                <h2> Join the discussion </h2>
                <form action="solostock.php?stock_id=$postid" method="post">
    
                <input placeholer="comment" type="text" name="comment"/>
                <input type="submit" value="comment stock"></form>
                </form>
                XYZ;
                echo $comment;        
            };
            
            // Kod för att skapa kommentar
            if (isset($_POST['comment']) && isset($_SESSION['id'])) {
                $stockid = $_GET['stock_id'];
                $comment = $_POST['comment'];
            
                include_once('loginfile.php');
                 $conn = new mysqli($hn, $un, $pw, $db); //anslut till databas
                if ($conn->connect_error) {
                 die("Connection failed");            //om svaret misslyckades ska anslutning avbrytas
            
                }; 
            $sql = "INSERT INTO `comment` (`comment_id`, `stock_id`, `user_id`, `body`) VALUES (NULL, '$stockid', '".$_SESSION['id']."', '$comment');
            ";//sträng för förfrågan som ska göras till databasen.
            
            if($conn->query($sql) == TRUE) {
                echo "Comment is published!";
            }else {
                echo " Error " . $sql . "<br>" . $conn->error;
            }; 
                        
            };
            

            /*kod för att hämta kommentarer där kommentarens postid är postid så att rätt kommentarer visas till rätt inlägg*/
            //$query = "SELECT stock_id, comment_id, user_id, body, username FROM comment, user WHERE stock_id=$postid AND comment.user_id = user.id"; //sträng för förfrågan som ska göras till databasen, sortera inlägg på senast.
            $query = "SELECT comment.stock_id, comment.comment_id, user.username, comment.body FROM comment INNER JOIN user ON comment.user_id=user.id WHERE comment.stock_id=$postid ORDER BY isofficial DESC";
            $result =$conn->query($query); //returnerar svar från förfrågan till databasen och sparas i $result
             if (!$result) die($conn->error); //om svaret misslyckades ska anslutning avbrytas

            $rows = $result->num_rows;
            echo("<div id='commentSection'");
            for ($j = 0; $j < $rows ; ++$j) { //loop som lägger visar ett inläggs kommentarer
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_ASSOC); //hämtar enskild rad inom tabellen eftersom varje rad representerar varsit inlägg
                echo ("<br><i>". $row['username'] ."</i><br>" );
                echo ($row['body']."<br>" );
               // echo ($row['datestamp']."<br>" );
            };
            echo("</div>");
            /*--Stäng anslutning--*/
            $result->close();
            $conn->close();

            }else { echo"This post is unavaviable to display"; };
}; //slut på showpostfromlink
showpostfromlink();//anropa funktionen för att visa inlägget

?>