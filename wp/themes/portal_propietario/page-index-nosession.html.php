<?php

/**
 * Template Name: page-index-nosession.html
 * The template for displaying inicio.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

 if (get_current_user_id() != 0) {
    wp_redirect( '/inicio' );
    exit;
 }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST["action"] == 'crear-usuario') {
        $newuserid = wp_create_user( $_POST['email'], $_POST['pwd'], $_POST['email'] );
        $username = '';
        if ( is_numeric( $newuserid ) ) {
            if ( $user = get_user_by( 'id', $newuserid ) ) {
                $username = $user->user_login;
            }
        } else {
            die();
        }
    
        $res = wp_signon(array(
            'user_login' => $username,
            'user_password' => $_POST['pwd'],
            'remember' => true
        ), true);
        wp_set_current_user($res);

        wp_redirect( '/inicio' );

    } else {
        $username = $_POST['user'];
        if ( ! empty( $username ) && is_email( $username ) ) :
            if ( $user = get_user_by_email( $username ) )
              $username = $user->user_login;
        endif;
    
        $res = wp_signon(array(
            'user_login' => $username,
            'user_password' => $_POST['pwd'],
            'remember' => true
        ), true);
    
        if (is_wp_error($res)) {
            echo 'Contraseña incorrecta';
        } else {
            wp_set_current_user($res);
            echo "OK";
        }
    }
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/index-nosession.css">
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <title>Inicio</title>
</head>

<body>
    <div class="header">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" class="logo">
        <div class="boton">
            <a href="#contactos">Contacto</a>
            <a href="sobrenosotros">Sobre nosotros</a>
        </div>
    </div>
    </div>
    <div class="bg-image" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/img/landscape-429319_1920.jpg)"></div>
    <div class="bg-text">
        <div class="workspace">
            <div class="wrapper-text-btn">
                <h4>TU GESTOR INMOBILIARIO PERSONAL</h4>
                <h1>MIRACASA</h1>
                <p></p>
                <section class="container">
                    <button class="btn1" data-micromodal-trigger="modal-registro">Registrarse</button>
                    <button class="btn" data-micromodal-trigger="modal-login">Inicio</button>
                </section>
            </div>

        </div>

    </div>

    <div id="modal-registro" aria-hidden="true" class="modal">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-registro">
                <header class="modal__header">
                    <h2 id="modal-registro-title">
                        Registro
                    </h2>
                    <button aria-label="Cerrar" data-micromodal-close class="modal__close"></button>
                </header>
                <div id="modal-registro-content">
                    <form method="POST">
                        <input class="controls" type="email" name="email" id="correo" placeholder="E-mail">
                        <input class="controls" type="password" name="pwd" id="contraseña" placeholder="Contraseña">
                        <input class="controls" type="hidden" name="action" value="crear-usuario">
                        <input class="botons" type="submit" value="Registrar">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div id="modal-login" aria-hidden="true" class="modal">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-login">
                <header class="modal__header">
                    <h2 id="modal-login-title">
                        Login
                    </h2>
                    <button aria-label="Cerrar" data-micromodal-close class="modal__close"></button>
                </header>
                <div id="modal-login-content">
                    <input class="controls" type="text" id="user" placeholder="Ingrese su E-mail">
                    <input class="controls" type="password" id="pwd" placeholder="Ingrese su Contraseña">
                    <button class="botons" onclick="trylogin()">ENTRAR</button>
                    <p><a data-micromodal-trigger="modal-recpass">¿Olvidaste la contraseña?</a></p>
                </div>

            </div>
        </div>
    </div>


    <div id="modal-recpass" aria-hidden="true" class="modal">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-recpass">
                <header class="modal__header">
                    <h2 id="modal-recpass-title">
                        Recuperar contraseña
                    </h2>
                    <button aria-label="Cerrar" data-micromodal-close class="modal__close"></button>
                </header>
                <div id="modal-recpass-content">
                    <input class="controls" type="email" name="correo" id="correo" placeholder="INGRESE EMAIL CON EL QUE SE REGISTRO">
                    <input class="botons" type="submit" value="ENTRAR">
                    <p><a data-micromodal-close>Volver Login</a></p>
                </div>

            </div>
        </div>
    </div>

    <script>
        MicroModal.init();

        function trylogin() {
            var user = document.querySelector('#user').value;
            var pwd = document.querySelector('#pwd').value;

            var fd = new FormData();
            fd.append('user', user);
            fd.append('pwd', pwd);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '');
            xhr.onload = function () {
                if (this.responseText === 'OK') {
                    window.location.href = "/inicio";
                } else {

                }
            }
            xhr.send(fd);
        }
    </script>
</body>

</html>
<?php 
}
?>