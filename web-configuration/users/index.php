<!-- By D.J. Murray (apie), 2016-10-27 -->
<?php
function switchorder($order){
  if ($order=='ASC') return 'DESC';
  if ($order=='DESC') return 'ASC';
  return '';
}
//including the database connection file
include_once("../conf/config.php");

$sort = 'name';
if (isset($_GET['sort'])) $sort = mysqli_real_escape_string($mysqli, $_GET['sort']);
$order = 'ASC';
if (isset($_GET['order'])) $order = mysqli_real_escape_string($mysqli, $_GET['order']);

$result = mysqli_query($mysqli, "SELECT user_id,name,email,birthday,DATE_FORMAT( birthday, '%m-%d' ) as birthdaymonth, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) as age
 FROM users WHERE config_id=$c_config_id ORDER BY $sort $order ");
mysqli_close($mysqli);
$order = switchorder($order);
?>

<html>
<head>
<title>Birthday mailer - user configuration</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
    <h1>Birthday mailer - user configuration</h1>
	  <br/>
    <a href="add.html">Add new user</a><br/><br/>

    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <td><a href="?sort=name&order=<?php echo $order; ?>">Name</a></td>
            <td><a href="?sort=email&order=<?php echo $order; ?>">Email</a></td>
            <td><a href="?sort=birthday&order=<?php echo $order; ?>">Birthday</a></td>
            <td><a href="?sort=birthdaymonth&order=<?php echo $order; ?>">Birthday (w/o year)</a></td>
            <td><a href="?sort=age&order=<?php echo $order; ?>">Age</a></td>
            <td>Update</td>
        </tr>
        <?php
        while($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$res['name']."</td>";
            echo "<td>".$res['email']."</td>";
            echo "<td>".$res['birthday']."</td>";
            echo "<td>".$res['birthdaymonth']."</td>";
            echo "<td>".$res['age']."</td>";
            echo "<td><a href=\"edit.php?user_id=$res[user_id]\">Edit</a> | <a href=\"delete.php?user_id=$res[user_id]\" onClick=\"return confirm('Are you sure you want to delete ".$res['name']."?')\">Delete</a></td>";
        }
        ?>
    </table>
</body>
</html>
