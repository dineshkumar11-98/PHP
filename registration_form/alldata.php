
<html>
<body>

	<?php
	include 'object.php';
	include 'db.php';
	$alldata = new userdatadisplay();
	session_start();
	if ($_SESSION['id']) {
		$User_id = $_SESSION['id'];
		$alldata->display($User_id);
	}else{
		echo 'login again';
	}
	
	?>

	<br>
	<form method="post">
		<button type="submit" name="exit">Ok</button>
	</form>
	<?php

	if (isset($_POST['exit'])) {
		header('Location:user.php');
	}
	?>
</body>
</html>