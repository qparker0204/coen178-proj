$(document).ready(function(){
  //initialize materialize select tags
  $('select').material_select();
  
  $("#vMachStat").click(function(){
    $("#vMachStatForm").slideToggle();
    $("#vBillForm").hide();
    $("#vGenRevForm").hide();
  });

  $("#vBill").click(function(){
    $("#vBillForm").slideToggle();
    $("#vMachStatForm").hide();
    $("#vGenRevForm").hide();
  });

  $("#vGenRev").click(function(){
    $("#vGenRevForm").slideToggle();
    $("#vMachStatForm").hide();
    $("#vBillForm").hide();
  });

  $("#cServCon").click(function(){
    $("#cServConForm").slideToggle();
    $("#cRepJobForm").hide();
  });

  $("#cRepJob").click(function(){
    $("#cRepJobForm").slideToggle();
    $("#cServConForm").hide();
  });

  $("#uMachStat").click(function(){
    $("#uMachStatForm").slideToggle();
  });
  
  $("#vRepJob").click(function(){
    window.location.href="php/vRepJobs.php";
  });
});
