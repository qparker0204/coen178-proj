$(document).ready(function(){
  $("#vMachStat").click(function(){
    $("#vMachStatForm").slideToggle();
    $("#vBillForm").hide();
  });

  $("#vBill").click(function(){
    $("#vBillForm").slideToggle();
    $("#vMachStatForm").hide();
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
});