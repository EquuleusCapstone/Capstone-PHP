<?php
/*This page, AddContact.php, is used to create a new contact listing. 
 * It requires two arguments; user_id, the user making the entry, and email,
 * the email of the person to be added as a contact. 
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/

$friendID;
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
//This query will give us the user id associated with an email
$idQuery = "SELECT u.user_id FROM Users u WHERE u.email=".$_GET["email"];

 
 if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}
//Query the database for the user id that goes with the supplied email
$idResult = mysql_query($idQuery);
//An invalid email was supplied
if (!$idResult) {
    echo "Invalid email address supplied.";
    exit;
}
//We need to extract the user id from the query result
else {
    $row = mysql_fetch_assoc($idResult);
    $friendID = $row["user_id"];
}
//This query will add a new contact to the user's friends list'
$query = "INSERT INTO Contacts (user_id_c, friend_id) VALUES ("
         .$_GET["user_id"].", ".$friendID.")";
//Now we try to add the contact to the caller's contact list.
//If we get to this point, friendID should have a value and the query will
//be safe to run. 
$result = mysql_query($query);
if (!$result) {
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
 else {
     echo "Success\n";
 }
mysql_free_result($result);
mysql_free_result($idResult);
?>}