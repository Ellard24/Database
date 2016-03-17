
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
            <th style="text-align:left"><h1>CS 340 Final Project</h1><br><span id="headLine">Class Page</span></th>
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
            <td><a href="equipment.php">View, Add Equipment</a></td>
            <td><a href="player.php">View, Add Player</a></td>
            <td><a href="uses.php">View, Add Spell Usage</a></td>
            <td><a href="wears.php">View, Add Item Ownership</a></td>
            <td><a href="QueryPage.php">Query Page</a></td>

        </tr>

    </table>
</nav>


<hr>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Classes </h2></caption>
        <thead>
        <tr>
            <th>Class ID</th>
            <th>Strength</th>
            <th>Class Name</th>
            <th>Intelligence</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT * FROM class"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($id, $strength, $name,$intelligence)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $id . "</td><td>" . $strength . "</td><td>" . $name . "</td><td>" . $intelligence .
                "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>

<section>
    <h2 align = "center">Add Class</h2>
    <form action="addClass.php" method="post">

        <fieldset>

            <legend> Class Parameters</legend>

            <label> Class Name: </label>
            <input type="text" name="className" id="classN"/>

            <label> Strength: </label>
            <input type="text" name="strength" id="strengthV"/>

            <label> Intelligence: </label>
            <input type="text" name="intelligence" id="intelligenceV"/>



            <button type="submit" value="submitClass"> Submit Information </button>



        </fieldset>
    </form>
</section>


<section>
    <h2 align = "center">Delete Class</h2>
    <form action="deleteClass.php" method="post">

        <fieldset>

            <legend> Class Parameters</legend>

            <label> Class Name: </label>
            <select id="delClassID" name="delClass">
                <?php

                if(!($stmt = $mysqli->prepare("Select class_name FROM class"))){
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



            <button type="submit" value="submitDelClass"> Submit Information </button>



        </fieldset>
    </form>
</section>


</body>
</html>

