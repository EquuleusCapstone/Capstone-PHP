<?php
/*This page, AttendMeeting.php, is used to update the visible name associated to a user id. 
 * It requires 2 arguments: meeting_id and user_id
 */

$connection = mysql_connect("localhost", "root", "PASSWORD");
//This query will give us the user id associated with an email
$query="INSERT INTO Attendees (meeting_id, user_id, accepted) VALUES (".$_GET["meeting_id"].", ".$_GET["user_id"].", 0)";
if (!$connection) {
    echo "Connection to database failed: ".mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

//Now we try to add the record
$result = mysql_query($query);
if (!$result) {
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
else {
    echo "Success\n";
}
mysql_free_result($result);
?>}
