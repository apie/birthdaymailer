<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("../conf/config.php");
if(isset($_POST['submit'])) {
    $config_id = $_POST['config_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $emptybday = empty($birthday);
    $birthday = date_create_from_format('Y-m-d', $birthday);
    $birthday_valid = false;
		if((date_get_last_errors()['warning_count'] == 0) && (date_get_last_errors()['error_count'] == 0)) $birthday_valid = true;
    //print_r(date_get_last_errors());
    //echo date_format($birthday, 'Y-m-d');

    // checking empty fields
    if(empty($config_id) || empty($name) || $emptybday || !($birthday_valid) || empty($email)) {
        if(empty($config_id)) {
            echo "<font color='red'>config_id field is empty.</font><br/>";
        }
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        if($emptybday) {
            echo "<font color='red'>Birthday field is empty.</font><br/>";
        }
        if(!($birthday_valid)) {
            echo "<font color='red'>Birthday field is invalid.</font><br/>";
        }
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // if all the fields are filled (not empty)
        //insert data to database
        $result = $db->exec("INSERT INTO users(config_id,name,email,birthday) VALUES('$config_id','$name','$email','".date_format($birthday, 'Y-m-d')."')");
				if($result){
            //display success message
            echo "<font color='green'>Data added successfully.";
            echo "<br/><a href='index.php?config_id=".$config_id."'>View Result</a>";
				} else {
            echo "<font color='red'>Error while adding data (duplicate user?).";
            echo "<br/><a href='index.php'>Back to overview</a>";
        }
        $db->close();
    }
}
else
{
$config_id = 1;
if (isset($_GET['config_id'])) $config_id = $_GET['config_id'];
?>
<html>
<head>
    <title>Add Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br/><br/>

    <form action="add.php" method="post" name="form1">
        <table width="40%" border="0">
            <tr>
                <td>Name (e.g. John Doe)</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Email (e.g. john@example.com)</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td>Birthday (e.g. 1980-01-31)</td>
                <td><input type="date" name="birthday" min="1900-01-01"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="hidden" name="config_id" value=<?php echo $config_id;?>></td>
                <td><input type="submit" name="submit" value="Add"></td>
            </tr>
        </table>
    </form>
</body>
</html>
</body>
</html>
<?php
}
?>
