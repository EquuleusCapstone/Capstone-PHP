<?php
/*This page, DeleteMeeting.php, is used to delete an existing meeting. The only
 * argument to be provided is meeting_id
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$query = "DELETE FROM Meetings WHERE Meetings.meeting_id = ".$_GET["meeting_id"];

 if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

$result = mysql_query($query);
if (!$result) { //Something broke. Check the formatting of all arguments.
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
else {
	echo "Success.\n";
}
mysql_free_result($result);
?>}