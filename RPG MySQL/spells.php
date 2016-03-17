<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'gerritse-db', 'HvMvGOlNsFGRyBEO', 'gerritse-db');
if ($mysqli->connect_errno) {
    echo "Connection Failed." . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CS340 Final Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <table width="100%">
        <tr>
            <th style="text-align:left"><h1>CS 340 Final Project</h1><br><span id="headLine"Spell Page</span></th>
        </tr>
    </table>
</header>
<hr>
<nav>
    <table border="1" width="100%" id="navigation"><caption><h3>Links to other options</h3></caption>
        <tr>
            <td><a href="HomePage.php">Home Page</a></td>
            <td><a href="party.php">View, Add Party</a></td>
            <td><a href="player.php">View, Add Player</a></td>
            <td><a href="equipment.php">View, Add Equipment</a></td>
            <td><a href="class.php">View, Add Classes</a></td>
            <td><a href="uses.php">View, Add Spell Usage</a></td>
            <td><a href="wears.php">View, Add Item Ownership</a></td>
            <td><a href="QueryPage.php">Query Page</a></td>

        </tr>

    </table>
</nav>


<hr>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Spells </h2></caption>
        <thead>
        <tr>
            <th>Spell ID</th>
            <th>Name</th>
            <th>Damage</th>
            <th>Element Type</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT * FROM spell"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($id, $name, $damage,$type)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $id . "</td><td>" . $name . "</td><td>" . $damage . "</td><td>" . $type .
                "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>

<section>
    <h2 align = "center">Add Spell</h2>
    <form action="addSpell.php" method="post">

        <fieldset>

            <legend> Spell Parameters</legend>

            <label> Spell Name: </label>
            <input type="text" name="spellName" id="spellN"/>

            <label> Damage: </label>
            <input type="text" name="damage" id="spellDamage"/>

            <label> Element Type(water,fire,etc): </label>
            <input type="text" name="elementType" id="elementT"/>



            <button type="submit" value="submitSpell"> Submit Information </button>



        </fieldset>
    </form>
</section>


<section>
    <h2 align = "center">Delete Spell</h2>
    <form action="deleteSpell.php" method="post">

        <fieldset>

            <legend> Spell Parameters</legend>

            <label> Spell Name: </label>
            <select id="delSpellID" name="delSpell">
                <?php

                if(!($stmt = $mysqli->prepare("Select spell_name FROM spell"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }

                if(!$stmt->bind_result($name)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }

                while($stmt->fetch()){
                    echo "<option>". $name . "</option>\n";
                }
                $stmt->close();
                ?>



            </select>



            <button type="submit" value="submitDelSpell"> Submit Information </button>



        </fieldset>
    </form>
</section>




</body>
</html>
