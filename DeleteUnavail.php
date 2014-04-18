<?php
/*This page, AddUnavail.php, is used to add a new unavailable time frame for a 
 * given user. This requires user_id in addition to start and end DATETIME for
 * the time period in question. 
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$query = "DELETE FROM Events WHERE user_id_e = ".$_GET[user_id].
        " AND unavailable_start = ".$_GET["start"].
        " AND unavailable_end = ". $_GET["end"]. " LIMIT 1";
if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

$result = mysql_query($query);
//Something went wrong.
if (!$result) {
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
 else {
     echo "Success\n";
 }
mysql_free_result($result);
?>}