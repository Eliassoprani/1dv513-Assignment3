<?php 
if(isset($_POST['username']) && isset($_POST['password'])){
    
$username = @$_POST['username'];
$password = @$_POST['password'];
echo($username . $password);
//kollar om användaren anländer till sidan genom inlogningsformuläret. Gör den inte det skall inget hända på denna sidan
if (strlen(trim($username)) > 4 && strlen(trim($password)) > 4) {
    require_once 'loginfile.php';
    $conn = new mysqli($hn, $un, $pw, $db); //anslut till databas
    $query = "INSERT INTO `user` (`id`, `username`, `password`, `isofficial`) VALUES (NULL, '$username', '$password', '0');"; //sträng för förfrågan som ska göras till databasen.
    $result =$conn->query($query); //returnerar svar från förfrågan till databasen och sparas i $result
    if (!$result){ 
        echo '<p><b>username taken.</b></p>'; 
        die($conn->error);
    } //om svaret misslyckades ska anslutning avbrytas
    else { 
        echo ("Account Created! <a href='index.php'>Return to homepage to log in!</a>");
    };//Om användaren kunde logga in får den sessions id av dess användare id i databasen och skickad till 

   // $result->close();
    $conn->close();

}else {
    echo("username or password must contain more than four characters");
};

};

if(!isset($_POST['username'])){
$login = <<<XYZ
<h2> Register account to join the community!</h2>
<form action="createAccount.php" method="post">

<input placeholder="username" type="text" name="username" />
<input placeholer="password" type="password" name="password"/>
<input type="submit" value="Create account"></form>
</form>
XYZ;
echo $login;
};
?>