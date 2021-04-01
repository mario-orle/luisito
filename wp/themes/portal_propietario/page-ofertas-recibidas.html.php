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
require_once "self/users-stuff.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inmueble_id = $_POST["inmueble_id"];
    $oferta_id = $_POST["oferta_id"];

    if ($_POST["action"] == "respuesta-cliente") {
        foreach (get_post_meta($inmueble_id, 'meta-oferta-al-cliente') as $old_meta_encoded) {
            $meta = json_decode(wp_unslash(($old_meta_encoded)), true);
            if ($meta["id"] == $oferta_id) {
                $meta["status"] = "respondida-cliente";
                $meta["respuesta"] = $_POST["respuesta"];
                $meta["motivo"] = $_POST["motivo"];
                $meta["propuesta"] = $_POST["propuesta"];


                delete_post_meta($inmueble_id, 'meta-oferta-al-cliente', wp_slash($old_meta_encoded));
                add_post_meta($inmueble_id, 'meta-oferta-al-cliente', wp_slash(json_encode($meta)));

                wp_redirect("/ofertas-recibidas");


            }
        }
    }

    if ($_POST["action"] == "respuesta-cita") {
        foreach (get_post_meta($inmueble_id, 'meta-oferta-al-cliente') as $old_meta_encoded) {
            $meta = json_decode(wp_unslash(($old_meta_encoded)), true);
            if ($meta["id"] == $oferta_id) {
                $meta["status"] = "respondida-cita";
                $meta["respuesta"] = $_POST["respuesta"];

                delete_post_meta($inmueble_id, 'meta-oferta-al-cliente', wp_slash($old_meta_encoded));
                add_post_meta($inmueble_id, 'meta-oferta-al-cliente', wp_slash(json_encode($meta)));

                wp_redirect("/ofertas-recibidas");


            }
        }
    }
}



function myCss()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/ofertas-recibidas.css?cb=' . generate_random_string() . '">';
}
add_action('wp_head', 'myCss');

$user = wp_get_current_user();

$asesor_id = get_user_meta($user->ID, 'meta-gestor-asignado', true);

$asesor = get_user_by('id', $asesor_id);


$array_ofertas = get_own_ofertas_recibidas();

get_header();
?>

<main id="primary" class="site-main">
<div class="main">
<?php 
    
    foreach ($array_ofertas as $inmueble_id => $ofertas) {
        $inmueble = get_post($inmueble_id);
        if (count($ofertas) > 0) {
            $oferta = $ofertas[0];
?>
            <h2>Ofertas Recibidas</h2>

            <div class="oferta-main">
<?php

if ($oferta['status'] === 'respondida-cliente') {
?>

                <div class="oferta-left aceptar-text ">
                    <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                    <p><?php echo date_format(new DateTime($oferta['created']), 'd/m/Y') ?></p>
                    <p><?php echo number_format($oferta['cantidad'], 0, ',', '.') ?> €</p>
                    <div class="btn-oferta denegada-btn">
                        <textarea readonly><?php echo $oferta['descripcion'] ?></textarea>
<?php 
    if ($oferta['respuesta'] === 'denegar') {
?>
                        <p>Denegada</p>
                        <textarea placeholder="Motivo" name="motivo" readonly><?php echo $oferta['motivo'] ?></textarea>


<?php
    } else if ($oferta['respuesta'] === 'aceptar') { 
?>

                        <p>Aceptada</p>


<?php
    } else if ($oferta['respuesta'] === 'contraoferta') {
?>
                        <p>Contraofertada</p>
                        <textarea placeholder="Propuesta" name="propuesta" readonly><?php echo $oferta['propuesta'] ?></textarea>
<?php
    } 
?></p>
                    </div>
                </div>


<?php
} else if ($oferta['status'] === 'cita-propuesta' || $oferta['status'] === 'respondida-cita') {
?>
    <div class="oferta-left aceptar-text ">
        <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
        <p>Cita propuesta: <?php echo date_format(new DateTime($oferta['cita']), 'd/m/Y H:i') ?></p>
        <p><?php echo number_format($oferta['cantidad'], 0, ',', '.') ?> €</p>
        <div class="btn-oferta denegada-btn">
            <form method="POST" class="btn-oferta aceptar-btn">
                <textarea readonly><?php echo $oferta['descripcion'] ?></textarea>
                <select class="select" name="respuesta" <?php if ($oferta['status'] === "respondida-cita") { ?> disabled style="background: white;" <?php  } ?>>
                    <option <?php if ($oferta['respuesta'] == 'aceptar') echo "selected"; ?>  value="aceptar">Aceptar</option>
                    <option <?php if ($oferta['respuesta'] == 'denegar') echo "selected"; ?>  value="denegar">Denegar</option>
                </select>
                 <input type="hidden" value="respuesta-cita" name="action" />
                <input type="hidden" value="<?php echo $inmueble_id?>" name="inmueble_id" />
                <input type="hidden" value="<?php echo $oferta['id']?>" name="oferta_id" />
<?php 

                if ($oferta['status'] === "cita-propuesta") {
                    if ($oferta['respuesta'] === 'contraoferta') {
?>
                        <textarea placeholder="Propuesta" name="propuesta" readonly><?php echo $oferta['propuesta'] ?></textarea>

<?php
                    }
?>
                <input type="submit">

<?php
                }
?>
            </form>
        </div>
    </div>
<?php

} else {

?>
                <div class="oferta-left aceptar-text" data-id="<?php echo $oferta['id']?>" id="oferta-<?php echo $oferta['id']?>">
                    <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                    <p><?php echo date_format(new DateTime($oferta['created']), 'd/m/Y') ?></p>
                    <p><?php echo number_format($oferta['cantidad'], 0, ',', '.') ?> €</p>
                    <div class="btn-oferta aceptar-btn">
                        <form method="POST" class="btn-oferta aceptar-btn">
                            <textarea readonly><?php echo $oferta['descripcion'] ?></textarea>
                            <select class="select" name="respuesta" onchange="prepareSelect('<?php echo $oferta['id']?>')">
                                <option value="aceptar">Aceptar</option>
                                <option value="denegar">Denegar</option>
                                <option value="contraoferta">Contra Oferta</option>
                            </select>
                            <input type="hidden" value="respuesta-cliente" name="action" />
                            <input type="hidden" value="<?php echo $inmueble_id?>" name="inmueble_id" />
                            <input type="hidden" value="<?php echo $oferta['id']?>" name="oferta_id" />
                            <textarea style="display: none" placeholder="Motivo" name="motivo"></textarea>
                            <textarea style="display: none" placeholder="Ingrese su Propuesta" name="propuesta"></textarea>
                            <input type="submit">
                        </form>
                    </div>
                </div>

<?php
}
?>

                <div class="card-wrapper">
                    <button>
                        <a href="/perfil-inmueble?inmueble_id=<?php echo $inmueble->ID ?>">
                        <img src="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-foto-principal', true); ?>">
                        <h3><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-destino', true); ?></h3>
                        <h4><b><?php echo number_format(get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true), 2, ",", "."); ?> €</b></h4>
                        <p><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-comentarios', true) ?:  "Sin descripción"; ?></p>
                        </a>
                    </button>
                </div>
            </div>

            <?php
        }
        if (count($ofertas) > 1) {
            for ($i = 1; $i < count($ofertas); $i++) {
                $oferta = $ofertas[$i];
?>

            <div class="oferta-main">
            <?php

if ($oferta['status'] === 'respondida-cliente') {
    ?>
    
                    <div class="oferta-left aceptar-text ">
                        <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                        <p><?php echo date_format(new DateTime($oferta['created']), 'd/m/Y') ?></p>
                        <p><?php echo number_format($oferta['cantidad'], 0, ',', '.') ?> €</p>
                        <div class="btn-oferta denegada-btn">
                            <textarea readonly><?php echo $oferta['descripcion'] ?></textarea>
    <?php 
        if ($oferta['respuesta'] === 'denegar') {
    ?>
                            <p>Denegada</p>
                            <textarea placeholder="Motivo" name="motivo" readonly><?php echo $oferta['motivo'] ?></textarea>
    
    
    <?php
        } else if ($oferta['respuesta'] === 'aceptar') { 
    ?>
    
                            <p>Aceptada</p>
    
    
    <?php
        } else if ($oferta['respuesta'] === 'contraoferta') {
    ?>
                            <p>Contraofertada</p>
                            <textarea placeholder="Propuesta" name="propuesta" readonly><?php echo $oferta['propuesta'] ?></textarea>
    <?php
        } 
    ?></p>
                        </div>
                    </div>
    
    
    <?php
    } else if ($oferta['status'] === 'cita-propuesta' || $oferta['status'] === 'respondida-cita') {
    ?>
        <div class="oferta-left aceptar-text ">
            <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
            <p>Cita propuesta: <?php echo date_format(new DateTime($oferta['cita']), 'd/m/Y H:i') ?></p>
            <p><?php echo number_format($oferta['cantidad'], 0, ',', '.') ?> €</p>
            <div class="btn-oferta denegada-btn">
                <form method="POST" class="btn-oferta aceptar-btn">
                    <textarea readonly><?php echo $oferta['descripcion'] ?></textarea>
                    <select class="select" name="respuesta" <?php if ($oferta['status'] === "respondida-cita") { ?> disabled style="background: white;" <?php  } ?>>
                        <option <?php if ($oferta['respuesta'] == 'aceptar') echo "selected"; ?>  value="aceptar">Aceptar</option>
                        <option <?php if ($oferta['respuesta'] == 'denegar') echo "selected"; ?>  value="denegar">Denegar</option>
                    </select>
                     <input type="hidden" value="respuesta-cita" name="action" />
                    <input type="hidden" value="<?php echo $inmueble_id?>" name="inmueble_id" />
                    <input type="hidden" value="<?php echo $oferta['id']?>" name="oferta_id" />
    <?php 
    
                    if ($oferta['status'] === "cita-propuesta") {
                        if ($oferta['respuesta'] === 'contraoferta') {
    ?>
                            <textarea placeholder="Propuesta" name="propuesta" readonly><?php echo $oferta['propuesta'] ?></textarea>
    
    <?php
                        }
    ?>
                    <input type="submit">
    
    <?php
                    }
    ?>
                </form>
            </div>
        </div>
    <?php
    
    } else {
    
    ?>
                    <div class="oferta-left aceptar-text" data-id="<?php echo $oferta['id']?>" id="oferta-<?php echo $oferta['id']?>">
                        <h3>Precio de Oferta <i class="fas fa-home"></i></h3>
                        <p><?php echo date_format(new DateTime($oferta['created']), 'd/m/Y') ?></p>
                        <p><?php echo number_format($oferta['cantidad'], 0, ',', '.') ?> €</p>
                        <div class="btn-oferta aceptar-btn">
                            <form method="POST" class="btn-oferta aceptar-btn">
                                <textarea readonly><?php echo $oferta['descripcion'] ?></textarea>
                                <select class="select" name="respuesta" onchange="prepareSelect('<?php echo $oferta['id']?>')">
                                    <option value="aceptar">Aceptar</option>
                                    <option value="denegar">Denegar</option>
                                    <option value="contraoferta">Contra Oferta</option>
                                </select>
                                <input type="hidden" value="respuesta-cliente" name="action" />
                                <input type="hidden" value="<?php echo $inmueble_id?>" name="inmueble_id" />
                                <input type="hidden" value="<?php echo $oferta['id']?>" name="oferta_id" />
                                <textarea style="display: none" placeholder="Motivo" name="motivo"></textarea>
                                <textarea style="display: none" placeholder="Ingrese su Propuesta" name="propuesta"></textarea>
                                <input type="submit">
                            </form>
                        </div>
                    </div>
    
    <?php
    }
?>
            </div>
<?php




            }


        }
    }

            ?>

        </div>
<script>

function prepareSelect(id) {
    var oferta = document.querySelector("#oferta-" + id);
    oferta.classList.remove("aceptar-text");
    oferta.classList.remove("denegar-text");
    oferta.classList.remove("contraoferta-text");
    var respuesta = oferta.querySelector("select").value;
    oferta.classList.add(respuesta + "-text");
    if (respuesta === "aceptar") {
        oferta.querySelector("[name=motivo]").style.display = "none";
        oferta.querySelector("[name=propuesta]").style.display = "none";
    } else if (respuesta === "denegar") {
        oferta.querySelector("[name=motivo]").style.display = "block";
        oferta.querySelector("[name=propuesta]").style.display = "none";
    } else if (respuesta === "contraoferta") {
        oferta.querySelector("[name=motivo]").style.display = "none";
        oferta.querySelector("[name=propuesta]").style.display = "block";
    }
}

</script>
</main><!-- #main -->

<?php
get_footer();
