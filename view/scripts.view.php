<!-- jQuery -->
<script src="../util/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../util/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../util/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../util/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../util/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../util/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../util/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../util/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../util/plugins/moment/moment.min.js"></script>
<script src="../util/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../util/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../util/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../util/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<!--<script src="../util/dist/js/adminlte.js"></script>-->
<script src="../util/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../util/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../util/dist/js/demo.js"></script>
<!--sweetalert-->
<script src="../util/plugins/swa/sweetalert-dev.js"></script>
<script src="../util/plugins/datatables/jquery.dataTables.js"></script>


<!-- InputMask -->
<script src="../util/plugins/moment/moment.min.js"></script>
<script src="../util/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="../util/plugins/daterangepicker/daterangepicker.js"></script>   

<script src="../util/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../util/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src = "https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"> </script>

<!--  CK Editor -->
<script src="../util/plugins/ckeditor/ckeditor.js"></script>
<!-- overlayScrollbars -->
<script src="../util/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FileSaver -->
<script src="../util/plugins/FileSaver/FileSaver.js"></script>



<script>

$(function () {

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })

            function mostrarR() {
							        //document.getElementById('iniciarSesion').style.display    = 'none';
							        //document.getElementById('registrarCuenta').style.display  = 'block';
									document.getElementById('iniciarSesion').style.display    = 'none';
									document.getElementById('elegirtipoCuenta').style.display    = 'block';
									document.getElementById('registrarCuentaCliente').style.display    = 'none';
									document.getElementById('registrarCuentaProveedor').style.display    = 'none';
							    }
			function mostrarC() {
							        //document.getElementById('iniciarSesion').style.display    = 'none';
							        //document.getElementById('registrarCuenta').style.display  = 'block';
									document.getElementById('iniciarSesion').style.display    = 'none';
									document.getElementById('elegirtipoCuenta').style.display    = 'none';
									document.getElementById('registrarCuentaCliente').style.display    = 'block';
									document.getElementById('registrarCuentaProveedor').style.display    = 'none';
							    }								
			function mostrarP() {
							        //document.getElementById('iniciarSesion').style.display    = 'none';
							        //document.getElementById('registrarCuenta').style.display  = 'block';
									document.getElementById('iniciarSesion').style.display    = 'none';
									document.getElementById('elegirtipoCuenta').style.display    = 'none';
									document.getElementById('registrarCuentaCliente').style.display    = 'none';
									document.getElementById('registrarCuentaProveedor').style.display    = 'block';
							    }
			function mostrarI() {
									document.getElementById('iniciarSesion').style.display    = 'block';
									document.getElementById('elegirtipoCuenta').style.display    = 'none';
									document.getElementById('registrarCuentaCliente').style.display    = 'none';
									document.getElementById('registrarCuentaProveedor').style.display    = 'none';
							    }
								
$(document).ready(function(){


		$('#opcdoccli').change(function() {
      $("#opcdoccli option[value='000']").remove();
      $("#textdoccli").attr("placeholder", $(this).children("option:selected").text());
      $("#textdoccli").prop("disabled", false);
        });
		$('#opcdocpro').change(function() {
      $("#opcdocpro option[value='000']").remove();
      $("#textdocpro").attr("placeholder", $(this).children("option:selected").text());
      $("#textdocpro").prop("disabled", false);
        });	
});


</script>
 <script>
                function ValidaSoloNumeros() {/* no permite el ingreso de carÃ¡cteres que no sean numeros*/
                if ((event.keyCode > 47) && (event.keyCode/* cÃ³digo de la tecla fÃ­sica*/ < 58)){
                  event.returnValue = true;
                }else{
              event.returnValue = false;
            } /* del 48 al 56 corresponde solo numeros*/
             
            }
            function ValidaSoloNumerosYPunto() {/* no permite el ingreso de carÃ¡cteres que no sean numeros*/
                if ((event.keyCode > 47) && (event.keyCode/* cÃ³digo de la tecla fÃ­sica*/ < 58) || event.keyCode == 46){
                  event.returnValue = true;
                }else{
              event.returnValue = false;
            } /* del 48 al 56 corresponde solo numeros*/
             
            }
</script>