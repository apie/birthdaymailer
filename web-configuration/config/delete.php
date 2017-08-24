<?php
include("../conf/config.php");

if (isset($_GET['config_id']))
{
  $config_id = mysqli_real_escape_string($mysqli, $_GET['config_id']);

  //deleting the row from table
  $result = mysqli_query($mysqli, "DELETE FROM config WHERE config_id='$config_id'");

  if($result)
  {
    mysqli_free_result($result);
    mysqli_close($mysqli);
    //redirecting to the display page (index.php in our case)
    header("Location:index.php");
  }
  else {
    mysqli_close($mysqli);
    echo 'Deletion FAILED. Probably the config is still in use by some users?
      <br>
      <a href="index.php">Back</a>';
  }
}
?>
