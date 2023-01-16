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
                <div class="step-number active" data-step="imei-step">1 de 2</div>
                <div class="step-number" data-step="valid-step">2 de 2</div>
            </div>

            <div class="steps-container">
                <!-- IMEI Step -->
                <div id="imei-step" class="step active">
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
                                        <label for="imei" class="colorwhite required">Ingresa el código IMEI de tu celular</label>
                                        <input type="tel" name="imei" id="imei" required>
                                    </div>
                                    <span class="imei-error">¡Parece que tu equipo no es compatible con nuestra red! Te invitamos a revisar nuestra sección de equipos.</span>
                                    <div class="figou-info-card">
                                        <p>Hay tres maneras de obtenerlo:</p>
                                        <ul>
                                            <li>Marcar <a href="tel:*%2306%23">*#06#</a> desde tu celular</li>
                                            <li>Búscalo en la configuración de tu teléfono, son entre 15 y 17 números</li>
                                            <li>Encuéntralo impreso en la etiqueta de la batería de tu celular</li>
                                        </ul>
                                    </div>
                                    <div class="button-underline">
                                        <button type="button" class="prev">Regresar</button>
                                        <button id="valida_imei" type="button" class="button next" data-nonce="<?php wp_create_nonce( 'figou_save_nonce' ) ?>">Continuar</button>
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
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/android-2-1.png" class="android-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>1</h3>
                                                        <p>En Ajustes, ve a “Información del teléfono”</p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/android-2-2.png" class="android-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>2</h3>
                                                        <p>En Información del teléfono, ve a “Estado”</p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/android-2-3.png" class="android-img">
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
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/ios-2-1.png" class="ios-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>1</h3>
                                                        <p>Ve a configuraciones y selecciona “General”</p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/ios-2-2.png" class="ios-img">
                                                    </div>
                                                    <div class="figou-col-50 desc">
                                                        <h3>2</h3>
                                                        <p>En General, ve a la sección de “Información” </p>
                                                    </div>
                                                </div>
                                                <div class="figou-row">
                                                    <div class="figou-col-50 desc">
                                                        <img src="<?= wp_upload_dir()['baseurl']; ?>/figou/ios-2-3.png" class="ios-img">
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
                </div>
                <!-- Fin IMEI Step -->

                <!-- Success Step -->
                <div id="valid-step" class="step">
                    <div class="figou-row">
                        <div class="figou-col-100">
                            <h2>¡Felicidades!</h2>
                            <br/>
                            <p>Tu equipo es compatible con nuestra red.</p>
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