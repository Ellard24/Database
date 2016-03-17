<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'gerritse-db', 'HvMvGOlNsFGRyBEO', 'gerritse-db');


// This checks to see if connection works. If there are problems, it will list the error
if(!$mysqli || $mysqli->connect_errno)
echo "There's been an ERROR connecting to the USER database." . $mysqli->connect_errno . "" . $mysqli->connect_error;


?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

<table width="100%">
    <tr>
        <th style="text-align:left"><h1>CS 340 Final Project</h1><br><span id="headLine"> RPG Database Simulator</span></th>
        <td valign="top"> By <strong>Ellard Gerritsen</strong><br>
    </tr>
</table>


<p> This Database Project focuses on an RPG(Role Playing Game). In a RPG there are many elements that encompass the genre.
    From character creation, to class selection, loot collection, spell . This project's purpose is to mimic what could be
    expected to be found in a real commercial RPG. </p>



    <ol align="center">
        <?php

        if(!($stmt = $mysqli->prepare("SELECT
  (SELECT COUNT(player.id) FROM player) as table1Count,
  (SELECT COUNT(equipment.id) FROM equipment) as table2Count,
  (SELECT COUNT(spell.id) FROM spell) as table3Count,
  (SELECT COUNT(party.id) FROM party) as table4Count
")))
            echo "Prepare Statement error" . $stmt->errno . " " . $stmt->error;



        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($playerCount, $equipmentCount, $spellCount, $partyCount)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo  "<h3> Number of Players Currently Existing in the Database:</h3>" ."<tr><td>" .$playerCount.
                "<h3> Number of Items Currently Existing in the Database: </h2>" ."</td><td>" .$equipmentCount.
                "<h3> Number of Spells Currently Existing in the Database:</h2>" ."</td><td>" .$spellCount.
                "<h3> Number of Parties Currently Existing in the Database: </h2>" ."</td><td>" . "$partyCount";
        }
        $stmt->close();


        ?>



    </ol>


<nav>
    <table border="1" width="100%" id="navigation"><caption><h3>Links to other options</h3></caption>
        <tr>
            <td><a href="player.php">View, Add Player</a></td>
            <td><a href="spells.php">View, Add Spells</a></td>
            <td><a href="equipment.php">View, Add Equipment</a></td>
            <td><a href="party.php">Add,View Party </a> </td>
            <td><a href="class.php">View, Add Classes</a></td>
            <td><a href="uses.php">View, Add Spell Usage</a></td>
            <td><a href="wears.php">View, Add Item Ownership</a></td>
            <td><a href="QueryPage.php">Query Page</a></td>

        </tr>

    </table>
</nav>


</body>
</html>