<?php

$IS_INSTALLED_KEY = "__default_pages_installed";
$is_installed = get_option($IS_INSTALLED_KEY);

if ($is_installed) {

} else {
    update_option($IS_INSTALLED_KEY, 'true');
    make_installation();
}

create_our_pages();

function make_installation() {
    drop_default_pages();
}

function create_our_pages() {
    if (!get_page_by_title('index-nosession')) {
        $index = wp_insert_post(array(
            'post_title' => 'index-nosession',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-index-nosession.html.php'
        ));
        
        update_option( 'page_on_front', $index );
        update_option( 'show_on_front', 'page' );
    }

    if (!get_page_by_title('inicio')) {
        wp_insert_post(array(
            'post_title' => 'inicio',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-inicio.html.php'
        ));
    }
    
    if (!get_page_by_title('servicios+')) {
        wp_insert_post(array(
            'post_title' => 'servicios+',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-servicios.html.php'
        ));
    }
    if (!get_page_by_title('perfil')) {
        wp_insert_post(array(
            'post_title' => 'perfil',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-perfil.html.php'
        ));
    }
    if (!get_page_by_title('mensajes')) {
        wp_insert_post(array(
            'post_title' => 'mensajes',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-mensajes.html.php'
        ));
    }
    if (!get_page_by_title('citas')) {
        wp_insert_post(array(
            'post_title' => 'citas',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-citas.html.php'
        ));
    }
    if (!get_page_by_title('alerta-asesor')) {
        wp_insert_post(array(
            'post_title' => 'alerta-asesor',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-alerta-asesor.html.php'
        ));
    }
    if (!get_page_by_title('inmuebles')) {
        wp_insert_post(array(
            'post_title' => 'inmuebles',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-inmuebles.html.php'
        ));
    }
    if (!get_page_by_title('mis-documentos')) {
        wp_insert_post(array(
            'post_title' => 'mis-documentos',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-mis-documentos.html.php'
        ));
    }
    if (!get_page_by_title('file-upload')) {
        wp_insert_post(array(
            'post_title' => 'file-upload',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-file-upload.xhr.php'
        ));
    }
    if (!get_page_by_title('inmueble-xhr')) {
        wp_insert_post(array(
            'post_title' => 'inmueble-xhr',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-inmueble.xhr.php'
        ));
    }


    
}

function drop_default_pages() {
    foreach (get_posts() as $post) {
        wp_delete_post($post->ID, true);
    }
    foreach (get_pages(array('post_status' => 'draft')) as $page) {
        wp_delete_post($page->ID, true);
    }
    foreach (get_pages() as $page) {
        wp_delete_post($page->ID, true);
    }
}
