<?php

$IS_INSTALLED_KEY = "__default_pages_installed";
$is_installed = get_option($IS_INSTALLED_KEY);

if ($is_installed) {

} else {
    update_option($IS_INSTALLED_KEY, 'true');
    make_installation();
}

function make_installation() {
    drop_default_pages();
    create_our_pages();
}
function create_our_pages() {
    if (!get_page_by_title('inicio')) {
        wp_insert_post(array(
            'post_title' => 'inicio',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-index.html.php'
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
