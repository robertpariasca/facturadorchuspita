$("#frmgrabarUsuarioCli").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro de registrar este cliente?",
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
/*
                    alert($("#opcdoccli option:selected").val());
                    alert($("#textdoccli").val());
                    alert($("#textNombreCompletoCli").val());
                    alert($("#textDireccionCli").val());
                    alert($("#fechaNacCli").val());
                    alert($("#textEmailCli").val());
                    alert($("#telCli").val());
                    alert($("#textUsuarioCli").val());
                    alert($("#textPasswordCli").val());
*/
                    $.post(
                            "../controller/registrate.cliente.agregar.controller.php",
                            {
                                p_tipodoc: $("#opcdoccli option:selected").val(),
                                p_dni: $("#textdoccli").val(),
                                p_nombreCompleto: $("#textNombreCompletoCli").val(),
                                p_usuario: $("#textUsuarioCli").val(),
                                p_password: $("#textPasswordCli").val()
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
                            mostrarI();
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


$("#btnagregar").click(function () {
    $("#txtTipoOperacion").val("agregar");
    $("#txtCodigo").val("");
    $("#txtDni").val("");
    $("#txtNombre").val("");
    $("#txtApellidos").val("");
    $("#txtDireccion").val("");
    $("#estado_civil").val("");
    $("#txtDepartamento").val("");
    $("#txtProvincia").val("");
    $("#txtEmail").val("");
    $("#txtTelefono").val("");
    $("#sexo").val("");
    $("#edad").val("");
    $("#hijo").val("");
    $("#cuenta").val("");
    $("#contrasenia").val("");
    $("#titulomodal").html("Crear nuevo usuario");
});


$("#myModal").on("shown.bs.modal", function () {
    $("#txtNombre").focus();
});


function leerDatos(codLab) {
    $.post
            (
                    "../controller/laboratorio.leer.datos.controller.php",
                    {
                        p_cod_lab: codLab
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            $("#txtCodigo").val(jsonResultado.datos.codigo_laboratorio);
            $("#txtNombre").val(jsonResultado.datos.nombre);
            $("#cboPais").val(jsonResultado.datos.codigo_pais);
            $("#titulomodal").html("Modificar datos del laboratorio");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}


function eliminar(codLab) {
    swal({
        title: "Confirme",
        text: "¿Esta seguro de eliminar el registro seleccionado?",
        showCancelButton: true,
        confirmButtonColor: '#d93f1f',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/eliminar2.png"
    },
            function (isConfirm) {
                if (isConfirm) {
                    $.post(
                            "../controller/laboratorio.eliminar.controller.php",
                            {
                                p_cod_lab: codLab
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;
                        if (datosJSON.estado === 200) { //ok
                            listar();
                            swal("Exito", datosJSON.mensaje, "success");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

}
