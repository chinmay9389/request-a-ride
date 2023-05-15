<?php
    include 'connect.php';
    session_start();
        if(!isset($_SESSION['userid'])){
            header("Location:index.html");
        }
    
    $fn=$_POST['fname'];
    $mn=$_POST['mname'];
    $ln=$_POST['lname'];
    $m1=$_POST['mob1'];
    $m2=$_POST['mob2'];
    $loc=$_POST['lDropdown'];
    $dept=$_POST['deptDropdown'];
    $year=$_POST['yDropdown'];
    
	
	

	if($_FILES['editdp']['name']!=NULL){
		$file= $_FILES['editdp']['name'];
		$extension=strtolower(substr(strrchr($file, '.'), 1));
		$newfilename=$_SESSION['userid'] .".".$extension;
		echo $d = "dp/".basename($newfilename);
		move_uploaded_file($_FILES["editdp"]["tmp_name"], $d);
	}
	else{
		$r = $db->query("select Img_Path from user where user_id={$_SESSION['userid']}") or die($db->error);
		echo $d = $r->fetch_assoc()['Img_Path'];
	}


    $result1=$db->query("select * from locality") or die($db->error);
    while($row1=$result1->fetch_assoc()){
        if($loc==$row1['locality_name']){
            $loc_id=$row1['user_locality_id'];
       }
    }

    $result2=$db->query("select * from user_dept") or die($db->error);
    while($row2=$result2->fetch_assoc()){
        if($dept==$row2['user_dept']){
            $dept_id=$row2['user_dept_id'];
        }
    }

    $result3=$db->query("select * from user_year") or die($db->error);
    while($row3=$result3->fetch_assoc()){
        if($year==$row3['user_year']){
            $year_id=$row3['user_year_id'];
        }
    }
    
    $result4=$db->query("select user_role from user where user_id='{$_SESSION['userid']}'") or die($db->error); 
    $row4=$result4->fetch_assoc();        
   
    if($row4['user_role']=="R"){
        $bno=$_POST['bikeNumber'];
        $bn=$_POST['bikeModel'];
        $lno=$_POST['licenceNumber'];
        
        $result5=$db->query("call update_rider('{$_SESSION['userid']}','$fn','$mn','$ln','$loc_id','$year_id','$dept_id','$m1','$m2','$bno','$bn','$lno','$d')") or die($db->error);
        echo "Rider profile updated successfully\n";
    }
    else{
        $result5=$db->query("call update_passenger('{$_SESSION['userid']}','$fn','$mn','$ln','$loc_id','$year_id','$dept_id','$m1','$m2','$d')") or die($db->error);
        echo "Passenger profile updated successfully\n";
    }
        echo "<script>
            window.alert('Profile Updated Successfully');
            window.location='profile.html';
        </script>";
		
  ?>      