<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
body {font-family: Arial, Helvetica, sans-serif;}
body, html {
  height: 100%;
}

.bg {
  /* The image used */
  background-image: url('images/BACKGROUND.png');

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}


/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
.below{

}
}
</style>
  </head>
  
<body>
    
<div class='bg'>

<?php include 'header1.php'?>
<?php
$host = "localhost";
$port = "5432";
$dbname = "agrigo";
$user = "postgres";
$password = "charu2001"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);
session_start();

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
if(!$re){
  echo "Soething Went Wrong";
}
$place_insert="insert into warehouse values('$_POST[warehouse]','$_POST[location]','$_POST[owner]','$_POST[capacity]')";
$ret3 = pg_query($dbconn, $place_insert);
if(!$ret3){
    
  echo "Soething Went Wrong";
}
$lo1="insert into stored_at values('$_POST[CROP_NAME]',$farmer_id,'$_POST[warehouse]')";
$re = pg_query($dbconn, $lo1);
if(!$re){
  echo "Soething Went Wrong";
}
if ($re && $ret3 && $re){
  echo '<script>alert("Crop added succesfully")</script>';
}
}
//delete
else if(isset($_POST['new']) && $_POST['new']=='2'){
  echo $_POST['new'];
  
  $lo="delete from crop where crop.CROP_NAME='$_POST[CROP_N]' and crop.FAR_ID='$farmer_id'";
  $re = pg_query($dbconn, $lo);
  if(!$re){
    echo "Soething Went Wrong";
  }
  $l1="delete from stored_at where stored_at.cname='$_POST[CROP_N]' and stored_at.farm_id='$farmer_id'";
  $re1 = pg_query($dbconn, $l1);
  if(!$re1){
    echo "Soething Went Wrong";
  }
  if ($re && $re1){
    echo '<script>alert("Crop deleted succesfully")</script>';
  }


}
//update
else if(isset($_POST['new']) && $_POST['new']=='3'){
  echo $_POST['new'];
  $lo="update crop set quantity='$_POST[quan]'  where crop.CROP_NAME='$_POST[CROP]' and crop.FAR_ID='$farmer_id'";
  $re = pg_query($dbconn, $lo);
  if(!$re){
    echo "Soething Went Wrong";
  }else{
      
    echo '<script>alert("Crop updated succesfully")</script>';
      }}

      ?>


<button id="myBtn" onclick="get_element('myModal','myBtn')">ADD CROPS</button>
<button id="myBtn1" onclick="get_element('myModal1','myBtn1')">DELETE CROPS</button>
<button id="myBtn2" onclick="get_element('myModal2','myBtn2')">UPDATE CROPS</button>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>
    <h1>ADDING CROPS</h1>
    <form name="form" method="post" action="">
    <input type="hidden" name="new" value="1" />
    <div>
    <label class="fieldlabels">crop name:</label> <input type="text" name="CROP_NAME" placeholder="crop name" />
    </div>
    <div>
    <label class="fieldlabels">crop type:</label> <input type="text" name="CROP_TYPE" placeholder="crop type" />
    </div>
    <div>
    <label class="fieldlabels">crop qunatity:</label> <input type="numbers" name="quantity" placeholder="quantity" />
    </div>
    <div>
    <label class="fieldlabels">WAREHOUSE_ID</label> <input type="number" name="warehouse" placeholder="0" />
    </div>
    <div>
    <label class="fieldlabels">LOCATION</label> <input type="text" name="location" placeholder="location" />
    </div>
    <div>
    <label class="fieldlabels">Owner</label> <input type="text" name="owner" placeholder="owner of warehouse" />
    </div>
    <div>
    <label class="fieldlabels">CAPACITY</label> <input type="number" name="capacity" placeholder="capacity" />
    </div>
    <div>
    <input type="submit"  />
    </div>
  </form>
</div>

  </div>
</div>

  
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

<!-- The Modal -->
<div id="myModal1" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>
    <h1>Deleting Crops</h1>
    
    <form action='' method=post> 
    <input type="hidden" name="new" value="2" />
    <label class="fieldlabels">crop name:</label> <input type="text" name="CROP_N" placeholder="crop name" />
    <input type="submit"  />
  </form></div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</div>





<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div>
  <h1>update CROPS</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="3" />
    <label class="fieldlabels">crop name:</label> <input type="text" name="CROP" placeholder="crop name" />
    <label class="fieldlabels">crop qunatity:</label> <input type="numbers" name="quan" placeholder="quantity" />

    <input type="submit"  />
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </div>
</div>


<script>
// Get the modal
function get_element(model,botton){
var modal = document.getElementById(model);

// Get the button that opens the modal
var btn = document.getElementById(botton);

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}}
</script>  

 
<div>
<h1> want to know farmers(s) whose working on particular crop and in same place.</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="4" />
    <label class="fieldlabels">crop name:</label> <input type="text" name="CRO" placeholder="crop name" />
    <input type="submit"  />
  </form></div>
  
    <?php 
    if(isset($_POST['new']) && $_POST['new']=='4'){

$lo="select farmer_name,village,crop_name from farmer,place,crop where crop.crop_name='$_POST[CRO]' and crop.FAR_ID=farmer.farmer_id and farmer.d_no=place.door_no";
$count=0;
$re = pg_query($dbconn, $lo);
  if($re){
    
    echo "<table>"; // start a table tag in the HTML
   
    while($row = pg_fetch_row($re)){   //Creates a loop to loop through results
    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";  //$row['index'] the index here is a field name
    }
    
    echo "</table>";
   


  
  }
  else{
  
    echo '<script>alert("ERROR")</script>';
}}?>
<div>
<h1> want to know List fertilizers and pesticides purchased with cost.</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="5" />
    <input type="submit"  />
  </form></div>
  <?php
  if(isset($_POST['new']) && $_POST['new']=='5'){
  $lo=" select pesticide,fertilizer,seed,quantity,sup_id,price from requirements ,offer where offer.farm_id='$farmer_id' and requirements.far_id='$farmer_id'";
  $count=0;
  $re = pg_query($dbconn, $lo);
    if($re){
     
    
      echo "<table>"; // start a table tag in the HTML
   
      while($row = pg_fetch_row($re)){   //Creates a loop to loop through results
      echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";  //$row['index'] the index here is a field name
      }
      
      echo "</table>";
      }
      else{
  
      echo "Soething Went Wrong";
  }}?>
  <div>
 <h1>Total price you  get for all crops you  produced.	</h1>
<form action='' method=post> 
    <input type="hidden" name="new" value="6" />
    <input type="submit"  />
  </form></div>

  <?php
  if(isset($_POST['new']) && $_POST['new']=='6'){
  $lo="select price,quantity,sum(price*quantity) from buys where  buys.farm_id='$farmer_id'  group by quantity,price"; 
  $li="select sum(buys.price*buys.quantity) as total from buys where  buys.farm_id='$farmer_id'";
  
  $re = pg_query($dbconn, $lo);
    if($re){
     
      echo "<table>"; // start a table tag in the HTML
   
      while($row = pg_fetch_row($re)){   //Creates a loop to loop through results
      echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";  //$row['index'] the index here is a field name
      }
      
      echo "</table>";
      
    }
    $re = pg_query($dbconn, $li);
    if($re){
     
      echo "<table>"; // start a table tag in the HTML
   
      while($row = pg_fetch_row($re)){   //Creates a loop to loop through results
      echo "<tr><td>" . $row[0] . "</td></tr>";  //$row['index'] the index here is a field name
      }
      
      echo "</table>";
      
    }
  }
    
    ?>
    </div>

  </body>
</html>
