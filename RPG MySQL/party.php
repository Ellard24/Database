
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
            <th style="text-align:left"><h1>CS 340 Final Project</h1><br><span id="headLine">Party Page</span></th>
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
            <td><a href="wears.php">View, Add Item Ownership</a></td>
            <td><a href="QueryPage.php">Query Page</a></td>

        </tr>

    </table>
</nav>


<hr>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Party </h2></caption>
        <thead>
        <tr>
            <th> Party Name</th>
            <th> ID</th>
            <th>Goal</th>
            <th>Formation Date</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT * FROM party"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($name, $id, $goal, $date)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $name . "</td><td>" . $id . "</td><td>" . $goal . "</td><td>" . $date ."</td></tr>" ;
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>

<section>
    <h2 align = "center">Add Party</h2>
    <form action="addParty.php" method="post">

        <fieldset>

            <legend> Party Parameters</legend>

            <label> Party Goal: </label>
            <input type="text" name="partyGoal" id="partyG"/>

            <label> Formation Date:  Year-Month-Date </label>
            <input type="text" name="formationDate" id="formationD"/>

            <label> Party Name </label>
            <input type="text" name="partyName" id="partyD"/>

            <button type="submit" value="submitParty"> Submit Information </button>



        </fieldset>
    </form>
</section>

<section>
    <h2 align = "center">Delete Party</h2>
    <form action="deleteParty.php" method="post">

        <fieldset>

            <legend> Party Parameters</legend>

            <label> Party Name </label>
            <select id="delPartyID" name="delParty">
                <?php

                if(!($stmt = $mysqli->prepare("Select party_name FROM party"))){
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


            <button type="submit" value="delParty"> Submit Information </button>



        </fieldset>
    </form>
</section>




</body>
</html>

