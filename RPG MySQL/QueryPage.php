<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'gerritse-db', 'HvMvGOlNsFGRyBEO', 'gerritse-db');
if ($mysqli->connect_errno) {
    echo "Connection Failed." . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>

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
            <td><a href="spells.php">View, Add Spells</a></td>

        </tr>

    </table>
</nav>






<p> On this page, you have the option to test some queries. Fill in the appropriate inputs for each corresponding form to test
them out. </p>





This first form will let you find all information regarding a Player. For the sake of keeping it error-free, entities
in the database for each query will be presented to you in a drop down menu.
<form action="QueryPage.php" method="post">
    <fieldset>
            <label> Player Name: </label>
             <select  name="playerN">
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

        <button type="submit" value="charSearch"> Submit Information </button>



    </fieldset>



</form>


<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Players </h2></caption>
        <thead>
        <tr>
            <th>Player Name</th>
            <th>Level</th>
            <th>Race </th>
            <th>Class Name</th>
            <th>Party Name</th>
            <th>Intelligence</th>
            <th>Strength</th>
        </tr>
        </thead>
        <tbody>
        <?php


        if(!($stmt = $mysqli->prepare("SELECT player.first_name, player.level_number, player.race, class.class_name, party.party_name, class.strength
        , class.intelligence FROM player
        INNER JOIN party ON party.id = player.party_id
         INNER JOIN class ON class.id = player.class_id
         WHERE player.first_name = ?"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }


        if(!($stmt->bind_param("s",$_POST['playerN']))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($name, $level, $race,$class, $party,$intelligence, $strength )){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo  "<tr><td>" . $name . "</td><td>" . $level . "</td><td>" . $race . "</td><td>" . $class .
                "</td><td>" . $party . "</td><td>" . $intelligence . "</td><td>" . $strength . "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>





















<p> This query will allow you to see all players that have intelligence higher than the number requested</p>
<form action="QueryPage.php" method="post">
    <fieldset>
        <label> Intelligence Value: </label>
        <input type="text" name="IntelSelect">

        <button type="submit" value="IntelSubmit"> Submit Information </button>



    </fieldset>



</form>


<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Players </h2></caption>
        <thead>
        <tr>
            <th>Player Name</th>
            <th>Class Name</th>
            <th>Party Name</th>
            <th>Strength</th>
            <th>Intelligence</th>
        </tr>
        </thead>
        <tbody>
        <?php


        if(!($stmt = $mysqli->prepare("SELECT player.first_name, class.class_name, party.party_name, class.strength
        , class.intelligence FROM player
        INNER JOIN party ON party.id = player.party_id
         INNER JOIN class ON class.id = player.class_id
         WHERE class.intelligence >= ?
         ORDER BY class.intelligence DESC
         "))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }


        if(!($stmt->bind_param("i",$_POST['IntelSelect']))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($name, $class, $party,$strength, $intelligence )){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo  "<tr><td>" . $name . "</td><td>" . $class . "</td><td>" . $party . "</td><td>" . $strength .
                "</td><td>" . $intelligence  . "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>



















<p> This query will let you pick all players which have a certain spell . </p>
<form action="QueryPage.php" method="post">
    <fieldset>
        <label> Spell Name: </label>
        <select  name="spellN">
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

        <button type="submit" value="spellSearch"> Submit Information </button>



    </fieldset>

</form>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Players </h2></caption>
        <thead>
        <tr>
            <th>Player Name</th>
            <th>Class Name</th>
            <th>Spell Name</th>
        </tr>
        </thead>
        <tbody>
        <?php


        if(!($stmt = $mysqli->prepare("SELECT player.first_name, class.class_name, spell.spell_name FROM player
         INNER JOIN class ON class.id = player.class_id
         INNER JOIN uses ON class.id = uses.class_id
         INNER JOIN spell ON uses.spell_id = spell.id
         WHERE spell.spell_name = ?

         "))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }


        if(!($stmt->bind_param("s",$_POST['spellN']))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($name, $class, $spellName )){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo  "<tr><td>" . $name . "</td><td>" . $class . "</td><td>" . $spellName . "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>


<p> This query will let you pick all a player and then it sums up their total damage and armor . </p>
<form action="QueryPage.php" method="post">
    <fieldset>
        <label> Player Name: </label>
        <select  name="Player2">
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

        <button type="submit" value="play2Submit"> Submit Information </button>



    </fieldset>

</form>

<section>
    <table align = "center" border="1" id="databaseData"><caption><h2>Players </h2></caption>
        <thead>
        <tr>
            <th>Player Name</th>
            <th>Total Damage</th>
            <th>Total Armor</th>
        </tr>
        </thead>
        <tbody>
        <?php


        if(!($stmt = $mysqli->prepare("SELECT player.first_name, sum(equipment.bonus_damage), sum(equipment.armor_value) FROM player
        INNER JOIN wears ON player.id = wears.player_id
         INNER JOIN equipment ON wears.equipment_id = equipment.id
         WHERE player.first_name = ?


         "))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }


        if(!($stmt->bind_param("s",$_POST['Player2']))){
            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($name, $damage, $armor )){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
            echo  "<tr><td>" . $name . "</td><td>" . $damage . "</td><td>" . $armor . "</td></tr>";
        }
        $stmt->close();
        ?>
        </tbody>
    </table>
</section>