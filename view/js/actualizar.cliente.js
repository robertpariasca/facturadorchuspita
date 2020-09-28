$("#frmActualizarUsuarioCli").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro de actualizar este cliente?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) { 

                    if(document.getElementById("fotoUsuarioimagen").files.length != 0 ){
                        var blobFile = $('#fotoUsuarioimagen')[0].files[0];
                        var formData = new FormData();
                        formData.append("fileToUpload", blobFile);
                        // do the extra stuff here
                        $.ajax({
                         type: "POST",
                          url: "../controller/gestionar.cliente.actualizar.foto.controller.php",
                          //data: $(this).serialize(),
                          data: formData,
                          processData: false,
                          contentType: false,
                          success: function(response) {
                            if(response != 0){
                               
                            }else{
                                alert('Archivo no subido.');
                            }
                           }
                        })
                    }

                    $.post(
                            "../controller/gestionar.cliente.actualizar.controller.php",
                            {
                                p_tipodoc: $("#opcdoccli option:selected").val(),
                                p_dni: $("#textdoccli").val(),
                                p_nombreCompleto: $("#textNombreCompletoCli").val(),
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {

                            if (datosJSON.mensaje == "DUDoc"){
                                swal("Error", "Este número de documento ya esta registrado", "warning");
                            //location.reload();
                            $("#btncerrar").click(); //Cerrar la ventana 
                            }else if (datosJSON.mensaje == "DUAli"){
                                swal("Error", "Este usuario ya ha sido tomado", "warning");
                                //location.reload();
                                $("#btncerrar").click(); //Cerrar la ventana 
                            }else{
                                swal("Exito", datosJSON.mensaje, "success");
                            //location.reload();
                            $("#btncerrar").click(); //Cerrar la ventana 
                            }

                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

});

