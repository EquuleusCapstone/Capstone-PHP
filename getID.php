<?php

/*This page, GetUserID, takes a single argument: email. It then returns the user
 * id that is associated with the email. 
 * Connecting to the actual database has been withdrawn, since this will be publicly
 * visible on github.
*/
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
$query = "SELECT u.user_id, u.email FROM Users u WHERE u.email=".$_GET["email"];
if (!$connection) {
    echo "Connection to database failed: ". mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

$result = mysql_query($query);
if (!$result) { //Email is probably not present in our database if you get this.
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
else {
	while ($row = mysql_fetch_assoc($result)){
	echo $row["user_id"];
	}
	
}
echo "\n";
mysql_free_result($result);
?>}