<?php
  $repId = $_POST['vRepId'];

  $conn = oci_connect('qparker', '01Eragon01', '//dbserver.engr.scu.edu/db11g');
  if(!$conn){
    alert("Could not connect to database");
    exit;
  }
  

  $sql = "SELECT genBill('$repId') from dual";
  $sql_stmt = OCIParse($conn, $sql);
  OCIExecute($sql_stmt);
  OCIFetch($sql_stmt);
  $column_value = OCIResult($sql_stmt, 1);
  $values = explode(",", $column_value);
  if($values[4] == 0){
    $warranty = "Yes";
  }
  else{
    $warranty = "No";
  }
  $laborCost = $values[3]*25 + 50;
?>
<!DOCTYPE html>
<html>
   <head>
    <title>SoPrompt Services Inc.</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	  <link rel="stylesheet" href="../css/materialize.min.css">
    <linl rel="stylesheet" href="../css/style.css">
  </head>
  <body class="container">
      <div class="card-panel center teal">
        <h3 style="color:white">SoPrompt Services Inc.</h3>
      </div>
      <div class="card-panel white">
        <h3>Customer Bill</h3>
        <div class="row">
          <div class="col s4">
            <p><b>Customer Name: </b><?php echo $values[6] ?></p>
          </div>
          <div class="col s4">
            <p><b>Customer Phone: </b><?php echo $values[5]; ?></p>
          </div>
	</div>
	<div class="row">
	  <table class="striped center">
	    <thead>
	      <tr><th>Problem Code</th><th>Problem Description</th><th>Problem Cost</th><th>Hours Worked</th><th>Labor Cost</th></tr>
	    </thead>
	    <tr>
	      <td><?php echo $values[0]?></td>
	      <td><?php echo $values[1]?></td>
	      <td><?php echo "$".$values[2]?></td>
	      <td><?php echo $values[3]?></td>
	      <td><?php echo "$".$laborCost?></td>
	    </tr>
	  </table>
	</div>
        <div class="row">
	  <div class="col s4">
	    <p><b>Under Warranty?: <b><?php echo $warranty?></p>
	  </div>
          <div class="col s4">
            <p><b>Total Charges: $</b><?php echo $values[4] ?></p>
          </div>
        </div>
        <div class="row">
          <button id="back" class="btn-large waves-effect waves-dark grey" onclick="goBack()"><i class="material-icons left">arrow_back</i>Back</button>
        </div>
      </div>

      <!-- Materialize Core Javascript -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="../js/materialize.min.js"></script>
      <!-- JQuery Scripts -->
      <script src="../js/soprompt.js"></script>
      <script>
        function goBack(){
          window.history.back();
        }
      </script>
    </body>
</html>
