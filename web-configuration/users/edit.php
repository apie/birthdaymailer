<?php
// including the database connection file
include_once("../conf/config.php");

if(isset($_POST['update']))
{
    $user_id = $_POST['user_id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $birthday=$_POST['birthday'];

    // checking empty fields
    if(empty($name) || empty($email) || empty($birthday)) {
      echo "<font color='red'>No empty fields allowed.</font><br/>";
    } else {
      //updating the table
      $result = $db->exec("UPDATE users SET name='$name',email='$email',birthday='$birthday' WHERE user_id=$user_id");
      $result = $db->query("SELECT config_id FROM users WHERE user_id=$user_id");
      while($res = $result->fetchArray(SQLITE3_ASSOC)) {
        $config_id = $res['config_id'];
      }
      $db->close();
      echo 'Save done, redirecting..';
      //redirecting to the display page. In our case, it is index.php
      header("Location: index.php?config_id=".$config_id."");
    }
}
?>
<?php
//getting user_id from url
$user_id = $_GET['user_id'];
//selecting data associated with this particular user_id
$result = $db->query("SELECT name,email,birthday FROM users WHERE user_id=$user_id");
while($res = $result->fetchArray(SQLITE3_ASSOC)) {
    $name = $res['name'];
    $email = $res['email'];
	  $birthday = $res['birthday'];
}
$db->close();
?>
<html>
<head>
    <title>Edit Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br/><br/>

    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="<?php echo $email;?>"></td>
            </tr>
            <tr>
                <td>Birthday</td>
                <td><input type="date" name="birthday" value="<?php echo $birthday;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="user_id" value=<?php echo $user_id;?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>
