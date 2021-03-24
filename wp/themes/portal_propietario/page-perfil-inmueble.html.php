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
    //echo '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css">';
    echo '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>';

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
    <div class="main-datos">
      <div class="texto">
        <h3>Datos del Inmueble</h3>
        <hr />
        <div class="datos-inmuebles">
          <h4><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true);?> en <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true);?>(<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-codigopostal', true);?>)</h4>
          <h4><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-municipio', true);?></h4>
          <p><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true);?>m2 - <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-habitaciones', true);?>Hab. - <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-estado', true);?></p>
        </div>
      </div>
      <div class="precios">
        <div class="venta">
          <h1><?php echo number_format(get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true), 0, ',', '.'); ?>€</h1>
          <p>Precio de Venta</p>
        </div>
        <div class="valoracion" <?php if (current_user_can('administrator')) { ?> onclick="setPrecioRecomendado()" <?php }?> >
          <?php if (!empty(get_post_meta($inmueble->ID, 'meta-inmueble-preciorecomendado', true))) { ?>
            
            <h1><?php echo number_format(get_post_meta($inmueble->ID, 'meta-inmueble-preciorecomendado', true), 0, ',', '.'); ?>€</h1>
            <p>Precio Recomendado</p>

          <?php } else { ?>
            <p>En espera de valoración...</p>

          <?php } ?>
        </div>
      </div>
    </div>
    <div class="perfil-inmueble">
      <div class="colum-left">
        <h2>Perfil Inmueble</h2>
        <hr />
        <div class="img-home">
          <img
            src="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-foto-principal', true); ?>"
            width="100%"
          />
        </div>
        <h3>CARACTERISTICAS</h3>
        <hr />
        <form>
          <div class="first-block formulario">
            <input
              type="number"
              value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2utiles', true); ?>"
              name="inmueble-m2utiles"
              class="question"
              placeholder=""
              id="MU"
              required
              autocomplete="off"
              onchange="editar(event)"
            />
            <label for="MU">
              <span>Metros Utiles</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">
            <input
              type="number"
              value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true); ?>"
              name="inmueble-m2construidos"
              class="question"
              placeholder=""
              id="MC"
              required
              autocomplete="off"
              onchange="editar(event)"
            />
            <label for="MC">
              <span>Metros Construido</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">
          <select id="AM" class="js-choice" name="inmueble-equipamiento" onchange="editar(event)">
            <option value="">Equipamiento</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-equipamiento', true) == "Amueblado") echo "selected"; ?> value="Amueblado">Amueblado</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-equipamiento', true) == "Semi-Amueblado") echo "selected"; ?> value="Semi-Amueblado">Semi-Amueblado</option>           
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-equipamiento', true) == "Sin Amueblar") echo "selected"; ?> value="Sin Amueblar">Sin Amueblar</option>
            </select>
            <label for="AM">
              <span>Amueblado</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">
          <select class="js-choice question" onchange="editar(event)" id="CE" name="inmueble-certificadoenergetico">
            <option value="">Certificado Energético</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-certificadoenergetico', true) == "Sí") echo "selected"; ?> value="Sí">Sí</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-certificadoenergetico', true) == "No") echo "selected"; ?> value="No">No</option>
            </select>
            <label for="CE">
              <span>Certificado energetico</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">
          <select class="js-choice question" onchange="editar(event)" id="PI" name="inmueble-tipo" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true); ?>">
            <option value="">Tipo de inmueble</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Piso") echo "selected"; ?> value="Piso">Piso</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Casa") echo "selected"; ?> value="Casa">Casa</option> 
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Atico") echo "selected"; ?> value="Atico">Atico</option>          
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Chalet Independiente") echo "selected"; ?> value="Chalet Independiente">Chalet Independiente</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Chalet Pareado") echo "selected"; ?> value="Chalet Pareado">Chalet Pareado</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Chalet Adosado") echo "selected"; ?> value="Chalet Adosado">Chalet Adosado</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Garaje") echo "selected"; ?> value="Garaje">Garaje</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) == "Trastero") echo "selected"; ?> value="Trastero">Trastero</option>
            </select>
            <label for="PI">
              <span>Tipo Inmueble</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">

          <select class="js-choice question" onchange="editar(event)" id="AS" name="inmueble-ascensor">
            <option value="">Ascensor</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-ascensor', true) == "Sí") echo "selected"; ?> value="Sí">Sí</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-ascensor', true) == "No") echo "selected"; ?> value="No">No</option>
            </select>
            <label for="AS">
              <span>Ascensor</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">
          <select class="js-choice question" onchange="editar(event)" id="AS" name="inmueble-garaje">
            <option value="">Garaje</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-garaje', true) == "Sí") echo "selected"; ?> value="Sí">Sí</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-garaje', true) == "No") echo "selected"; ?> value="No">No</option>
            </select>
           
            <label for="GA">
              <span>Garaje</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">
          <select class="js-choice question" onchange="editar(event)" id="TR" name="inmueble-trastero">
            <option value="Trastero"></option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-trastero', true) == "Sí") echo "selected"; ?> value="Sí">Sí</option>
            <option <?php if (get_post_meta($inmueble->ID, 'meta-inmueble-trastero', true) == "No") echo "selected"; ?> value="No">No</option>
            </select>
            
            <label for="TR">
              <span>Trastero</span>
            </label>
          </div>
        </form>
        <form>
          <div class="first-block formulario">
            <input
              type="text"
              value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true); ?>"
              name="inmueble-precioestimado"
              class="question"
              placeholder=""
              id="PR"
              required
              autocomplete="off"
              onchange="editar(event)"
            />
            <label for="PR">
              <span>PRECIO DE VENTA</span>
            </label>
          </div>
        </form>
      </div>
      <div class="colum-rigth">
        <h3>Resumen Inmueble</h3>
<?php
$photos = get_post_meta($inmueble_id, 'meta-photos-inmueble', $movefile);
if (count($photos) > 0) {
?>
        <div class="photos splide">
          <div class="splide__track">
            <ul class="splide__list">
<?php



foreach ($photos as $key => $photo) {
?>
        <li class="splide__slide"><img src="<?php echo $photo['url']; ?>" width="100%" /></li>


<?php
}
?>
            </ul>
          </div>
        </div>
        <hr />

<?php
}
?>
        <form>
          <div class="sec-block formulario">
            <textarea
              name="inmueble-descripcion"
              rows="2"
              class="question"
              placeholder=""
              id="msg"
              required
              autocomplete="off"
              onchange="editar(event)"
            ><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-descripcion', true); ?></textarea>
            <label for="msg">
              <span>Describa su Inmueble:</span>
            </label>
          </div>
        </form>
      </div>
    </div>
    <div class="bg-fotos">
      <div class="btn-imagenes">
        <h2>
          Fotografias
          <hr />
        </h2>
        <div class="fotos">
          <div class="card-scroller">
<?php

$photos = get_post_meta($inmueble_id, 'meta-photos-inmueble', $movefile);


foreach ($photos as $key => $photo) {
?>


            <div class="card">
              <img src="<?php echo $photo['url']?>" alt="<?php echo basename($photo['url'])?>" style="width: 100%" />
              <div class="container">
                <span><b><?php echo basename($photo['url'])?></b></span>
              </div>
            </div>

<?php


}

?>


          </div>
        </div>
        <input type="file" class="filepond">
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
    FilePond.registerPlugin(FilePondPluginFileRename);
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.setOptions({
      server: '/file-upload?action=upload-photo-inmueble&inmueble_id=<?php echo $_GET["inmueble_id"] ?>',
      fileRenameFunction: file => new Promise(resolve => {
        resolve(window.prompt('Introduce un nombre descriptivo', file.name) + file.extension)
      })

    });
    var inputElement = document.querySelector('input[type="file"]');
    var pond = FilePond.create( inputElement );
    var pondevent = document.querySelector('.filepond--root');
    pondevent.addEventListener('FilePond:processfile', function () {window.location.reload()});

    new Splide( '.splide', {
      rewind: true,
      autoplay: true,
      cover: true,
      fixedHeight: 300
    } ).mount();


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
</script>
<?php
get_footer();