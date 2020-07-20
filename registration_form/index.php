<!DOCTYPE html>
<html>
<head>
	<title>File Upload</title>
   <!--  <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<form method="POST" enctype="multipart/form-data" >
    <div class="form-group row">
       <label class="col-sm-1">First Name*</label>
       <input name="fname" class="col-sm-2 " type="text" required="required"  placeholder="first name">
    </div>
    <div class="form-group row">
        <label class="col-sm-1">Last Name*</label>
        <input name="lname" class="col-sm-2" type="text" required="required"  placeholder="last name">    
    </div>
    <div class="form-group row">
        <label class="col-sm-1">User Name*</label>
        <input name="uname" class="col-sm-2" type="text" required="required"  placeholder="user name">
    </div>
    <div class="form-group row">
       <label class="col-sm-1">Email*</label>
       <input name="email" class="col-sm-2" type="text" required="required"  placeholder="Email">
    </div>
    <div class="form-group row">
        <label class="col-sm-1">Password*</label>
        <input name="password" class="col-sm-2" type="password" placeholder="password" required="required">
    </div>
    
    <input type="submit" class="btn btn-primary btn-sm" value="Create Account" name="submit"><br><br>


<?php
    include 'object.php';
    include 'db.php';
   
   $post = $_POST;
    
   //insert the data to database
    $userObject = new User();
    if(!empty($post['submit'])) { 
        if ($userObject->valid()) {
            
            $userObject->setfirstName($_POST['fname']);
            $userObject->setlastName($_POST['lname']);
            $userObject->setuserName($_POST['uname']);
            $userObject->setmail($_POST['email']);
            $userObject->setPassword($_POST['password']);
            $userObject->save();
        }else{
            echo "Enter all the required field!";
        }
            
    }
?>
</form>


<br><br>
<form method="post">
<div class="form-group row">
    <label class="col-sm-1">Email</label>
    <input name="useremail" class="col-sm-2" type="text" placeholder="Email">   
</div>
<div class="form-group row">
    <label class="col-sm-1">Password</label>
    <input name="userpassword" class="col-sm-2" type="password" placeholder="Password">    
</div>

<input type="submit" class="btn btn-primary btn-sm" value="Sigin" name="submit1"><br><br>
</form>


<?php
    //check the data from the database
    
    if (!empty($post['submit1'])) {
         $db_obj = new database();
        if (!empty($post['useremail']) && !empty($post['userpassword'])) {
            $useremail = $post['useremail'];
            $userpassword = $post['userpassword'];
            $select = "SELECT id,email, password FROM datas WHERE email='$useremail' AND password='$userpassword';";
            $dbdata=mysqli_query($db_obj->connection,$select);
            $data = $dbdata->fetch_assoc();
            if(!empty($data['email']) && !empty($data['password'])){
                if ($data['email'] == $useremail && $data['password'] == $userpassword) {
                    echo "email and password are match";
                    session_start();
                    $_SESSION['id'] = $data['id'];
                    header("Location:user.php");
                    
                } 
            }else{
                    echo "email and Password are incorrect";
                }
        } else{
            echo "Enter all the field";
        }
    }
?>
</body>
</html>