<?php
/**
 * Template Name: page-usuario-admin-mbl.html
 * The template for displaying usuario-admin-mbl.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/usuario-admin-mbl.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="inm-mbl">
            <h2>Gestión Usuarios <i class="fas fa-users"></i></h2>
            <hr>
            <div class="espacio-caja">
                <button type="button" class="collapsible">Arturo ramirez</button>
                <div class="content">
                    <table>

                        <tbody>
                            <tr>
                                <th>Inmuebles</th>
                                <td>4</td>
                            </tr>
                            <tr>
                                <th>Documentación:</th>
                                <td>Completa</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar sale la documentacion del cliente -->
                        <a id="documentacion" href="doc-mobile.html"><i class="far fa-address-card"></i></a>
                        <!-- popup al pulsar ve listado inmuebles del cliente -->
                        <a id="inmuebles" href="inmuebles-mbl.html"><i class="fas fa-home"></i></a>
                        <!-- pop up cambio de usuario a otro asesor -->
                        <a id="cambio-asesor" href="#"><i class="fas fa-random"></i></a>
                        <!-- pop up listado inmubles con listado de usuario mas precio de oferta -->
                        <a id="oferta" href="#"><i class="fas fa-dollar-sign"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="espacio-caja">
                <button type="button" class="collapsible">Adela Jimenez</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Inmuebles</th>
                                <td>4</td>
                            </tr>
                            <tr>
                                <th>Documentación:</th>
                                <td>Completa</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar sale la documentacion del cliente -->
                        <a id="documentacion" href="doc-mobile.html"><i class="far fa-address-card"></i></a>
                        <!-- popup al pulsar ve listado inmuebles del cliente -->
                        <a id="inmuebles" href="inmuebles-mbl.html"><i class="fas fa-home"></i></a>
                        <!-- pop up cambio de usuario a otro asesor -->
                        <a id="cambio-asesor" href="#"><i class="fas fa-random"></i></a>
                        <!-- pop up listado inmubles con listado de usuario mas precio de oferta -->
                        <a id="oferta" href="#"><i class="fas fa-dollar-sign"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="espacio-caja">
                <button type="button" class="collapsible">Carolina Hernandez</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Inmuebles</th>
                                <td>4</td>
                            </tr>
                            <tr>
                                <th>Documentación:</th>
                                <td>Completa</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar sale la documentacion del cliente -->
                        <a id="documentacion" href="doc-mobile.html"><i class="far fa-address-card"></i></a>
                        <!-- popup al pulsar ve listado inmuebles del cliente -->
                        <a id="inmuebles" href="inmuebles-mbl.html"><i class="fas fa-home"></i></a>
                        <!-- pop up cambio de usuario a otro asesor -->
                        <a id="cambio-asesor" href="#"><i class="fas fa-random"></i></a>
                        <!-- pop up listado inmubles con listado de usuario mas precio de oferta -->
                        <a id="oferta" href="#"><i class="fas fa-dollar-sign"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="espacio-caja">
                <button type="button" class="collapsible">Alberto Conde</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Inmuebles</th>
                                <td>4</td>
                            </tr>
                            <tr>
                                <th>Documentación:</th>
                                <td>Completa</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar sale la documentacion del cliente -->
                        <a id="documentacion" href="doc-mobile.html"><i class="far fa-address-card"></i></a>
                        <!-- popup al pulsar ve listado inmuebles del cliente -->
                        <a id="inmuebles" href="inmuebles-mbl.html"><i class="fas fa-home"></i></a>
                        <!-- pop up cambio de usuario a otro asesor -->
                        <a id="cambio-asesor" href="#"><i class="fas fa-random"></i></a>
                        <!-- pop up listado inmubles con listado de usuario mas precio de oferta -->
                        <a id="oferta" href="#"><i class="fas fa-dollar-sign"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="pop-asesor">
            <form>
                <label for="usuario">Selecione Asesor</label>
                <select name="usuario" id="usuarios">
                    <option value="user">Luis Gabaldon</option>
                    <option value="user">Antonio Ramirez</option>
                    <option value="user">Javier carbajal</option>
                    <option value="user">Ernesto rejonero</option>
                </select>
                <input type="submit" value="Submit">
            </form>
        </div>
        <br>
        <div class="pop-asesor">
            <form>
                <label for="usuario">Selecione Inmueble</label>
                <select name="usuario" id="usuarios">
                    <option value="home">Inmueble 1</option>
                    <option value="home">Inmueble 2</option>
                    <option value="home">Inmueble 3</option>
                    <option value="home">Inmueble 4</option>
                </select>
                <br>
                <label for="oferta">Ingrese Cantidad</label>
                <input type="text" name="oferta" id="oferta" placeholder="Precio">
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>
        <br>

    </div>
</main><!-- #main -->

<?php
get_footer();