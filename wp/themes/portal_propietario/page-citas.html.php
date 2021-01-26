<?php
/**
 * Template Name: page-citas.html
 * The template for displaying citas.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/citas.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="gestor-citas">
            <div class="main-calendar">
                <div id="foo"></div>
            </div>
            <div class="main-gestiones-calendar">
                <div class="citas-programadas">
                    <div class="icono-citas">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>cita.png" width="100%">
                        <h2>CITAS</h2>
                    </div>
                    <div class="text-programadas">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Fecha y hora</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>

                                </tr>
                                <tr>
                                    <td>
                                        <a onclick="showPopup()">12-DICIEMBRE-2020 <span>18:30</span></a>
                                    </td>
                                    <td>
                                        MARTA EUGENIA MARTINEZ SORIA
                                    </td>
                                    <td>
                                        <i class="fas fa-circle" style="color:green"></i> Visitado
                                    </td>
                                    <td class="mid">
                                        <i class="fas fa-edit"></i> <i class="fas fa-ban"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a onclick="showPopup()">13-DICIEMBRE-2021 <span>18:30</span></a>
                                    </td>
                                    <td>
                                        VICTOR GARRIDO SOBERA
                                    </td>
                                    <td>
                                        <i class="fas fa-circle" style="color:green"></i> Visitado
                                    </td>
                                    <td class="mid">
                                        <i class="fas fa-edit"></i> <i class="fas fa-ban"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a onclick="showPopup()">15-DICIEMBRE-2021 <span>18:30</span></a>
                                    </td>
                                    <td>
                                        FERNANDO ANDANDO DELANTE
                                    </td>
                                    <td>
                                        <i class="fas fa-circle" style="color:green"></i> Visitado
                                    </td>
                                    <td class="mid">
                                        <i class="fas fa-edit"></i> <i class="fas fa-ban"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a onclick="showPopup()">16-DICIEMBRE-2021 <span>18:30</span></a>
                                    </td>
                                    <td>
                                        ALBERTUCHO UCHO MOYA
                                    </td>
                                    <td>
                                        <i class="fas fa-circle" style="color:green"></i> Visitado
                                    </td>
                                    <td class="mid">
                                        <i class="fas fa-edit"></i> <i class="fas fa-ban"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a onclick="showPopup()">17-DICIEMBRE-2021 <span>18:30</span></a>
                                    </td>
                                    <td>
                                        DIOSNISIO GARCIOSO MORZOSA
                                    </td>
                                    <td>
                                        <i class="fas fa-circle" style="color:red"></i> Anulado
                                    </td>
                                    <td class="mid">
                                        <i class="fas fa-edit"></i> <i class="fas fa-ban"></i>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div id="popup-bg" onclick="document.getElementById('popup').classList.remove('active');document.getElementById('popup-bg').classList.remove('active')">
        </div>
        <div id="popup">
            <div class="popup-icon">
                <img src="<?php echo get_template_directory() . '/assets/img/'?>logo.png">
            </div>
            <div class="popup-text">
                <h3><i class="fas fa-name"></i>NOMBRE Y APELLIDOS</h3>
                <hr>
                <p>Jose Carlos martinez</p>
                <h3>FECHA CITA Y HORA</h3>
                <hr>
                <p>13 de Diciembre de 2020 / 18:30</p>
                <h3>CONFIRMACIÓN CLIENTES</h3>
                <hr>
                <p>OK</p>
                <h3>CONFIRMACIÓN PROPIETARIO</h3>
                <hr>
                <p>OK</p>
                <h3>REALIZADA</h3>
                <hr>
                <p>SI</p>
                <h3>COMENTARIO VISITA</h3>
                <hr>
                <p>Lorem fistrum no te digo trigo por no llamarte Rodrigor llevame al sircoo a peich cillum ut
                    nostrud dolor tempor. Llevame al sircoo ahorarr consequat quietooor. Quietooor está la cosa muy
                    malar aliqua tempor aliqua ese hombree hasta luego Lucas adipisicing veniam apetecan
                    reprehenderit. Al ataquerl a wan minim al ataquerl et. Qué dise usteer torpedo no puedor fistro
                    cillum exercitation aliquip. Torpedo hasta luego Lucas velit a peich. Amatomaa quis caballo
                    blanco caballo negroorl ullamco jarl velit a gramenawer ahorarr llevame al sircoo torpedo. Duis
                    duis nisi minim ullamco. Enim ese pedazo de officia consectetur por la gloria de mi madre te va
                    a hasé pupitaa ut por la gloria de mi madre diodeno. </p>


            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();