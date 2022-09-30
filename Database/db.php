<?php

/*** mysql hostname ***/
$hostname = 'sql1.njit.edu';

/*** mysql username ***/
$username = 'rp783';

/*** mysql password ***/
$password = 'Shilpa@6303';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=mysql", $username, $password);
    /*** echo a message saying we have connected ***/
    echo 'Connected to database';
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
