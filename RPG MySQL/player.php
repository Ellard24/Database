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
            <th style="text-align:left"><h1>CS 340 Final Project</h1><br><span id="headLine"> Player Page</span></th>
        </tr>
    </table>
</header>
<hr>
<nav>
    <table align = "center"border="1" width="100%" id="navigation"><caption><h3>Links to other options</h3></caption>
        <tr>
            <td><a href="HomePage.php">Home Page</a></td>
            <td><a href="party.php">View, Add Party</a></td>
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
    <table align = "center" border="1" id="databaseData"><caption><h2>Players </h2></caption>
        <thead>
        <tr>
            <th>Player ID</th>
            <th>Level</th>
            <th>Player Name</th>
            <th>Race</th>
            <th>PartyID</th>
            <th>ClassID</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT * FROM player"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($id, $level, $firstname,$race, $partyID, $classID)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $id . "</td><td>" . $level . "</td><td>" . $firstname . "</td><td>" . $race .
                "</td><td>" . $partyID . "</td><td>" . $classID . "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Party IDs </h2></caption>
        <thead>
        <tr>
            <th> ID</th>
            <th>Party Name</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT id,party_name FROM party"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($id, $name)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $id . "</td><td>" . $name . "</td></tr>" ;
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Class IDs </h2></caption>
        <thead>
        <tr>
            <th> ID</th>
            <th>Class Name</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if(!($stmt = $mysqli->prepare("SELECT id,class_name FROM class"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($id, $name)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo "<tr><td>" . $id . "</td><td>" . $name . "</td></tr>" ;
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>



<section>
    <h2 align = "center">Add Players</h2>
    <form action="addPlayer.php" method="post">

            <fieldset>

            <legend> Player Parameters</legend>

            <label> Player Name: </label>
            <input type="text" name="playerName" id="player">

            <label> Starting Level: </label>
            <input type="text" name="levelNumber" id="level">

            <label> Race Name: </label>
            <input type="text" name="raceName" id="race">

                <label> Party : </label>
                <select id="parID" name="party1">
                    <?php

                    if(!($stmt = $mysqli->prepare("Select party.id FROM party"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }

                    if(!$stmt->bind_result($ID)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }

                    while($stmt->fetch()){
                        echo "<option>". $ID . "</option>\n";
                    }
                    $stmt->close();
                    ?>
                </select>
              <!--  <input type="text" name="partyID" id="party"/> -->


                <label> Class : </label>

                <select id="classIDD" name="class1">
                    <?php

                    if(!($stmt = $mysqli->prepare("Select class.id FROM class"))){
                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }

                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }

                    if(!$stmt->bind_result($ID)){
                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }

                    while($stmt->fetch()){
                        echo "<option>". $ID . "</option>\n";
                    }
                    $stmt->close();
                    ?>



                </select>
             <!--   <input type="text" name="classID" id="classIDD"/>  -->



            <button type="submit" value="submitPlayer"> Submit Information </button>



            </fieldset>
    </form>
</section>

<section>
    <h2 align = "center">Delete Players</h2>
    <form action="deletePlayer.php" method="post">

        <fieldset>

            <label> Player Name: </label>

            <select id="delPlayerID" name="delPlayer">
                <?php

                if(!($stmt = $mysqli->prepare("Select first_name FROM player"))){
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




            <button type="submit" value="deletePlayer"> Submit Information </button>



        </fieldset>
    </form>
</section>





</body>
</html>
