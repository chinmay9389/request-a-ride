<?php
    include 'connect.php';
   session_start();
        if(!isset($_SESSION['userid'])){
            header("Location:index.html");
        }
    
    $c_pass=md5($_POST['curPWD']);
    $newPass1=md5($_POST['newPWD']);

    $result=$db->query("select user_password from login where user_id={$_SESSION['userid']}") or die($db->error);
    $row=$result->fetch_assoc();
    $_SESSION['counter']=0;
    if($c_pass==$row['user_password'])
    {
        $result2=$db->query("update login set user_password='$newPass1' where user_id={$_SESSION['userid']}") or die($db->error);
        session_unset();
        unset($_SESSION['userid']);
        setcookie('PHPSESSID',"",time()-3600,"/");
        session_destroy();
        echo "<script>
            window.alert('Password Updated Successfully....Please Re-Login');
            window.location='index.html';
        </script>";
    }
    else
    {
        echo "<script>
            window.alert('Incorrect Current Password....Please Retry!!!');
            window.location='changePWD.html';
        </script>";
    }
?>
