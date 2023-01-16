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



<section class="figou-section recarga">
    <div id="figou-recarga">
        <div class="figou-container">

            <div class="step-indicator" style="display: none">
                <div class="step-number active" data-step="imei-step">1 de 4</div>
                <div class="step-number" data-step="offerings-step">2 de 4</div>
                <div class="step-number" data-step="register-step">3 de 4</div>
                <div class="step-number" data-step="payment-step">4 de 4</div>
            </div>

            <div class="steps-container">

                <!-- MSISDN Step -->
                <div id="imei-step" class="step active">
                    <div class="figou-row">
                        <div class="figou-col-100">
                            <h2 class="figou-heading-title">Ingresa el número telefónico a recargar</h2>
                            <div class="liketable">
                                <form id="msisdn_check">
                                    <div class="field">
                                        <label for="msisdn">Número a recargar</label>
                                        <input type="tel" class="phone" name="msisdn" id="msisdn" required>
                                    </div>
                                    <div class="button-underline">
                                        <button id="valida_msisdn" type="button" class="button" data-nonce="<?php wp_create_nonce( 'figou_save_nonce' ) ?>">Siguiente</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin MSISDN Step -->

                <!-- Offerings Step -->
                <div id="offerings-step" class="step">
                    <div class="registercontent">
                        <h3 class="title-center">Elige tu plan móvil</h3>
                        <p class="subtitle">¡Tenemos las siguientes ofertas para tí!</p>
                        <div class="liketable">
                            <div id="offerings">
                            </div>
                        </div>
                    </div>
                    <div class="portabilidadcontent">
                        <h3 class="title-center">No hemos encontrado el registro de tu número celular</h3>
                        <p>Si aun no tienes un plan lgbt+mobile, contratarlo <a href="<?php echo get_home_url(); ?>/contrata">aquí</a> y obten las mejores tarifas.</p>
                    </div>
                    <div class="button-underline">
                        <button type="button" class="prev">Regresar</button>
                    </div>
                </div>
                <!-- Fin Offerings Step -->

                <!-- Register Step -->
                <div id="register-step" class="step">
                    <div class="registercontent">
                        <form id="rechargin_form">
                            <input type="hidden" id="product_id" name="product_id" value="">
                            <input type="hidden" id="product_name" name="product_name" value="">
                            <input type="hidden" id="product_price" name="product_price" value="">
                            <input type="hidden" id="product_desc" name="product_desc" value="">
                            <div class="figou-row">
                                <div class="figou-col-66">
                                    <h3>Elige un metodo de pago</h3>
                                    <fieldset class="payment">
                                        <div class="figou-row">
                                            <div class="figou-col-100">
                                                <div class="figou-row payment-selector-container">
                                                    <input type="hidden" name="paymentMethod" id="paymentMethod" />
                                                    <div id="stripe" class="figou-col-50" style="display: none;">
                                                        <button type="button" class="payment-selector" name="stripe" data-method="stripe-credit-card">Pagar con tarjeta de crédito ó débito<br/><span class="light">AMEX, VISA, MASTERCARD</span></button>
                                                    </div>
                                                    <div id="conekta" class="figou-col-50">
                                                        <button type="button" class="payment-selector" name="conekta" data-method="conekta-credit-card">
                                                            <p>
                                                                Pagar con tarjeta de crédito ó débito<br/><span class="light">AMEX, VISA, MASTERCARD</span>
                                                            </p>
                                                            <img src="/wp-content/uploads/figou/conekta.png">
                                                        </button>
                                                    </div>
                                                    <div class="figou-col-50">
                                                        <button type="button" class="payment-selector" name="oxxo" data-method="oxxo-cash">
                                                            <p>
                                                                Pagar en las siguientes tiendas<br/>
                                                                <span class="light">*Se aplica una comisión al pagar en el establecimiento</span>
                                                            </p>
                                                            <img src="/wp-content/uploads/figou/stores_pay.png">
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="button-underline">
                                                    <button type="button" class="prev">Regresar</button>
                                                    <button type="button" class="next" id="payment_intent_recharge">Enviar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
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
                                                <tbody><tr>
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
                                    <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/stores_pay.png" class="oxxo-pay" alt="StoresPay">
                                </div>
                                <div class="figou-col-50">
                                    <span class="nombre-plan"></span><br/>
                                    <span class="monto"></span><br/>
                                    <span class="oxxo-comision">*La tienda cobrará una comisión adicional al momento de realizar el pago.</span>
                                    <br/><br/>
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
                    <div class="stripe-credit-card">
                        <div class="figou-row">
                            <div class="figou-col-66">
                                <form id="payment-form">
                                    <h2>Pago con tarjeta</h2>
                                    <p>Ingresa los datos de tu tarjeta para proceder con el pago:</p>
                                    <div class="card-container">
                                        <div class="figou-row">
                                            <div class="figou-col-100">
                                                <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                                            </div>
                                        </div>
                                        <div class="figou-row">
                                            <div class="figou-col-50">
                                                <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/stripe_large.png" class="stripe-cards" alt="Stripe">
                                            </div>
                                            <div class="figou-col-50">
                                                <button id="submit">
                                                    <div class="spinner hidden" id="spinner"></div>
                                                    <span id="button-text">Pagar</span>
                                                </button>
                                            </div>
                                        </div>
                                        <p id="card-error" role="alert"></p>
                                        <p class="result-message hidden">
                                            Pago aceptado.
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="figou-col-33">
                                <div class="summary">
                                    <h2>Resumen</h2>
                                    <div class="plan-name"></div>
                                    <div class="incluye">
                                        <h3>Caracteristicas:</h3>
                                        <p></p>
                                    </div>
                                    <div class="totals">
                                        <table>
                                            <tbody><tr>
                                                <td>Plan:</td>
                                                <td class="total-plan"></td>
                                            </tr>
                                            <tr>
                                                <td>SIM:</td>
                                                <td class="total-sim"></td>
                                            </tr>
                                            <tr>
                                                <td>Total:</td>
                                                <td class="total-total"></td>
                                            </tr>
                                            </tbody></table>
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
                                        <label for="cardholder" class="colorwhite required">Nombre del tarjetahabiente</label>
                                        <input id="cardholder" type="text" size="20" data-conekta="card[name]">
                                    </div>
                                    <div class="field field-100">
                                        <label for="email" class="colorwhite required">Correo electrónico</label>
                                        <input id="email" type="text" size="20" required>
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
                                            <tbody><tr>
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
                                            </tbody></table>
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
                            <h2>¡Felicidades! Tu pago ha sido exitoso</h2>
                            <br/>
                            <p>Te damos la bienvenida a la red LGBTMASMOBILE.</p>
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