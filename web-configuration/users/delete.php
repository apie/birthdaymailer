<?php

//including the database connection file
include("../conf/config.php");

//getting user_id of the data from url
$user_id = mysqli_real_escape_string($mysqli, $_GET['user_id']);

//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM users WHERE user_id='$user_id'");
mysqli_close($mysqli);
if($result)
{
				//redirecting to the display page (index.php in our case)
				header("Location:index.php");
}
else {print_r(mysqli_error_list($mysqli));}
?>
