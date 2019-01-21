<?php

//including the database connection file
include("../conf/config.php");
//getting user_id of the data from POST
if (isset($_POST['user_id'])) {
  $user_id = $_POST['user_id'];
  $result = $db->query("SELECT config_id FROM users WHERE user_id=$user_id");
  while($res = $result->fetchArray(SQLITE3_ASSOC)) {
    $config_id = $res['config_id'];
  }
  //deleting the row from table
  $result = $db->exec("DELETE FROM users WHERE user_id='$user_id'");
  if($result) {
    $db->close();
    //redirecting to the display page (index.php in our case)
    header("Location: index.php?config_id=".$config_id."");
  }
  else {
    echo $db->lastErrorMsg();
    $db->close();
  }
}
?>
