<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package portal_propietario
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'portal_propietario' ); ?></a>

	<header id="masthead" class="site-header">
		
    <div class="header">
      <div class="right">
        <div class="alerta-asesor">
          <a id="alerta-asesor" href="alerta-asesor.html"><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>asesoramiento.png"></a>
        </div>
        <div class="mensages">
          <a id="mensajes" href="mensajes.html"><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email.png"></a>
        </div>
        <div class="alertas">
          <a id="alertas"><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>advertencia.png"></a>
        </div>
        <div class="usuario">
          <a id="usuario" href="perfil2.html"><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png"></a>
        </div>

      </div>


    </div>
    <div class="menu">
      <div class="logo" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/logo.png'?>)"> </div>
      <h2>PORTAL PROPIETARIO</h2>
      <hr />
      <span>Opciones generales</span>
      <hr>
      <a id="inicio" href="index.html"><i class="fas fa-home"></i>INICIO</a>
      <a id="servicios" href="servicios.html"><i class="fas fa-briefcase"></i>SERVICIOS + </a>
      <a id="perfil" href="perfil2.html"><i class="fas fa-user-circle"></i>PERFIL</a>
      <a id="mensajes" href="mensajes.html"><i class="far fa-envelope"></i>MENSAJES</a>
      <hr />
      <a id="citas" href="citas.html"><i class="fas fa-calendar-alt"></i>CITAS</a>
      <hr />
      <a id="asesor" href="alerta-asesor.html"><i class="fas fa-hands-helping"></i>ASESOR</a>
      <hr />


      <button id="gestiones" class="dropdown-btn">
        <i class="fa fa-tasks"></i> GESTIONES

      </button>
      <div class="dropdown-container">
        <a id="inmuebles" href="inmuebles.html">INMUEBLES</a>
        <a id="documentacion" href="mis-documentos.html">DOCUMENTACIÓN</a>
      </div>
      <hr />
    </div>

	</header><!-- #masthead -->
