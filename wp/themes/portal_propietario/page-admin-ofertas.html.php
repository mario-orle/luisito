<?php
/**
 * Template Name: page-usuarios-admin.html
 * The template for displaying usuarios-admin.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/users-stuff.php";


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
    wp_redirect("/admin-ofertas");

}

function myCss() {    
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/popup.css?cb=' . generate_random_string() . '">';
    echo '<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>';
    echo '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>';
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/ofertas-admin.css">';
    echo '<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>';
}
add_action('wp_head', 'myCss');
get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
    <div class="agregar-wrapper">
        <div class="card-agregar">
          <button>
            <a href="#" data-micromodal-trigger="modal-crear-oferta">
              <div class="img-agregar">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>plus.png" alt="" style="width:10%">
                <h3><b>CREAR OFERTA</b></h3>
              </div>
            </a>
          </button>
        </div>
      </div>
        <div class="style-box">
            <table class="default">
                <thead>
                    <tr>
                        <th>Usuario </th>
                        <th>Inmueble </th>
                        <th>Oferta realizada </th>
                        <th>Descripción Oferta </th>
                        <th>Estado Oferta </th>
<?php 
if (get_current_user_id() === 1) {
?>
                        <th>Asesor asignado</th>
<?php
}
?>
                        <th>Gestionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user_of_admin) {
    if (get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true) == get_current_user_id() || get_current_user_id() === 1) {
        $asesor = get_user_by('id', get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true));
        $inmuebles_del_cliente = getInmueblesOfUser($user_of_admin);
        foreach ($inmuebles_del_cliente as $inmueble) {
            $ofertas_del_inmueble = get_post_meta($inmueble->ID, 'meta-oferta-al-cliente');
            foreach ($ofertas_del_inmueble as $key => $oferta) {
                $oferta = json_decode(wp_unslash($oferta), true);
                    ?>
                    <tr>
                        <td><?php echo $user_of_admin->display_name; ?></td>
                        <td><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true); ?></td>
                        <td><?php echo number_format($oferta["cantidad"], 0, ',', '.'); ?> €</td>
                        <td><?php echo $oferta["descripcion"]; ?></td>
                        <td>
<?php

                if ($oferta["status"] = "respondida-cliente") {
                    $respuesta = $oferta["respuesta"];
                    if ($respuesta == 'aceptar') {
                        
?>

                            <input disabled checked type="checkbox" id="test<?php echo $user_of_admin->ID ?>">
                            <label for="test<?php echo $user_of_admin->ID ?>"></label>

<?php

                    } else if ($respuesta == 'denegar') {
                        
?>

                            <input disabled type="checkbox" id="test<?php echo $user_of_admin->ID ?>">
                            <label for="test<?php echo $user_of_admin->ID ?>"></label>

<?php

                    } else if ($respuesta == 'contraoferta') {
                        
?>

                            <input disabled type="checkbox" id="test<?php echo $user_of_admin->ID ?>">
                            <label style="background-color: yellow" for="test<?php echo $user_of_admin->ID ?>"></label>

<?php
                    }
?>
<?php
                }
?>
                        </td>
                        <?php 
if (get_current_user_id() === 1) {
?>
                        <td><?php echo $asesor->display_name ?></td>
<?php
}
?>
                        <td>
                            <a id="edit-oferta" href="#"><i class="fas fa-money-check-alt"></i></a>
                            <a id="edit-cita" href="#"><i class="fas fa-calendar-alt"></i></a>
                            <a id="eliminar" onclick="eliminaOferta('<?php echo $oferta["id"] ?>', <?php echo $inmueble->ID ?>)" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>

                    <?php
            }

        }
    }
}
                    ?>
                </tbody>
            </table>
        </div>
        
        <div id="modal-crear-oferta" aria-hidden="true" class="modal">
            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-crear-oferta-asesor">
                    <header class="modal__header">
                        <h2 id="modal-crear-oferta-title">
                            Crear oferta
                        </h2>
                        <button aria-label="Cerrar" data-micromodal-close class="modal__close"></button>
                    </header>
                    <div id="modal-crear-oferta-asesor-content">
                        <form method="POST" onsubmit="onsubmitOferta(event)">
                            <select class="controls js-choices" type="text" name="usuario" id="usuario" onchange="getInmueblesOfUser(event)">
                                <option value="" style="color: #ccc">Elija propietario...</option>
                                <?php
foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user) {
    if (get_user_meta($user->ID, 'meta-gestor-asignado', true) == get_current_user_id() || get_current_user_id() === 1) {
        $inmuebles = getInmueblesOfUserID($user->ID);
        if (count($inmuebles) > 0) {
                                ?>
                                <option value="<?php echo $user->ID ?>"><?php echo $user->display_name ?></option>
                                <?php
        }
    }
}
                                ?>
                            </select>
                            <select class="controls js-choices" type="text" name="inmueble_id" id="inmueble">
                            </select>
                            <input type="hidden" name="action" value="crear" />
                            <input type="hidden" name="status" value="creada" />
                            <div>
                                <input class="controls" type="number" placeholder="Cantidad" id="cantidad" name="cantidad" />
                            </div>
                            <div>
                                <textarea class="controls" name="descripcion" placeholder="Descripción"></textarea>
                            </div>
                            <input class="botons" type="submit" value="Crear Oferta" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>

MicroModal.init();

function eliminaOferta(ofertaId, inmuebleId) {
    if (confirm("¿Seguro que desea eliminar la oferta?"))
    fetch('/inmueble-xhr?action=elimina-oferta&oferta_id=' + ofertaId + '&inmueble_id=' + inmuebleId)
        .then(res =>  window.location.reload());
}

function onsubmitOferta(e) {
if (document.querySelector("#usuario").value == "" || document.querySelector("#inmueble").value == "" || document.querySelector("#cantidad").value == "")
    e.preventDefault();
}

function getInmueblesOfUser(e) {
    document.querySelector("#inmueble").innerHTML = "";
    var userId = e.currentTarget.value;
    if (userId) {
        fetch("/inmueble-xhr?action=inmuebles_of_user&user_id=" + userId)
            .then(res => res.json())
            .then(res => {
                res.forEach(i => {
                    var option = document.createElement("option")
                    option.value = i.id;
                    option.textContent = i.name;
                    document.querySelector("#inmueble").appendChild(option);
                }
            )
        })
    }

}

const dataTable = new simpleDatatables.DataTable("table", {
    labels: {
        placeholder: "Buscar...",
        perPage: "Mostrar {select} elementos por página",
        noRows: "Sin elementos para mostrar",
        info: "Mostrando {start} a {end} de {rows} elementos (Pág {page} de {pages})",
    },

});


    </script>
</main><!-- #main -->
<div class="main">
<div class="oferta-main aceptar">
                <div class="oferta-left aceptar-text">
                    <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                    <hr>
                    <p>Calle marineros</p>
                    <p>125.000€\130.000€</p>
                    <div class="btn-oferta aceptar-btn">
                        <textarea></textarea>
                        <select class="select">
                            <option>Aceptar</option>
                        </select>
                        <input type="submit">
                    </div>
                </div>


                <div class="card-wrapper">
                    <button>
                        <a href="perfil-inmueble.html">
                            <img src="../../casa3.jpg" alt="Avatar" style="width:100%">
                            <h3><b>SE ALQUILA</b> <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h3>
                            <h4><b>145.000€</b></h4>
                            <p>Casa moderna con piscina, zona ajardina, garaje con 3 plazas.</p>
                        </a>
                    </button>
                </div>

            </div>
            <div class="oferta-main">
                <div class="oferta-left denegar">
                    <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                    <hr>
                    <p>Calle marineros</p>
                    <p>125.000€\130.000€</p>
                    <div class="btn-oferta denegar-text">
                        <textarea></textarea>
                        <select class="select">
                            <option>Denegar</option>
                        </select>
                        <!-- input opcional en caso de elegir denegar -->
                        <textarea placeholder="Motivo"></textarea>
                        <input type="submit">
                    </div>
                </div>
            </div>
            <div class="oferta-main">
                <div class="oferta-left contraoferta">
                    <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                    <hr>
                    <p>Calle marineros</p>
                    <p>125.000€\130.000€</p>
                    <div class="btn-oferta contraoferta-btn">
                        <textarea></textarea>
                        <select class="select">
                            <option>Contra Oferta</option>
                        </select>
                        <!-- input opcional en caso de elegir contra oferta -->
                        <textarea placeholder="Ingrese su Propuesta"></textarea>
                        <input type="submit">
                    </div>
                </div>
            </div>
            <div class="oferta-main">
                <div class="oferta-left denegada ">
                    <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                    <hr>
                    <p>Calle marineros</p>
                    <p>125.000€\130.000€</p>
                    <div class="btn-oferta denegada-btn">
                        <textarea></textarea>
                        <p>Denegada</p>
                    </div>
                </div>
            </div>
            <div class="oferta-main">
                <div class="oferta-left aceptar">
                    <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                    <hr>
                    <p>Calle marineros</p>
                    <p>125.000€\130.000€</p>
                    <div class="btn-oferta  aceptar-btn">
                        <textarea></textarea>
                       <p>Aceptada</p>

                    </div>
                </div>
          </div>

<?php
get_footer();