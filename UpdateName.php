<?php
/*This page, UpdateName.php, is used to update the visible name associated to a user id. 
 * It requires 2-3 arguments; email of user, and one or both of fname and lname.
 *
 */

$fname; 
$lname;
$connection = mysql_connect("localhost", "dataOnly", "PASSWORD");
//This query will give us the user id associated with an email
$fname = $_GET["f_name"];
$lname = $_GET["l_name"];
 
if (!$connection) {
    echo "Connection to database failed: ".mysql_error();
    exit;
}
if (!mysql_select_db("Capstone")) {
    echo "Unable to select Capstone: ".mysql_error();
    exit;
}

//This query will update the information that needs changing. If a value is not null, it will be changed.
$updateQuery;
if (!isNull($fname) && isNull(lname)) {
	$updateQuery = "UPDATE Users SET Users.f_name=".$fname." WHERE Users.email=".$_GET["email"];
}
else if (isNull($fname) && !isNull(lname)) {
	$updateQuery = "UPDATE Users SET Users.l_name=".$lname." WHERE Users.user_id=".$_GET["email"];
}
else if(!isNull($fname) && !isNull(lname)) {
	$updateQuery = "UPDATE Users SET Users.f_name=".$fname.", Users.l_name=".$lname." WHERE users.user_id=".$_GET["email"]; 
}
else {	//Nothing to be updated so we exit
	exit;
}

//Now we try to update the information
$result = mysql_query($updateQuery);
if (!$result) { //Improper formatting, or invalid email address
    echo "Unable to run query \"".$query." from database: ". mysql_error();
    exit;
}
else {
    echo "Success\n";
}
mysql_free_result($result);
?>}