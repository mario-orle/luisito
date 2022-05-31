<?php

/**
 * Template Name: page-alerta-asesor.html
 * The template for displaying alerta-asesor.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";
function myCss()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/alerta-asesor.css?cb=' . generate_random_string() . '">';
}
add_action('wp_head', 'myCss');

$user = wp_get_current_user();

$asesor_id = get_user_meta($user->ID, 'meta-gestor-asignado', true);

$asesor = get_user_by('id', $asesor_id);

function get_own_documentos_solicitados() {
    $arr = array();
    foreach (get_user_meta(get_current_user_id(), 'meta-documento-solicitado-al-cliente') as $meta) {
        $arr[] = json_decode(wp_unslash($meta), true);
    }
    return $arr;
}

$array_documentos = get_own_documentos_solicitados();

get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="container">
            <div class="perfil-asesor">
                <div class="form-perfil">
                    <h2>PERFIL ASESOR</h2>
                    <hr />
                    <form>
                        <div class="Nombre">
                            <h3>Nombre Asesor</h3>
                            <p><?php echo $asesor->display_name; ?></p>
                        </div>
                        <div class="email">
                            <h3>E-mail Asesor</h3>
                            <p><a href="mailto:<?php echo $asesor->user_email; ?>"><?php echo $asesor->user_email; ?></a></p>
                        </div>
                        <div class="email">
                            <h3>Whatsapp Asesor</h3>
                            <p>
                                <button type="button" class="btn-wasap" onclick="window.open('https://wa.me/34<?php echo get_user_meta($asesor->ID, 'meta-phone', true); ?>')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
                                    </svg>
                                    Whatsapp
                                </button>
                            </p>
                        </div>
                        <div class="doc-punt">
                            <div class="text-documentos">
                                <h2>Documentos Requeridos por el Asesor:
                                    <hr />
                                </h2>
                                <div class="scroll-text">
<?php 
foreach ($array_documentos as $i => $documento) {
    if (wp_unslash($documento["status"]) == 'creada') {
        $hay_documentos = true;
        break;
    }
}
if (!$hay_documentos) {
?>
        
                                <div class="fila-documento-2">
                                    <p>Sin documentación aún</p>
                                </div>
<?php
} else {
    foreach ($array_documentos as $i => $documento) {
?>

                                <div class="fila-documento-2">
                                    <p><?php echo $documento["nombre"] ?></p>
                                    <div class="btn-container">
<?php
            if (wp_unslash($documento["status"]) == 'creada') {
?>
                                        <form method="POST" enctype="multipart/form-data" action="/mis-documentos">
                                            <input type="hidden" name="id" value="<?php echo wp_unslash($documento["id"])?>" />
                                            <input type="hidden" name="nombre" value="<?php echo wp_unslash($documento["nombre"])?>" />
                                            <input type="hidden" name="file" value="<?php echo wp_unslash($documento["file"])?>" />
                                            <input type="hidden" name="status" value="<?php echo wp_unslash($documento["status"])?>" />
                                            <input type="hidden" name="action" value="cargar" />
                                            <label class="botons" for="uploader-<?php echo $i ?>">CARGAR</label>
                                            <input name="documento" onchange="this.parentElement.submit()" style="display: none;" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*" type="file" id="uploader-<?php echo $i ?>" />
                                        </form>
                                        <form method="POST" onsubmit="return confirmSubmit(event)" action="/mis-documentos">
                                            <input type="hidden" name="id" value="<?php echo wp_unslash($documento["id"])?>" />
                                            <input type="hidden" name="nombre" value="<?php echo wp_unslash($documento["nombre"])?>" />
                                            <input type="hidden" name="status" value="<?php echo wp_unslash($documento["status"])?>" />
                                            <input type="hidden" name="file" value="<?php echo wp_unslash($documento["file"])?>" />
                                            <input type="hidden" name="action" value="solicitar" />
                                            <input class="botons" type="submit" value="SOLICITAR">
                                        </form>
<?php
            } else if (wp_unslash($documento["status"]) == 'solicitado-al-asesor' && 0) {
?>
                                        <form method="POST" enctype="multipart/form-data" action="/mis-documentos">
                                            <input type="hidden" name="id" value="<?php echo wp_unslash($documento["id"])?>" />
                                            <input type="hidden" name="nombre" value="<?php echo wp_unslash($documento["nombre"])?>" />
                                            <input type="hidden" name="file" value="<?php echo wp_unslash($documento["file"])?>" />
                                            <input type="hidden" name="status" value="<?php echo wp_unslash($documento["status"])?>" />
                                            <input type="hidden" name="action" value="cargar" />
                                            <label class="botons" for="uploader-<?php echo $i ?>">CARGAR</label>
                                            <input name="documento" onchange="this.parentElement.submit()" style="display: none;" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*" type="file" id="uploader-<?php echo $i ?>" />
                                        </form>
                                        <input class="botons" type="submit" disabled value="SOLICITADO...">
<?php
                
                
            } else if (wp_unslash($documento["status"]) == 'fichero-anadido' && 0) {
                $file = pathinfo($documento["file"])["basename"];
?>
                                        <a download="<?php echo $file ?>" style="display: block;" class="botons" href="<?php echo $documento["file"] ?>">DESCARGAR</a>
<?php
                
                
            }
    
?>          
                                    </div>
                                </div>

<?php
    }
}
?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
