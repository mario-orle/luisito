<?php
/**
 * Template Name: page-file-upload.xhr.php
 * The template for displaying page-file-upload.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    if ($_GET['action'] == 'upload-photo-inmueble') {
        $inmueble_id = $_GET['inmueble_id'];
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $_FILES['file'], $upload_overrides );

        if ( $movefile ) {

            $movefile['validated'] = false;
            add_post_meta( $inmueble_id, 'meta-photos-inmueble', $movefile);

            echo json_encode($movefile);
        } else {
        }
    }
}
