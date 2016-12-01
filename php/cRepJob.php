<?php
  $machineId = $_POST['cMachId2'];
  $repairId = $_POST['cRepId'];
  $model = $_POST['cModel'];
  $monthIn = $_POST['cMonthIn'];
  $dayIn = $_POST['cDayIn'];
  $yearIn = $_POST['cYearIn'];
  $timeIn = $_POST['cTimeIn'];
  $repPersonId = $_POST['cRepPersonId'];
  $covered = $_POST['cCovered'];
  $pNum = $_POST['cPhoneNumber2'];
  

  $dateIn = $dayIn."-".$monthIn."-".$yearIn;
  $status = "1";
  $timeIn = $dateIn." ".$timeIn.":00";
  $hWorked = 0;

  $conn = oci_connect('qparker', '01Eragon01', '//dbserver.engr.scu.edu/db11g');
  if(!$conn){
    alert("Could not connect to database");
    exit;
  }

  $sql = "INSERT INTO MachineUnderRepair (repairId, machineId, model, personId, timeIn, status, coverage, hoursWorked, phone) VALUES ('$repairId', '$machineId', '$model', '$repPersonId', '$timeIn', '$status', '$covered', '$hWorked', '$pNum')";
  $sql_stmt = OCIParse($conn, $sql);
  OCIExecute($sql_stmt);
  OCIFreeStatement($sql_stmt);
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
        <h3>New Repair Job Created</h3>
        <div class="row">
          <div class="col s4">
            <p><b>Machine ID: </b><?php echo $machineId; ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col s4">
            <p><b>Date In: </b><?php echo $dateIn; ?></p>
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
      <script>
        function goBack(){
          window.history.back();
        }
      </script>
    </body>
</html>
