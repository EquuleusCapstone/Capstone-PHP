<?php
/*This page, DeclineMeeting.php, is used to signify the user will not be attending
 * the meeting that they are invited to.
 * This file should also be used to allow a user to remove themself from a meeting.
 * It requires 2 arguments: meeting_id and user_id
 */

$connection = mysql_connect("localhost", "root", "PASSWORD");
//This query changes the accepted field to be '-1', to signify declining
//NOTE: Should this instead delete the column, rather than making it -1?
//-1 allows meeting owners to see who has declined, but simply deleting the row
//would save space. 
$query="UPDATE Attendees SET accepted=-1 WHERE user_id=".$_GET["user_id"]
            ." AND meeting_id=".$_GET["meeting_id"]." LIMIT 1";
if (!$connection) {
    echo "Connection to database failed: ".mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

//Now we try to update the record
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