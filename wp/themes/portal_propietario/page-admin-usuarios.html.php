<?php
/**
 * Template Name: page-usuarios-admin.html
 * The template for displaying usuarios-admin.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/usuarios-admin.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="style-box">
            <table class="default">
                <tbody>
                    <tr>
                        <th>Usuario </th>
                        <th>E-mail </th>
                        <th>Dirección </th>
                        <th>Estado Documentación </th>
                        <th>Gestionar</th>
                    </tr>
                    <tr>
                        <td>antonio lopez </td>
                        <td>antoniolope@gmail.com </td>
                        <td>C/Pescadores</td>
                        <td>
                            <input type="checkbox" id="test1">
                            <label for="test1"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Miguel gutierrez</td>
                        <td>Miguelgutierrez@gmail.com</td>
                        <td>C/Marineros</td>
                        <td>
                            <input type="checkbox" id="test2">
                            <label for="test2"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Jose Luis martines</td>
                        <td>JoseLuismartines@gmail.com</td>
                        <td>C/Ampostas </td>
                        <td>
                            <input type="checkbox" id="test3">
                            <label for="test3"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Miguel hernandez</td>
                        <td>&gt;Miguelhernandez@gmail.com </td>
                        <td>C/hermitaño</td>
                        <td> <input type="checkbox" id="test4">
                            <label for="test4"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Javier sanchez</td>
                        <td>Javiersanchez@gmail.com </td>
                        <td>C/Garcia Noblejas </td>
                        <td>
                            <input type="checkbox" id="test5">
                            <label for="test5"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Gonzalo gonzalez</td>
                        <td>Gonzalogonzalez@gmail.com </td>
                        <td>C/Ascao </td>
                        <td> <input type="checkbox" id="test6">
                            <label for="test6"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Arturo jimenez</td>
                        <td>Arturojimenez@gmail.com</td>
                        <td>C/Raimundo amador</td>
                        <td> <input type="checkbox" id="test7">
                            <label for="test7"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Garrido garcia</td>
                        <td>Garridogarcia@gmail.com </td>
                        <td>C/Antonio bizarra </td>
                        <td> <input type="checkbox" id="test8">
                            <label for="test8"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Ignacio gutierrez</td>
                        <td>Ignaciogutierrez@gmail.com </td>
                        <td>C/Enrique vamonde </td>
                        <td> <input type="checkbox" id="test9">
                            <label for="test9"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Javier ayala</td>
                        <td>Javierayala@gmail.com </td>
                        <td>C/Arturo cano</td>
                        <td> <input type="checkbox" id="test10">
                            <label for="test10"></label>
                        </td>
                        <td>
                            <a id="Archivo" href="usuarios-admin.html"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="usuarios-admin.html"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="mensajes-admin.html"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();