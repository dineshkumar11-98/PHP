<?php
    class User {
        public $firstName ; //firstName
        public $lastName ;
        public $userName ;
        public $mail ;
        public $p_word ;
        public $getid;
   
        function setfirstName($firstName) { 
        	$this->firstName = $firstName;
        }
        function getfirstName() {
        	return $this->firstName;
        }
        function setlastName($lastName) {
        $this->lastName = $lastName;
       	}
        function getlastName() {
        return $this->lastName;
        }
        function setuserName($userName){
        	$this->userName = $userName;
        }
        function getuserName() {
        return $this->userName;
        }
        function setmail($mail) {
        $this->mail = $mail;
       	}
        function getmail() {
        return $this->mail;
        }
        function setPassword($p_word) {
        $this->p_word = $p_word;
       	}
        function getPassword() {
        return $this->p_word;
        }
   

        function valid() {
            $post = $_POST;
            $validcheck = true;
            if (empty($post['fname'])) {
               $validcheck = false;
            }
             if (empty($post['lname'])) {
               $validcheck = false;
            }
             if (empty($post['uname'])) {
               $validcheck = false;
            }
             if (empty($post['email'])) {
               $validcheck = false;
            }
             if (empty($post['password'])) {
               $validcheck = false;
            }
            return $validcheck;
        }

        function checkexist(){
            $check = true;
            $db_fetch = new database();
            $query = "SELECT email FROM datas;";
            $fetchdata = mysqli_query($db_fetch->connection,$query);
            while($datacheck = $fetchdata->fetch_assoc()){
                 
                if ($datacheck['email'] == $this->getmail()) {
                    $check = false;
                }
            }
            return $check;
        }

        function save(){
            
            if ($this->checkexist()) {
                $db_obj = new database();
                $insert = "INSERT INTO datas (firstname, lastname, username, email, password) VALUES ('" . $this->getFirstName() . "','" . $this->getLastName() . "','" . $this->getUserName() . "','" . $this->getmail() . "','" . $this->getPassword() . "')";
                mysqli_query($db_obj->connection, $insert);
                echo "Registered Successfully !";
                mysqli_close($db_obj->connection);
            }else{
                echo "Entered mail id is already exist!!";
            }
        }
    
    }


    class userdatadisplay {


       


        function getdashnoard($user_id,$date,$reason,$price){
            $database = new database();
            $insert = "INSERT INTO reason(user_id,day,Reason,price) VALUES($user_id,'$date','$reason',$price);";
            mysqli_query($database->connection,$insert);
            mysqli_close($database->connection);
            
        }
        function display($User_id){
            $database1 = new database();
            $display = "SELECT * FROM datas,reason WHERE datas.id=$User_id AND datas.id=reason.user_id; ";
            $datadisplay = mysqli_query($database1->connection,$display);
            $ready = $datadisplay->fetch_assoc();
            if(!empty($ready)){
                 echo '<br>Name: '.$ready['firstname'].' '.$ready['lastname'].'<br>E-MAIL: '.$ready['email'].'<br><br>Date: '.$ready['day'].'<br>Reason: '.$ready['Reason'].'<br>Price: '.$ready['price'].'<br>';
            while ($ready = $datadisplay->fetch_assoc()) {
                echo '<br>Date: '.$ready['day'].'<br>Reason: '.$ready['Reason'].'<br>Price '.$ready['price'].'<br>';
                }
            }
            else{
                echo "you don't have any registered expenses!!";
            }
            mysqli_close($database1->connection);  
        }
    }
?>