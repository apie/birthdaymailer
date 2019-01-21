<?php
// including the database connection file
include_once("../conf/config.php");

if(isset($_POST['update']))
{
    $config_id = $_POST['config_id'];
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
    if(empty($config_id) || empty($config_name) || empty($from_name) || empty($from_address) || empty($bcc_address) || empty($topic) || empty($line1) || empty($age_line) || empty($noage_line) || empty($picture_file) ) {
        echo "<font color='red'>No empty fields allowed.</font><br/>";
    } else {
        //updating the table
        $result = $db->exec("UPDATE config SET config_name='$config_name',from_name='$from_name',from_address='$from_address',bcc_address='$bcc_address',topic='$topic',line1='$line1',age_line='$age_line',noage_line='$noage_line',picture_file='$picture_file' WHERE config_id=$config_id");
				echo 'Save done, redirecting..';
        //redirecting to the display page. In our case, it is index.php
        header("Location: index.php");
    }
}
?>
<?php
$config_id = 1;
if (isset($_GET['config_id'])) $config_id = $_GET['config_id'];

//selecting data associated with this particular config_id
$result = $db->query("SELECT config_id,config_name,from_name,from_address,bcc_address,topic,line1,age_line,noage_line,picture_file FROM config WHERE config_id=$config_id");

while($res = $result->fetchArray(SQLITE3_ASSOC))
{
    $config_name = $res['config_name'];
    $from_name = $res['from_name'];
    $from_address = $res['from_address'];
	  $bcc_address = $res['bcc_address'];
	  $topic = $res['topic'];
	  $line1 = $res['line1'];
	  $age_line = $res['age_line'];
	  $noage_line = $res['noage_line'];
	  $picture_file = $res['picture_file'];
}
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
                <td>Config Name</td>
                <td><input size=80 type="text" name="config_name" value="<?php echo $config_name;?>"></td>
            </tr>
            <tr>
                <td>From name</td>
                <td><input size=80 type="text" name="from_name" value="<?php echo $from_name;?>"></td>
            </tr>
            <tr>
                <td>From address</td>
                <td><input size=80 type="email" name="from_address" value="<?php echo $from_address;?>"></td>
            </tr>
            <tr>
                <td>BCC address</td>
                <td><input size=80 type="email" name="bcc_address" value="<?php echo $bcc_address;?>"></td>
            </tr>
            <tr>
                <td>Topic</td>
                <td><input size=80 type="text" name="topic" value="<?php echo $topic;?>"></td>
            </tr>
            <tr>
                <td>Line 1</td>
                <td><input size=80 type="text" name="line1" value="<?php echo $line1;?>"></td>
            </tr>
            <tr>
                <td>Age line</td>
                <td><input size=80 type="text" name="age_line" value="<?php echo $age_line;?>">(%age% will be replaced by the age)</td>
            </tr>
            <tr>
                <td>No age line</td>
                <td><input size=80 type="text" name="noage_line" value="<?php echo $noage_line;?>"></td>
            </tr>
            <tr>
                <td>Picture file</td>
                <td><input size=80 type="text" name="picture_file" value="<?php echo $picture_file;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="config_id" value=<?php echo $config_id;?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php
$db->close();
?>
