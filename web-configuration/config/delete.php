<?php
include("../conf/config.php");

if (isset($_GET['config_id']))
{
  $config_id = $_GET['config_id'];

  //deleting the row from table
  $result = $db->exec("DELETE FROM config WHERE config_id='$config_id'");
  
  if($result)
  {
    $db->close();
    //redirecting to the display page (index.php in our case)
    header("Location:index.php");
  }
  else {
    echo $db->lastErrorMsg();
    $db->close();
    echo 'Deletion FAILED. Probably the config is still in use by some users?
      <br>
      <a href="index.php">Back</a>';
  }
}
?>
