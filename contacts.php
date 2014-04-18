<?php
/*This page, contacts.php, takes a string user_id as an argument and returns a 
 *list of contacts for that user.
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$query = "SELECT u.user_id, u.email, u.f_name, u.l_name FROM Users u, Contacts c "
        . "WHERE c.user_id_c ='". $_GET['user_id']. "' AND c.friend_id =u.user_id";
if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}
$result = mysql_query($query);

if (!$result) {//There's only 1 argument! How did you incorrectly enter 1 argument?'
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    echo $row["user_id"]."\n";
    echo $row["email"]."\n";
    echo $row["f_name"]."\n";
    echo $row["l_name"]."\n";
}
mysql_free_result($result);
?>}