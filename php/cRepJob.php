<?php
  $machineId = $_POST['cMachId2'];
  $monthIn = $_POST['cMonthIn'];
  $dayIn = $_POST['cDayIn'];
  $yearIn = $_POST['cYearIn'];
  $timeIn = $_POST['cTimeIn'];

  $dateIn = $monthIn."-".$dayIn."-".$yearIn;

  echo "Machine ID: ".$machineId."<br>";
  echo "Date In: ".$dateIn."<br>";
  echo "Time In: ".$timeIn;
?>
