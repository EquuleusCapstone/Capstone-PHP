<?php
/*This page, Unavail.php, is used to create a unavailable time listing. 
 * It requires the user_id of the person you wish to see unavailable times for.
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$removeOldTimes ="DELETE FROM Events WHERE unavailable_end < CURRENT_TIMESTAMP";
$query = "SELECT e.unavailable_start, e.unavailable_end FROM Events e WHERE "
        ."e.user_id_e =".$_GET["user_id"]." ORDER BY e.unavailable_start ASC";
if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}

if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}
//Don't bother checking if this executed. The only way this would fail to execute
//is if we can't connect to the DB, since it uses no user input. All we want to do
// is purge outdated time slots from our database before we return the rest.
$deletionResult = mysql_query($removeOldTimes);
//This result, on the other hand, needs to be checked for completion.
$result = mysql_query($query);
//Something went wrong. 
if (!$result) {
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
//echo "<unavailable_times>";
while ($row = mysql_fetch_assoc($result)) {
    echo $row["unavailable_start"]."\n";
    echo $row["unavailable_end"]."\n";
}
//echo "</unavailable_times>\n";
mysql_free_result($result);
mysql_free_result($deletionResult);
?>}