<?php
    session_start();
        if(!isset($_SESSION['userid'])){
            header("Location:index.html");
		}
    echo "<script>
            window.alert('Logged out successfully');
			</script>";
			session_unset();
			setcookie("PHPSESSID","",time()-3600,"/");
			unset($_SESSION['userid']);
	echo "<script>
            window.location= 'index.html';
			</script>";
?>