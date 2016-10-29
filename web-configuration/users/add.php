<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("../conf/config.php");
if(isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $birthday = mysqli_real_escape_string($mysqli, $_POST['birthday']);
    $emptybday = empty($birthday);
    $birthday = date_create_from_format('Y-m-d', $birthday);
    $birthday_valid = false;
		if((date_get_last_errors()['warning_count'] == 0) && (date_get_last_errors()['error_count'] == 0)) $birthday_valid = true;
    //print_r(date_get_last_errors());
    //echo date_format($birthday, 'Y-m-d');

    // checking empty fields
    if(empty($name) || $emptybday || !($birthday_valid) || empty($email)) {
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
        $result = mysqli_query($mysqli, "INSERT INTO users(config_id,name,email,birthday) VALUES(1,'$name','$email','".date_format($birthday, 'Y-m-d')."')");
				if($result){
								//display success message
								echo "<font color='green'>Data added successfully.";
								echo "<br/><a href='index.php'>View Result</a>";
				} else {
								echo "<font color='red'>Error while adding data (duplicate user?).";
								echo "<br/><a href='index.php'>Back to overview</a>";
        }
    }
}
?>
</body>
</html>
