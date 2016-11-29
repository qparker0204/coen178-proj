<?php
  $machineId = $_POST['uMachId'];
  $newMachStat = $_POST['newMachStat'];
  $curTime = $_POST['curTime'];
  $costs = $_POST['costs'];

  echo "Machine ID: ".$machineId."<br>";
  echo "Machine Status: ".$newMachStat."<br>";
  echo "Current Time: ".$curTime."<br>";
  echo "Costs: ".$costs;
?>
