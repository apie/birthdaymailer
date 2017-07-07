<?php
include("../conf/config.php");

if (isset($_GET['config_id']))
{
  $config_id = mysqli_real_escape_string($mysqli, $_GET['config_id']);

  //deleting the row from table
  $result = mysqli_query($mysqli, "DELETE FROM config WHERE config_id='$config_id'");
  mysqli_close($mysqli);
  if($result)
  {
    //redirecting to the display page (index.php in our case)
    header("Location:index.php");
  }
  else {print_r(mysqli_error_list($mysqli));}
}
?>
