$("#frmGenerarDocumento").submit(function (event) {
  event.preventDefault();

  swal(
    {
      title: "Confirme",
      text: "¿Esta seguro de generar este documento?",
      showCancelButton: true,
      confirmButtonColor: "#3d9205",
      confirmButtonText: "Si",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: true,
      imageUrl: "../images/pregunta.png",
    },
    function (isConfirm) {
      if (isConfirm) {
        var tipodoc = $("input[name='tipodoc']:checked").val();
        var serie = "";
        if (tipodoc == "01") {
          serie = serie + "F";
        } else if (tipodoc == "03") {
          serie = serie + "B";
        }
        var corre = "";
        var subtotal = 0;
        var igv = 0;
        var total = parseFloat($("#texttotalproducto").val()).toFixed(2);

        subtotal = ((parseFloat(total) * 100) / 118).toFixed(2);
        igv = (parseFloat(total) - parseFloat(subtotal)).toFixed(2);

        var fechaactual = new Date();
        var fechaemision =
          fechaactual.getFullYear() +
          "-" +
          String(fechaactual.getMonth() + 1).padStart(2, "0") +
          "-" +
          String(fechaactual.getDate()).padStart(2, "0");
        var horaemision =
          String(fechaactual.getHours()).padStart(2, "0") +
          ":" +
          String(fechaactual.getMinutes()).padStart(2, "0") +
          ":" +
          String(fechaactual.getSeconds()).padStart(2, "0");

        /* 
        Serie-Correlativo
        */
        $.post("../controller/gestionar.documento.obtener.correlativo.php", {
          p_tipodoc: tipodoc,
        })
          .done(function (resultado) {
            var datosJSON = resultado;

            if (datosJSON.estado === 200) {
              for (i = 0; i < resultado.datos.length; i++) {
                serie = serie + resultado.datos[i].serie_doc;
                corre = resultado.datos[i].corre_doc;
                /*
                    Codigo de Guardado y Trama
                    */

                $.post(
                  "../controller/gestionar.documento.generar.controller.php",
                  {
                    p_tipodoc: tipodoc,
                    p_seriedoc: serie,
                    p_nrodoc: corre,
                    p_nroruc: $("#textRuc").val(),
                    p_razonsocial: $("#textRazonSocial").val(),
                    p_direccion: $("#textDireccion").val(),
                    p_subtotal: subtotal,
                    p_igv: igv,
                    p_total: total,
                    p_fechaemision: fechaemision,
                    p_horaemision: horaemision,
                  }
                )
                  .done(function (resultado) {
                    var datosJSON = resultado;
                    if (datosJSON.estado === 200) {
                      $.post(
                        "../controller/gestionar.documento.actualizar.correlativo.controller.php",
                        {
                          p_tipodoc: tipodoc,
                          p_seriedoc: serie,
                          p_nrodoc: corre,
                        }
                      )
                        .done(function (resultado) {
                          var datosJSON = resultado;
                          /*Limpiar campos
                           */

                          $("#textRuc").val("");
                          $("#textRazonSocial").val("");
                          $("#textDireccion").val("");
                          $("#textproducto").val("");
                          $("#codproducto").val("");
                          $("#textCantProducto").val("0.00");
                          $("#textPrecioProducto").val("0.00");
                          $("#texttotalproducto").val("0.00");
                          $("#detprod tbody>tr").empty();

                          /*Limpiar campos
                           */

                          /*Impresion
                           */

                          var datosJSON = resultado;
                          if (datosJSON.estado === 200) {
                            $.post(
                              "../controller/gestionarFactura.imprimir.documento.controller.php",
                              {
                                p_tipodoc: tipodoc,
                                p_seriedoc: serie,
                                p_nrodoc: corre,
                              }
                            )
                              .done(function (resultado) {
                                var datosJSON = resultado;

      
                              })
                              .fail(function (error) {
                                var datosJSON = $.parseJSON(error.responseText);
                                swal("Error", datosJSON.mensaje, "error");
                              });
                          }
                           
                        })
                        .fail(function (error) {
                          var datosJSON = $.parseJSON(error.responseText);
                          swal("Error", datosJSON.mensaje, "error");
                        });

                        /*Impresion
                           */

                    }
                  })
                  .fail(function (error) {
                    var datosJSON = $.parseJSON(error.responseText);
                    swal("Error", datosJSON.mensaje, "error");
                  });

                $("#detprod tbody>tr").each(function () {
                  //alert(codpromocion);
                  var codproducto = $(this).find(".codproducto").html();
                  var textproducto = $(this).find(".textproducto").html();
                  var cantproducto = parseFloat(
                    $(this).find(".cantproducto").html()
                  ).toFixed(2);
                  var precioproducto = parseFloat(
                    $(this).find(".precioproducto").html()
                  ).toFixed(2);
                  var preciosinigv = (
                    (parseFloat(precioproducto) * 100) /
                    118
                  ).toFixed(2);
                  var productoigv = (
                    parseFloat(precioproducto) - parseFloat(preciosinigv)
                  ).toFixed(2);
                  $.post(
                    "../controller/gestionar.documento.generar.detalle.controller.php",
                    {
                      p_tipodoc: tipodoc,
                      p_seriedoc: serie,
                      p_nrodoc: corre,
                      p_codproducto: codproducto,
                      p_nomproducto: textproducto,
                      p_preciosinigv: preciosinigv,
                      p_productoigv: productoigv,
                      p_precioventa: precioproducto,
                      p_cantidad: cantproducto,
                    }
                  )
                    .done(function (resultado) {
                      var datosJSON = resultado;
                      swal("Exito", datosJSON.mensaje, "success");
                      //location.reload();
                      $("#btncerrar").click(); //Cerrar la ventana
                    })
                    .fail(function (error) {
                      var datosJSON = $.parseJSON(error.responseText);
                    });
                });

                /*
                    Codigo de Guardado y Trama
                    */
              }
            } else {
            }
          })
          .fail(function (error) {
            var datosJSON = $.parseJSON(error.responseText);
          });
      }
    }
  );
});
