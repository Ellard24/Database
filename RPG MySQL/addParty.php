<?php
error_reporting(E_ALL);
ini_set('display_errors',1);


$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'gerritse-db', 'HvMvGOlNsFGRyBEO', 'gerritse-db');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if(!($stmt = $mysqli->prepare("INSERT INTO party(goal, formation_date, party_name) VALUES (?,?,?)"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss",$_POST['partyGoal'],$_POST['formationDate'],$_POST['partyName']))){
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
