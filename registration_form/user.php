<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<script>
		
	</script>
</head>
<body>
<?php 
	include 'db.php';
	include 'object.php';
	session_start();
	$User_id = $_SESSION['id'];
	$alldetail = new userdatadisplay();
    $alldetail->display($User_id);
?>
<form method="post" id="dash">
	<label >Date</label><br>
<input name="date" type="date" ><br><br>
<label >Reason</label><br>
<select name="reason">
	<option>taxe</option>
	<option>shopping</option>
	<option>loan</option>
	<option>rent</option>
	<option>petrol/diseal</option>
	<option>food</option>
	<option>Recharge</option>
</select><br><br>
	<label >price</label><br>
<input name="price" type="number" ><br><br>
<input name="submit" type="submit" value="Add" >&nbsp;&nbsp;
<button type="submit" name="exit">log out</button><br><br>
</form>
<?php
	$post = $_POST;

	if (isset($post['exit'])) {
		echo "string";
		header('Location:index.php');
	}

	if (!empty($post['submit'])) {
		if (!empty($post['date']) && !empty($post['reason']) && !empty($post['price'])) {
			$date = $post['date'];
			$reason = $post['reason'];
			$price = $post['price'];
			$alldetail->getdashnoard($User_id,$date,$reason,$price);
			header('Location:alldata.php');
		}
		else{
			echo "Enter all the fields!!";
		}
	}
?>

</body>
</html>
