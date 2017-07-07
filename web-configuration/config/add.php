<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
// including the database connection file
include_once("../conf/config.php");

if(isset($_POST['submit']))
{
    $config_name=mysqli_real_escape_string($mysqli, $_POST['config_name']);
    $from_name=mysqli_real_escape_string($mysqli, $_POST['from_name']);
    $from_address=mysqli_real_escape_string($mysqli, $_POST['from_address']);
    $bcc_address=mysqli_real_escape_string($mysqli, $_POST['bcc_address']);
    $topic=mysqli_real_escape_string($mysqli, $_POST['topic']);
    $line1=mysqli_real_escape_string($mysqli, $_POST['line1']);
    $age_line=mysqli_real_escape_string($mysqli, $_POST['age_line']);
    $noage_line=mysqli_real_escape_string($mysqli, $_POST['noage_line']);
    $picture_file=mysqli_real_escape_string($mysqli, $_POST['picture_file']);

    // checking empty fields
    if(empty($config_name) || empty($from_name) || empty($from_address) || empty($bcc_address) || empty($topic) || empty($line1) || empty($age_line) || empty($noage_line) || empty($picture_file) ) {
        echo "<font color='red'>No empty fields allowed.</font><br/>";
    } else {
        //inserting in the table
        $result = mysqli_query($mysqli, "INSERT INTO config(config_name,from_name,from_address,bcc_address,topic,line1,age_line,noage_line,picture_file) VALUES('$config_name','$from_name','$from_address','$bcc_address','$topic','$line1','$age_line','$noage_line','$picture_file' )");

				if($result){
            //display success message
            echo "<font color='green'>Data added successfully.";
            echo "<br/><a href='index.php'>View Result</a>";
				} else {
            echo "<font color='red'>Error while adding data (duplicate config?).";
            echo "<br/><a href='index.php'>Back to overview</a>";
        }
    }
}
?>
</body>
</html>
