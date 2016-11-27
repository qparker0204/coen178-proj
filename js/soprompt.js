$(document).ready(function(){
  $("#vMachStat").click(function(){
    $("#vMachStatForm").show();
    $("#vBillForm").hide();
  });

  $("#vBill").click(function(){
    $("#vBillForm").show();
    $("#vMachStatForm").hide();
  });

  $("#cServCon").click(function(){
    $("#cServConForm").show();
    $("#cRepJobForm").hide();
  });

  $("#cRepJob").click(function(){
    $("#cRepJobForm").show();
    $("#cServConForm").hide();
  });

  $("#uMachStat").click(function(){
    $("#uMachStatForm").show();
  });
});
