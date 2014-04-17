<?php
/*This page, PendingMeetings.php, takes a user_id as an argument and returns a 
 * list of meetings that this user is invited to, signified by the accepted column
 * in the database being marked as a 0
*/
$connection = mysql_connect("localhost", "root", "PASSWORD");
//This query will find all meetings that the supplied user needs to give a response
// to. This query will be used on the meeting invitations page of the application.
$query = "SELECT U.f_name, U.l_name, U.email, M.start, M.end, M.created, M.description, M.meeting_id
FROM Users U, Meetings M, Attendees A
WHERE A.user_id = ".$_GET["user_id"]." AND A.meeting_id = M.meeting_id AND A.accepted = 0 AND M.owner = U.user_id";
if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}
$result = mysql_query($query);

//This only happens if the user id is formatted incorrectly (as a string, for example) Even if the id isn't
if (!$result) { //in the database (invalid id) it still won't throw this error
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    echo $row["meeting_id"];
    echo $row["f_name"]."\n";
    echo $row["l_name"]."\n";
    echo $row["email"]."\n";
    echo $row["start"]."\n";
    echo $row["end"]."\n";
    echo $row["created"]."\n";
    echo $row["description"]."\n";
}
mysql_free_result($result);
?>}