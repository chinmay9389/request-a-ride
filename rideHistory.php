<?php 
    
    include 'connect.php';
    
    session_start();
        if(!isset($_SESSION['userid'])){
            header("Location:index.html");
        }

    $passid=$_POST['requestedId'];
    $riderid=$_SESSION['userid'];
    $result = $db->query("select * from passenger where passenger_id=$passid") or die($db->error);
    
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $s_loc_id= $row['passenger_current_location'];
        $d_loc_id= $row['passenger_destination_location'];   
    }
    
?>