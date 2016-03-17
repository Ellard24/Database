<?php
error_reporting(E_ALL);
ini_set('display_errors',1);


$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'gerritse-db', 'HvMvGOlNsFGRyBEO', 'gerritse-db');
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if(!($stmt = $mysqli->prepare("DELETE FROM spell WHERE spell_name = ?"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s",$_POST['delSpell']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
    echo "Successfully deleted " . $stmt->affected_rows . "  <br>";
}
$stmt->close();
//}
?>
