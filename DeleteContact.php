<?php
/*This page, DeleteContact.php, is used to delete an existing contact. The
 * arguments needed are:
 *      user_id: the id of the person submitting the request
 *      friend_id: the id of the person to be deleted from the contact list
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "root", "PASSWORD");
$query = "DELETE FROM Contacts WHERE Contacts.user_id_c = ".$_GET["user_id"].
         " AND Contacts.friend_id =".$_GET["friend_id"]." LIMIT 1";

 if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

$result = mysql_query($query);
if (!$result) { //Invalid formatting, or the contact didn't exist in the DB.
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
else {
	echo "Success.\n";
}
mysql_free_result($result);
?>}