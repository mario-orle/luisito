<?php
/**
 * Template Name: page-ofertas.html
 * The template for displaying ofertas.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/ofertas.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="ofertas-recibidas">
            <h2>Ofertas Recibidas <i class="fas fa-house-user"></i></h2>
            <hr>
            <div class="espacio-caja">
                <button type="button" class="collapsible">OFERTA 1</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Nombre:</th>
                                <td>Bill Gates</td>
                            </tr>
                            <tr>
                                <th>Telefono:</th>
                                <td>648 952 358</td>
                            </tr>
                            <tr>
                                <th>Oferta:</th>
                                <td>165.000€</td>
                            </tr>
                            <tr>
                                <th>Cita:</th>
                                <td>25/04/2021</td>
                            </tr>
                            <tr>
                                <th>Hora:</th>
                                <td>18:00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar el checke mostando las opciones aceptar denegar o contraoferta -->
                        <a id="edit-oferta" href="#"><i class="fas fa-money-check-alt"></i></a>
                        <!-- popup calendario para modificar feche de cita -->
                        <a id="edit-cita" href="#"><i class="fas fa-calendar-alt"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="espacio-caja">
                <button type="button" class="collapsible">OFERTA 2</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Nombre:</th>
                                <td>Bill Gates</td>
                            </tr>
                            <tr>
                                <th>Telefono:</th>
                                <td>648 952 358</td>
                            </tr>
                            <tr>
                                <th>Oferta:</th>
                                <td>165.000€</td>
                            </tr>
                            <tr>
                                <th>Cita:</th>
                                <td>25/04/2021</td>
                            </tr>
                            <tr>
                                <th>Hora:</th>
                                <td>18:00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar el checke mostando las opciones aceptar denegar o contraoferta -->
                        <a id="edit-oferta" href="#"><i class="fas fa-money-check-alt"></i></a>
                        <!-- popup calendario para modificar feche de cita -->
                        <a id="edit-cita" href="#"><i class="fas fa-calendar-alt"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="espacio-caja">
                <button type="button" class="collapsible">OFERTA 3</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Nombre:</th>
                                <td>Bill Gates</td>
                            </tr>
                            <tr>
                                <th>Telefono:</th>
                                <td>648 952 358</td>
                            </tr>
                            <tr>
                                <th>Oferta:</th>
                                <td>165.000€</td>
                            </tr>
                            <tr>
                                <th>Cita:</th>
                                <td>25/04/2021</td>
                            </tr>
                            <tr>
                                <th>Hora:</th>
                                <td>18:00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar el checke mostando las opciones aceptar denegar o contraoferta -->
                        <a id="edit-oferta" href="#"><i class="fas fa-money-check-alt"></i></a>
                        <!-- popup calendario para modificar feche de cita -->
                        <a id="edit-cita" href="#"><i class="fas fa-calendar-alt"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="espacio-caja">
                <button type="button" class="collapsible">OFERTA 4</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Nombre:</th>
                                <td>Bill Gates</td>
                            </tr>
                            <tr>
                                <th>Telefono:</th>
                                <td>648 952 358</td>
                            </tr>
                            <tr>
                                <th>Oferta:</th>
                                <td>165.000€</td>
                            </tr>
                            <tr>
                                <th>Cita:</th>
                                <td>25/04/2021</td>
                            </tr>
                            <tr>
                                <th>Hora:</th>
                                <td>18:00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar el checke mostando las opciones aceptar denegar o contraoferta -->
                        <a id="edit-oferta" href="#"><i class="fas fa-money-check-alt"></i></a>
                        <!-- popup calendario para modificar feche de cita -->
                        <a id="edit-cita" href="#"><i class="fas fa-calendar-alt"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();