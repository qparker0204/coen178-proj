<?php
  $machineId = $_POST['cMachId1'];
  $contractId = $_POST['cConId'];
  if($_POST['cGroupId']){
    $groupId = $_POST['cGroupId'];
  }
  else{
    $groupId = "null";
  }
  $pNum = $_POST['cPhoneNumber'];
  $startMonth = $_POST['cStartMonth'];
  $startDay = $_POST['cStartDay'];
  $startYear = $_POST['cStartYear'];
  $endMonth = $_POST['cEndMonth'];
  $endDay = $_POST['cEndDay'];
  $endYear = $_POST['cEndYear'];

  $startDate = $startMonth."-".$startDay."-".$startYear;
  $endDate = $endMonth."-".$endYear."-".$endDay;

  $conn = oci_connect('qparker', '01Eragon01', '//dbserver.engr.scu.edu/db11g');
  if(!$conn){
    alert("Could not connect to database");
    exit;
  }

  $sql = "INSERT INTO Contract VALUES ($contractId, $startDate, $endDate)";
  $sql_stmt = OCIParse($conn, $sql);
  OCIExecute($sql_stmt);

  $sql = "INSERT INTO ServiceItem VALUES($machineId, $groupId, $pNum, $contractId)"
  $sql_stmt = OCIParse($conn, $sql);
  OCIExecute($sql_stmt);
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
        <h3>New Service Contract Created</h3>
        <div class="row">
          <div class="col s4">
            <p><b>Machine ID: </b><?php echo $machineId; ?></p>
          </div>
          <div class="col s4">
            <p><b>Phone Number: </b><?php echo $pNum; ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col s4">
            <p><b>Start Date: </b><?php echo $startDate; ?></p>
          </div>
          <div class="col s4">
            <p><b>End Date: </b><?php echo $endDate; ?></p>
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
