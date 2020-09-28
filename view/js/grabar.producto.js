$("#frmGrabarProducto").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar este producto?",
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

                    $.post(
                            "../controller/gestionar.cliente.actualizar.controller.php",
                            {
                                p_descripcion: $("#textdescripcion").val(),
                                p_categoria: $("#opccategoria option:selected").val(),
                                p_tipo: $("#opctipo option:selected").val(),
                                p_marca: $("#opcmarca option:selected").val(),
                                p_envase: $("#opcenvase option:selected").val(),
                                p_medida: $("#opcmedida option:selected").val(),
                                p_precio: $("#textprecio").val(),
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

