<?php

function getAllInmueblesForAdmin() {
    $inmueblesAcc = [];
    foreach (getAllUsersForAdmin() as $user_of_admin) {
        $inmueblesAcc = $inmueblesAcc + getInmueblesOfUser($user_of_admin);
    }

    return $inmueblesAcc;
}

function getInmueblesOfUser($user) {
    $inmuebles = get_posts([
        'post_type' => 'inmueble',
        'post_status' => 'publish',
        'numberposts' => -1,
        'author' => $user->ID
    ]);
    return $inmuebles;
}

function getAllUsersForAdmin() {
    $users = [];
    foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user_of_admin) {
        if (get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true) == get_current_user_id() || get_current_user_id() === 1) {
            $users[] = $user_of_admin;
        }
    }
    return $users;
}