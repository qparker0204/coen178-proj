<?php
  $machineId = $_POST['uMachId'];
  $newMachStat = $_POST['newMachStat'];
  $curTime = $_POST['curTime'];
  $costs = $_POST['costs'];

  $conn = oci_connect('qparker', '01Eragon01', '//dbserver.engr.scu.edu/db11g');
  if(!$conn){
    alert("Could not connect to database");
    exit;
  }

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
        <h3>Machine Status Uodated</h3>
        <div class="row">
          <div class="col s4">
            <p><b>Machine ID: </b><?php echo $machineId; ?></p>
          </div>
          <div class="col s4">
            <p><b>Updated Status: </b><?php echo $newMachStat; ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col s4">
            <p><b>Current Time: </b><?php echo $curTime; ?></p>
          </div>
          <div class="col s4">
            <p><b>Costs: </b><?php echo $costs; ?></p>
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
