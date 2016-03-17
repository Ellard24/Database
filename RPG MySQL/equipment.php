
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
            <th style="text-align:left"><h1>CS 340 Final Project</h1><br><span id="headLine">Equipment Page</span></th>
        </tr>
    </table>
</header>
<hr>
<nav>
    <table border="1" width="100%" id="navigation"><caption><h3>Links to other options</h3></caption>
        <tr>
            <td><a href="HomePage.php">Home Page</a></td>
            <td><a href="party.php">View, Add Party</a></td>
            <td><a href="spells.php">View, Add Spells</a></td>
            <td><a href="player.php">View, Add Player</a></td>
            <td><a href="class.php">View, Add Classes</a></td>
            <td><a href="uses.php">View, Add Spell Usage</a></td>
            <td><a href="wears.php">View, Add Item Ownership</a></td>
            <td><a href="QueryPage.php">Query Page</a></td>

        </tr>

    </table>
</nav>


<hr>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Equipment </h2></caption>
        <thead>
        <tr>
            <th> Equipment ID</th>
            <th> Durability</th>
            <th> Name</th>
            <th> Armor Value</th>
            <th> Bonus Damage</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT * FROM equipment"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($id, $durability, $name,$armor,$damage)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $id . "</td><td>" . $durability . "</td><td>" . $name . "</td><td>" . $armor
            . "</td><td>" . $damage . "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>

<section>
    <h2 align = "center">Add Equipment</h2>
    <form action="addEquipment.php" method="post">

        <fieldset>

            <legend> Equipment Parameters</legend>

            <label> Durability: </label>
            <input type="text" name="durability" id="durabilityV"/>

            <label> Name </label>
            <input type="text" name="name" id="eName"/>

            <label> Armor Value </label>
            <input type="text" name="armor" id="armorV"/>

            <label> Bonus Damage </label>
            <input type="text" name="bonusDamage" id="damageV"/>

            <button type="submit" value="submitEquip"> Submit Information </button>



        </fieldset>
    </form>
</section>


<section>
    <h2 align = "center">Delete Equipment</h2>
    <form action="deleteEquipment.php" method="post">

        <fieldset>

            <legend> Equipment Parameters</legend>

            <label> Name </label>
            <select id="delEquipID" name="delEquip">
                <?php

                if(!($stmt = $mysqli->prepare("Select item_name FROM equipment"))){
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



            <button type="submit" value="submitDelete"> Submit Information </button>



        </fieldset>
    </form>
</section>




</body>
</html>

