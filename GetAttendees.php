<?php
/*This page, getAttendees.php, takes a string meeting_id as an argument and returns a 
 *list of contacts for that meeting.
 *Returns emails followed by first name and last name of each attendee.
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$idquery = "SELECT a.user_id FROM Attendees a WHERE a.meeting_id=".$_GET['meeting_id'];

if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}
$result = mysql_query($idquery);
$inforesult;
if (!$result) {
    echo "Unable to run query \"".$idquery." from database: ". mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
   $infoquery = "SELECT c.f_name, c.l_name, c.email FROM Contacts c WHERE c.user_id=".$row["user_id"];
   $inforesult = mysql_query($infoquery);
    if (!$inforesult) {
	echo "Unable to run query \"".$infoquery." from database: ". mysql_error();
        exit;
    }
    echo $inforesult["f_name"]."\n";
    echo $inforesult["l_name"]."\n";
    echo $inforesult["email"]."\n";
}
mysql_free_result($result);
mysql_free_result($inforesult);
?>}