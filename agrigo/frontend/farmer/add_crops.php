<?php
<style>
body {font-family: Arial, Helvetica, sans-serif;}

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
<button id="myBtn">ADD CROPS</button>

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
</div><div>

    <label class="fieldlabels">crop type:</label> <input type="text" name="CROP_TYPE" placeholder="crop type" />
</div><div>
    <label class="fieldlabels">crop qunatity:</label> <input type="numbers" name="quantity" placeholder="quantity" />
</div><div>
    <label class="fieldlabels">warehouse id its stored at</label> <input type="numbers" name="warehouse" placeholder="warehouse" />
</div><div>
    <label class="fieldlabels">WAREHOUSE_ID</label> <input type="number" name="warehouse" placeholder="0" />
    </div><div>
    <label class="fieldlabels">LOCATION</label> <input type="text" name="location" placeholder="location" />
    </div><div>
    <label class="fieldlabels">Owner</label> <input type="text" name="owner" placeholder="owner of warehouse" />
    </div><div>
    <label class="fieldlabels">CAPACITY</label> <input type="number" name="capacity" placeholder="capacity" />
    </div><div>
    <input type="submit"  />
</div>
  </form>
</div>
  </div>
</div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

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
}
</script>
?>