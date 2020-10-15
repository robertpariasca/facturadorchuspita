$("#frmGenerarDocumento").submit(function (event) {
  event.preventDefault();

  swal(
    {
      title: "Confirme",
      text: "¿Esta seguro de generar este documento?",
      confirmButtonColor: "#3d9205",
      buttons: ["No", "Si"],
      buttons: {
        cancel: {
          text: "No",
          value: null,
          visible: false,
          className: "",
          closeModal: true,
        },
        confirm: {
          text: "Si",
          value: true,
          visible: true,
          className: "",
          closeModal: false
        }
      },
      icon: "../images/pregunta.png",
    }).then(function (isConfirm) {
      if (isConfirm) {
        var tipodoc = $("input[name='tipodoc']:checked").val();
        var serie = "";
        if (tipodoc == "01") {
          serie = serie + "F";
        } else if (tipodoc == "03") {
          serie = serie + "B";
        }
        var corre = "";
        var subtotal = 0.00;
        var gravado = 0.00;
        var inafecto = 0.00;
        var exonerado = 0.00;
        var igv = 0.00;

        var total = parseFloat($("#texttotalproducto").val()).toFixed(2);
        var preciosinigv = 0.00;
        var productoigv = 0.00;
        var ICBPERprod =0.00;
        /*Impuestos*/

        $("#detprod tbody>tr").each(function () {
          var cantproducto = parseFloat(
            $(this).find(".cantproducto").html()
          ).toFixed(2);
          var precioproducto = parseFloat(
            $(this).find(".precioproducto").html()
          );
          var icbperproducto = parseFloat(
            $(this).find(".icbper").html()
          );
          var subtotitem = (
            parseFloat(cantproducto) * parseFloat(precioproducto)
          );
          var icbperitem = (
            parseFloat(cantproducto) * parseFloat(icbperproducto)
          );
          var codinafecto = $(this).find(".inafecto").html();
          if (codinafecto == "GRA") {
            var preciosinigvunit = 0;
            var productoigvunit = 0;
            var icbperunit = 0;

            preciosinigvunit = parseFloat(
              (parseFloat(subtotitem) * 100) / 118
            ).toFixed(2);
            productoigvunit = parseFloat(
              parseFloat(subtotitem) - parseFloat(preciosinigvunit)
            );
            icbperunit = parseFloat(icbperitem).toFixed(2);

            preciosinigv = (
              parseFloat(preciosinigv) + parseFloat(preciosinigvunit)
            );
            productoigv = (
              parseFloat(productoigv) + parseFloat(productoigvunit)
            );
            gravado = (
              parseFloat(gravado) + parseFloat(preciosinigvunit)
            );
            ICBPERprod = (
              parseFloat(ICBPERprod) + parseFloat(icbperunit)
            );
          } else {

            var icbperunit = 0;
            icbperunit = parseFloat(icbperitem);

            preciosinigv = (
              parseFloat(preciosinigv) + parseFloat(subtotitem)
            );
            exonerado = (
              parseFloat(exonerado) + parseFloat(subtotitem)
            );
            ICBPERprod = (
              parseFloat(ICBPERprod) + parseFloat(icbperunit)
            );
          }
        });

        /*Impuestos*/

        //subtotal = ((parseFloat(total) * 100) / 118).toFixed(2);
        //igv = (parseFloat(total) - parseFloat(subtotal)).toFixed(2);
        gravado = parseFloat(gravado).toFixed(2);
        inafecto = parseFloat(inafecto).toFixed(2);
        exonerado = parseFloat(exonerado).toFixed(2);
        subtotal = parseFloat(preciosinigv).toFixed(2);
        igv = parseFloat(productoigv).toFixed(2);
        ICBPERprod = parseFloat(ICBPERprod).toFixed(2);
        total = parseFloat(total).toFixed(2);

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
                    p_gravado: gravado,
                    p_inafecto: inafecto,
                    p_exonerado: exonerado,
                    p_subtotal: subtotal,
                    p_igv: igv,
                    p_icbper: ICBPERprod,
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
                          $("#detprod tbody>tr").remove();

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
                  var textinafecto = $(this).find(".inafecto").html();
                  var texticbper = $(this).find(".icbper").html();
                  var gravadouni = 0.00;
                  var inafectouni = 0.00;
                  var exoneradouni = 0.00;
                  var cantproducto = parseFloat(
                    $(this).find(".cantproducto").html()
                  ).toFixed(2);
                  var precioproducto = parseFloat(
                    $(this).find(".precioproducto").html()
                  ).toFixed(2);

                  var preciosinigv = "0.00";
                  var productoigv = "0.00";

                  if (textinafecto == "GRA") {
                    var preciosinigv = 
                      (parseFloat(precioproducto) * 100) /
                      118
                    ;
                    var productoigv = 
                      parseFloat(precioproducto) - parseFloat(preciosinigv)
                    ;
                    gravadouni = parseFloat(preciosinigv);
                  } else {
                    var preciosinigv = parseFloat(precioproducto).toFixed(2);
                    exoneradouni = preciosinigv;
                  }

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
                      p_gravadouni: gravadouni,
                      p_inafectouni: inafectouni,
                      p_exoneradouni: exoneradouni,
                      p_precioventa: precioproducto,
                      p_icbper: texticbper,
                      p_cantidad: cantproducto,
                      p_inafecto: textinafecto,
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
