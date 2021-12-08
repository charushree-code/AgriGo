<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
echo "hi";
$host = "localhost";
$port = "5432";
$dbname = "agrigo";
$user = "postgres";
$password = "charu2001"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);
echo "stage1";

echo "connection established";
$utente=$_POST['fname'];
$psw=$_POST['fpass'];
$query="CREATE USER {$utente} WITH password '{$psw}'";
pg_prepare($dbconn, "", $query);
$result = pg_execute($dbconn, "", []);
//
$lo="insert into government values('$_POST[farmer_id]','$_POST[fname]','farmer','$_POST[fpass]')";
$re = pg_query($dbconn, $lo);
if($re){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }

$loa="insert into loan values('$_POST[loan_id]','$_POST[loan]')";
$ret1 = pg_query($dbconn, $loa);
if($ret1){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }



$ban="insert into bank values('$_POST[bank_id]','$_POST[bank]')";
$ret2 = pg_query($dbconn, $ban);
if($ret2){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }

$place_insert="insert into place values('$_POST[pincode]','$_POST[d_no]','$_POST[addr]','$_POST[district]','$_POST[village]')";
$ret3 = pg_query($dbconn, $place_insert);
if($ret3){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }

$sql = "insert into farmer values('$_POST[farmer_id]','$_POST[farmername]','$_POST[gender]','$_POST[phno]','$_POST[acres]','$_POST[watertype]','$_POST[d_no]','$_POST[loan_id]','$_POST[bank_id]')";
$ret = pg_query($dbconn, $sql);
if($ret){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }
if($ret && $ret1 && $ret2 && $ret3 && $result){
    echo '<h1> SUCCESSFULL REGISTRATION </h1>';
    echo 'image';
    echo("<button onclick=\"location.href='login.php'\">LOGIN PAGE</button>");
    echo '<a href="login.php"  role="button" aria-disabled="true">login</a>';
}
else{
    echo '<h1>REGISTRATION FAILED</h1>';
}
?>   

</body>
</html>

