<?php

function login() {
    $username = @$_POST['username'];
    $password = @$_POST['password'];
//kollar om användaren anländer till sidan genom inlogningsformuläret. Gör den inte det skall inget hända på denna sidan
    if (isset($username) && isset($password)) {
        require_once 'loginfile.php';
        $conn = new mysqli($hn, $un, $pw, $db); //anslut till databas
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'"; //sträng för förfrågan som ska göras till databasen.
        $result =$conn->query($query); //returnerar svar från förfrågan till databasen och sparas i $result
        if (!$result){ 
            echo '<p><b>Invalid login.</b></p>'; 
            die($conn->error);
        } //om svaret misslyckades ska anslutning avbrytas
        else { 
            session_start();
            $_SESSION['id'] = $result->fetch_array(MYSQLI_ASSOC)['id']; //sätter användarens id till id´t som finns i den rad användaren finns i
            header('location: index.php'); //skickar användaren till index.php
        };//Om användaren kunde logga in får den sessions id av dess användare id i databasen och skickad till 

        $result->close();
        $conn->close();
    }

};

if (count($_POST)) {
login();
};

?>