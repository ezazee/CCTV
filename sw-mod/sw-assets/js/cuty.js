$(()=>{
  $('#tgl1').datetimepicker({
    locale:'id',
    format:'DD-MM-YYYY',
  });
    
   $('#tgl2').datetimepicker({
    useCurrent: false,
    locale:'id',
    format:'DD-MM-YYYY'
  });
    
    $('#tgl1').on("dp.change", function(e) {
      $('#tgl2').data("DateTimePicker").minDate(e.date);
    });
   
    $('#tgl2').on("dp.change", function(e) {
     $('#tgl1').data("DateTimePicker").maxDate(e.date);
      $('#selisih').val(Math.floor(CalcDiff()/(86400))+1)  
    });
  

    function CalcDiff(){
      var a=$('#tgl1').data("DateTimePicker").date();
      var b=$('#tgl2').data("DateTimePicker").date();
      var timeDiff=0
      timeDiff = (b - a) / 1000;
      return timeDiff 
      }
})
