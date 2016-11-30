<?php
  $pNum = $_POST['vPhoneNumber2'];

  $conn = oci_connect('qparker', '01Eragon01', '//dbserver.engr.scu.edu/db11g');
  if(!$conn){
    alert("Could not connect to database");
    exit;
  }
  

  $sql = "SELECT SUM(hoursWorked)
	  FROM MachineUnderRepair
	  WHERE phone = $pNum and coverage = 'Y'";

  $sql_statement = OCIParse($conn, $sql);
  
  OCIExecute($sql_statement);
  
  $sql_cust = "SELECT name
	      FROM Customer
	      WHERE phone = $pNum
	      ";

  $sql_cust_statement = OCIParse($conn, $sql_cust);
  OCIExecute($sql_cust_statement)
  
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
            <p><b>Customer Name: </b><?php echo  ?></p>
          </div>
          <div class="col s4">
            <p><b>Customer Phone: </b><?php echo $pNum; ?></p>
          </div>
        </div>
	<div class="">
	  <ol>
	    <li>Problem ID <?php ?></li>
	    <li>Description <?php ?></li>
	    <li>Cost <?php ?></li>
	  </ol>
	</div>
        <div class="row">
          <div class="col s4">
            <p><b>Total Charges: </b><?php ?></p>
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
