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

    $("#portabilidad").on("change", function () {
      if ($("#portabilidad").prop("checked")) {
        $("#pannel_portabilidad").show();
      } else {
        $("#pannel_portabilidad").hide();
      }
    });
    var offer = "";
    var template =
      '<div class="plan offeringTemplate :superoferta">' +
      '<div class="offer-name plan_title">:offername</div>' +
      '<div class="offer-price letrasplan">$:offerprice</div>' +
      '<div class="offer-short" style="display: none;">:offershort</div>' +
      '<div class="offer-description letrasplan">:offerdesc</div>' +
      '<button class="select_plan buttonplan next" data-id=":offerid">Continuar</button>' +
      "</div>";

    //Codigo postal en cascada
    $("#cp").on("focusout", function () {
      var $this = $(this),
        nonce = $("#nonce").val(),
        cp = $("#cp").val();

      if (cp) {
        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            cp: cp,
            action: "cp_validator",
          },
          success: function (result) {
            var data = jQuery.parseJSON(result);

            if (!data.error) {
              console.log(data.response);

              var colonia = $("#colonia");
              var municipio = $("#municipio");
              var estado = $("#estado");

              municipio.val(data.municipio);
              estado.val(data.estado);
              colonia.empty();
              colonia.append(
                '<option value="">Seleccione una colonia</option>'
              );

              if (data.colonia.length > 0) {
                $.each(data.colonia, function (index, item) {
                  var selected = index == 0 ? "selected" : "";
                  colonia.append(
                    '<option value="' +
                      item +
                      '" ' +
                      selected +
                      ">" +
                      item +
                      "</option>"
                  );
                });
              } else {
                alert("No hay colonia disponible para este código postal.");
              }
            } else {
              alert(
                "El código postal no esta registrado en la base de datos de SEPOMEX, por favor utiliza un código postal valido."
              );
              $("#colonia").empty();
              $("#colonia").append(
                '<option value="">Seleccione una colonia</option>'
              );
              $("#municipio").val("");
              $("#estado").val("");
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
      } else {
        $("#colonia").empty();
        $("#colonia").append(
          '<option value="">Seleccione una colonia</option>'
        );
        $("#municipio").val("");
        $("#estado").val("");
      }
    });

    // Ofertas por imei
    $("#imei_check").on("submit", function () {
      return false;
    });

    // Valida DiDi
    $("#didi_code_check").on("submit", function () {
      return false;
    });

    // Cambio de flujo primero ofertas
    $(".select_plan").on("click", function () {
      $("#product_id").val($(this).attr("data-id"));
      var productCard = $(this).parent();
      var name = productCard.find(".offer-name").text();
      var description = productCard.find(".offer-description").html();
      var priceStr = productCard.find(".offer-price").text();

      var price = priceStr.replace("MXN", "").replace("$", "");
      var total = Number(price).toString();

      var precioEnvio = "$0 MXN";

      $("#product_name").val(name);
      $("#product_desc").val(description);
      $("#product_price").val(total);

      $(".summary.register .plan-name").text(name);
      $(".summary .incluye").html(description);
      $(".summary .total-plan").text(priceStr);
      $(".summary .total-sim").text(precioEnvio);
      $(".summary .total-envio").text("$0 MXN");
      $(".summary .total-total").text("$" + total + " MXN");

      nextStep();
    });

    // Validación DiDi Code
    $("#valida_didi").on("click", function (event) {
      event.preventDefault();

      if ($("#didi_code_check").valid()) {
        var $this = $(this),
          nonce = $("#nonce").val(),
          didi_code = $("#didi_code").val();

        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            didi_code: didi_code,
            action: "didi_code_validation",
          },
          success: function (data) {
            if (data.error != "error") {
              nextStep();
            } else {
              $("span.didi-code-error").show();
              $("#didi_code").addClass("imei-error");
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

    // Next simple
    $(".simple_next").on("click", function () {
      nextStep();
    });

    // OS IMEI instrucciones
    $(".os-selector span").on("click", function () {
      var os = $(this).attr("id");
      $(".os-selector span").removeClass("active");
      $(this).addClass("active");

      $(".os-panel").removeClass("active");
      $("." + os + "-panel").addClass("active");
    });

    // Payment Intent
    $("#register").on("click", function () {
      event.preventDefault();

      if ($("#register_form").valid()) {
        $("#payment-error").remove();
        var $this = $(this),
          nonce = $("#nonce").val(),
          product_id = $("#product_id").val(),
          product_name = $("#product_name").val(),
          product_price = $("#product_price").val(),
          product_desc = $("#product_desc").val(),
          paymentMethod = "register";
        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            product_id: product_id,
            product_name: product_name,
            product_price: product_price,
            product_desc: product_desc,
            nombre: $("#nombre").val(),
            apellidos: $("#apellidos").val(),
            tipo_documento: $("#tipo_documento").val(),
            identificacion: $("#identificacion").val(),
            contacto: $("#contacto").val(),
            email: $("#email").val(),
            direccion: $("#direccion").val(),
            exterior: $("#exterior").val(),
            interior: $("#interior").val(),
            referencias: $("#referencias").val(),
            cp: $("#cp").val(),
            colonia: $("#colonia").val(),
            municipio: $("#municipio").val(),
            estado: $("#estado").val(),
            pais: $("#pais").val(),
            paymentMethod: paymentMethod,
            action: "payment_register",
          },
          success: function (data) {
            var result = jQuery.parseJSON(data);

            if (result != "error") {
              nextStep();
            } else {
              alert(
                "Lo sentimos no se pudo procesar la solicitud, por favor intente nuevamente o elija un medio de pago distinto."
              );
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

    // Validación IMEI
    $("#valida_imei").on("click", function (event) {
      event.preventDefault();

      if ($("#imei_check").valid()) {
        var $this = $(this),
          nonce = $("#nonce").val(),
          imei = $("#imei").val();

        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            imei: imei,
            action: "imei_validation",
          },
          success: function (data) {
            if (data.offerings.length > 0) {
              $("span.imei-error").hide();
              $("#imei").removeClass("imei-error");

              nextStep();
            } else {
              $("span.imei-error").show();
              $("#imei").addClass("imei-error");
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

    /* Paso atras */
    $(".prev_imei").on("click", function () {
      var current = $(".step-number.active");
      var target = $('.step-number[data-step="imei-step"]');

      current.removeClass("active");
      current.removeClass("visited");
      target.addClass("active");

      $(".step").removeClass("active");
      $("#" + target.data("step")).addClass("active");
      $(".register-information").show();
      $(".metodos-de-pago").hide();

      $("html, body").animate(
        {
          scrollTop: $(target).offset().top,
        },
        300
      );
    });

    // Ofertas para recarga
    $("#valida_msisdn").on("click", function (event) {
      event.preventDefault();

      if ($("#msisdn_check").valid()) {
        var $this = $(this),
          nonce = $("#nonce").val(),
          msisdn = $("#msisdn").val();

        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            msisdn: msisdn,
            action: "msisdn_validation",
          },
          success: function (data) {
            if (data.offerings.length > 0) {
              $("#offerings").html("");
              $.each(data.offerings, function (index, item) {
                if (item.description == "") {
                  item.description = "Descripci&oacute;n no disponible.";
                }

                if (item.name != null) {
                  var name = item.name.replace("Figou", "");

                  offer = template
                    .replace(":superoferta", item.superOferta)
                    .replace(":offerprice", item.specialPrice)
                    .replace(":offername", name)
                    .replace(":offerdesc", item.description)
                    .replace(":offerid", item.productId);
                  $("#offerings").append(offer);
                }
              });

              $("#" + data.paymentMethodDefault).show();

              $(".select_plan").on("click", function () {
                $("#product_id").val($(this).attr("data-id"));
                var productCard = $(this).parent();
                var name = productCard.find(".offer-name").text();
                var description = productCard.find(".offer-description").html();
                var total = productCard.find(".offer-price").text();

                var priceStr = total.replace("MXN", "").replace("$", "");
                var price = Number(priceStr).toString();

                $("#product_name").val(name);
                $("#product_desc").val(description);
                $("#product_price").val(price);

                $(".summary.register .plan-name").text(name);
                $(".summary .incluye").html(description);
                $(".summary .total-plan").text(total);
                $(".summary .total-sim").parent().hide();
                $(".summary .total-total").text(total);

                nextStep();
              });

              $(".registercontent").show();
              $(".portabilidadcontent").hide();
            } else {
              $(".registercontent").hide();
              $(".portabilidadcontent").show();
            }

            nextStep();
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

    // Payment Intent
    $("#payment_intent").on("click", function () {
      event.preventDefault();

      if ($("#register_form").valid()) {
        if ($("#paymentMethod").val() !== "") {
          $("#payment-error").remove();

          var shipmentMethod = $("#shipmentMethod").val(),
            product_price;

          if (shipmentMethod == "express-Shipment") {
            product_price = +$("#product_price").val() + +188;
          } else {
            product_price = $("#product_price").val();
          }

          console.log(product_price);

          var $this = $(this),
            nonce = $("#nonce").val(),
            product_id = $("#product_id").val(),
            product_name = $("#product_name").val(),
            product_desc = $("#product_desc").val(),
            paymentMethod = $("#paymentMethod").val();
          $.ajax({
            showLoader: true,
            type: "post",
            url: figou_ajax.ajax_url,
            data: {
              nonce: nonce,
              product_id: product_id,
              product_name: product_name,
              product_price: product_price,
              product_desc: product_desc,
              nombre: $("#nombre").val(),
              apellidos: $("#apellidos").val(),
              tipo_documento: $("#tipo_documento").val(),
              identificacion: $("#identificacion").val(),
              contacto: $("#contacto").val(),
              nacimiento: $("#nacimiento").val(),
              email: $("#email").val(),
              direccion: $("#direccion").val(),
              exterior: $("#exterior").val(),
              interior: $("#interior").val(),
              referencias: $("#referencias").val(),
              cp: $("#cp").val(),
              colonia: $("#colonia").val(),
              municipio: $("#municipio").val(),
              estado: $("#estado").val(),
              pais: $("#pais").val(),
              paymentMethod: paymentMethod,
              shipmentMethod: shipmentMethod,
              action: "payment_register",
              referido: $("#referido").val(),
              iccid: $("#iccid").val(),
              iccid_confirm: $("#iccid_confirm").val(),
              msisdn: $("#msisdn").val(),
              nip: $("#nip").val(),
            },
            success: function (data) {
              var result = jQuery.parseJSON(data);
              console.log(result);

              console.log(result.paymentType);

              if (result != "error") {
                if (result.paymentType == "oxxo-cash") {
                  $(".oxxo-cash").show();
                  $(".nomina").hide();
                  $(".openpay-credit-card").hide();
                  $(".conekta-credit-card").hide();
                  var imprime = $("#oxxo-imprime");
                  imprime.find(".nombre-plan").text(result.name);
                  imprime.find(".monto").text("$" + result.total + " MXN");
                  imprime
                    .find(".referencia-figou")
                    .text(result.referenceNumber);
                  imprime.find(".barcode-img").attr("src", result.barcode);
                  imprime.find(".barcode-ref").text(result.refcode);
                } else {
                  if (result.paymentType == "openpay-credit-card") {
                    /* OpenPay credit card conekta-credit-card */
                    $(".openpay-credit-card").show();
                    $(".oxxo-cash").hide();
                    $(".nomina").hide();
                    $(".conekta-credit-card").hide();
                    var paymentType = "openpay-credit-card";

                    var direccion =
                      $("#direccion").val() +
                      " " +
                      $("#exterior").val() +
                      $("#interior").val() +
                      " " +
                      $("#referencias").val() +
                      " " +
                      $("#cp").val() +
                      " " +
                      $("#colonia").val() +
                      " " +
                      $("#municipio").val() +
                      " " +
                      $("#estado").val() +
                      $("#pais").val() +
                      " " +
                      $("#contacto").val();
                    var plan = $(".summary.register").find(".plan-name").text();
                    var incluye = $(".summary.register")
                      .find(".incluye")
                      .html();
                    var totalPlan = $(".summary.register")
                      .find(".total-plan")
                      .html();
                    var totalSim = $(".summary.register")
                      .find(".total-sim")
                      .html();
                    var descuento = "$0 MXN";
                    var totalTotal = $(".summary.register")
                      .find(".total-total")
                      .html();

                    if (result.paymentType == "didipay-card") {
                      totalTotal = "$" + result.product_price + " MXN";
                      descuento = "-$" + result.product_desc + " MXN";
                      $("#product_id").val(result.product_id);
                      paymentType = result.paymentType;
                    }

                    $(".openpay-credit-card .summary .plan-name").text(plan);
                    $(".openpay-credit-card .summary .incluye").html(incluye);
                    $(".openpay-credit-card .summary .total-plan").html(
                      totalPlan
                    );
                    $(".openpay-credit-card .summary .total-sim").html(
                      totalSim
                    );
                    $(".openpay-credit-card .summary .descuento-didipay").html(
                      descuento
                    );
                    $(".openpay-credit-card .summary .total-total").html(
                      totalTotal
                    );
                    $(
                      ".openpay-credit-card .summary .shipping-information"
                    ).text(direccion);

                    paymentOpenPay(
                      result.merchantId,
                      result.publicKey,
                      result.sandbox
                    );
                  } else {
                    if (result.paymentType == "nomina") {
                      /* Descuento en nomina */
                      $(".nomina").show();
                      $(".openpay-credit-card").hide();
                      $(".oxxo-cash").hide();
                      $(".conekta-credit-card").hide();

                      var direccion =
                        $("#direccion").val() +
                        " " +
                        $("#exterior").val() +
                        $("#interior").val() +
                        " " +
                        $("#referencias").val() +
                        " " +
                        $("#cp").val() +
                        " " +
                        $("#colonia").val() +
                        " " +
                        $("#municipio").val() +
                        " " +
                        $("#estado").val() +
                        $("#pais").val() +
                        " " +
                        $("#contacto").val();
                      var plan = $(".summary.register")
                        .find(".plan-name")
                        .text();
                      var incluye = $(".summary.register")
                        .find(".incluye")
                        .html();
                      var totalPlan = $(".summary.register")
                        .find(".total-plan")
                        .html();
                      var totalSim = $(".summary.register")
                        .find(".total-sim")
                        .html();
                      var descuento = "$0 MXN";
                      var totalTotal = $(".summary.register")
                        .find(".total-total")
                        .html();
                      var nombreEmpleado =
                        $("#nombre").val() + " " + $("#apellidos").val();
                      var emailEmpleado = $("#email").val();
                      var telefonoEmpleado = $("#contacto").val();

                      $(".nomina input#nombre_empleado").val(nombreEmpleado);
                      $(".nomina input#tel_empleado").val(telefonoEmpleado);
                      $(".nomina input#email_empleado").val(emailEmpleado);
                      $(".nomina .summary .plan-name").text(plan);
                      $(".nomina .summary .incluye").html(incluye);
                      $(".nomina .summary .total-plan").html(totalPlan);
                      $(".nomina .summary .total-sim").html(totalSim);
                      $(".nomina .summary .descuento-didipay").html(descuento);
                      $(".nomina .summary .total-total").html(totalTotal);
                      $(".nomina .summary .shipping-information").text(
                        direccion
                      );
                    } else {
                      /* Conekta credit card conekta-credit-card */
                      $(".conekta-credit-card").show();
                      $(".oxxo-cash").hide();
                      $(".nomina").hide();
                      $(".openpay-credit-card").hide();
                      var paymentType = "conekta-credit-card";

                      var direccion =
                        $("#direccion").val() +
                        " " +
                        $("#exterior").val() +
                        $("#interior").val() +
                        " " +
                        $("#referencias").val() +
                        " " +
                        $("#cp").val() +
                        " " +
                        $("#colonia").val() +
                        " " +
                        $("#municipio").val() +
                        " " +
                        $("#estado").val() +
                        $("#pais").val() +
                        " " +
                        $("#contacto").val();
                      var plan = $(".summary.register")
                        .find(".plan-name")
                        .text();
                      var incluye = $(".summary.register")
                        .find(".incluye")
                        .html();
                      var totalPlan = $(".summary.register")
                        .find(".total-plan")
                        .html();
                      var totalSim = $(".summary.register")
                        .find(".total-sim")
                        .html();
                      var descuento = "$0 MXN";

                      var envio;

                      if (shipmentMethod == "express-Shipment") {
                        envio = "$188 MXN";
                      } else {
                        envio = "$0 MXN";
                      }
                      var totalTotal = "$" + product_price + " MXN";
                      // var totalTotal = $(".summary.register")
                      //   .find(".total-total")
                      //   .html();

                      if (result.paymentType == "didipay-card") {
                        totalTotal = "$" + result.product_price + " MXN";
                        descuento = "-$" + result.product_desc + " MXN";
                        $("#product_id").val(result.product_id);
                        paymentType = result.paymentType;
                      }

                      $(".conekta-credit-card .summary .plan-name").text(plan);
                      $(".conekta-credit-card .summary .incluye").html(incluye);
                      $(".conekta-credit-card .summary .total-plan").html(
                        totalPlan
                      );
                      $(".conekta-credit-card .summary .total-sim").html(
                        totalSim
                      );
                      $(".conekta-credit-card .summary .total-envio").html(
                        envio
                      );
                      $(
                        ".conekta-credit-card .summary .descuento-didipay"
                      ).html(descuento);
                      $(".conekta-credit-card .summary .total-total").html(
                        totalTotal
                      );
                      $(
                        ".conekta-credit-card .summary .shipping-information"
                      ).text(direccion);

                      var sim_active = 0;

                      paymentConekta(result.conekta, paymentType, sim_active);
                    }
                  }
                }
                nextStep();
              } else {
                alert(
                  "Lo sentimos no se pudo procesar la solicitud, por favor intente nuevamente o elija un medio de pago distinto."
                );
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
        } else {
          $(".payment-selector-container").append(
            '<em id="payment-error" class="error help-block">Para continuar, elecciona un método de pago.</em>'
          );
        }
      }
    });

    // Recharge
    $("#payment_intent_recharge").on("click", function () {
      event.preventDefault();

      if ($("#rechargin_form").valid()) {
        if ($("#paymentMethod").val() != "") {
          $("#payment-error").remove();
          var nonce = $("#nonce").val(),
            product_id = $("#product_id").val(),
            product_name = $("#product_name").val(),
            product_price = $("#product_price").val(),
            product_desc = $("#product_desc").val(),
            msisdn = $("#msisdn").val(),
            paymentMethod = $("#paymentMethod").val();
          $.ajax({
            showLoader: true,
            type: "post",
            url: figou_ajax.ajax_url,
            data: {
              nonce: nonce,
              product_id: product_id,
              product_name: product_name,
              product_price: product_price,
              product_desc: product_desc,
              msisdn: msisdn,
              recurrente: $("#recurrente").is(":checked") ? "SI" : "NO",
              paymentMethod: paymentMethod,
              action: "payment_recharge",
            },
            success: function (data) {
              var result = jQuery.parseJSON(data);
              if (result != "error") {
                if (result.paymentType == "oxxo-cash") {
                  $(".oxxo-cash").show();
                  $(".stripe-credit-card").hide();
                  $(".conekta-credit-card").hide();
                  var imprime = $("#oxxo-imprime");
                  imprime.find(".nombre-plan").text(result.name);
                  imprime.find(".monto").text("$" + result.total + " MXN");
                  imprime
                    .find(".referencia-figou")
                    .text(result.referenceNumber);
                  imprime.find(".barcode-img").attr("src", result.barcode);
                  imprime.find(".barcode-ref").text(result.refcode);
                } else {
                  if (result.paymentType == "stripe-credit-card") {
                    $(".stripe-credit-card").show();
                    $(".oxxo-cash").hide();
                    $(".conekta-credit-card").hide();
                    paymentStripe(result.stripe, result.clientSecret);

                    var direccion =
                      $("#direccion").val() +
                      " " +
                      $("#exterior").val() +
                      $("#interior").val() +
                      " " +
                      $("#referencias").val() +
                      " " +
                      $("#cp").val() +
                      " " +
                      $("#colonia").val() +
                      " " +
                      $("#municipio").val() +
                      " " +
                      $("#estado").val() +
                      $("#pais").val() +
                      " " +
                      $("#contacto").val();
                    $(".stripe-credit-card .summary .plan-name").text(
                      result.name
                    );
                    $(".stripe-credit-card .summary .incluye").html(
                      result.desc
                    );
                    $(".stripe-credit-card .summary .total-plan").text(
                      "$" + result.price + " MXN"
                    );
                    $(".stripe-credit-card .summary .total-sim").text(
                      "$" + result.sim + " MXN"
                    );
                    $(".stripe-credit-card .summary .total-total").text(
                      "$" + result.total + " MXN"
                    );
                    $(
                      ".stripe-credit-card .summary .shipping-information"
                    ).text(direccion);
                    $(".success-reference").text(result.referenceNumber);
                  } else {
                    /* Conekta credit card conekta-credit-card */
                    $(".conekta-credit-card").show();
                    $(".oxxo-cash").hide();
                    $(".stripe-credit-card").hide();
                    var paymentType = "conekta-credit-card";

                    var direccion =
                      $("#direccion").val() +
                      " " +
                      $("#exterior").val() +
                      $("#interior").val() +
                      " " +
                      $("#referencias").val() +
                      " " +
                      $("#cp").val() +
                      " " +
                      $("#colonia").val() +
                      " " +
                      $("#municipio").val() +
                      " " +
                      $("#estado").val() +
                      $("#pais").val() +
                      " " +
                      $("#contacto").val();
                    var plan = $(".summary.register").find(".plan-name").text();
                    var incluye = $(".summary.register")
                      .find(".incluye")
                      .html();
                    var totalPlan = $(".summary.register")
                      .find(".total-plan")
                      .html();
                    var totalSim = $(".summary.register")
                      .find(".total-sim")
                      .html();
                    var totalEnvio = $(".summary.register")
                      .find(".total-sim")
                      .html();
                    var descuento = "$0 MXN";
                    var totalTotal = $(".summary.register")
                      .find(".total-total")
                      .html();

                    if (result.paymentType == "didipay-card") {
                      totalPlan = "$" + result.product_price + " MXN";
                      descuento = "$" + result.product_desc + " MXN";
                      paymentType = result.paymentType;
                    }

                    $(".conekta-credit-card .summary .plan-name").text(plan);
                    $(".conekta-credit-card .summary .incluye").html(incluye);
                    $(".conekta-credit-card .summary .total-plan").html(
                      totalPlan
                    );
                    $(".conekta-credit-card .summary .total-sim").html(
                      totalSim
                    );
                    $(".conekta-credit-card .summary .descuento-didipay").html(
                      descuento
                    );
                    $(".conekta-credit-card .summary .total-total").html(
                      totalTotal
                    );
                    $(
                      ".conekta-credit-card .summary .shipping-information"
                    ).text(direccion);

                    var sim_active = 0;

                    paymentConekta(result.conekta, paymentType, sim_active);
                  }
                }
                nextStep();
              } else {
                alert(
                  "Lo sentimos ha sucedido un error, en breve un ejecutivo se pondra en contacto contigo para darte opciones para completar el tramite."
                );
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
        } else {
          $(".payment-selector-container").append(
            '<em id="payment-error" class="error help-block">Para continuar, elecciona un método de pago.</em>'
          );
        }
      }
    });

    // Payment Intent Activacion
    $("#payment_intent_activate").on("click", function () {
      event.preventDefault();

      if ($("#register_form").valid()) {
        if ($("#paymentMethod").val() !== "") {
          $("#payment-error").remove();
          var $this = $(this),
            nonce = $("#nonce").val(),
            product_id = $("#product_id").val(),
            product_name = $("#product_name").val(),
            product_price = $("#product_price").val(),
            product_desc = $("#product_desc").val(),
            paymentMethod = $("#paymentMethod").val(),
            nombre = $("#nombre").val(),
            apellidos = $("#apellidos").val(),
            email = $("#email").val(),
            contacto = $("#contacto").val(),
            nacimiento = $("#nacimiento").val(),
            iccid = $("#iccid").val(),
            msisdn_to_port = $("#msisdn_to_port").val(),
            nip = $("#nip").val(),
            direccion = $("#direccion").val(),
            exterior = $("#exterior").val(),
            interior = $("#interior").val(),
            referencias = $("#referencias").val(),
            cp = $("#cp").val(),
            colonia = $("#colonia").val(),
            municipio = $("#municipio").val(),
            estado = $("#estado").val(),
            action = "payment_register";
          $.ajax({
            showLoader: true,
            type: "post",
            url: figou_ajax.ajax_url,
            data: {
              nonce: nonce,
              product_id: product_id,
              product_name: product_name,
              product_price: product_price,
              product_desc: product_desc,
              paymentMethod: paymentMethod,
              nombre: nombre,
              apellidos: apellidos,
              email: email,
              contacto: contacto,
              nacimiento: nacimiento,
              iccid: iccid,
              msisdn_to_port: msisdn_to_port,
              nip: nip,
              direccion: direccion,
              exterior: exterior,
              interior: interior,
              referencias: referencias,
              cp: cp,
              colonia: colonia,
              municipio: municipio,
              estado: estado,
              active_sim: 1,
              action: action,
            },
            success: function (data) {
              var result = jQuery.parseJSON(data);
              console.log(result);

              if (result !== "error" && result !== "null") {
                if (result.paymentType === "oxxo-cash") {
                  $(".oxxo-cash").show();
                  $(".nomina").hide();
                  $(".openpay-credit-card").hide();
                  $(".conekta-credit-card").hide();
                  var imprime = $("#oxxo-imprime");
                  imprime.find(".nombre-plan").text(result.name);
                  imprime.find(".monto").text("$" + result.total + " MXN");
                  imprime
                    .find(".referencia-figou")
                    .text(result.referenceNumber);
                  imprime.find(".barcode-img").attr("src", result.barcode);
                  imprime.find(".barcode-ref").text(result.refcode);
                } else {
                  if (result.paymentType == "openpay-credit-card") {
                    /* OpenPay credit card conekta-credit-card */
                    $(".openpay-credit-card").show();
                    $(".oxxo-cash").hide();
                    $(".nomina").hide();
                    $(".conekta-credit-card").hide();
                    var paymentType = "openpay-credit-card";

                    var direccion =
                      $("#direccion").val() +
                      " " +
                      $("#exterior").val() +
                      $("#interior").val() +
                      " " +
                      $("#referencias").val() +
                      " " +
                      $("#cp").val() +
                      " " +
                      $("#colonia").val() +
                      " " +
                      $("#municipio").val() +
                      " " +
                      $("#estado").val() +
                      $("#pais").val() +
                      " " +
                      $("#contacto").val();
                    var plan = $(".summary.register").find(".plan-name").text();
                    var incluye = $(".summary.register")
                      .find(".incluye")
                      .html();
                    var totalPlan = $(".summary.register")
                      .find(".total-plan")
                      .html();
                    var totalSim = $(".summary.register")
                      .find(".total-sim")
                      .html();
                    var descuento = "$0 MXN";
                    var totalTotal = $(".summary.register")
                      .find(".total-total")
                      .html();

                    if (result.paymentType == "didipay-card") {
                      totalTotal = "$" + result.product_price + " MXN";
                      descuento = "-$" + result.product_desc + " MXN";
                      $("#product_id").val(result.product_id);
                      paymentType = result.paymentType;
                    }

                    $(".openpay-credit-card .summary .plan-name").text(plan);
                    $(".openpay-credit-card .summary .incluye").html(incluye);
                    $(".openpay-credit-card .summary .total-plan").html(
                      totalPlan
                    );
                    $(".openpay-credit-card .summary .total-sim").html(
                      totalSim
                    );
                    $(".openpay-credit-card .summary .descuento-didipay").html(
                      descuento
                    );
                    $(".openpay-credit-card .summary .total-total").html(
                      totalTotal
                    );
                    $(
                      ".openpay-credit-card .summary .shipping-information"
                    ).text(direccion);

                    paymentOpenPay(
                      result.merchantId,
                      result.publicKey,
                      result.sandbox
                    );
                  } else {
                    if (result.paymentType == "nomina") {
                      /* Descuento en nomina */
                      $(".nomina").show();
                      $(".openpay-credit-card").hide();
                      $(".oxxo-cash").hide();
                      $(".conekta-credit-card").hide();

                      var direccion =
                        $("#direccion").val() +
                        " " +
                        $("#exterior").val() +
                        $("#interior").val() +
                        " " +
                        $("#referencias").val() +
                        " " +
                        $("#cp").val() +
                        " " +
                        $("#colonia").val() +
                        " " +
                        $("#municipio").val() +
                        " " +
                        $("#estado").val() +
                        $("#pais").val() +
                        " " +
                        $("#contacto").val();
                      var plan = $(".summary.register")
                        .find(".plan-name")
                        .text();
                      var incluye = $(".summary.register")
                        .find(".incluye")
                        .html();
                      var totalPlan = $(".summary.register")
                        .find(".total-plan")
                        .html();
                      var totalSim = $(".summary.register")
                        .find(".total-sim")
                        .html();
                      var descuento = "$0 MXN";
                      var totalTotal = $(".summary.register")
                        .find(".total-total")
                        .html();
                      var nombreEmpleado =
                        $("#nombre").val() + " " + $("#apellidos").val();
                      var emailEmpleado = $("#email").val();
                      var telefonoEmpleado = $("#contacto").val();

                      $(".nomina input#nombre_empleado").val(nombreEmpleado);
                      $(".nomina input#tel_empleado").val(telefonoEmpleado);
                      $(".nomina input#email_empleado").val(emailEmpleado);
                      $(".nomina .summary .plan-name").text(plan);
                      $(".nomina .summary .incluye").html(incluye);
                      $(".nomina .summary .total-plan").html(totalPlan);
                      $(".nomina .summary .total-sim").html(totalSim);
                      $(".nomina .summary .descuento-didipay").html(descuento);
                      $(".nomina .summary .total-total").html(totalTotal);
                      $(".nomina .summary .shipping-information").text(
                        direccion
                      );
                    } else {
                      /* Conekta credit card conekta-credit-card */
                      $(".conekta-credit-card").show();
                      $(".oxxo-cash").hide();
                      $(".nomina").hide();
                      $(".openpay-credit-card").hide();
                      var paymentType = "conekta-credit-card";

                      var direccion =
                        $("#direccion").val() +
                        " " +
                        $("#exterior").val() +
                        $("#interior").val() +
                        " " +
                        $("#referencias").val() +
                        " " +
                        $("#cp").val() +
                        " " +
                        $("#colonia").val() +
                        " " +
                        $("#municipio").val() +
                        " " +
                        $("#estado").val() +
                        $("#pais").val() +
                        " " +
                        $("#contacto").val();
                      var plan = $(".summary.register")
                        .find(".plan-name")
                        .text();
                      var incluye = $(".summary.register")
                        .find(".incluye")
                        .html();
                      var totalPlan = $(".summary.register")
                        .find(".total-plan")
                        .html();
                      var totalSim = $(".summary.register")
                        .find(".total-sim")
                        .html();
                      var descuento = "$0 MXN";
                      var totalTotal = $(".summary.register")
                        .find(".total-total")
                        .html();

                      if (result.paymentType == "didipay-card") {
                        totalTotal = "$" + result.product_price + " MXN";
                        descuento = "-$" + result.product_desc + " MXN";
                        $("#product_id").val(result.product_id);
                        paymentType = result.paymentType;
                      }

                      $(".conekta-credit-card .summary .plan-name").text(plan);
                      $(".conekta-credit-card .summary .incluye").html(incluye);
                      $(".conekta-credit-card .summary .total-plan").html(
                        totalPlan
                      );
                      $(".conekta-credit-card .summary .total-sim").html(
                        totalSim
                      );
                      $(
                        ".conekta-credit-card .summary .descuento-didipay"
                      ).html(descuento);
                      $(".conekta-credit-card .summary .total-total").html(
                        totalTotal
                      );
                      $(
                        ".conekta-credit-card .summary .shipping-information"
                      ).text(direccion);

                      var sim_active = 1;

                      paymentConekta(result.conekta, paymentType, sim_active);
                    }
                  }
                }
                nextStep();
              } else {
                alert(
                  "Lo sentimos no se pudo procesar la solicitud, por favor intente nuevamente o elija un medio de pago distinto."
                );
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
        } else {
          $(".payment-selector-container").append(
            '<em id="payment-error" class="error help-block">Para continuar, elecciona un método de pago.</em>'
          );
        }
      }
    });

    /* Stripe */
    function paymentStripe(apiKey, clientSecret) {
      // A reference to Stripe.js initialized with your real test publishable API key.
      var stripe = Stripe(apiKey);
      var elements = stripe.elements();
      var style = {
        base: {
          color: "#32325d",
          fontFamily: "Arial, sans-serif",
          fontSmoothing: "antialiased",
          fontSize: "16px",
          "::placeholder": {
            color: "#32325d",
          },
        },
        invalid: {
          fontFamily: "Arial, sans-serif",
          color: "#fa755a",
          iconColor: "#fa755a",
        },
      };

      var card = elements.create("card", { style: style });
      // Stripe injects an iframe into the DOM
      card.mount("#card-element");

      card.on("change", function (event) {
        // Disable the Pay button if there are no card details in the Element
        document.querySelector("button").disabled = event.empty;
        document.querySelector("#card-error").textContent = event.error
          ? event.error.message
          : "";
      });

      var form = document.getElementById("payment-form");
      form.addEventListener("submit", function (event) {
        event.preventDefault();
        // Complete payment when the submit button is clicked
        payWithCard(stripe, card, clientSecret);
      });

      // Calls stripe.confirmCardPayment
      // If the card requires authentication Stripe shows a pop-up modal to
      // prompt the user to enter authentication details without leaving your page.
      var payWithCard = function (stripe, card, clientSecret) {
        loading(true);
        stripe
          .confirmCardPayment(clientSecret, {
            payment_method: {
              card: card,
            },
          })
          .then(function (result) {
            if (result.error) {
              // Show error to your customer
              showError(result.error.message);
            } else {
              // The payment succeeded!
              orderComplete(result.paymentIntent.id);
            }
          });
      };

      /* ------- UI helpers ------- */

      // Shows a success message when the payment is complete
      var orderComplete = function (paymentIntentId) {
        loading(false);

        var direccion =
          $("#direccion").val() +
            " " +
            $("#exterior").val() +
            $("#interior").val() +
            " " +
            $("#referencias").val() +
            " " +
            $("#cp").val() +
            " " +
            $("#colonia").val() +
            " " +
            $("#municipio").val() ??
          "" + " " + $("#estado").val() ??
          "" + $("#pais").val() ??
          "" + " " + $("#contacto").val() ??
          "";
        var nonce = $("#nonce").val(),
          nombre = $("#nombre").val(),
          email = $("#email").val() ?? "",
          pedido = $(".success-reference").text(),
          plan = $(".stripe-credit-card .summary .plan-name").text(),
          totalPlan = $(".stripe-credit-card .summary .total-plan").text(),
          totalSim = $(".stripe-credit-card .summary .total-sim").text(),
          totalTotal = $(".stripe-credit-card .summary .total-total").text(),
          msisdn = $("#msisdn").val() ?? "";

        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            nombre: nombre,
            email: email,
            pedido: pedido,
            direccion: direccion,
            plan: plan,
            totalPlan: totalPlan,
            totalSim: totalSim,
            totalTotal: totalTotal,
            msisdn: msisdn,
            action: "send_email",
          },
          success: function (data) {
            console.log(data);
          },
          error: function (error) {
            alert(
              "El cobro se realizo con exito pero no pudimos enviar el correo electrónico."
            );
          },
        }).done(function () {
          setTimeout(function () {
            $("#overlay").fadeOut(300);
          }, 500);
        });

        successStep();
      };

      // Show the customer the error from Stripe if their card fails to charge
      var showError = function (errorMsgText) {
        loading(false);
        var errorMsg = document.querySelector("#card-error");
        errorMsg.textContent = errorMsgText;
        setTimeout(function () {
          errorMsg.textContent = "";
        }, 4000);
      };

      // Show a spinner on payment submission
      var loading = function (isLoading) {
        if (isLoading) {
          // Disable the button and show a spinner
          $("#overlay").fadeIn(300);
        } else {
          $("#overlay").fadeOut(300);
        }
      };
    }

    /* Conekta credit cards */
    function paymentConekta(apiKey, paymentType, sim_active) {
      Conekta.setPublicKey(apiKey);

      var conektaSuccessResponseHandler = function (token) {
        var direccion =
          $("#direccion").val() +
            " " +
            $("#exterior").val() +
            $("#interior").val() +
            " " +
            $("#referencias").val() +
            " " +
            $("#cp").val() +
            " " +
            $("#colonia").val() +
            " " +
            $("#municipio").val() ??
          "" + " " + $("#estado").val() ??
          "" + $("#pais").val() ??
          "" + " " + $("#contacto").val() ??
          "";
        var nonce = $("#nonce").val(),
          nombre = $("#nombre").val() + " " + $("#apellidos").val(),
          email = $("#email").val() ?? "",
          plan = $(".conekta-credit-card .summary .plan-name").text(),
          productId = $("#product_id").val(),
          totalPlan = $(".conekta-credit-card .summary .total-plan").text(),
          totalSim = $(".conekta-credit-card .summary .total-sim").text(),
          descuento = "$0 MXN",
          totalTotal = $(".conekta-credit-card .summary .total-total").text(),
          msisdn = $("#msisdn").val() ?? $("#msisdn_to_port").val() ?? "",
          nip = $("#nip").val() ?? "",
          iccid = $("#iccid").val() ?? "",
          firstname = $("#nombre").val(),
          lastname = $("#apellidos").val(),
          dir = $("#direccion").val(),
          exterior = $("#exterior").val(),
          referencias = $("#referencias").val(),
          cp = $("#cp").val(),
          colonia = $("#colonia").val(),
          municipio = $("#municipio").val() ?? "",
          estado = $("#estado").val() ?? "",
          pais = $("#pais").val() ?? "",
          contacto = $("#contacto").val() ?? "";

        if (paymentType == "didipay-card") {
          plan = "Pay " + plan;
          descuento = $(
            ".conekta-credit-card .summary .descuento-didipay"
          ).text();
        }

        var total = totalTotal.replace("MXN", "").replace("$", "");
        var price = Number(total).toString();

        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            nombre: nombre,
            email: email,
            contacto: $("#contacto").val(),
            direccion: direccion,
            plan: plan,
            descuento: descuento,
            price: price,
            productId: productId,
            totalPlan: totalPlan,
            totalSim: totalSim,
            totalTotal: totalTotal,
            msisdn: msisdn,
            nip: nip,
            iccid: iccid,
            token: token.id,
            sim_active: sim_active,
            action: "conekta_pay",
            firstname: firstname,
            lastname: lastname,
            dir: dir,
            exterior: exterior,
            referencias: referencias,
            cp: cp,
            colonia: colonia,
            municipio: municipio,
            estado: estado,
            pais: pais,
            contacto: contacto,
          },
          success: function (data) {
            var result = jQuery.parseJSON(data);
            console.log(result);

            if (result.error == "") {
              $(".success-reference").text(result.orderId);
              if (result[0].error) {
                $(".activate-error").show();
              }
              successStep();
            } else {
              var $form = $("#card-form");
              $form.find(".card-errors").text(result.error);
              $form.find("button").prop("disabled", false);
            }
          },
          error: function (error) {
            alert(
              "El cobro se realizo con exito pero no pudimos enviar el correo electrónico."
            );
          },
        }).done(function () {
          setTimeout(function () {
            $("#overlay").fadeOut(300);
          }, 500);
        });
      };
      var conektaErrorResponseHandler = function (response) {
        var $form = $("#card-form");
        $form.find(".card-errors").text(response.message_to_purchaser);
        $form.find("button").prop("disabled", false);
      };

      //jQuery para que genere el token después de dar click en submit
      $(function () {
        $("#card-form").submit(function (event) {
          var didiPay = $("#paymentMethod").val();
          var $form = $(this);

          if (didiPay == "didipay-card") {
            var cardBin = $form
              .find("#card")
              .val()
              .replace(/\s+/g, "")
              .substring(0, 6);
            if (cardBin == "410141") {
              // Previene hacer submit más de una vez
              $form.find("button").prop("disabled", true);
              Conekta.Token.create(
                $form,
                conektaSuccessResponseHandler,
                conektaErrorResponseHandler
              );
            } else {
              alert("La tarjeta ingresada no pertenece a DiDi Pay");
            }
          } else {
            // Previene hacer submit más de una vez
            $form.find("button").prop("disabled", true);
            Conekta.Token.create(
              $form,
              conektaSuccessResponseHandler,
              conektaErrorResponseHandler
            );
          }

          return false;
        });
      });
    }

    /* OpenPay credit cards */
    function paymentOpenPay(merchant_id, public_api_key, sandbox) {
      OpenPay.setId(merchant_id);
      OpenPay.setApiKey(public_api_key);
      OpenPay.setSandboxMode(sandbox);

      var deviceSessionId = OpenPay.deviceData.setup(
        "payment-form",
        "device_session_id"
      );

      $("#pay-button").on("click", function (event) {
        event.preventDefault();
        $("#pay-button").prop("disabled", true);
        OpenPay.token.extractFormAndCreate(
          "payment-form",
          sucess_callbak,
          error_callbak
        );
      });

      var sucess_callbak = function (response) {
        var token_id = response.data.id;
        $("#token_id").val(token_id);
        $("#payment-form").submit();
      };

      var error_callbak = function (response) {
        var desc =
          response.data.description != undefined
            ? response.data.description
            : response.message;
        alert("ERROR [" + response.status + "] " + desc);
        $("#pay-button").prop("disabled", false);
      };
    }

    /* Nomina */
    $("#nominaSubmit").on("click", function (event) {
      event.preventDefault();

      if ($("#nomina-form").valid()) {
        var nonce = $("#nonce").val(),
          idProduct = $("#product_id").val(),
          nombreEmpleado = $("#nombre_empleado").val(),
          empresaEmpleado = $("#empresa_empleado").val(),
          matriculaEmpleado = $("#matricula_empleado").val(),
          telefonoEmpleado = $("#tel_empleado").val(),
          emailEmpleado = $("#email_empleado").val();

        var nombre = $("#nombre").val() + " " + $("#apellidos").val(),
          email = $("#email").val() ?? "",
          direccion = $(".nomina .summary .shipping-information").text(),
          plan = $(".nomina .summary .plan-name").text(),
          totalPlan = $(".conekta-credit-card .summary .total-plan").text(),
          totalSim = $(".conekta-credit-card .summary .total-sim").text(),
          descuento = "$0 MXN",
          totalTotal = $(".conekta-credit-card .summary .total-total").text();

        $.ajax({
          showLoader: true,
          type: "post",
          url: figou_ajax.ajax_url,
          data: {
            nonce: nonce,
            idProduct: idProduct,
            nombreEmpleado: nombreEmpleado,
            empresaEmpleado: empresaEmpleado,
            matriculaEmpleado: matriculaEmpleado,
            telefonoEmpleado: telefonoEmpleado,
            emailEmpleado: emailEmpleado,
            nombre: nombre,
            email: email,
            direccion: direccion,
            plan: plan,
            totalPlan: totalPlan,
            totalSim: totalSim,
            totalTotal: totalTotal,
            action: "nomina_pay",
          },
          success: function (result) {
            var data = jQuery.parseJSON(result);
            if (data.error == "") {
              $(".success-reference").text(data.orderId);
              successStep();
            }
            console.log("nomina success");
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

    /* Paso siguiente */
    function nextStep() {
      var current = $(".step-number.active");
      var target = current.next();

      current.removeClass("active");
      current.addClass("visited");
      target.addClass("active");

      $(".step").removeClass("active");
      $("#" + target.data("step")).addClass("active");

      $("html, body").animate(
        {
          scrollTop: $(target).offset().top,
        },
        300
      );
    }

    /* Paso atras */
    $(".prev").on("click", function () {
      var current = $(".step-number.active");
      var target = current.prev();

      current.removeClass("active");
      current.removeClass("visited");
      target.addClass("active");

      $(".step").removeClass("active");
      $("#" + target.data("step")).addClass("active");

      $("html, body").animate(
        {
          scrollTop: $(target).offset().top,
        },
        300
      );
    });

    /* Success Step */
    function successStep() {
      $(".step").removeClass("active");
      $("#success-step").show();
    }

    /* Payment button selector */
    $(".payment-selector").on("click", function () {
      $(".payment-selector").removeClass("active");
      $(this).addClass("active");
      var paymentMethod = $(this).data("method");
      $("#paymentMethod").val(paymentMethod);
    });

    /* Shipment button selector */
    $(".shipment-selector").on("click", function () {
      $(".shipment-selector").removeClass("active");
      $(this).addClass("active");
      var shipmentMethod = $(this).data("method");
      $("#shipmentMethod").val(shipmentMethod);

      var precioEnvio,
        plan = $(".summary.register").find(".total-plan").text();

      if (shipmentMethod == "express-Shipment") {
        precioEnvio = 188;
      } else {
        precioEnvio = 0;
      }

      var nuevoTotal = +plan.replace("MXN", "").replace("$", "") + +precioEnvio;
      $(".summary.register .total-envio").text("$" + precioEnvio + " MXN");
      $(".summary.register .total-total").text("$" + nuevoTotal + " MXN");
    });

    /* Recurrente */
    $("#stripe-cards").on("click", function () {
      //$('.recurrente').show();
    });

    $("#oxxo-cash").on("click", function () {
      $(".recurrente").hide();
    });

    /**
     * Validación
     */
    $("#register_form").validate({
      rules: {
        nombre: {
          required: true,
          minlength: 3,
        },
        apellidos: {
          required: true,
          minlength: 3,
        },
        contacto: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true,
        },
        direccion: {
          required: true,
          minlength: 3,
        },
        exterior: {
          required: true,
        },
        colonia: {
          required: true,
          minlength: 3,
        },
        ciudad: {
          required: true,
          minlength: 3,
        },
        municipio: {
          required: true,
          minlength: 3,
        },
        cp: {
          required: true,
          minlength: 5,
          maxlength: 5,
          number: true,
        },
        estado: {
          required: true,
          minlength: 3,
        },
        pais: {
          required: true,
          minlength: 2,
        },
        email: {
          required: true,
          email: true,
        },
        privacidad: {
          required: true,
        },
        condiciones: {
          required: true,
        },
        iccid: {
          required: true,
          minlength: 7,
          maxlength: 7,
          number: true,
        },
        iccid_confirm: {
          required: true,
          minlength: 7,
          maxlength: 7,
          number: true,
        },
        nip: {
          required: true,
          minlength: 4,
          maxlength: 4,
          number: true,
        },
        msisdn: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true,
        },
        msisdn_to_port: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true,
        },
      },
      messages: {
        nombre: {
          required: "Campo requerido.",
          minlength: "Tu nombre parece muy corto, por favor verifícalo.",
        },
        apellidos: {
          required: "Campo requerido.",
          minlength: "Tus apellidos parecen muy cortos, por favor verifícalos.",
        },
        contacto: {
          required: "Campo requerido.",
          minlength: "Mínimo 10 dígitos.",
          maxlength: "Máximo 10 dígitos.",
          number: "Solo números, ingresa el teléfono a 10 dígitos.",
        },
        direccion: {
          required: "Campo requerido.",
          minlength: "Tu dirección parece muy corta, por favor verifícala.",
        },
        exterior: {
          required: "Campo requerido.",
        },
        colonia: {
          required: "Campo requerido.",
          minlength: "Tu colonia parece muy corta, por favor verifícala.",
        },
        ciudad: {
          required: "Campo requerido.",
          minlength: "Tu ciudad parece muy corta, por favor verifícala.",
        },
        municipio: {
          required: "Campo requerido.",
          minlength: "Tu municipio parece muy corta, por favor verifícala.",
        },
        cp: {
          required: "Campo requerido.",
          minlength: "Mínimo 5 dígitos.",
          maxlength: "Máximo 5 dígitos.",
          number: "Solo números.",
        },
        estado: {
          required: "Campo requerido.",
          minlength: "Tu estado parece muy corto, por favor verifícalo.",
        },
        pais: {
          required: "Campo requerido.",
          minlength: "Tu país parece muy corto, por favor verifícalo.",
        },
        email: {
          required: "Campo requerido.",
          email: "Ingresa un email valido Ej. juan@dominio.com",
        },
        privacidad: {
          required: "Campo requerido.",
        },
        condiciones: {
          required: "Campo requerido.",
        },
        iccid: {
          required: "El codigo ICCID es necesario para activar tu SIM",
          minlength: "Requerimos al menos 7 dígitos",
          maxlength: "Máximo 7 dígitos",
          number: "Solo números",
        },
        iccid_confirm: {
          required: "Confirma tu ICCID",
          minlength: "Requerimos al menos 7 dígitos",
          maxlength: "Máximo 7 dígitos",
          number: "Solo números",
        },
        nip: {
          required: "Tú NIP es neceario para realizar la portabilidad",
          minlength: "Consta de 4 dígitos",
          maxlength: "Consta de 4 dígitos",
          number: "Solo números",
        },
        msisdn_to_port: {
          required: "El número celular a portar es requerido",
          minlength: "Consta de 10 dígitos",
          maxlength: "Consta de 10 dígitos",
          number: "Solo números",
        },
      },
      errorElement: "em",
      errorPlacement: function (error, element) {
        // Add the `help-block` class to the error element
        error.addClass("help-block");

        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("div").find("label"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-error")
          .removeClass("has-success");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-success")
          .removeClass("has-error");
      },
    });

    $("#imei_check").validate({
      rules: {
        imei: {
          required: true,
          minlength: 15,
          maxlength: 16,
          number: true,
        },
      },
      messages: {
        imei: {
          required:
            "El imei es necesario para ofrecerte planes adecuados a tu equipo.",
          minlength:
            "El imei ingresado parece muy corto, deben ser al menos 15 dígitos.",
          maxlength: "El imei no debe superar los 16 dígitos.",
          number: "Solo ingresa números.",
        },
      },
      errorElement: "em",
      errorPlacement: function (error, element) {
        // Add the `help-block` class to the error element
        error.addClass("help-block");

        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("div").find("label"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-error")
          .removeClass("has-success");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-success")
          .removeClass("has-error");
      },
    });

    $("#msisdn_check").validate({
      rules: {
        msisdn: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true,
        },
      },
      messages: {
        msisdn: {
          required: "Es necesario tu número para realizar la recarga.",
          minlength: "Tu número debe constar de 10 dígitos.",
          maxlength: "Tu número debe constar de 10 dígitos.",
          number: "Solo ingresa números.",
        },
      },
      errorElement: "em",
      errorPlacement: function (error, element) {
        // Add the `help-block` class to the error element
        error.addClass("help-block");

        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-error")
          .removeClass("has-success");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-success")
          .removeClass("has-error");
      },
    });

    $("#nomina-form").validate({
      rules: {
        nombre_empleado: {
          required: true,
          minlength: 10,
        },
        empresa_empleado: {
          required: true,
        },
        matricula_empleado: {
          required: true,
        },
        tel_empleado: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true,
        },
        email_empleado: {
          required: true,
          email: true,
        },
      },
      messages: {
        nombre_empleado: {
          required: "Campo requerido.",
          minlength: "Tu nombre parece muy corto, por favor verifícalo.",
        },
        empresa_empleado: {
          required: "Campo requerido.",
        },
        matricula_empleado: {
          required: "Campo requerido.",
        },
        tel_empleado: {
          required: "Campo requerido.",
          minlength: "Mínimo 10 dígitos.",
          maxlength: "Máximo 10 dígitos.",
          number: "Solo números, ingresa el teléfono a 10 dígitos.",
        },
        email_empleado: {
          required: "Campo requerido.",
          email: "Ingresa un email valido Ej. juan@dominio.com",
        },
      },
      errorElement: "em",
      errorPlacement: function (error, element) {
        // Add the `help-block` class to the error element
        error.addClass("help-block");

        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-error")
          .removeClass("has-success");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element)
          .parents(".form-group")
          .addClass("has-success")
          .removeClass("has-error");
      },
    });

    // Mascaras
    $("#imei").mask("000000000000000");
    $("#nip").mask("0000");
    $(".phone").mask("0000000000");
    $(".postcode").mask("00000");
    $("#card").mask("0000 0000 0000 0000");
    $("#op_card").mask("0000 0000 0000 0000");
    $("#cvc").mask("000");
    $("#op_cvc").mask("000");
    $(".card-date").mask("00");
    $(".iccid").mask("0000000");

    // Imprimir

    $("#oxxo_print").on("click", function () {
      $.print("#oxxo-imprime");
    });

    // Label animation

    $("input").on("focusin", function () {
      $(this).parent().find("label").addClass("active-label");
    });

    $("input").on("focusout", function () {
      if (!this.value) {
        $(this).parent().find("label").removeClass("active-label");
      }
    });
  });
})(jQuery);
