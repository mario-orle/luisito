<?php

/**
 * Template Name: page-inicio.html
 * The template for displaying inicio.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

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
            <a data-micromodal-trigger="modal-contacto">Contacto</a>
            <a data-micromodal-trigger="modal-sobrenosotros">Sobre nosotros</a>
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
    <div id="modal-contacto" aria-hidden="true" class="modal">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-contacto">
                <header class="modal__header">
                    <h2 id="modal-contacto-title">
                    </h2>
                    
                    <button aria-label="Cerrar" data-micromodal-close class="modal__close"></button>
                </header>
                <div id="modal-contacto-content">
                    <div class="info-contac">
                        <h2>Telefono:</h2>
                        <p>91 042 44 77</p>
                        <h2>E-mail</h2>
                        <p>Grupomiracasa@miracasa.com</p>
                        <h2>Dirección</h2>
                        <p> Calle Nicolás Salmerón nº 44</p>
                        <h2>Como Llegar:</h2>
                        <p> Metro Alsacia (Línea 2)</p>
                        <p> Autobuses Alsacia (Líneas 70, 106, 140, E2)</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="modal-sobrenosotros" aria-hidden="true" class="modal">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-sobrenosotros">
                <header class="modal__header">
                    <h2 id="modal-sobrenosotros-title">
                    </h2>
                    
                    <button aria-label="Cerrar" data-micromodal-close class="modal__close"></button>
                </header>
                <div id="modal-sobrenosotros-content">
                    <div class="info-nos">
                        <h2>Seriedad, compromiso y transparencia.</h2>
                        <p> La búsqueda de una vivienda se antoja realmente difícil para casi  todo el mundo y es por eso que prestamos la mayor atención  a las necesidades de cada persona, además de ayudar en todo el proceso de compra, así como facilitar el acceso al préstamo hipotecario  o bien, asesoramiento y presupuesto de reformas. El objetivo no es otro que localizar  la casa de sus sueños.
                            Si usted necesita vender su vivienda, cuente con nosotros, nos encargamos de todo. Estamos presentes en todo el proceso de la venta; de principio a fin.  Nuestro servicio de gestión integral de venta incluye, entre otras cosas, la total promoción de su inmueble, gestionamos las visitas, redactamos los contratos pertinentes de compraventa/arrendamiento, organizamos y acompañamos a la escritura pública ante Notario, le ayudamos con la gestión del pago de impuestos, herencias, viviendas de protección oficial, etc.
                            En Grupo Inmobiliario Miracasa entendemos que la mejor publicidad que podemos tener es un cliente satisfecho.
                            Somos una  agencia de intermediación inmobiliaria especializada en  la compraventa y arrendamiento de inmuebles, formada por profesionales con amplia experiencia en el sector, dónde nuestra filosofía es la plena satisfacción de nuestros clientes, tanto vendedores  como compradores.​
                            En Grupo Inmobiliario Miracasa miramos por el empleo indefinido del Sistema Nacional de Garantía juvenil realizando contrataciones de acuerdo al Fondo Social Europeo para contribuir a la disminución de desempleo en nuestro país.
                        </p>
                    </div>
                </div>

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
                    <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
                    <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido">
                    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su E-mail">
                    <input class="controls" type="email" name="correo" id="correo" placeholder="Repita su E-mail">
                    <input class="controls" type="password" name="correo" id="contraseña" placeholder="Ingrese su Contraseña">
                    <input class="controls" type="password" name="correo" id="contraseña" placeholder="Repita su Contraseña">
                    <p><input type="checkbox" id="myCheck" onclick=""> Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
                    <input class="botons" type="submit" value="Registrar">
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
                    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su E-mail">
                    <input class="controls" type="password" name="correo" id="correo" placeholder="Ingrese su Contraseña">
                    <button class="botons" onclick="location.href='../index.html'">ENTRAR</button>
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
    </script>
</body>

</html>