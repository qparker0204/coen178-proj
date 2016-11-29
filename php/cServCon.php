<?php
  $machineId = $_POST['cMachId1'];
  $pNum = $_POST['cPhoneNumber'];
  $startMonth = $_POST['cStartMonth'];
  $startDay = $_POST['cStartDay'];
  $startYear = $_POST['cStartYear'];
  $endMonth = $_POST['cEndMonth'];
  $endDay = $_POST['cEndDay'];
  $endYear = $_POST['cEndYear'];

  $startDate = $startMonth."-".$startDay."-".$startYear;
  $endDate = $endMonth."-".$endYear."-".$endDay;

  echo "Machine ID: ".$machineId."<br>";
  echo "Phone Number: ".$pNum."<br>";
  echo "Start Date: ".$startDate."<br>";
  echo "End Date: ".$endDate;
?>
