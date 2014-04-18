<?php
/*This page, UpdateMeeting.php, is used to update the description of an existing meeting. 
 * It requires 2 arguments; meeting_id, and description (string max 256 characters)
 */

$desc=$_GET["description"];
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
//This query will give us the user id associated with an email
$query="UPDATE m.description=".$desc." FROM Meetings m WHERE m.meeting_id=".$_GET["meeting_id"];

if (!$connection) {
    echo "Connection to database failed: ".mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

//Now we try to update the information
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

