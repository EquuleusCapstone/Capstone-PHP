<?php
/*This page, AddUnavail.php, is used to add a new unavailable time frame for a 
 * given user. This requires user_id in addition to start and end DATETIME for
 * the time period in question. 
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$query = "INSERT INTO Events (user_id_e, unavailable_start, unavailable_end)"
        . "VALUES (".$_GET["user_id"].",".$_GET["start"].",".$_GET["end"].")";
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