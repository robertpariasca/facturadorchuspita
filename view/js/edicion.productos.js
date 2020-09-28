$(document).ready(function () {
  cargarvalores();
  cargarProductos();

  $(document).on("click", ".update", function () {
    var codproducto = $(this).closest("tr").find("td:eq(0)").text();
    $.post(
      "../controller/gestionarProducto.editar.cargar.datos.controller.php",
      {
        p_codproducto: codproducto,
      }
    )
      .done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado === 200) {
          for (i = 0; i < resultado.datos.length; i++) {
            $("#textdescripcion").val(resultado.datos[i].descripcion);
         
            $("#opccategoria option[value='"+ resultado.datos[i].id_categoria +"']").prop('selected', true);

            $("#opctipo option[value='"+ resultado.datos[i].id_tipo +"']").prop('selected', true);

            $("#opcmarca option[value='"+ resultado.datos[i].id_marca +"']").prop('selected', true);

            $("#opcenvase option[value='"+ resultado.datos[i].id_envase +"']").prop('selected', true);

            $("#opcmedida option[value='"+ resultado.datos[i].id_unidad_medida +"']").prop('selected', true);

            $("#textprecio").val(resultado.datos[i].precio);

            $("#textcodproducto").val(resultado.datos[i].cod_producto);
            
          }
        } else {
        }
      })
      .fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
      });

    $("#btngrabar").text("Actualizar");
    
    $('.nav-pills a[href="#activity"]').tab("show");
  });

  $(document).on("click", ".delete", function () {
    //alert($(this).closest('tr').find('td:eq(0)').text());

    if (confirm("¿Esta seguro que desea eliminar este producto?")) {
      var codproducto = $(this).closest("tr").find("td:eq(0)").text();

      $.post(
        "../controller/gestionarProducto.eliminar.producto.controller.php",
        {
          p_codproducto: codproducto,
        }
      )
        .done(function (resultado) {
          var datosJSON = resultado;
          if (datosJSON.estado === 200) {
            alert("Producto eliminado");

            $("#tblproducto tbody>tr").empty();
            cargarProductos();
          } else {
            //swal("Mensaje del sistema", resultado , "warning");
          }
        })
        .fail(function (error) {
          var datosJSON = $.parseJSON(error.responseText);
          //swal("Error", datosJSON.mensaje , "error");
        });
    } else {
      return;
    }
  });


$("#frmGrabarProducto").submit(function (event) {
  event.preventDefault();
  var text = "¿Esta seguro de grabar este producto?"
if($("#btngrabar").text() == "Actualizar"){
  text = "¿Esta seguro de actualizar este producto?"
}
swal(
  {
    title: "Confirme",
    text: text,
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

      if($("#btngrabar").text() == "Actualizar"){

      
        $.post("../controller/gestionarProducto.editar.producto.controller.php", {
          p_codproducto: $("#textcodproducto").val(),
          p_descripcion: $("#textdescripcion").val(),
          p_precio: $("#textprecio").val(),
        })
          .done(function (resultado) {
            var datosJSON = resultado;
  
            if (datosJSON.estado === 200) {
              if (datosJSON.mensaje == "DUDoc") {
                swal(
                  "Error",
                  "Este número de documento ya esta registrado",
                  "warning"
                );
                //location.reload();
                $("#btncerrar").click(); //Cerrar la ventana
              } else if (datosJSON.mensaje == "DUAli") {
                swal("Error", "Este usuario ya ha sido tomado", "warning");
                //location.reload();
                $("#btncerrar").click(); //Cerrar la ventana
              } else {
                swal("Exito", datosJSON.mensaje, "success");
                //location.reload();
                $("#btncerrar").click(); //Cerrar la ventana
              }
            } else {
              swal("Mensaje del sistema", resultado, "warning");
            }
          })
          .fail(function (error) {
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
          });

        }else{
      
          $.post("../controller/gestionar.cliente.actualizar.controller.php", {
            p_descripcion: $("#textdescripcion").val(),
            p_categoria: $("#opccategoria option:selected").val(),
            p_tipo: $("#opctipo option:selected").val(),
            p_marca: $("#opcmarca option:selected").val(),
            p_envase: $("#opcenvase option:selected").val(),
            p_medida: $("#opcmedida option:selected").val(),
            p_precio: $("#textprecio").val(),
          })
            .done(function (resultado) {
              var datosJSON = resultado;
    
              if (datosJSON.estado === 200) {
                if (datosJSON.mensaje == "DUDoc") {
                  swal(
                    "Error",
                    "Este número de documento ya esta registrado",
                    "warning"
                  );
                  //location.reload();
                  $("#btncerrar").click(); //Cerrar la ventana
                } else if (datosJSON.mensaje == "DUAli") {
                  swal("Error", "Este usuario ya ha sido tomado", "warning");
                  //location.reload();
                  $("#btncerrar").click(); //Cerrar la ventana
                } else {
                  swal("Exito", datosJSON.mensaje, "success");
                  //location.reload();
                  $("#btncerrar").click(); //Cerrar la ventana
                }
              } else {
                swal("Mensaje del sistema", resultado, "warning");
              }
            })
            .fail(function (error) {
              var datosJSON = $.parseJSON(error.responseText);
              swal("Error", datosJSON.mensaje, "error");
            });
        }

    }
  }
);
});

});

function cargarvalores() {
  $.post("../controller/gestionarProducto.cargar.tipo.controller.php")
    .done(function (resultado) {
      var datosJSON = resultado;

      if (datosJSON.estado === 200) {
        for (i = 0; i < resultado.datos.length; i++) {
          var o = new Option(
            resultado.datos[i].descripcion_tipo,
            resultado.datos[i].codigo_tipo
          );
          $(o).html(resultado.datos[i].descripcion_tipo);
          $("#opctipo").append(o);
        }
      } else {
        //swal("Mensaje del sistema", resultado , "warning");
      }
    })
    .fail(function (error) {
      var datosJSON = $.parseJSON(error.responseText);
      //swal("Error", datosJSON.mensaje , "error");
    });

  $.post("../controller/gestionarProducto.cargar.categoria.controller.php")
    .done(function (resultado) {
      var datosJSON = resultado;

      if (datosJSON.estado === 200) {
        for (i = 0; i < resultado.datos.length; i++) {
          var o = new Option(
            resultado.datos[i].descripcion_categoria,
            resultado.datos[i].codigo_categoria
          );
          $(o).html(resultado.datos[i].descripcion_categoria);
          $("#opccategoria").append(o);
        }
      } else {
        //swal("Mensaje del sistema", resultado , "warning");
      }
    })
    .fail(function (error) {
      var datosJSON = $.parseJSON(error.responseText);
      //swal("Error", datosJSON.mensaje , "error");
    });

  $.post("../controller/gestionarProducto.cargar.marca.controller.php")
    .done(function (resultado) {
      var datosJSON = resultado;

      if (datosJSON.estado === 200) {
        for (i = 0; i < resultado.datos.length; i++) {
          var o = new Option(
            resultado.datos[i].descripcion_marca,
            resultado.datos[i].codigo_marca
          );
          $(o).html(resultado.datos[i].descripcion_marca);
          $("#opcmarca").append(o);
        }
      } else {
        //swal("Mensaje del sistema", resultado , "warning");
      }
    })
    .fail(function (error) {
      var datosJSON = $.parseJSON(error.responseText);
      //swal("Error", datosJSON.mensaje , "error");
    });

  $.post("../controller/gestionarProducto.cargar.envase.controller.php")
    .done(function (resultado) {
      var datosJSON = resultado;

      if (datosJSON.estado === 200) {
        for (i = 0; i < resultado.datos.length; i++) {
          var o = new Option(
            resultado.datos[i].descripcion_envase,
            resultado.datos[i].codigo_envase
          );
          $(o).html(resultado.datos[i].descripcion_envase);
          $("#opcenvase").append(o);
        }
      } else {
        //swal("Mensaje del sistema", resultado , "warning");
      }
    })
    .fail(function (error) {
      var datosJSON = $.parseJSON(error.responseText);
      //swal("Error", datosJSON.mensaje , "error");
    });

  $.post("../controller/gestionarProducto.cargar.unidadmedida.controller.php")
    .done(function (resultado) {
      var datosJSON = resultado;

      if (datosJSON.estado === 200) {
        for (i = 0; i < resultado.datos.length; i++) {
          var o = new Option(
            resultado.datos[i].descripcion,
            resultado.datos[i].codigo
          );
          $(o).html(resultado.datos[i].descripcion);
          $("#opcmedida").append(o);
        }
      } else {
        //swal("Mensaje del sistema", resultado , "warning");
      }
    })
    .fail(function (error) {
      var datosJSON = $.parseJSON(error.responseText);
      //swal("Error", datosJSON.mensaje , "error");
    });
}

$("#opctipo").change(function () {
  $("#opctipo option[value='000']").remove();
});

$("#opccategoria").change(function () {
  $("#opccategoria option[value='000']").remove();
});

$("#opcmarca").change(function () {
  $("#opcmarca option[value='000']").remove();
});

$("#opcenvase").change(function () {
  $("#opcenvase option[value='000']").remove();
});

$("#opcmedida").change(function () {
  $("#opcmedida option[value='000']").remove();
});

function cargarProductos() {
  $.post("../controller/gestionarProducto.listar.producto.controller.php")
    .done(function (resultado) {
      var datosJSON = resultado;

      if (datosJSON.estado === 200) {
        for (i = 0; i < resultado.datos.length; i++) {
          var numeracion = i + 1;

          var adicion =
            '<tr><th scope="row">-</th>' +
            '<td class="codproducto" style="display:none;">' +
            resultado.datos[i].cod_producto +
            '</td><td class="descripcion">' +
            resultado.datos[i].descripcion +
            "</td>" +
            '<td class="precio">' +
            resultado.datos[i].precio +
            "</td>" +
            '<td><div class="widget-content-right widget-content-actions">' +
            '<button type="button" name="update" class="border-0 btn-transition btn btn-outline-success update"><i class="fa fa-edit"></i></button>' +
            '<button type="button" name="delete" class="border-0 btn-transition btn btn-outline-danger delete"><i class="fa fa-trash-alt"></i></button></div></td></tr>';

          $("#tblproducto tbody").append(adicion);
        }
      } else {
        //swal("Mensaje del sistema", resultado , "warning");
      }
    })
    .fail(function (error) {
      var datosJSON = $.parseJSON(error.responseText);
      //swal("Error", datosJSON.mensaje , "error");
    });
}
