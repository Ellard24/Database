<?php
error_reporting(E_ALL);
ini_set('display_errors',1);


$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'gerritse-db', 'HvMvGOlNsFGRyBEO', 'gerritse-db');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if(!($stmt = $mysqli->prepare("INSERT INTO wears(equipment_id, player_id) VALUES (
          (SELECT id
          FROM equipment
          WHERE item_name =  ?),

          (SELECT id
          FROM player
          WHERE first_name =  ?) )"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['item'],$_POST['player']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
    echo "Successfully added " . $stmt->affected_rows . "  <br>";
}
$stmt->close();
//}
?>