<?php
/**
 * Template Name: page-inmueble.xhr.php
 * The template for displaying page-file-upload.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
if ($_GET['action'] == 'update_metadata') {
    $inmueble_id = $_GET['inmueble_id'];
    update_post_meta($inmueble_id, 'meta-' . $_POST['metaname'], $_POST['metavalue']);
}
