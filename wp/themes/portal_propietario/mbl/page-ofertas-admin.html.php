<?php
/**
 * Template Name: page-ofertas.html
 * The template for displaying ofertas.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once __DIR__ . "/../self/security.php";

function myCss() {
    echo '<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>';
    echo '<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/css/datepicker.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/datepicker-full.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/locales/es.js"></script>';
    echo '<script src="'.get_bloginfo('stylesheet_directory').'/assets/ext/moment.min.js?cb=' . generate_random_string() . '"></script>';
    echo '<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>';
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/ofertas.css">';
}
add_action('wp_head', 'myCss');



function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && current_user_can('administrator')) {
    $user = get_user_by('id', $_POST['usuario']);
    $data = array();
    if ($_POST['action'] == "crear") {
        $data['id'] = generateRandomString(30);
        $data['user_id'] = ($_POST['usuario']);
        $data['inmueble_id'] = ($_POST['inmueble_id']);
        $data['status'] = ($_POST['status']);
        $data['cantidad'] = ($_POST['cantidad']);
        $data['descripcion'] = ($_POST['descripcion']);
        $data['created'] = date("c");
        
        //add_user_meta($user->ID, 'meta-oferta-al-cliente', wp_slash(json_encode($data)));
        add_post_meta($_POST['inmueble_id'], 'meta-oferta-al-cliente', wp_slash(json_encode($data)));
    }
    if ($_POST['action'] == "proponer-cita") {
        $ofertaid = ($_POST['oferta-id']);
        $date = $_POST["fecha-cita"];
        $time = $_POST["hora-cita"];
        $inmuebleid = $_POST["inmueble_id"];


        
        foreach (get_post_meta($inmuebleid, 'meta-oferta-al-cliente') as $old_meta_encoded) {
            $old_meta = json_decode(wp_unslash(($old_meta_encoded)), true);
            if ($old_meta["id"] == $ofertaid) {

                delete_post_meta($inmuebleid, 'meta-oferta-al-cliente', wp_slash($old_meta_encoded));

                $old_meta['status'] = "cita-propuesta";
                add_post_meta($inmuebleid, 'meta-oferta-al-cliente', wp_slash(json_encode($old_meta)));

            }
        }
    }
    wp_redirect("/ofertas-admin-mbl");

}
get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="ofertas-recibidas">
            <h2>Ofertas Realizadas <i class="fas fa-house-user"></i></h2>
            <hr>

<?php

$ofertas = [];
foreach (get_users(array('role__in' => array( 'subscriber' ), 'nopaging' => true)) as $user_of_admin) {
    if (get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true) == get_current_user_id() || get_current_user_id() === 1) {
        $asesor = get_user_by('id', get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true));
        $inmuebles_del_cliente = getInmueblesOfUser($user_of_admin);
        foreach ($inmuebles_del_cliente as $inmueble) {
            $ofertas_del_inmueble = get_post_meta($inmueble->ID, 'meta-oferta-al-cliente');
            foreach ($ofertas_del_inmueble as $key => $oferta) {
                $oferta = json_decode(wp_unslash($oferta), true);
                $ofertas[] = $oferta;
?>
            <div class="espacio-caja">
                <button type="button" class="collapsible">OFERTA</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Nombre:</th>
                                <td><?php echo $user_of_admin->display_name; ?></td>
                            </tr>
                            <tr>
                                <th>Dirección:</th>
                                <td><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true); ?></td>
                            </tr>
                            <tr>
                                <th>Oferta:</th>
                                <td><?php echo number_format($oferta["cantidad"], 0, ',', '.'); ?> €</td>
                            </tr>
                            <?php
if ($oferta['status'] === 'creada') {
?>

                            <tr>
                                <th>Estado:</th>
                                <td>En espera de respuesta</td>
                            </tr>


<?php 
} else if ($oferta['status'] === 'cita-propuesta') {
?>
    
                            <tr>
                                <th>Estado:</th>
                                <td>Oferta aceptada</td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                            </tr>

<?php 
} else {
    if ($oferta['respuesta'] === 'denegar') {
?>

                            <tr>
                                <th>Estado:</th>
                                <td>Denegada</td>
                            </tr>
                        


<?php
    } else if ($oferta['respuesta'] === 'aceptar') { 
?>

                            <tr>
                                <th>Estado:</th>
                                <td>Aceptada</td>
                            </tr>


<?php
    } else if ($oferta['respuesta'] === 'contraoferta') {
?>
  
                            <tr>
                                <th>Estado:</th>
                                <td>Contraofertada</td>
                            </tr>
                            <tr>
                                <th>Propuesta:</th>
                                <td><?php echo number_format($oferta["propuesta"], 0, ',', '.'); ?> €</td>
                            </tr>
<?php
    } 
}
?>
                        </tbody>
                    </table>
                    <div class="funciones">
<?php 
                if ($oferta["status"] == "respondida-cliente" || $oferta["status"] == "respondida-cita") {
                    if ($respuesta == 'contraoferta') {
?>
                            <a id="edit-oferta" onclick="ver('<?php echo $oferta["id"] ?>')" href="#"><i class="fas fa-money-check-alt"></i></a>
<?php 
                    } else if ($oferta["status"] != "respondida-cita" && $respuesta != 'denegar') {
?>
                            <a id="edit-cita" onclick="ver('<?php echo $oferta["id"] ?>')" href="#"><i class="fas fa-calendar-alt"></i></a>
<?php 
                    }
                }
?>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" onclick="eliminaOferta('<?php echo $oferta["id"] ?>', <?php echo $inmueble->ID ?>)" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>

<?php
            }
        }
    }
}
?>

        </div>
    </div>

    <div id="modal-ver-oferta" aria-hidden="true" class="modal">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-ver-oferta-asesor">
                <div id="modal-ver-oferta-asesor-content">

                </div>

            </div>
        </div>
    </div>

    <script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "flex") {
      content.style.display = "none";
    } else {
      content.style.display = "flex";
    }
  });
}



MicroModal.init();

function eliminaOferta(ofertaId, inmuebleId) {
    if (confirm("¿Seguro que desea eliminar la oferta?"))
    fetch('/inmueble-xhr?action=elimina-oferta&oferta_id=' + ofertaId + '&inmueble_id=' + inmuebleId)
        .then(res =>  window.location.reload());
}

var ofertas = <?php echo json_encode($ofertas); ?>;
moment.locale("es");
var datepicker;
function ver(id) {
    var oferta = ofertas.find(o => o.id === id);
    var popup = document.querySelector("#modal-ver-oferta");
    popup.classList.remove("contraoferta");
    popup.classList.remove("denegar");
    popup.classList.remove("aceptar");
    popup.classList.add(oferta.respuesta);
    
    var container = document.querySelector("#modal-ver-oferta-asesor-content");
    if (oferta.respuesta == "aceptar") {

        container.innerHTML = `
        <div class="oferta ${oferta.respuesta}">
            <p>Aceptada</p>
            <button type="button" onclick="location.href='/citas-mbl'" id="crear-cita">Ir a citas</button>
        </div>`;
    } else if (oferta.respuesta == "aceptar" || oferta.respuesta == 'contraoferta' || (oferta.status == 'respondida-cita' && oferta.respuesta == 'denegar')) {

        container.innerHTML = `
        <div class="oferta ${oferta.respuesta}">
            <form method="POST" onsubmit="onsubmitCita(event)">
            <p>${oferta.respuesta == 'aceptar' ? "Aceptada" : (oferta.respuesta == 'denegar' ? "Cita rechazada el " + moment(oferta.cita).format("DD/MM/YYYY HH:mm") : "Contraoferta realizada")}</p>
            ${oferta.respuesta == 'contraoferta' ? "<label style='color: white' for='txtprop'>Cantidad</label><br><textarea id='txtprop' readonly>" + oferta.propuesta + "</textarea><br>" : ""}
            ${oferta.respuesta == 'contraoferta' ? "<label style='color: white' for='txtmotivo'>Motivo</label><br><textarea id='txtmotivo' readonly>" + oferta.motivo + "</textarea><br>" : ""}
            <input type="hidden" value="${id}" name="oferta-id">
            <input type="hidden" id="fecha" name="fecha-cita" value="${moment().format("YYYY-MM-DD")}">
            <input type="hidden" name="action" value="proponer-cita">
            <input type="hidden" name="inmueble_id" value="${oferta.inmueble_id}">
            <br>
            <button type="submit" id="crear-cita">
            ${oferta.respuesta == 'contraoferta' ? "Aceptar contraoferta" : "Proponer"}
            </button>
            </form>
        </div>
        `;
    } else if (oferta.respuesta == 'denegar') {
        container.innerHTML = `
        <div class="oferta ${oferta.respuesta}">
            <p>Oferta rechazada</p>
            <textarea style="width:100%">${oferta.motivo}</textarea>
        </div>
        `;
    }

    console.log(oferta);
    MicroModal.show("modal-ver-oferta");
}

function onsubmitCita(e) {

if (document.querySelector("#fecha").value == "")
e.preventDefault();
}
    </script>
</main><!-- #main -->

<?php
get_footer();