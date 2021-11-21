<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <a href="#" class="btn btn-primary btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">Primary link</a>
<a href="#" class="btn btn-secondary btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">Link</a>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

    <?php
session_start();

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
echo $_SESSION['user'];
echo $farmer_id;

//insert
if(isset($_POST['new']) && $_POST['new']=='1'){
echo $_POST['new'];
$lo="insert into crop values('$_POST[CROP_TYPE]','$_POST[CROP_NAME]','$_POST[quantity]',$farmer_id)";
$re = pg_query($dbconn, $lo);
if($re){
        echo "Data saved Successfully";
}else{
    
        echo "Soething Went Wrong";
    }}
//delete
else if(isset($_POST['new']) && $_POST['new']=='2'){
  echo $_POST['new'];
  
  $lo="delete from crop where crop.CROP_NAME='$_POST[CROP_N]' and crop.FAR_ID='$farmer_id'";
  $re = pg_query($dbconn, $lo);
  if($re){
          echo "Data saved Successfully";
  }else{
      
          echo "Soething Went Wrong";
      }}
//update
else if(isset($_POST['new']) && $_POST['new']=='3'){
  echo $_POST['new'];
  $lo="update crop set quantity='$_POST[quan]'  where crop.CROP_NAME='$_POST[CROP]' and crop.FAR_ID='$farmer_id'";
  $re = pg_query($dbconn, $lo);
  if($re){
          echo "Data saved Successfully";
  }else{
      
          echo "Soething Went Wrong";
      }}
//query 1
else if(isset($_POST['new']) && $_POST['new']=='4'){

$lo="select farmer_name,village,crop_name from farmer,place,crop where crop.crop_name='$_POST[CRO]' and crop.FAR_ID=farmer.farmer_id and farmer.d_no=place.door_no";
$count=0;
$re = pg_query($dbconn, $lo);
  if($re){
    echo "Data saved Successfully";
    while($row = pg_fetch_row($re)) {
      echo '<hr>';
    echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td</tr>";
    echo '<hr>';}}
    else{

    echo "Soething Went Wrong";
}
  
  }
//query2
else if(isset($_POST['new']) && $_POST['new']=='5'){
  $lo=" select pesticide,fertilizer,seed,quantity,sup_id,price from requirements ,offer where offer.farm_id='$farmer_id' and requirements.far_id='$farmer_id'";
  $count=0;
  $re = pg_query($dbconn, $lo);
    if($re){
      echo "Data saved Successfully";
      while($row = pg_fetch_row($re)) {
      
      echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td</tr>";}}
      else{
  
      echo "Soething Went Wrong";
  }
    
    }
//query3
else if(isset($_POST['new']) && $_POST['new']=='6'){
  $lo="select price,quantity,sum(price*quantity) from buys where  buys.farm_id='$farmer_id'  group by quantity,price"; 
  $li="select sum(buys.price*buys.quantity) as total from buys where  buys.farm_id='$farmer_id'";
  
  $re = pg_query($dbconn, $lo);
    if($re){
      echo "Data saved Successfully";
      while($row = pg_fetch_row($re)) {
      
      echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td</tr>";}}
      else{
  
      echo "Soething Went Wrong";
  }
    
    }
  else{
        echo '';
      }?>
    <h1>ADDING CROPS</h1>
    <form name="form" method="post" action="">
    <input type="hidden" name="new" value="1" />
    <label class="fieldlabels">crop name:</label> <input type="text" name="CROP_NAME" placeholder="crop name" />
    <label class="fieldlabels">crop type:</label> <input type="text" name="CROP_TYPE" placeholder="crop type" />
    <label class="fieldlabels">crop qunatity:</label> <input type="numbers" name="quantity" placeholder="quantity" />

    <input type="submit"  />
  </form>
}

    <h1>Deleting Crops</h1>
    
    <form action='' method=post> 
    <input type="hidden" name="new" value="2" />
    <label class="fieldlabels">crop name:</label> <input type="text" name="CROP_N" placeholder="crop name" />
    <input type="submit"  />
  </form>
  <h1>update CROPS</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="3" />
    <label class="fieldlabels">crop name:</label> <input type="text" name="CROP" placeholder="crop name" />
    <label class="fieldlabels">crop qunatity:</label> <input type="numbers" name="quan" placeholder="quantity" />

    <input type="submit"  />
  </form>

<h1> want to know farmers(s) whose working on particular crop and in same place.</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="4" />
    <label class="fieldlabels">crop name:</label> <input type="text" name="CRO" placeholder="crop name" />
    <input type="submit"  />
  </form>
<h1> want to know List fertilizers and pesticides purchased with cost.</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="5" />
    <input type="submit"  />
  </form>
  <h1>Total price you  get for all crops you  produced.	</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="6" />
    <input type="submit"  />
  </form>
  </body>
</html>