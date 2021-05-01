<?php
/**
 * Template Name: page-perfil.html
 * The template for displaying perfil.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */


require_once "self/security.php";

$logged_user = wp_get_current_user();

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/perfil-inmueble.css?cb=' . generate_random_string() . '">';

    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/css/datepicker.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/datepicker-full.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/locales/es.js"></script>';
    echo '<script src="'.get_bloginfo('stylesheet_directory').'/assets/ext/moment.min.js?cb=' . generate_random_string() . '"></script>';
    echo '<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>';
    
    echo '<script src="https://unpkg.com/filepond/dist/filepond.js"></script>';
    echo '<script src="https://unpkg.com/filepond-plugin-file-rename/dist/filepond-plugin-file-rename.js"></script>';
    echo '<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>';
    echo '<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">';
    echo '<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">';


    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">';
}
add_action('wp_head', 'myCss');

$inmueble_id = ($_GET["inmueble_id"]);
$inmueble = get_post($_GET["inmueble_id"]);


get_header();
?>
<main id="primary" class="site-main">
<div class="main">

<hr>
<div class="box">

  <div class="resumen-inmueble">
    <h3>Resumen Inmueble</h3>
    <div class="derecha">
      <div class="slider">
        <ul>
          <li>
            <img
              src="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-foto-principal', true); ?>"
            />
          </li>
        </ul>
      </div>



      <div class="info">
        <div class="fila-res">
          <div>
            <label for="calle">CALLE</label>
            <input type="text" id="calle" name="calle" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true);?>">
          </div>
          <div>
            <label for="planta">PLANTA</label>
            <input type="text" id="planta" name="planta" placeholder="planta" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-piso-planta', true);?>">
          </div>
          <div>
            <label for="numero">NUMERO</label>
            <input type="text" name="numero" placeholder="numero" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-numero', true);?>">
          </div>
          <div>
            <label for="codigo">C.POSTAL</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-codigopostal', true);?>">
          </div>
          <div>
            <label for="metros2">M2 UTILES</label>
            <input type="text" id="metros2" name="metros2" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true);?>m2">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="izquierda">
    <div class="precio">
      <h3><?php echo number_format(get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true), 0, ',', '.'); ?>€</h3>
      <p>PRECIO DE VENTA</p>
    </div>
    <div class="recomendado">
    <?php if (!empty(get_post_meta($inmueble->ID, 'meta-inmueble-preciorecomendado', true))) { ?>
    
      <h3><?php echo number_format(get_post_meta($inmueble->ID, 'meta-inmueble-preciorecomendado', true), 0, ',', '.'); ?>€</h3>
      <p>PRECIO RECOMENDADO</p>

    <?php } else { ?>
      <p>En espera de valoración...</p>

    <?php } ?>
    </div>
  </div>
</div>
<div class="perfil-inmueble">
  <h2>Perfil Inmueble</h2>
  <h3>INFORMACIÓN DEL INMUEBLE</h3>
  <hr>
  <div class="inmueble">
    <div class="fila">
      <div>
        <label for="tipo-de-inmueble">Tipo de inmueble</label>
        <select class="controls js-choices" onchange="editar(event)" name="inmueble-tipo" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true); ?>">
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Piso") echo "selected"; ?> value="Piso">Piso</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Casa") echo "selected"; ?> value="Casa">Casa</option> 
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Atico") echo "selected"; ?> value="Atico">Atico</option>          
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Chalet Independiente") echo "selected"; ?> value="Chalet Independiente">Chalet Independiente</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Chalet Pareado") echo "selected"; ?> value="Chalet Pareado">Chalet Pareado</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Chalet Adosado") echo "selected"; ?> value="Chalet Adosado">Chalet Adosado</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Garaje") echo "selected"; ?> value="Garaje">Garaje</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Trastero") echo "selected"; ?> value="Trastero">Trastero</option>
        </select>
      </div>
      <div>
        <label for="tipo-de-inmueble">Disponibilidad</label>
        <select class="controls js-choices" type="text" name="disponibilidad" id="disponibilidad">
          <option>Venta</option>
          <option>Alquiler</option>
        </select>
      </div>
      <div>
        <label for="tipo-de-inmueble">Estado</label>
        <select class="controls js-choices" type="text" onchange="editar(event)" name="inmueble-estado" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true); ?>">>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-estado', true) == "Buen estado") echo "selected"; ?> value="Buen estado">Buen estado</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-estado', true) == "A Estrenar") echo "selected"; ?> value="A Estrenar">A Estrenar</option>           
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-estado', true) == "A Reformar") echo "selected"; ?> value="A Reformar">A Reformar</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-estado', true) == "Reformado") echo "selected"; ?> value="Reformado">Reformado</option>
        </select>
      </div>
      <div>
        <label for="valor">Valor</label>
        <input type="number" id="valor" name="inmueble-valor" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-valor', true);?>">
      </div>
      <div>
        <label for="habitaciones">Habitaciones</label>
        <input type="number" id="habitaciones" name="inmueble-habitaciones" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-habitaciones', true);?>">
      </div>
      <div>
        <label for="baños">Baños</label>
        <input type="number" id="baños" name="inmueble-baños" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-baños', true);?>">
      </div>
      <div>
        <label for="salones">Salones</label>
        <input type="number" id="salones" name="inmueble-salones" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-salones', true);?>">
      </div>
      <div>
        <label for="terrazas">Terrazas</label>
        <input type="number" id="terrazas" name="inmueble-terrazas" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-terrazas', true);?>">
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
        <input type="text" id="pais" name="inmueble-pais" placeholder="pais" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-pais', true);?>">
      </div>
      <div>
        <label for="provincia">Provincia</label>
        <input type="text" id="provincia" name="inmueble-provincia" placeholder="provincia" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-provincia', true);?>">
      </div>
      <div>
        <label for="municipio">Municipio</label>
        <input type="text" id="municipio" name="inmueble-municipio" onchange="editar(event)" placeholder="municipio" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-municipio', true);?>">
      </div>
      <div>
        <label for="poblacion">Población</label>
        <input type="text" id="poblacion" name="inmueble-poblacion" placeholder="población" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-poblacion', true);?>">
      </div>
      <div>
        <label for="tipo-de-via">Tipo de Via</label>
        <select class="controls js-choices" type="text" name="inmueble-tipo-de-via" id="tipo-de-via" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true); ?>">
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Calle") echo "selected"; ?> value="Calle">Calle</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Avenida") echo "selected"; ?> value="Avenida">Avenida</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Via") echo "selected"; ?> value="Via">Via</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Paseo") echo "selected"; ?> value="Paseo">Paseo</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Camino") echo "selected"; ?> value="Camino">Camino</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Pasaje") echo "selected"; ?> value="Pasaje">Pasaje</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Plaza") echo "selected"; ?> value="Plaza">Plaza</option>
          <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo-de-via', true) == "Poligono") echo "selected"; ?> value="Poligono">Poligono</option>
        </select>
      </div>
      <div class="direccion">    
        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="inmueble-direccion" placeholder="direccion" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true);?>">
      </div>
      <div>
        <label for="codigo-postal">Codigo Postal</label>
        <input type="text" id="codigo-postal" name="inmueble-codigo-postal" placeholder="codigo postal" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-codigo-postal', true);?>">
      </div>
      <div>
        <label for="numero">Numero</label>
        <input type="text" id="numero" name="inmueble-numero" placeholder="numero" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-numero', true);?>">
      </div>
      <div>
        <label for="escalera">Escalera</label>
        <input type="text" id="escalera" name="inmueble-escalera" placeholder="escalera" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-escalera', true);?>">
      </div>
      <div>
        <label for="piso-planta">Piso-planta</label>
        <input type="text" id="piso-planta" name="inmueble-piso-planta" placeholder="piso/planta" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-piso-planta', true);?>">
      </div>
      <div>
        <label for="puerta">Puerta</label>
        <input type="text" id="puerta" name="inmueble-puerta" placeholder="puerta" onchange="editar(event)" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-puerta', true);?>">
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
        <input type="number" id="superficie-util" name="inmueble-m2utiles" onchange="editar(event)" placeholder="superficie util" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2utiles', true); ?>">
      </div>
      <div>
        <label for="superficie-construida">Superficie Construida</label>
        <input type="number" id="superficie-construida" onchange="editar(event)" name="inmueble-m2construidos" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true); ?>"
          placeholder="superficie construida">
      </div>
      <!-- div class terreno solo si es un chalet de cualquiera de los 3 tipos -->
      <div class="terreno">
        <label for="superficie-parcela">Superficie Parcela</label>
        <input type="number" id="superficie-parcela" onchange="editar(event)" name="inmueble-superficie-parcela" placeholder="superficie parcela" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-superficie-parcela', true); ?>">
      </div>
    </div>
  </div>

  <hr>
  <div class="descripcion">
    <h3>Descripción Del Inmueble</h3>
    <hr>
    <div class="fila descripcion">
      <textarea
        name="inmueble-descripcion"
        rows="2"
        class="question"
        placeholder="Describa su inmueble"
        id="msg"
        required
        autocomplete="off"
        onchange="editar(event)"
      ><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-descripcion', true); ?></textarea>
    </div>
  </div>
  <hr>
  <div class="caracteristicas">
    <h3>Caracteristicas de la Zona</h3>
    <hr>
    <div class="fila">
      <div>
        <input type="checkbox" id="cbox1" name="inmueble-garaje" onchange="editarCheck(event)" 
          <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-garaje', true) == "on" ) { ?> checked <?php }?>>
        <label for="cbox1">Garaje</label>
      </div>
      <div>
        <input type="checkbox" id="cbox2" name="inmueble-ascensor" onchange="editarCheck(event)" 
          <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-ascensor', true) == "on" ) { ?> checked <?php }?>>
        <label for="cbox2">Ascensor</label>
      </div>
      <div>
        <input type="checkbox" id="cbox3" name="inmueble-transporte" onchange="editarCheck(event)" 
          <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-transporte', true) == "on" ) { ?> checked <?php }?>>
        <label for="cbox3">Transporte publico</label>
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
<hr>

<div class="funciones-buton">
  <h2>Fotografias</h2>
  <div class="boton" style="display: none">
  <div>
    <input class="botons " type="submit" value="EDITAR">
  </div>
  <div>
    <input class="botons" type="submit" value="EXAMINAR">
  </div>
  <div>
    <input class="botons " type="submit" value="GUARDAR">
  </div>
</div>
</div>
<hr />
<div class="bg-fotos">

<?php

$photosRaw = get_post_meta($inmueble_id, 'meta-inmueble-imagenes-metainfo', true);

$photos = json_decode(wp_unslash($photosRaw), true);

foreach ($photos as $key => $photo) {
?>

          <div class="card-ft" data-photo="<?php echo $photo['url']?>">
            <div class="iconos">
              <div class="icn-move">
                <i class="fas fa-grip-horizontal"></i>
              </div>
              <div class="icn-del delete-img" onclick="removeImage('<?php echo $photo['url']?>')">
                <i class="fas fa-times"></i>
              </div>
            </div>
            <div class="card-img">
              <img src="<?php echo $photo['url']?>" alt="<?php echo ($photo['name'])?>" width="100%">
            </div>
            <div class="card-text">
              <input onchange="updateImgs(event)" type="text" name="name-img" placeholder="TITULO" value="<?php echo ($photo['name'])?>">
            </div>
          </div>

<?php


}

?>


        </div>
        <input type="file" class="filepond" multiple>
      </div>
    </div>

  
</div>


</main>
<!-- #main -->

<script>
  moment.locale("es");
  var choicesObjs = document.querySelectorAll('.js-choice');
  var choices = [];
  for (var i = 0; i < choicesObjs.length; i++) {
    choices.push(new Choices(choicesObjs[i], {
      itemSelectText: 'Click para seleccionar',
      searchEnabled: false,
      shouldSort: false
    }));
  }

  function removeImage(url) {
    if (confirm("¿Está seguro de querer eliminarlo?")) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/file-upload?action=remove-photo-inmueble&inmueble_id=<?php echo $inmueble->ID ?>&photo_url=" + url);

      xhr.onload = function () {
        document.querySelector("[data-photo='" + url + "']").remove();
        updateImgs();
      }

      xhr.send();
    }
  }
  
  function editarCheck(e) {
    var input = e.currentTarget;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/inmueble-xhr?action=update_metadata&inmueble_id=<?php echo $inmueble->ID ?>");

    var formData = new FormData();

    formData.append('metaname', input.getAttribute("name"));
    formData.append('metavalue', input.checked ? "on" : "off");


    xhr.onload = function() {
        input.style.filter = "none";
        input.removeAttribute("readonly");
        
        Toastify({
            text: "Dato actualizado",
            duration: 3000,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            backgroundColor: "rgb(254, 152, 0)",
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function(){} // Callback after click
        }).showToast();

    }.bind(input);
    xhr.send(formData);
    input.style.filter = "blur(1px)";
    input.setAttribute("readonly", "true");

  }

  function editar(e) {
    var input = e.currentTarget;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/inmueble-xhr?action=update_metadata&inmueble_id=<?php echo $inmueble->ID ?>");

    var formData = new FormData();

    formData.append('metaname', input.getAttribute("name"));
    formData.append('metavalue', input.value);


    xhr.onload = function() {
        input.style.filter = "none";
        input.removeAttribute("readonly");
        
        Toastify({
            text: "Dato actualizado",
            duration: 3000,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            backgroundColor: "rgb(254, 152, 0)",
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function(){} // Callback after click
        }).showToast();

    }.bind(input);
    xhr.send(formData);
    input.style.filter = "blur(1px)";
    input.setAttribute("readonly", "true");
  }
  

    FilePond.setOptions({    
      labelIdle: 'Arrastra y suelta tus archivos o <span class = "filepond--label-action"> Examinar <span>',
      labelInvalidField: "El campo contiene archivos inválidos",
      labelFileWaitingForSize: "Esperando tamaño",
      labelFileSizeNotAvailable: "Tamaño no disponible",
      labelFileLoading: "Cargando",
      labelFileLoadError: "Error durante la carga",
      labelFileProcessing: "Cargando",
      labelFileProcessingComplete: "Carga completa",
      labelFileProcessingAborted: "Carga cancelada",
      labelFileProcessingError: "Error durante la carga",
      labelFileProcessingRevertError: "Error durante la reversión",
      labelFileRemoveError: "Error durante la eliminación",
      labelTapToCancel: "toca para cancelar",
      labelTapToRetry: "tocar para volver a intentar",
      labelTapToUndo: "tocar para deshacer",
      labelButtonRemoveItem: "Eliminar",
      labelButtonAbortItemLoad: "Abortar",
      labelButtonRetryItemLoad: "Reintentar",
      labelButtonAbortItemProcessing: "Cancelar",
      labelButtonUndoItemProcessing: "Deshacer",
      labelButtonRetryItemProcessing: "Reintentar",
      labelButtonProcessItem: "Cargar",
      labelMaxFileSizeExceeded: "El archivo es demasiado grande",
      labelMaxFileSize: "El tamaño máximo del archivo es {filesize}",
      labelMaxTotalFileSizeExceeded: "Tamaño total máximo excedido",
      labelMaxTotalFileSize: "El tamaño total máximo del archivo es {filesize}",
      labelFileTypeNotAllowed: "Archivo de tipo no válido",
      fileValidateTypeLabelExpectedTypes: "Espera {allButLastType} o {lastType}",
      imageValidateSizeLabelFormatError: "Tipo de imagen no compatible",
      imageValidateSizeLabelImageSizeTooSmall: "La imagen es demasiado pequeña",
      imageValidateSizeLabelImageSizeTooBig: "La imagen es demasiado grande",
      imageValidateSizeLabelExpectedMinSize: "El tamaño mínimo es {minWidth} × {minHeight}",
      imageValidateSizeLabelExpectedMaxSize: "El tamaño máximo es {maxWidth} × {maxHeight}",
      imageValidateSizeLabelImageResolutionTooLow: "La resolución es demasiado baja",
      imageValidateSizeLabelImageResolutionTooHigh: "La resolución es demasiado alta",
      imageValidateSizeLabelExpectedMinResolution: "La resolución mínima es {minResolution}",
      imageValidateSizeLabelExpectedMaxResolution: "La resolución máxima es {maxResolution}",
    });
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.setOptions({
      server: '/file-upload?action=upload-photo-inmueble&inmueble_id=<?php echo $_GET["inmueble_id"] ?>',
    });
    function createElementFromHTML(htmlString) {
      var div = document.createElement('div');
      div.innerHTML = htmlString.trim();

      // Change this to div.childNodes to support multiple top-level nodes
      return div.firstChild; 
    }
    var inputElement = document.querySelector('input[type="file"]');
    var pond = FilePond.create( inputElement );
    var pondevent = document.querySelector('.filepond--root');
    pond.onprocessfile = (err, file) => {
      if (!err) {
        const response = JSON.parse(file.serverId);
        var img = `<div class="card-ft" data-photo="${response.url}">
            <div class="iconos">
              <div class="icn-move">
                <i class="fas fa-grip-horizontal"></i>
              </div>
              <div class="icn-del delete-img" onclick="removeImage('${response.url}')">
                <i class="fas fa-times"></i>
              </div>
            </div>
            <div class="card-img">
              <img src="${response.url}" alt="${response.name}" width="100%">
            </div>
            <div class="card-text">
              <input onchange="updateImgs(event)" type="text" name="name-img" placeholder="TITULO" value="${response.name}">
            </div>
          </div>`;

        document.querySelector(".bg-fotos").appendChild(createElementFromHTML(img));
        setTimeout(() => {
          pond.removeFile(file);
        }, 200); 
      }
    }

    pond.onprocessfiles = updateImgs;
/*
    new Splide( '.splide', {
      rewind: true,
      autoplay: true,
      cover: true,
      fixedHeight: 300
    } ).mount();
*/

    function setPrecioRecomendado() {
      var newValue = prompt("Introduzca valoración");
      if (!isNaN(newValue)) {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/inmueble-xhr?action=update_metadata&inmueble_id=<?php echo $inmueble->ID ?>");

        var formData = new FormData();

        formData.append('metaname', 'inmueble-preciorecomendado');
        formData.append('metavalue', newValue);


        xhr.onload = function() {
            window.location.reload();
            Toastify({
                text: "Dato actualizado",
                duration: 3000,
                gravity: "bottom", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                backgroundColor: "rgb(254, 152, 0)",
                stopOnFocus: true, // Prevents dismissing of toast on hover
                onClick: function(){} // Callback after click
            }).showToast();

        }
        xhr.send(formData);
      }
    }

    const draggable = new Sortable.create(document.querySelector('.bg-fotos'), {
      draggable: '.card-ft',
      handle: '.icn-move',
      animation: 150,  // ms, animation speed moving items when sorting, `0` — without animation
	    easing: "cubic-bezier(1, 0, 0, 1)", // Easing for animation. Defaults to null. See https://easings.net/ for examples.
      onEnd: updateImgs
    });

    function updateImgs(event) {
      const wrapper = document.querySelector(".bg-fotos");
      const elements = wrapper.querySelectorAll(".card-ft");
      const elementsArray = [];
      elements.forEach((el) => {
        const element = {};
        element.name = el.querySelector("[name='name-img']").value;
        element.url = el.querySelector("img").src;

        elementsArray.push(element);
      }); 
      console.log(elementsArray);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/inmueble-xhr?action=actualiza-imagenes&inmueble_id=<?php echo $inmueble->ID ?>");

      var formData = new FormData();

      formData.append('metavalue', JSON.stringify(elementsArray));


      xhr.onload = function() {
          Toastify({
              text: "Dato actualizado",
              duration: 3000,
              gravity: "bottom", // `top` or `bottom`
              position: "center", // `left`, `center` or `right`
              backgroundColor: "rgb(254, 152, 0)",
              stopOnFocus: true, // Prevents dismissing of toast on hover
              onClick: function(){} // Callback after click
          }).showToast();
      }
      xhr.send(formData);
    }
</script>
<?php
get_footer();