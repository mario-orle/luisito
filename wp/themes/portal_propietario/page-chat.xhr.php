<?php
/**
 * Template Name: page-chat.xhr.php
 * The template for displaying page-file-upload.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";
if ($_GET['action'] == 'get_messages') {
    if (current_user_can("administrator")) {
        $messages = [];
        foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user) {
                $messages[$user->ID] = get_user_meta($user->ID, 'meta-messages-chat');
        }
    } else {
        $messages[wp_get_current_user()->ID] = get_user_meta(wp_get_current_user()->ID, 'meta-messages-chat');

    }
    echo json_encode($messages);
}

if ($_GET['action'] == 'put_messages') {

    $msg = array();
    $msg['message'] = $_POST['message'];
    $msg['name'] = wp_get_current_user()->display_name;

    if (current_user_can("administrator")) {
        $msg['user'] = 'admin';
        add_user_meta($_GET["user_id"], 'meta-messages-chat', $msg);
    } else {
        $msg['user'] = 'user';
        add_user_meta(wp_get_current_user()->ID, 'meta-messages-chat', $msg);
    }
}
