<?php
/**
 * Template Name: page-usuarios.xhr.php
 * The template for displaying page-usuarios.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";
if ($_GET['action'] == 'check-email') {
    $email = $_GET['email'];
    echo email_exists($email);
}
