<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.leancommerce.mx
 * @since      1.0.0
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<section class="figou-section contrata">
    <div id="figou-contrata">
        <div class="figou-container">
            <div class="step-indicator" style="display: none">
                <div class="step-number active" data-step="offerings-step">1 de 4</div>
                <!-- <div class="step-number" data-step="imei-step">2 de 4</div> -->
                <div class="step-number" data-step="register-step">3 de 4</div>
                <div class="step-number" data-step="payment-step">4 de 4</div>
            </div>

            <div class="steps-container">
                <!-- Offerings Step -->
                <div id="offerings-step" class="step active">
                    <div class="registercontent">
                        <h2 class="title-center">Elige el que más te convenga</h2>
                        <div class="liketable">
                            <div id="offerings">
                                <div class="plan offeringTemplate">
                                    <div class="offer-name plan_title">5GB</div>
                                    <div class="offer-price letrasplan">$260 MXN</div>
                                    <div class="offer-covertura">Cobertura en todo México</div>
                                    <div class="offer-short" style="display: none;">Vigencia 30 días</div>
                                    <div class="offer-description letrasplan">
                                        <ul>
                                            <li><span class="figou-list-icon"><i class="fas fa-check-circle"></i></span><span class="figou-list-text">Llamadas y SMS ilimitados </span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Territorio Nacional, EUA y Canada</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">WiFi para compartir</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Redes sociales gratis: Facebook, Instagram, Twitter y Snapchat</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Asistencia y seguros Premium</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Vigencia: 30 días</span></li>
                                        </ul>
                                    </div>
                                    <button class="select_plan buttonplan next" data-id="PO_SAYLGRM_CT_750_750Mi_1500Mi_5000M_250_250SMS_30D_N">Continuar</button>
                                </div>
                                <div class="plan offeringTemplate ">
                                    <div class="offer-name plan_title">8GB</div>
                                    <div class="offer-price letrasplan">$340 MXN</div>
                                    <div class="offer-covertura">Cobertura en todo México</div>
                                    <div class="offer-short" style="display: none;">Vigencia 30 días</div>
                                    <div class="offer-description letrasplan">
                                        <ul>
                                            <li><span class="figou-list-icon"><i class="fas fa-check-circle"></i></span><span class="figou-list-text">Llamadas y SMS ilimitados </span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Territorio Nacional, EUA y Canada</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">WiFi para compartir</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Redes sociales gratis: Facebook, Instagram, Twitter y Snapchat</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Asistencia y seguros Premium</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Vigencia: 30 días</span></li>
                                        </ul>
                                    </div>
                                    <button class="select_plan buttonplan next" data-id="PO_SAYLG_CT_750_750Mi_1500Mi_3000_5000M_250_250SMS_30D_NR">Continuar</button>
                                </div>
                                <div class="plan offeringTemplate ">
                                    <div class="offer-name plan_title">20GB</div>
                                    <div class="offer-price letrasplan">$560 MXN</div>
                                    <div class="offer-covertura">Cobertura en todo México</div>
                                    <div class="offer-short" style="display: none;">Vigencia 30 días</div>
                                    <div class="offer-description letrasplan">
                                        <ul>
                                            <li><span class="figou-list-icon"><i class="fas fa-check-circle"></i></span><span class="figou-list-text">Llamadas y SMS ilimitados </span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Territorio Nacional, EUA y Canada</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">WiFi para compartir</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Redes sociales gratis: Facebook, Instagram, Twitter y Snapchat</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Asistencia y seguros Premium</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Vigencia: 30 días</span></li>
                                        </ul>
                                    </div>
                                    <button class="select_plan buttonplan next" data-id="PO_SAYLGST750_750Mi_1500Mi_15000_5000M_500_500SMS_20000T_30">Continuar</button>
                                </div>
                                <div class="plan offeringTemplate ">
                                    <div class="offer-name plan_title">50GB</div>
                                    <div class="offer-price letrasplan">$865 MXN</div>
                                    <div class="offer-covertura">Cobertura en todo México</div>
                                    <div class="offer-short" style="display: none;">Vigencia 30 días</div>
                                    <div class="offer-description letrasplan">
                                        <ul>
                                            <li><span class="figou-list-icon"><i class="fas fa-check-circle"></i></span><span class="figou-list-text">Llamadas y SMS ilimitados </span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Territorio Nacional, EUA y Canada</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">WiFi para compartir</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Redes sociales gratis: Facebook, Instagram, Twitter y Snapchat</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Asistencia y seguros Premium</span></li>
                                            <li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">Vigencia: 30 días</span></li>
                                        </ul>
                                    </div>
                                    <button class="select_plan buttonplan next" data-id="PO_SAYLGRM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_N">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Offerings Step -->

                <!-- IMEI Step -->
                <!-- <div id="imei-step" class="step">
                    <div class="figou-row">
                        <div class="figou-col-100">
                            <div class="figou-title-container">
                                <h2 class="figou-heading-title">Verifica si tu celular es compatible con la red 4.5</h2>
                            </div>
                        </div>
                    </div>
                    <div class="figou-row">
                        <div class="figou-col-100">
                            <div class="imei-form-container">
                                <form id="imei_check">
                                    <div class="field">
                                        <label for="imei" class="colorwhite required">Ingresa el código IMEI de tu
                                            celular</label>
                                        <input type="tel" name="imei" id="imei" required>
                                    </div>
                                    <span class="imei-error">¡Parece que tu equipo no es compatible con nuestra red! Te
                                        invitamos a revisar nuestra sección de equipos.</span>
                                    <div class="figou-info-card">
                                        <p>Hay tres maneras de obtenerlo:</p>
                                        <ul>
                                            <li>Marcar <a href="tel:*%2306%23">*#06#</a> desde tu celular</li>
                                            <li>Búscalo en la configuración de tu teléfono, son entre 15 y 17 números
                                            </li>
                                            <li>Encuéntralo impreso en la etiqueta de la batería de tu celular</li>
                                        </ul>
                                    </div>
                                    <div class="button-underline">
                                        <button type="button" class="prev">Regresar</button>
                                        <button id="valida_imei" type="button" class="button next"
                                            data-nonce="<?php wp_create_nonce('figou_save_nonce') ?>">Continuar</button>
                                    </div>
                                    <div id="os-imei-instructions" class="figou-row">
                                        <div class="figou-col-100">
                                            <div class="os-selector">
                                                <span id="android" class="active">Android</span>
                                                <span id="ios">iOS</span>
                                            </div>
                                            <div class="figou-row">
                                                <div class="figou-col-100">
                                                    <span class="os-title">Cómo obtener el código IMEI:</span>
                                                </div>
                                            </div>
                                            <div class="android-panel os-panel active">
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/android-2-1.png"
                                                            class="android-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>1</h3>
                                                        <p>En Ajustes, ve a “Información del teléfono”</p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/android-2-2.png"
                                                            class="android-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>2</h3>
                                                        <p>En Información del teléfono, ve a “Estado”</p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/android-2-3.png"
                                                            class="android-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>3</h3>
                                                        <p>En Estado, encontrarás el “IMEI”</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ios-panel os-panel">
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/ios-2-1.png"
                                                            class="ios-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>1</h3>
                                                        <p>Ve a configuraciones y selecciona “General”</p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/ios-2-2.png"
                                                            class="ios-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>2</h3>
                                                        <p>En General, ve a la sección de “Información” </p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/ios-2-3.png"
                                                            class="ios-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>3</h3>
                                                        <p>En Información, encontrarás el “IMEI”</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- Fin IMEI Step -->

                <!-- Register Step -->
                <div id="register-step" class="step">
                    <div class="registercontent">
                        <form id="register_form">
                            <input type="hidden" id="product_id" name="product_id" value="">
                            <input type="hidden" id="product_name" name="product_name" value="">
                            <input type="hidden" id="product_price" name="product_price" value="">
                            <input type="hidden" id="product_desc" name="product_desc" value="">
                            <div class="figou-row">
                                <div class="figou-col-66">

                                    <div class="register-information">
                                        <h2 class="figou-center">Agrega tu información personal</h2>
                                        <fieldset class="personal-information">
                                            <div class="figou-row">
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="nombre"
                                                            class="colorwhite required">Nombre(s)</label>
                                                        <input type="text" id="nombre" name="nombre">
                                                    </div>
                                                </div>
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="apellidos"
                                                            class="colorwhite required">Apellido(s)</label>
                                                        <input type="text" id="apellidos" name="apellidos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="figou-row">
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="email" class="colorwhite required">Correo
                                                            electrónico </label>
                                                        <input type="email" id="email" name="email" class="email">
                                                    </div>
                                                </div>
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="contacto" class="colorwhite required">Teléfono
                                                        </label>
                                                        <input type="tel" id="contacto" name="contacto" class="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="figou-row">
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="email" class="colorwhite required">Fecha de
                                                            nacimiento </label>
                                                        <input type="date" id="nacimiento" name="nacimiento"
                                                            class="date">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- <p class="subtitle">Datos de la tarjeta SIM</p>
                                        <fieldset>
                                            <div class="figou-row">
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="referido" class="colorwhite">Código de referido
                                                        </label>
                                                        <input type="text" id="referido" name="referido">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset> -->
                                        <p class="subtitle">Dirección</p>
                                        <fieldset class="shipping-address">
                                            <div class="figou-row">
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="direccion" class="colorwhite required">Calle</label>
                                                        <input type="text" id="direccion" name="direccion">
                                                    </div>
                                                </div>
                                                <div class="figou-col-25">
                                                    <div class="field">
                                                        <label for="exterior" class="colorwhite required">Número</label>
                                                        <input type="text" id="exterior" name="exterior">
                                                    </div>
                                                </div>
                                                <div class="figou-col-25">
                                                    <div class="field">
                                                        <label for="interior" class="colorwhite">Interior</label>
                                                        <input type="text" id="interior" name="interior">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="figou-row">
                                                <div class="figou-col-100">
                                                    <div class="field">
                                                        <label for="referencias" class="colorwhite">Referencia entre
                                                            calles</label>
                                                        <input type="text" id="referencias" name="referencias">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="figou-row">
                                                <div class="figou-col-33">
                                                    <div class="field">
                                                        <label for="cp" class="colorwhite required">Código
                                                            Postal</label>
                                                        <input type="tel" id="cp" name="cp" class="postcode">
                                                    </div>
                                                </div>
                                                <div class="figou-col-33">
                                                    <div id="field-colonia" class="field">
                                                        <label for="colonia" class="colorwhite required">Colonia</label>
                                                        <select id="colonia">
                                                            <option value="">Seleccione una colonia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="figou-col-33">
                                                    <div class="field">
                                                        <label for="municipio"
                                                            class="colorwhite required">Municipio</label>
                                                        <input type="text" id="municipio" name="municipio"
                                                            readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="figou-row">
                                                <div class="figou-col-50">
                                                    <div class="field">
                                                        <label for="estado" class="colorwhite required">Estado</label>
                                                        <input type="text" id="estado" name="estado"
                                                            readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="figou-row">
                                                <div class="figou-col-100">
                                                    <div class="field checkbox">
                                                        <label for="privacidad" class="colorwhite required"><a
                                                                href="https://xnosotras.mx/aviso-de-privacidad-app/"
                                                                target="_blank">Datos protegidos por la Ley (LFPDP) y
                                                                por el Aviso de Privacidad</a></label>
                                                        <input type="checkbox" id="privacidad" name="privacidad">
                                                    </div>
                                                </div>
                                                <div class="figou-col-100">
                                                    <div class="field checkbox">
                                                        <label for="condiciones" class="colorwhite required"><a
                                                                href="https://xnosotras.mx/condiciones-uso/"
                                                                target="_blank">He leído y acepto los términos y
                                                                condiciones</a></label>
                                                        <input type="checkbox" id="condiciones" name="condiciones">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="metodos-de-envio">
                                        <p class="subtitle">Método de envío</p>
                                        <p class="figou-center">Selecciona el método de envío que prefieras</p>
                                        <fieldset class="shipment">
                                            <legend></legend>
                                            <div class="figou-row">
                                                <div class="figou-col-100">
                                                    <div class="figou-row shipment-selector-container">
                                                    <input type="hidden" name="shipmentMethod" id="shipmentMethod" />
                                                        <div class="figou-col-50">
                                                            <button type="button" class="shipment-selector"
                                                                name="freeShipment" data-method="free-Shipment">
                                                                <p>
                                                                    Envío gratis<br /><span
                                                                        class="light">Envío sin costo de 10 a 15 días.</span>
                                                                </p>
                                                            </button>
                                                        </div>
                                                        <div class="figou-col-50">
                                                            <button type="button" class="shipment-selector" name="expressShipment"
                                                                data-method="express-Shipment">
                                                                <p>
                                                                    Envío Exprés<br />
                                                                    <span class="light">Costo de $188 MXN</span>
                                                                </p>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="metodos-de-pago">
                                        <p class="subtitle">Método de pago</p>
                                        <p class="figou-center">Selecciona cómo deseas realizar tu pago</p>
                                        <fieldset class="payment">
                                            <legend></legend>
                                            <div class="figou-row">
                                                <div class="figou-col-100">
                                                    <div class="figou-row payment-selector-container">
                                                        <input type="hidden" name="paymentMethod" id="paymentMethod" />
                                                        <div id="didipay" class="figou-col-50" style="display: none;">
                                                            <button type="button" class="payment-selector"
                                                                name="didipay" data-method="didipay-card">
                                                                <p>Pagar con tarjeta de crédito DiDi Pay<br /><span
                                                                        class="light">Obtén hasta un 20% de
                                                                        descuento</span></p>
                                                                <img src="/wp-content/uploads/figou/DiDiPay_logo.png">
                                                            </button>
                                                        </div>
                                                        <div id="conekta" class="figou-col-50">
                                                            <button type="button" class="payment-selector"
                                                                name="conekta" data-method="conekta-credit-card">
                                                                <p>
                                                                    Pagar con tarjeta de crédito ó débito<br /><span
                                                                        class="light">AMEX, VISA, MASTERCARD</span>
                                                                </p>
                                                                <img src="/wp-content/uploads/figou/conekta.png">
                                                            </button>
                                                        </div>
                                                        <div id="openpay" class="figou-col-50" style="display:none;">
                                                            <button type="button" class="payment-selector"
                                                                name="openpay" data-method="openpay-credit-card">
                                                                <p>
                                                                    Pagar con tarjeta de crédito ó débito<br /><span
                                                                        class="light">AMEX, VISA, MASTERCARD</span>
                                                                </p>
                                                                <img src="/wp-content/uploads/figou/openpay.png">
                                                            </button>
                                                        </div>
                                                        <div class="figou-col-50">
                                                            <button type="button" class="payment-selector" name="oxxo"
                                                                data-method="oxxo-cash">
                                                                <p>
                                                                    Pagar en las siguientes tiendas<br />
                                                                    <span class="light">*Se aplica una comisión al pagar en el establecimiento</span>
                                                                </p>
                                                                <img src="/wp-content/uploads/figou/stores_pay.png" class="payment-selector img" style="max-width: 60%;">
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="button-underline">
                                                        <button type="button" class="prev">Regresar</button>
                                                        <button type="button" class="next"
                                                            id="payment_intent">Enviar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="figou-col-33">
                                    <div class="summary register">
                                        <h3>Resumen</h3>
                                        <div class="plan-name"></div>
                                        <div class="incluye">
                                            <h4>Caracteristicas:</h4>
                                            <p></p>
                                        </div>
                                        <div class="totals">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="label-plan">Plan:</td>
                                                        <td class="total-plan"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label-plan">SIM:</td>
                                                        <td class="total-sim"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label-plan">Envío:</td>
                                                        <td class="total-envio"></td>
                                                     </tr>
                                                    <tr>
                                                        <td class="label-plan">Total:</td>
                                                        <td class="total-total"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Fin Register Step -->

                <!-- Payment Step -->
                <div id="payment-step" class="step">
                    <div class="oxxo-cash">
                        <h2>¡Gracias por tu preferencia!</h2>
                        <p>Realiza el pago en la tienda más cercana con tu número de referencia.</p>
                        <div class="oxxo-imprime" id="oxxo-imprime">
                            <div class="no-imprime">FICHA DIGITAL, NO ES NECESARIO IMPRIMIR.</div>
                            <div class="figou-row">
                                <div class="figou-col-50">
                                    <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/stores_pay.png" class="oxxo-pay"
                                        alt="StoresPay">
                                </div>
                                <div class="figou-col-50">
                                    <span class="nombre-plan"></span><br />
                                    <span class="monto"></span><br />
                                    <span class="oxxo-comision">*La tienda cobrará una comisión adicional al momento de
                                        realizar el pago.</span>
                                    <br /><br />
                                </div>
                            </div>
                            Id transacción: <span class="referencia-figou"></span><br>
                            <div class="barcode">
                                <img class="barcode-img" src="" />
                                <p class="barcode-label">REFERENCIA</p>
                                <span class="barcode-ref"></span>
                            </div>
                            <div class="oxxo-instrucciones">
                                <h5>INSTRUCCIONES:</h5>
                                <ul>
                                    <li>Acude a la tienda más cercana.</li>
                                    <li>Indica en caja que quieres realizar un pago con tu ficha dígital.</li>
                                    <li>Presenta el código de barras o dicta al cajero el número de referencia.</li>
                                    <li>Realiza tu pago en efectivo.</li>
                                    <li>Solicita y conserva el comprobante impreso.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="button-underline">
                            <button id="oxxo_print" type="button">Imprimir</button>
                        </div>
                    </div>
                    <div class="openpay-credit-card">
                        <div class="figou-row">
                            <div class="figou-col-66">
                                <div class="bkng-tb-cntnt">
                                    <div class="pymnts">
                                        <form action="#" method="POST" id="payment-form">
                                            <input type="hidden" name="token_id" id="token_id">
                                            <input type="hidden" name="device_session_id" id="device_session_id">
                                            <div class="pymnt-itm card active">
                                                <h2>Tarjeta de crédito o débito</h2>
                                                <div class="pymnt-cntnt">
                                                    <div class="card-expl">
                                                        <div class="credit">
                                                            <h4>Tarjetas de crédito y débito</h4>
                                                        </div>
                                                    </div>
                                                    <div class="sctn-row">
                                                        <div class="sctn-col l">
                                                            <label>Nombre del titular</label><input type="text"
                                                                placeholder="Como aparece en la tarjeta"
                                                                autocomplete="off" data-openpay-card="holder_name">
                                                        </div>
                                                        <div class="sctn-col">
                                                            <label>Número de tarjeta</label><input type="text"
                                                                autocomplete="off" data-openpay-card="card_number">
                                                        </div>
                                                    </div>
                                                    <div class="sctn-row">
                                                        <div class="sctn-col l">
                                                            <label>Fecha de expiración</label>
                                                            <div class="sctn-col half l"><input type="text"
                                                                    class="card-date" placeholder="Mes"
                                                                    data-openpay-card="expiration_month"></div>
                                                            <div class="sctn-col half l"><input type="text"
                                                                    class="card-date" placeholder="Año"
                                                                    data-openpay-card="expiration_year"></div>
                                                        </div>
                                                        <div class="sctn-col cvv"><label>Código de seguridad</label>
                                                            <div class="sctn-col half l"><input type="text" id="op_cvc"
                                                                    placeholder="3 dígitos" autocomplete="off"
                                                                    data-openpay-card="cvv2"></div>
                                                        </div>
                                                    </div>
                                                    <div class="openpay">
                                                        <div class="logo">Transacciones realizadas vía:</div>
                                                        <div class="shield">Tus pagos se realizan de forma segura con
                                                            encriptación de 256 bits</div>
                                                    </div>
                                                    <div class="sctn-row">
                                                        <a class="button rght" id="pay-button">Pagar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="figou-col-33">
                                <div class="summary">
                                    <h3>Resumen</h3>
                                    <div class="plan-name"></div>
                                    <div class="incluye">
                                        <h3>Caracteristicas:</h3>
                                        <p></p>
                                    </div>
                                    <div class="totals">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="label-plan">Plan:</td>
                                                    <td class="total-plan"></td>
                                                </tr>
                                                <tr>
                                                    <td class="label-plan">SIM:</td>
                                                    <td class="total-sim"></td>
                                                </tr>
                                                <tr>
                                                    <td class="labe-plan">*Descuento DiDi-Pay:</td>
                                                    <td class="descuento-didipay"></td>
                                                </tr>
                                                <tr>
                                                    <td class="label-plan">Total:</td>
                                                    <td class="total-total"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">*Paga con tu tarjeta DiDi Pay para obtener un
                                                        descuento adicional</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="shipping-address">
                                        <h3>Dirección de envío:</h3>
                                        <p class="shipping-information"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="conekta-credit-card">
                        <div class="figou-row">
                            <div class="figou-col-66">
                                <form id="card-form">
                                    <h2>Pago con tarjeta</h2>
                                    <p>Ingresa los datos de tu tarjeta para proceder con el pago:</p>
                                    <div class="field field-100">
                                        <label for="card" class="colorwhite required">Número de tarjeta</label>
                                        <input id="card" type="tel" size="20" data-conekta="card[number]">
                                    </div>
                                    <div class="field field-33">
                                        <label for="date" class="colorwhite required">Mes exp</label>
                                        <input class="card-date" type="number" size="2" data-conekta="card[exp_month]">
                                    </div>
                                    <div class="field field-33">
                                        <label for="date" class="colorwhite required">Año exp</label>
                                        <input class="card-date" type="number" size="2" data-conekta="card[exp_year]">
                                    </div>
                                    <div class="field field-33">
                                        <label for="cvc" class="colorwhite required">CVC</label>
                                        <input id="cvc" type="tel" size="4" data-conekta="card[cvc]">
                                    </div>
                                    <div class="field field-100">
                                        <label for="cardholder" class="colorwhite required">Nombre del
                                            tarjetahabiente</label>
                                        <input id="cardholder" type="text" size="20" data-conekta="card[name]">
                                    </div>
                                    <div class="figou-row">
                                        <div class="figou-col-100">
                                            <span class="card-errors"></span>
                                        </div>
                                        <div class="figou-col-100">
                                            <button id="paymentSubmit" type="submit">Pagar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="figou-col-33">
                                <div class="summary">
                                    <h3>Resumen</h3>
                                    <div class="plan-name"></div>
                                    <div class="incluye">
                                        <h3>Caracteristicas:</h3>
                                        <p></p>
                                    </div>
                                    <div class="totals">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="label-plan">Plan:</td>
                                                    <td class="total-plan"></td>
                                                </tr>
                                                <tr>
                                                    <td class="label-plan">SIM:</td>
                                                    <td class="total-sim"></td>
                                                </tr>
                                                <tr>
                                                    <td class="label-plan">Envío:</td>
                                                    <td class="total-envio"></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td class="labe-plan">*Descuento DiDi-Pay:</td>
                                                    <td class="descuento-didipay"></td>
                                                </tr>
                                                <tr>
                                                    <td class="label-plan">Total:</td>
                                                    <td class="total-total"></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td colspan="2">*Paga con tu tarjeta DiDi Pay para obtener un
                                                        descuento adicional</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="shipping-address">
                                        <h3>Dirección de envío:</h3>
                                        <p class="shipping-information"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nomina">
                        <div class="figou-row">
                            <div class="figou-col-66">
                                <form id="nomina-form">
                                    <h2>Descuento en nómina</h2>
                                    <p>Formulario de solicitud:</p>
                                    <div class="field field-100">
                                        <label for="nombre_empleado" class="colorwhite required">Nombre completo del
                                            empleado</label>
                                        <input id="nombre_empleado" name="nombre_empleado" type="text" />
                                    </div>
                                    <div class="field field-50">
                                        <label for="empresa_empleado" class="colorwhite required">Empresa</label>
                                        <input id="empresa_empleado" name="empresa_empleado" type="text" />
                                    </div>
                                    <div class="field field-50">
                                        <label for="matricula_empleado" class="colorwhite required">No. empleado o
                                            matricula</label>
                                        <input id="matricula_empleado" name="matricula_empleado" type="text" />
                                    </div>
                                    <div class="field field-50">
                                        <label for="tel_empleado" class="colorwhite required">Teléfono</label>
                                        <input class="phone" id="tel_empleado" name="tel_empleado" type="tel" />
                                    </div>
                                    <div class="field field-50">
                                        <label for="email_empleado" class="colorwhite required">Correo
                                            elecrónico</label>
                                        <input id="email_empleado" name="email_empleado" type="email" />
                                    </div>
                                    <div class="figou-row">
                                        <div class="figou-col-100">
                                            <span class="card-errors"></span>
                                        </div>
                                        <div class="figou-col-100">
                                            <button id="nominaSubmit" type="submit">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="figou-col-33">
                                <div class="summary">
                                    <h3>Resumen</h3>
                                    <div class="plan-name"></div>
                                    <div class="incluye">
                                        <h3>Caracteristicas:</h3>
                                        <p></p>
                                    </div>
                                    <div class="totals">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="label-plan">Plan:</td>
                                                    <td class="total-plan"></td>
                                                </tr>
                                                <tr>
                                                    <td class="label-plan">SIM:</td>
                                                    <td class="total-sim"></td>
                                                </tr>
                                                <tr>
                                                    <td class="label-plan">Total:</td>
                                                    <td class="total-total"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="shipping-address">
                                        <h3>Dirección de envío:</h3>
                                        <p class="shipping-information"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Payment Step -->

                <!-- Success Step -->
                <div id="success-step" class="step">
                    <div class="figou-row">
                        <div class="figou-col-100">
                            <h2>¡Felicidades! Hemos recibido tu pago</h2>
                            <br />
                            <p>¡BIENVENIDO ya cuentas con todos los beneficios de LGBTMASMOBILE!</p>
                            <p>GRACIAS por tu preferencia.</p>
                            <p>En breve recibiras un correo electronico con la información de la compra.</p>
                            <p>Referencia: <span class="success-reference"></span></p>
                        </div>
                    </div>
                </div>
                <!-- Fin Success Step -->

            </div>
        </div>
    </div>
</section>

<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>