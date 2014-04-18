<?php
/*This page, InviteMeeting.php, is used to invite other users to a created meeting.
 * It requires 2 arguments: meeting_id and user_id
 */

$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
//This query inserts the user IDs of invited users into a table, linking them with a meeting
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
