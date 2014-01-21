<?php
/*This page, GetMeetings.php, takes a user_id as an argument and returns a 
 * list of meetings that this user is attending.
 * Depending on how we decide to implement this, we might want to use this to
 * instead display all meetings that a user is invited to or attending once the
 * application has progressed to that point. As of 1/20/14, however, it only shows
 * meetings that the user is going to be at. 
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "root", "PASSWORD");
//This query will find all meetings that the supplied user is attending, then 
//match that with information about the meeting itself and the person running the 
//meeting. 
$query = "SELECT U.f_name, U.l_name, U.email, M.start, M.end, M.created, M.location
FROM Users U, Meetings M, Attendees A
WHERE A.user_id = ".$_GET["user_id"]." AND A.meeting_id = M.meeting_id AND M.owner = U.user_id";
if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}
$result = mysql_query($query);

if (!$result) {//There's only 1 argument! How did you incorrectly enter 1 argument?
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    echo $row["f_name"]."\n";
    echo $row["l_name"]."\n";
    echo $row["email"]."\n";
    echo $row["start"]."\n";
    echo $row["end"]."\n";
    echo $row["created"]."\n";
    echo $row["location"]."\n";
}
mysql_free_result($result);
?>}