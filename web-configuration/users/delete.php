<?php

//including the database connection file
include("../conf/config.php");
//getting user_id of the data from POST
if (isset($_POST['user_id']))
{
  $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

  $result = mysqli_query($mysqli, "SELECT config_id FROM users WHERE user_id=$user_id");
  while($res = mysqli_fetch_array($result))
  {
    $config_id = $res['config_id'];
  }

  //deleting the row from table
  $result = mysqli_query($mysqli, "DELETE FROM users WHERE user_id='$user_id'");
  mysqli_close($mysqli);
  if($result)
  {
    mysqli_free_result($result);
    mysqli_close($mysqli);
    //redirecting to the display page (index.php in our case)
    header("Location: index.php?config_id=".$config_id."");
  }
  else {print_r(
    mysqli_close($mysqli)
    );
  }
}
?>
