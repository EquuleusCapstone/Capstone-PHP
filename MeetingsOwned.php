<?php
/*This page, meetingsOwned.php, takes a string user_id as an argument and returns a 
 *list of meetings that user is leading.
 *Returns all info about the related meetings except owner since that is redundant
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$query = "SELECT * FROM Meetings m WHERE m.owner=".$_GET['user_id'];

if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}
$result = mysql_query($query);
if (!$result) {
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    echo $row["meeting_id"]."\n";
    echo $row["start"]."\n";
    echo $row["end"]."\n";
    echo $row["created"]."\n";
    echo $row["description"]."\n";
}
mysql_free_result($result);
?>}