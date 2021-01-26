<?php
/**
 * Template Name: page-file-upload.xhr.php
 * The template for displaying page-file-upload.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
echo 'aaaaaa';
if ($_GET['action'] == 'update_metadata') {
    $inmueble_id = $_GET['inmueble_id'];
    echo 'bbbbb';

    update_post_meta($inmueble_id, 'meta-' . $_POST['metaname'], $_POST['metavalue']);
    
}
