<?php
    include 'connect.php';
    if(isset($_POST)){
        $cl = $_POST['curLocVal'];
        $dl = $_POST['destLocVal'];
    }
    
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location:index.html");
    }
    

    $result = $db->query("SELECT * FROM locality") or die($db->error);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($cl==$row['locality_name'])
            {
                $cl_id = $row['user_locality_id'];
                $sql="update passenger set passenger_current_location=$cl_id,passenger_status='Requested' where passenger_id = '{$_SESSION['userid']}' ";

                $result2 = $db->query($sql) or die($db->error); 
            }
            if($dl==$row['locality_name'])
            {   
                $dl_id = $row['user_locality_id'];
                $sql1="update passenger set passenger_destination_location=$dl_id,passenger_status='Requested' where passenger_id = '{$_SESSION['userid']}' " ;
                $result1 = $db->query($sql1) or die($db->error);
            }
        }
    }
    
    echo "<script>
        window.alert('Your request placed successfully');
        window.location='passengerHome.html';
    </script>";
?>