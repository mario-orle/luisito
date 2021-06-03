<?php
/**
 * Template Name: page-inmuebles-mbl.html
 * The template for displaying inmuebles-mbl.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once __DIR__ . "/../self/security.php";

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/inmuebles-mbl.css">';
}
add_action('wp_head', 'myCss');

$inmuebles = get_posts(array(
    'post_type' => 'inmueble',
    'author' => get_current_user_id()
));

$user = wp_get_current_user();

if (current_user_can('administrator') && !empty($_GET['user'])) {
    $inmuebles = get_posts(array(
      'post_type' => 'inmueble',
      'author' => $_GET['user']
    ));

    $user = get_user_by('ID', $_GET['user']);
}


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="inm-mbl">
            <h2>Inmuebles <i class="fas fa-house-user"></i></h2>
            <hr>
<?php
foreach ($inmuebles as $inmueble) {
    $inmueble_id = $inmueble->ID;
    //$photos = json_decode(wp_unslash(get_post_meta($inmueble->ID, 'meta-inmueble-photos', true)));
?>
            <div class="espacio-caja">
                <button type="button" class="collapsible">INMUEBLE 1</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Dirección:</th>
                                <td><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true);?></td>
                            </tr>
                            <tr>
                                <th>Metros:</th>
                                <td><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true);?>m2</td>
                            </tr>
                            <tr>
                                <th>Destino:</th>
                                <td><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-destino', true); ?></td>
                            </tr>
                            <tr>
                                <th>Precio:</th>
                                <td><?php echo number_format(get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true), 2, ",", "."); ?> €</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <a id="descripcion" onclick="document.querySelector('#descripcion-<?php echo $inmueble_id ?>').style.display = 'block';" href="#"><i class="far fa-address-card"></i></a>
                    </div>
                </div>
            </div>

<!-- Pop ups para las diferentes funciones -->

<div class="descripcion" id="descripcion-<?php echo $inmueble_id ?>" style="display: none; position: fixed; top: 10px; left: 10px; right: 10px; bottom: 10px; z-index:5;">
            <div class="perfil-inmueble">
                <h2>Perfil Inmueble</h2>
                <h3>INFORMACIÓN DEL INMUEBLE</h3>
                <hr>
                <div class="inmueble">
                    <div class="fila">
                        <div>
                            <label for="tipo-de-inmueble">Tipo de inmueble</label>
                            <input type="text" id="inmueble" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true);?>" name="tipo-inmueble" placeholder="Tipo de inmueble">
                        </div>
                        <div>
                            <label for="disponibilidad">Disponibilidad</label>
                            <input type="text" id="disponibilidad" name="disponibilidad" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-destino', true);?>" placeholder="valor">
                        </div>
                        <div>
                            <label for="Estado">Estado</label>
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-estado', true);?>"  id="estado" name="estado" placeholder="Estado">
                        </div>
                        <div>
                            <label for="valor">Valor</label>
                            <input type="text"  value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true);?>"  id="valor" name="valor" placeholder="valor">
                        </div>
                        <div class="solochalet solopiso">
                            <label for="habitaciones">Habitaciones</label>
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-habitaciones', true);?>"  id="habitaciones" name="habitaciones" placeholder="habitaciones">
                        </div>
                        <div class="solochalet solopiso">
                            <label for="baños">Baños</label>
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-baños', true);?>"  id="baños" name="baños" placeholder="baños">
                        </div>
                        <div class="solochalet solopiso">
                            <label for="salones">Salones</label>
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-salones', true);?>"  id="salones" name="salones" placeholder="salones">
                        </div>
                        <div class="solochalet solopiso">
                            <label for="terrazas">Terrazas</label>
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-terrazas', true);?>"  id="terrazas" name="terrazas" placeholder="terrazas">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="localizacion">
                    <h3>Localización</h3>
                    <hr>
                    <div class="fila">
                        <div>
                            <label for="pais">Pais</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-pais', true);?>"  type="text" id="pais" name="pais" placeholder="pais">
                        </div>
                        <div>
                            <label for="provincia">Provincia</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-provincia', true);?>"  type="text" id="provincia" name="provincia" placeholder="provincia">
                        </div>
                        <div>
                            <label for="municipio">Municipio</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-municipio', true);?>"  type="text" id="municipio" name="municipio" placeholder="municipio">
                        </div>
                        <div>
                            <label for="poblacion">Población</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-poblacion', true);?>"  type="text" id="poblacion" name="poblacion" placeholder="población">
                        </div>
                        <div>
                            <label for="via">Tipo de Via</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true);?>"  type="text" id="tipo-de-via" name="via" placeholder="Tipo de via">
                        </div>
                        <div class="direccion">
                            <label for="direccion">Dirección</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true);?>"  type="text" id="direccion" name="direccion" placeholder="direccion">
                        </div>
                        <div>
                            <label for="codigo-postal">Codigo Postal</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-codigopostal', true);?>"  type="text" id="codigo-postal" name="codigo-postal" placeholder="codigo postal">
                        </div>
                        <div>
                            <label for="numero">Numero</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-numero', true);?>"  type="text" id="numero" name="numero" placeholder="numero">
                        </div>
                        <div>
                            <label for="escalera">Escalera</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-escalera', true);?>"  type="text" id="escalera" name="escalera" placeholder="escalera">
                        </div>
                        <div>
                            <label for="piso-planta">Piso-planta</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-piso-planta', true);?>"  type="text" id="piso-planta" name="piso-planta" placeholder="piso/planta">
                        </div>
                        <div>
                            <label for="puerta">Puerta</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-puerta', true);?>"  type="text" id="puerta" name="puerta" placeholder="puerta">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="superficie">
                    <h3>Superficie</h3>
                    <hr>
                    <div class="fila">
                        <div>
                            <label for="superficie-util">Superficie Util</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2utiles', true);?>"  type="text" id="superficie-util" name="superficie-util" placeholder="superficie util">
                        </div>
                        <div>
                            <label for="superficie-construida">Superficie Construida</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true);?>"  type="text" id="superficie-construida" name="superficie-construida" placeholder="superficie construida">
                        </div>
                        <!-- div class terreno solo si es un chalet de cualquiera de los 3 tipos -->
                        <div class="terreno solochalet">
                            <label for="superficie-parcela">Superficie Parcela</label>
                            <input value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-superficie-parcela', true);?>"  type="text" id="superficie-parcela" name="superficie-parcela" placeholder="superficie parcela">
                        </div>
                    </div>
                </div>

                <hr>
                <div class="descripcion">
                    <h3>Descripción Del Inmueble</h3>
                    <hr>
                    <div class="fila descripcion">
                        <textarea><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-descripcion', true); ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="caracteristicas">
                    <h3>Caracteristicas de la Zona</h3>
                    <hr>
                    <div class="fila">

                        <div class="solochalet solopiso">
                            <input type="checkbox" id="cbox1" name="inmueble-garaje" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-garaje', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox1">Garaje</label>
                        </div>
                        <div class="solopiso">
                            <input type="checkbox" id="cbox2" name="inmueble-ascensor" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-ascensor', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox2">Ascensor</label>
                        </div>
                        <div class="solopiso">
                            <input type="checkbox" id="cbox3" name="inmueble-trastero" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-trastero', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox3">Trastero</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cbox4" name="inmueble-centrourbano" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-centrourbano', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox4">Centro Urbano</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cbox5" name="inmueble-comercio" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-comercio', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox5">Comercio</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cbox6" name="inmueble-farmacia" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-farmacia', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox6">Farmacia</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cbox7" name="inmueble-parques" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-parques', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox7">Parques y Jardines</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cbox8" name="inmueble-escuela" onchange="editarCheck(event)" 
                            <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-escuela', true) == "on" ) { ?> checked <?php }?>>
                            <label for="cbox8">Escuelas</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-slider">
            <div class="slider">
                <ul>


<?php

$photosRaw = get_post_meta($inmueble_id, 'meta-inmueble-imagenes-metainfo', true);

$photos = json_decode(wp_unslash($photosRaw), true);
foreach ($photos as $key => $photo) {
?>

                    <li>
                        <img src="<?php echo $photo['url']?>" alt="<?php echo ($photo['name'])?>">
                    </li>
<?php
}
?>
                </ul>
            </div>
        </div>
    </div>
<?php
}
?>

        </div>

        
    <script>

updateTipoPiso(tipoPiso);
  function updateTipoPiso(tipoPiso) {
    document.querySelectorAll('.solochalet').forEach(e => e.style.display='none');
    document.querySelectorAll('.solopiso').forEach(e => e.style.display='none');
    if (tipoPiso === "Piso" || tipoPiso === "Atico") {
      document.querySelectorAll('.solopiso').forEach(e => e.style.display='block'); 
    } else if (tipoPiso === "Casa" || tipoPiso.indexOf("Chalet") === 0) {
      document.querySelectorAll('.solochalet').forEach(e => e.style.display='block'); 
    }
  }
  document.querySelectorAll('input').forEach(e => e.setAttribute("readonly", "true"));

    </script>
</main><!-- #main -->

<?php
get_footer();