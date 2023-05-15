<?php
    include 'connect.php';

    

	if(isset($_POST))
	{
    $userid = $_POST['sUserID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $gen = $_POST['genderSelect'];
    $mob1 = $_POST['m1'];
    $mob2 = $_POST['m2'];
    $loc = $_POST['lDropdown'];
    $year = $_POST['yDropdown'];
    $dept = $_POST['deptDropdown'];
    $bno = $_POST['bikeNumber'];
    $bname = $_POST['bikeModel'];
    $lno = $_POST['licenceNumber'];
    $pass = md5($_POST['spwd']);
		
		
	$l = "license/".basename($_FILES['licence']['name']);
	$d = "dp/".basename($_FILES['dp']['name']);
    $riderPassenger = $_POST['riderPassenger'];
   
	move_uploaded_file($_FILES["dp"]["tmp_name"], $d);
	move_uploaded_file($_FILES["licence"]["tmp_name"], $l);
    }
    else
	{
		echo "NOT set";
	}
	
    
    $result = $db->query("SELECT * FROM user_year") or die($db->error);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($year==$row['user_year'])
            {
                $year_id = $row['user_year_id']; 
            }
        }
    }


    $result = $db->query("SELECT * FROM user_dept") or die($db->error);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($dept==$row['user_dept'])
            {
                $dept_id = $row['user_dept_id']; 
            }
        }
    }

    

    $result = $db->query("SELECT * FROM locality") or die($db->error);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($loc==$row['locality_name'])
            {
                $loc_id = $row['user_locality_id']; 
            }
        }
    }



	if($riderPassenger=="P")
    {
		$sql= "CALL insert_passenger('$userid','$fname','$mname','$lname','$gen','$loc_id','$year_id','$dept_id','$mob1','$mob2','$pass','P','$d')";	
		$query = mysqli_query($db,$sql);
    }
    else if($riderPassenger=="R")
    {
		$sql = "CALL insert_rider('$userid','$fname','$mname','$lname','$gen','$loc_id','$year_id','$dept_id','$mob1','$mob2','$bno','$bname','$lno','$pass','R','$d','$l')";	
		$query = mysqli_query($db,$sql);
    }  
    
	echo "<script>
		window.alert('Registered Successfully');
	</script>";

	header("Location:index.html");
	
?>