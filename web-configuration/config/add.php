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
    $config_name=$_POST['config_name'];
    $from_name=$_POST['from_name'];
    $from_address=$_POST['from_address'];
    $bcc_address=$_POST['bcc_address'];
    $topic=$_POST['topic'];
    $line1=$_POST['line1'];
    $age_line=$_POST['age_line'];
    $noage_line=$_POST['noage_line'];
    $picture_file=$_POST['picture_file'];

    // checking empty fields
    if(empty($config_name) || empty($from_name) || empty($from_address) || empty($bcc_address) || empty($topic) || empty($line1) || empty($age_line) || empty($noage_line) || empty($picture_file) ) {
        echo "<font color='red'>No empty fields allowed.</font><br/>";
    } else {
        //inserting in the table
        $result = $db->exec("INSERT INTO config (config_name,from_name,from_address,bcc_address,topic,line1,age_line,noage_line,picture_file) VALUES ('$config_name','$from_name','$from_address','$bcc_address','$topic','$line1','$age_line','$noage_line','$picture_file' );");

				if($result){
            //display success message
            echo "<font color='green'>Data added successfully.";
            echo "<br/><a href='index.php'>View Result</a>";
				} else {
            echo $db->lastErrorMsg();
            echo "<font color='red'>Error while adding data (duplicate config?).";
            echo "<br/><a href='index.php'>Back to overview</a>";
        }
    }
}
$db->close();
?>
</body>
</html>
