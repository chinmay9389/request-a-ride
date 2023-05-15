<?php
    
    include 'connect.php';
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location:index.html");
    }

    $passid=$_POST['requestedId'];
    $riderid=$_SESSION['userid'];
    $result = $db->query("select * from passenger inner join user_name on passenger.passenger_id=user_name.user_name_id where passenger_id=$passid") or die($db->error);
    
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $s_loc_id= $row['passenger_current_location'];
        $d_loc_id= $row['passenger_destination_location'];  
        $name=$row['first_name']." ".$row['last_name'];
    }

    if($s_loc_id==1){
    $result1= $db->query("SELECT * FROM locality where user_locality_id=$d_loc_id") or die($db->error);
    if($result1->num_rows>0){
        while($row1=$result1->fetch_assoc()){
                $ride_distance = $row1['locality_distance'];
                $cl="KIT COLLEGE";
                $dl=$row1['locality_name'];
            }
        }
    }
    else if($d_loc_id==1){
    $result1= $db->query("SELECT * FROM locality where user_locality_id=$s_loc_id") or die($db->error);
    if($result1->num_rows>0){
        while($row1=$result1->fetch_assoc()){
                $ride_distance = $row1['locality_distance'];
                $dl="KIT COLLEGE";
                $cl=$row1['locality_name'];
            }
        }
    }
        
    if($ride_distance>=8){
        $ride_fare=15;
    }
    else if(4<=$ride_distance and $ride_distance<8)
    {
        $ride_fare=10;
    }
    else if($ride_distance<4){
        $ride_fare=8;
    }

    $result2 = $db->query("call generate_rideHistory('$riderid','$passid','$s_loc_id','$d_loc_id','$ride_fare')") or die($db->error);
    
    echo "<script>
            window.alert('Your Ride Confirmed');
            window.location='riderHome.html';
        </script>";
?>