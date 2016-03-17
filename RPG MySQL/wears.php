
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
            <th style="text-align:left"><h1>CS 340 Final Project</h1><br><span id="headLine">Item Ownership</span></th>
        </tr>
    </table>
</header>
<hr>
<nav>
    <table border="1" width="100%" id="navigation"><caption><h3>Links to other options</h3></caption>
        <tr>
            <td><a href="HomePage.php">Home Page</a></td>
            <td><a href="player.php">View, Add Player</a></td>
            <td><a href="spells.php">View, Add Spells</a></td>
            <td><a href="equipment.php">View, Add Equipment</a></td>
            <td><a href="class.php">View, Add Classes</a></td>
            <td><a href="uses.php">View, Add Spell Usage</a></td>
            <td><a href="party.php">View, Add Party</a></td>
            <td><a href="QueryPage.php">Query Page</a></td>

        </tr>

    </table>
</nav>


<hr>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2> Item Ownership </h2></caption>
        <thead>
        <tr>
            <th> Item</th>
            <th> Player</th>


        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT * FROM wears"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($item, $player)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $item . "</td><td>" . $player . "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>

<section>
    <h2 align = "center">Add Spell Usage</h2>
    <form action="addWears.php" method="post">

        <fieldset>

            <legend> Wears Parameters</legend>

            <label> Item Name: </label>

            <select name="item" id="itemID">
                <?php

                if(!($stmt = $mysqli->prepare("Select item_name FROM equipment"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }

                if(!$stmt->bind_result($item)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }

                while($stmt->fetch()){
                    echo "<option>". $item . "</option>\n";
                }
                $stmt->close();
                ?>


            </select>

            <label> Player Name:  </label>

            <select name="player" id="playerID">
                <?php

                if(!($stmt = $mysqli->prepare("Select first_name FROM player"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }

                if(!$stmt->execute()){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }

                if(!$stmt->bind_result($player)){
                    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }

                while($stmt->fetch()){
                    echo "<option>". $player . "</option>\n";
                }
                $stmt->close();
                ?>


            </select>


            <button type="submit" value="submitWears"> Submit Information </button>



        </fieldset>
    </form>
</section>





</body>
</html>