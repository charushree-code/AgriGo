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
$utente=$_POST['bname'];
$psw=$_POST['bpass'];
$query="CREATE USER {$utente} WITH password '{$psw}'";
pg_prepare($dbconn, "", $query);
$result = pg_execute($dbconn, "", []);
//
$lo="insert into government values('$_POST[buyer_id]','$_POST[bname]','buyer','$_POST[bpass]')";
$re = pg_query($dbconn, $lo);
if($re){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }

$place_insert="insert into warehouse values('$_POST[warehouse]','$_POST[location]','$_POST[owner]','$_POST[capacity]')";
$ret3 = pg_query($dbconn, $place_insert);
if($ret3){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";}
    

$sql = "insert into buyer values('$_POST[buyer_id]','$_POST[buyername]','$_POST[warehouse]')";
$ret = pg_query($dbconn, $sql);
if($ret){
    
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }
if($re && $ret && $result){
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

