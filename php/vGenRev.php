<?php
  $startDate = $_POST['vRevStartDate'];
  $endDate = $_POST['vRevEndDate'];

  $conn = oci_connect('qparker', '01Eragon01', '//dbserver.engr.scu.edu/db11g');
  if(!$conn){
    alert("Could not connect to database");
    exit;
  }
  
  $sql = "SELECT * FROM MachineUnderRepair";
  $sql_stmt = OCIParse($conn, $sql);
  OCIExecute($sql_stmt);
  $num_columns = OCINumCols($sql_stmt);
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
        <h3>Machine Status</h3>
        <div class="row">
          <table BORDER=1>
	    <TR><TH>Repair ID</TH><TH>Machine ID</TH><TH>Model</TH><TH>Repair Person ID</TH><TH>TimeIn</TH><TH>TimeOut</TH><TH>Status</TH><TH>Coverage</TH>
	  <?php
	    while (OCIFetch($sql_stmt)) {
	      echo "<TR>";
	      for ($i = 1; $i <= $num_columns; $i++) {
		$column_value = OCIResult($sql_stmt, $i);
		echo "<TD>$column_value</TD>";
	      }
	      echo "</TR>";
	    }
	  ?>
	  </table>
        </div>
        <div class="row">
	  <div>
	    <button id="back" class="btn-large waves-effect waves-dark grey" onclick="goBack()"><i class="material-icons left">arrow_back</i>Back</button>
	  </div>
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