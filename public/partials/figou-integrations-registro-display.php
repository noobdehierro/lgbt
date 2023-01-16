<!DOCTYPE html>
<html>
<meta charset="utf-8" />

<head>
    <script type="text/javascript" src="https://pay.conekta.com/v1.0/js/conekta-checkout.min.js"></script>
    <style>
    label {
        font-weight: 600;
        margin-top: 20px;
        font-size: 20px;
    }

    input[type="text"] {
        color: black;
        font-weight: 400;
        padding-left: 10px;
        border-radius: 10px;
    }
    </style>
</head>


<body>

    <div class="steps-container">


        <div id="register-step" class="step active figou-col-66">
            <h3>Paso 1: Datos personales</h3>
            <form id="form-group" style="display: flex;flex-direction: column; ">

                <label for="name">Nombre Completo (como está en tu INE)</label>
                <input type="text" id="name" name="name" placeholder="Tu nombre..">

                <label for="tel">Número telefónico</label>
                <input type="text" id="tel" name="tel" placeholder="Tu Número telefónico..">

                <label for="wa">Número de WhatsApp</label>
                <input type="text" id="wa" name="wa" placeholder="Tu Número de WhatsApp..">

                <label for="email">Correo
                    electrónico</label>
                <input type="text" id="email" name="email" placeholder="Tu Correo electrónico..">

                <input style="margin-top: 20px; border-radius: 10px;" type="submit" value="Siguiente" id="validateData">

            </form>
            <form id="conekta_form">
                <input type="hidden" id="token" name="token" value="">
            </form>
        </div>
        <div class="figou-col-100">
            <span class="card-errors" style="background-color: #aaaeaa; border-radius: 5px; margin: 10px auto;"></span>
        </div>



        <div class="figou-row" id="pay-step" style="display: none;">

            <div class="figou-col-66">
                <h3>Paso 2: Finalizar compra</h3>

                <div id="conektaIframeContainer" style="height: 500px; display:none"></div>

            </div>
            <div class="figou-col-33">
                <div class="summary register" style="display: none;" id="resumen">
                    <h3>Resumen</h3>
                    <div class="plan-name"></div>
                    <div class="incluye">
                        <h4>Caracteristicas:</h4>
                    </div>
                    <div class="totals">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Plan: </td>
                                    <td>5GB</td>
                                </tr>
                                <tr>
                                    <td class="label-plan">Territorio Nacional, EUA y Canada</td>
                                </tr>
                                <tr>
                                    <td class="label-plan">WiFi para compartir</td>
                                    <td class="label-plan">Asistencia y seguros Premium</td>

                                </tr>

                                <tr>
                                    <td class="label-plan">Vigencia:</td>
                                    <td class="total-sim">30 días</td>
                                </tr>

                                <tr>
                                    <td class="label-plan">Total:</td>
                                    <td class="total-total">$260</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div id="success-step" class="step">
            <div class="figou-row">
                <div class="figou-col-100">
                    <h2>¡Felicidades! Tu pago ha sido exitoso</h2>
                    <br />
                    <p>En breve recibiras un correo con los detalles de tu registro.</p>
                    <p>Referencia: <span class="success-reference"></span></p>
                </div>
            </div>
        </div>
    </div>

    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>


    <script src="/wp-content/plugins/figou-integrations/public/js/registro3.js"></script>


</body>

</html>