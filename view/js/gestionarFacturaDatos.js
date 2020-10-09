$(document).ready(function () {
  cargarvalores();
});

function cargarvalores() {
  $.post("../controller/gestionarFactura.cargar.productos.controller.php")
    .done(function (resultado) {
      var datosJSON = resultado;

      if (datosJSON.estado === 200) {
        var prods = resultado.datos;
        autocomplete(document.getElementById("textproducto"), prods);

        /*
          for (i = 0; i < resultado.datos.length; i++) {
            var o = new Option(
              resultado.datos[i].descripcion_tipo,
              resultado.datos[i].codigo_tipo
            );
            $(o).html(resultado.datos[i].descripcion_tipo);
            $("#opctipo").append(o);
          }
          */
      } else {
      }
    })
    .fail(function (error) {
      var datosJSON = $.parseJSON(error.responseText);
      //swal("Error", datosJSON.mensaje , "error");
    });
}

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
      the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function (e) {
    var a,
      b,
      i,
      val = this.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) {
      return false;
    }
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    this.parentNode.appendChild(a);
    /*for each item in the array...*/
    for (i = 0; i < arr.length; i++) {
      /*check if the item starts with the same letters as the text field value:*/
      if (
        arr[i].descripcion.substr(0, val.length).toUpperCase() ==
        val.toUpperCase()
      ) {
        /*create a DIV element for each matching element:*/
        b = document.createElement("DIV");
        /*make the matching letters bold:*/
        b.innerHTML =
          "<strong>" + arr[i].descripcion.substr(0, val.length) + "</strong>";
        b.innerHTML += arr[i].descripcion.substr(val.length);
        /*insert a input field that will hold the current array item's value:*/
        b.innerHTML +=
          "<input type='hidden' name='" +
          arr[i].cod_producto +
          "|" +
          arr[i].precio +
          "|" +
          arr[i].inafecto +
          "|" +
          arr[i].ICBPER +
          "' value='" +
          arr[i].descripcion +
          "'>";
        /*execute a function when someone clicks on the item value (DIV element):*/
        b.addEventListener("click", function (e) {
          /*insert the value for the autocomplete text field:*/
          inp.value = this.getElementsByTagName("input")[0].value;
          var valores = this.getElementsByTagName("input")[0].name.split("|");
          document.getElementById("codproducto").value = valores[0];
          document.getElementById("textPrecioProducto").value = parseFloat(
            valores[1]
          ).toFixed(2);
          document.getElementById("txtinafecto").value = valores[2];
          document.getElementById("txticbper").value = valores[3];
          /*close the list of autocompleted values,
                  (or any other open lists of autocompleted values:*/
          closeAllLists();
        });
        a.appendChild(b);
      }
    }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function (e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");

    if (e.keyCode == 40) {
      /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
      currentFocus++;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 38) {
      //up
      /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
      currentFocus--;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 13) {
      /*If the ENTER key is pressed, prevent the form from being submitted,*/
      e.preventDefault();
      if (currentFocus > -1) {
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
      }
    } else if (
      e.keyCode != 9 &&
      e.keyCode != 37 &&
      e.keyCode != 38 &&
      e.keyCode != 39 &&
      e.keyCode != 40
    ) {
      document.getElementById("codproducto").value = "";
      document.getElementById("textPrecioProducto").value = "0.00";
    }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = x.length - 1;
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}

$("#agregarDetalleProm").click(function () {
  var textproducto = $("#textproducto").val();
  var codproducto = $("#codproducto").val();
  var textCantProducto = $("#textCantProducto").val();
  var textPrecioProducto = $("#textPrecioProducto").val();
  var textICBPER = $("#txticbper").val();
  var textTotal = (
    parseFloat(textCantProducto) * (parseFloat(textPrecioProducto) + parseFloat(textICBPER))
  ).toFixed(2);
  var inafecto = $("#txtinafecto").val();

  if (textproducto == "" || codproducto == "" || textCantProducto == "") {
    alert("Por favor, completar todos los campos");
  } else {
    var adicion =
      '<tr><th scope="row">-</th>' +
      '<td class="codproducto" style="display:none;">' +
      codproducto +
      '</td><td class="textproducto">' +
      textproducto +
      "</td>" +
      '</td><td class="cantproducto" align="right">' +
      textCantProducto +
      "</td>" +
      '</td><td class="precioproducto" align="right">' +
      textPrecioProducto +
      "</td>" +
      '</td><td class="totalproducto" align="right">' +
      textTotal +
      "</td>" +
      '</td><td class="inafecto" style="display:none;">' +
      inafecto +
      '</td><td class="icbper" style="display:none;">' +
      textICBPER +
      "</td>" +
      '<td><div class="widget-content-right widget-content-actions">' +
      '<button type="button" name="deleteproductos" class="border-0 btn-transition btn btn-outline-danger deleteproductos"><i class="fa fa-trash-alt"></i></button></div></td></tr>';

    $("#detprod tbody").append(adicion);
    sumardetalle();
    $("#textproducto").val("");
    $("#codproducto").val("");
    $("#textCantProducto").val("0.00");
    $("#textPrecioProducto").val("0.00");
  }
});

$(document).on("click", ".deleteproductos", function () {
  $(this).closest("tr").remove();
  sumardetalle();
});
function sumardetalle() {
  var sumatotal = 0.0;
  $("#detprod tbody>tr").each(function () {
    //alert(codpromocion);
    var totalprod = $(this).find(".totalproducto").html();

    if (totalprod === undefined) {
    } else {
      sumatotal = parseFloat(sumatotal) + parseFloat(totalprod);
    }
  });
  document.getElementById("texttotalproducto").value = parseFloat(
    sumatotal
  ).toFixed(2);
}

$('input:radio[name="tipodoc"]').change(function () {
  if ($(this).val() == "03") {
    $("#textRazonSocial").val("");
    $("#textDireccion").val("");
    $("#textRuc").attr("maxlength", "8");
    $("#textRuc").val("");
    $("#textRuc").focus();
  } else {
    $("#textRazonSocial").val("");
    $("#textDireccion").val("");
    $("#textRuc").attr("maxlength", "11");
    $("#textRuc").val("");
    $("#textRuc").focus();
  }
});
