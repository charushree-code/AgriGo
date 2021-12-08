<?php
    session_start();
    echo $_SESSION['user'];
    $host = "localhost";
$port = "5432";
$dbname = "agrigo";
$user = "postgres";
$password = "charu2001"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);
$utente= $_SESSION['user'];

$query = "SELECT USER_ID FROM government where government.USER_NAME='$_SESSION[user]' and government.JOB='farmer'";
$rs = pg_query($dbconn, $query) or die("Cannot execute query: $query\n");
$row = pg_fetch_row($rs);
$farmer_id=$row[0];


//insert

$lo="insert into crop values('$_POST[CROP_TYPE]','$_POST[CROP_NAME]','$_POST[quantity]',$farmer_id)";
$re = pg_query($dbconn, $lo);
if($re){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }
//delete
$lo="delete * from crop where crop.FAR_ID=$farmer_id and crop.CROP_NAME='$_POST[CROP_N]'";
$re = pg_query($dbconn, $lo);
if($re){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }

    ?>