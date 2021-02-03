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

$inmueble = get_posts(array(
  'post_type' => 'inmueble',
  'author' => get_current_user_id()
))[0];
if (current_user_can('administrator') && !empty($_GET['user'])) {
$inmueble = get_posts(array(
  'post_type' => 'inmueble',
  'author' => $_GET['user']
))[0];
}
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
<input 
  type="hidden" 
  value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-name', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-owner-lastname', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-owner-lastname2', true) ?>" 
  id="user-name-and-lastname" />
<input 
  type="hidden" 
  value="<?php echo get_current_user()->display_name; ?>" 
  id="real-user-name-and-lastname" />
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		
    <div class="header">
      <div class="right">
        <div class="alerta-asesor">
          <a id="alerta-asesor" href="/alerta-asesor"><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>asesoramiento.png"></a>
        </div>
        <div class="mensages">
          <a id="mensajes" href="/mensajes"><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email.png"></a>
        </div>
        <div class="alertas">
          <a id="alertas"><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>advertencia.png"></a>
        </div>
        <div class="usuario">
          <a id="usuario" href="/perfil"><img class="user-logo-auto" src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png"></a>
        </div>

      </div>


    </div>
    <div class="menu">
      <div class="logo" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/logo.png'?>)"> </div>
      <?php
if (!current_user_can("administrator")) {
      ?>
      <h2>PORTAL PROPIETARIO</h2>
      <hr />
      <span>Opciones generales</span>
      <hr>
      <a id="inicio" href="/inicio"><i class="fas fa-home"></i>INICIO</a>
      <a id="servicios" href="/servicios+"><i class="fas fa-briefcase"></i>SERVICIOS + </a>
      <a id="perfil" href="/perfil"><i class="fas fa-user-circle"></i>PERFIL</a>
      <a id="mensajes" href="/mensajes"><i class="far fa-envelope"></i>MENSAJES</a>
      <hr />
      <a id="citas" href="/citas"><i class="fas fa-calendar-alt"></i>CITAS</a>
      <hr />
      <a id="asesor" href="/alerta-asesor"><i class="fas fa-hands-helping"></i>ASESOR</a>
      <hr />


      <button id="gestiones" class="dropdown-btn">
        <i class="fa fa-tasks"></i> GESTIONES

      </button>
      <div class="dropdown-container">
        <a id="inmuebles" href="/inmuebles">INMUEBLES</a>
        <a id="documentacion" href="/mis-documentos">DOCUMENTACIÓN</a>
      </div>
      <hr />
      <?php
} else {

  ?>
    <h2>PORTAL ADMINISTRADOR</h2>
    <hr />
    <span>Opciones generales</span>
    <hr>
    <a id="inicio" href="/inicio"><i class="fas fa-home"></i>INICIO</a>
    <a id="mensajes" href="/mensajes"><i class="far fa-envelope"></i>MENSAJES</a>
    <hr />

    <button id="gestiones" class="dropdown-btn">
      <i class="fa fa-tasks"></i> GESTIONES

    </button>
    <div class="dropdown-container">
      <a id="citas" href="/citas"><i class="fas fa-calendar-alt"></i>ADMIN CITAS</a>
      <a id="admin-usuarios" href="/usuarios"><i class="fas fa-users"></i>ADMIN USUARIOS</a>
      <a id="perfil" href="/perfil"><i class="fas fa-user-circle"></i>ADMIN ASESOR</a>
      <a id="doc" href="doc-admin.html"><i class="fas fa-folder"></i>ADMIN DOC</a>
    </div>
    <hr />

  <?php
}
      ?>
    </div>

	</header><!-- #masthead -->
