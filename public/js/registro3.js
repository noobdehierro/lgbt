(function ($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  $(document).ready(function () {
    /* General */
    $(document).ajaxSend(function () {
      $("#overlay").fadeIn(300);
    });

    $(document).ajaxComplete(function () {
      $("#overlay").fadeOut(300);
    });

    $("#form-group").validate({
      rules: {
        name: {
          required: true,
          minlength: 5,
          number: false,
        },
        tel: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true,
        },
        wa: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true,
        },
        email: {
          required: true,
        },
      },
      messages: {
        name: {
          required: "El nombre es necesario.",
          minlength: "El nombre ingresado parece muy corto.",
          number: "Solo ingresa números.",
        },
        tel: {
          required: "El telefono es necesario.",
          minlength:
            "El numero ingresado parece muy corto, deben ser al menos 10 dígitos.",
          maxlength: "El numero ingresado demaciado largo",
          number: "Solo ingresa números.",
        },
        wa: {
          required: "El WA es necesario.",
          minlength:
            "El numero ingresado parece muy corto, deben ser al menos 10 dígitos.",
          number: "Solo ingresa números.",
          maxlength: "El numero ingresado demaciado largo",
        },
        email: {
          required: "El correo electronico es necesario.",
        },
      },
      errorElement: "em",
      errorPlacement: function (error, element) {
        // Add the `help-block` class to the error element
        error.addClass("help-block");

        error.insertAfter(element);
      },
      highlight: function (element, errorClass, validClass) {
        $(element)
          .last(".form-group")
          .addClass("has-error")
          .removeClass("has-success");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element)
          .last(".form-group")
          .addClass("has-success")
          .removeClass("has-error");
      },
    });

    $("#form-group").submit(function (event) {
      event.preventDefault();
      if ($("#form-group").valid()) {
        $("#register-step").hide();
        $("#conektaIframeContainer").show();
        $("#resumen").show();
        $("#pay-step").show();

        crearToken();
      }
    });

    function crearToken() {
      var nonce = $("#nonce").val();

      $.ajax({
        showLoader: true,
        type: "post",
        url: figou_ajax.ajax_url,
        data: {
          nonce: nonce,
          action: "firstPass",
        },
        success: function (result) {
          if (result) {
            var data = jQuery.parseJSON(result);
            window.ConektaCheckoutComponents.Card({
              targetIFrame: "#conektaIframeContainer",
              //Este componente "allowTokenization" permite personalizar el tokenizador, por lo que su valor siempre será TRUE
              allowTokenization: true,
              checkoutRequestId: data[1].checkout.id, // Checkout request ID, es el mismo ID generado en el paso 1
              publicKey: data[0], // Llaves: https://developers.conekta.com/docs/como-obtener-tus-api-keys
              options: {
                styles: {
                  // inputType modifica el diseño del Web Checkout Tokenizer
                  //        inputType: 'basic' // 'basic' | 'rounded' | 'line'
                  inputType: "line",
                  // buttonType modifica el diseño de los campos de llenado de información del  Web Checkout Tokenizer
                  //        buttonType: 'basic' // 'basic' | 'rounded' | 'sharp'
                  buttonType: "sharp",
                  //Elemento que personaliza el borde de color de los elementos
                  states: {
                    empty: {
                      borderColor: "#FFAA00", // Código de color hexadecimal para campos vacíos
                    },
                    invalid: {
                      borderColor: "#FF00E0", // Código de color hexadecimal para campos inválidos
                    },
                    valid: {
                      borderColor: "#0079c1", // Código de color hexadecimal para campos llenos y válidos
                    },
                  },
                },
                languaje: "es", // 'es' Español | 'en' Ingles
                //Elemento que personaliza el botón que finzaliza el guardado y tokenización de la tarjeta
                button: {
                  colorText: "#ffffff", // Código de color hexadecimal para el color de las palabrás en el botón de: Alta de Tarjeta | Add Card
                  //text: 'Agregar Tarjeta***', //Nombre de la acción en el botón ***Se puede personalizar
                  backgroundColor: "#301007", // Código de color hexadecimal para el color del botón de: Alta de Tarjeta | Add Card
                },
                //Elemento que personaliza el diseño del iframe
                iframe: {
                  colorText: "#65A39B", // Código de color hexadecimal para el color de la letra de todos los campos a llenar
                  backgroundColor: "#FFFFFF", // Código de color hexadecimal para el fondo del iframe, generalmente es blanco.
                },
              },
              onCreateTokenSucceeded: function (token) {
                // console.log(token);
                $("#token").val(token.id);
                $("#conekta_form").submit();
              },
              onCreateTokenError: function (error) {
                console.log(error);
              },
            });
          }
        },
        error: function (error) {
          console.log(error);
        },
      }).done(function () {
        setTimeout(function () {
          $("#overlay").fadeOut(300);
        }, 500);
      });
    }

    $("#conekta_form").submit(function (event) {
      event.preventDefault();

      crearOrden();
    });

    function crearOrden() {
      var nonce = $("#nonce").val();
      var name = $("#name").val();
      var tel = $("#tel").val();
      var wa = $("#wa").val();
      var email = $("#email").val();
      var token = $("#token").val();

      $.ajax({
        showLoader: true,
        type: "post",
        url: figou_ajax.ajax_url,
        data: {
          nonce: nonce,
          token: token,
          name: name,
          tel: tel,
          wa: wa,
          email: email,
          action: "conektaOrder",
        },
        success: function (result) {
          var data = jQuery.parseJSON(result);

          if (data[0]) {
            console.log(data[0]);
            $(".card-errors").text(data[0]);
            $(".card-errors").show();
          } else {
            console.log(data);
            $("#conektaIframeContainer").hide();
            $("#success-step").show();

            $(".success-reference").text(data[2].orderId);
          }
        },
        error: function (error) {
          console.log(error);
        },
      }).done(function () {
        setTimeout(function () {
          $("#overlay").fadeOut(300);
        }, 500);
      });
    }
  });
})(jQuery);
