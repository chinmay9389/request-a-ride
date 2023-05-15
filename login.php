<?php
    include 'connect.php';
    if(isset($_POST)){
        $userid = $_POST['userID'];
        $pass = md5($_POST['pwd']);
    }

    $result = $db->query("SELECT * FROM login") or die($db->error);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($userid==$row['user_id'])
            {
                $_SESSION['user_count']=0;
                if($pass == $row['user_password'] and $row['user_role']=="R")
                {
                    session_start();
                    $_SESSION['userid']=$userid;
                    echo "<script>
                        window.alert('Login Successfull as Rider');
                        window.location='riderHome.html';
                    </script>";
                }
                else if($pass == $row['user_password'] and $row['user_role']=="P")
                {
                    session_start();
                    $_SESSION['userid']=$userid;   
                    echo "<script>
                        window.alert('Login Successfull as Passenger');
                        window.location='passengerHome.html';
                    </script>";
                }
                else{
                    $x=false;
                }
            }
            else{
                $x=false;
            }
        }
    }
    if($x==false){
        echo "<script>
            window.alert('Invalid Credentials...Please Try Again!!!!');
            window.location='index.html';
        </script>";
    }
?>