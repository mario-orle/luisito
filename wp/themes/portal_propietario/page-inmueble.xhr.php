<?php
/**
 * Template Name: page-inmueble.xhr.php
 * The template for displaying page-inmueble.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";
if ($_GET['action'] == 'update_metadata') {
    $inmueble_id = $_GET['inmueble_id'];
    $user_id = $_GET['user_id'];
    if (!current_user_can("administrator") && !get_post_meta($inmueble_id, 'old-meta-' . $_POST['metaname'])) {
        update_post_meta($inmueble_id, 
            'old-meta-' . $_POST['metaname'], 
            get_post_meta($inmueble_id, 'meta-' . $_POST['metaname'], true)
        );
    } else if (current_user_can("administrator")) {
        delete_post_meta($inmueble_id, 'old-meta-' . $_POST['metaname']);
    }
    if ($_POST["metaname"] == "inmueble-ccaa") {
        delete_post_meta($inmueble_id, 'meta-inmueble-provincia');
        delete_post_meta($inmueble_id, 'meta-inmueble-municipio');
        delete_post_meta($inmueble_id, 'meta-inmueble-poblacion');
    }
    if ($_POST["metaname"] == "inmueble-provincia") {
        delete_post_meta($inmueble_id, 'meta-inmueble-municipio');
        delete_post_meta($inmueble_id, 'meta-inmueble-poblacion');
    }
    if ($_POST["metaname"] == "inmueble-municipio") {
        delete_post_meta($inmueble_id, 'meta-inmueble-poblacion');
    }
    update_post_meta($inmueble_id, 'meta-' . $_POST['metaname'], wp_slash($_POST['metavalue']));
}

if ($_GET['action'] == 'inmuebles_of_user') {
    require_once "self/users-stuff.php";
    $user_id = $_GET['user_id'];

    $ret = [];
    $inmuebles = getInmueblesOfUserID($user_id);
    foreach ($inmuebles as $key => $inmueble) {
        $ret[] = [
            "id" => $inmueble->ID,
            "name" => get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-poblacion', true)
        ];
    }


    echo json_encode($ret);
}
if ($_GET['action'] == 'elimina-oferta') {
    $inmueble_id = $_GET['inmueble_id'];
    $oferta_id = $_GET['oferta_id'];

    foreach (get_post_meta($inmueble_id, 'meta-oferta-al-cliente') as $old_meta_encoded) {

        $meta = json_decode(wp_unslash(($old_meta_encoded)), true);
        if ($meta["id"] == $oferta_id) {
            delete_post_meta($inmueble_id, 'meta-oferta-al-cliente', wp_slash($old_meta_encoded));

        }
    }

}
if ($_GET['action'] == 'elimina-inmueble') {
    $inmueble_id = $_GET['inmueble_id'];
    
    wp_delete_post($inmueble_id);

}
if ($_GET['action'] == 'actualiza-imagenes') {
    $inmueble_id = $_GET['inmueble_id'];
    
    delete_post_meta($inmueble_id, 'meta-inmueble-imagenes-metainfo');
    update_post_meta($inmueble_id, 'meta-inmueble-imagenes-metainfo', wp_slash($_POST['metavalue']));
    $photosRaw = get_post_meta($inmueble_id, 'meta-inmueble-imagenes-metainfo', true);
    
    $photos = json_decode(wp_unslash($photosRaw), true);
    if (count($photos) > 0) {
        update_post_meta($inmueble_id, 'meta-inmueble-foto-principal', $photos[0]["url"]);
    }

}


if ($_GET['action'] == 'get_ccaa') {
    require_once "self/graph-stuff.php";
    echo json_encode(getCCAA());
}
if ($_GET['action'] == 'get_provincia') {
    require_once "self/graph-stuff.php";
    echo json_encode(getPROVINCIA($_GET["id"]));
}
if ($_GET['action'] == 'get_municipio') {
    require_once "self/graph-stuff.php";
    echo json_encode(getMUNICIPIO($_GET["id"]));
}

if ($_GET['action'] == 'get_poblacion') {
    require_once "self/graph-stuff.php";
    echo json_encode(getPOBLACION($_GET["id"]));
}

if ($_GET['action'] == 'get_graph') {
    require_once "self/graph-stuff.php";
    echo json_encode(getGraphDataById($_GET["id"]));
}

//username and password of account
$username = trim($values["email"]);
$password = trim($values["password"]);

//set the directory for the cookie using defined document root var
$path = "./ctemp";
//build a unique path with every request to store. the info per user with custom func. I used this function to build unique paths based on member ID, that was for my use case. It can be a regular dir.
//$path = build_unique_path($path); // this was for my use case

//login form action url
$url="https://www.idealista.com/inmueble/90148886/"; 
$postinfo = "";//"email=".$username."&password=".$password;

$cookie_file_path = $path."/cookie.txt";

$ch = curl_init();/*
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
//set the cookie the site has for certain features, this is optional
curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");*/
curl_setopt($ch, CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");/*
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
*/
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
//curl_exec($ch);

//page with the content I want to grab
curl_setopt($ch, CURLOPT_URL, "https://www.idealista.com/inmueble/90148886/");
//do stuff with the info with DomDocument() etc
$html = curl_exec($ch);
curl_close($ch);

echo $html;