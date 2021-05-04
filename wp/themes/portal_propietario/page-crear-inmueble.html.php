<?php
/**
 * Template Name: page-crear-inmueble.html
 * The template for displaying crear-inmueble.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */


require_once "self/security.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$inmueble) {
      $user_id = get_current_user_id();
      if (current_user_can('administrator') && !empty($_GET['user'])) {
        $user_id = $_GET['user'];
      } else if (empty($_GET['user'])) {
        $user_id = wp_get_current_user()->ID;
        $_GET['user'] = $user_id;
      }
      
      $inmueble_id = wp_insert_post(array(
          'post_type' => 'inmueble',
          'post_title' => 'inmueble-' . $user_id,
          'post_status' => 'publish',
          'post_author' => $user_id
      ));
  
      foreach ($_POST as $key => $value) {
        update_post_meta($inmueble_id, 'meta-' . $key, wp_slash($value));
      }
      
    }
    
    wp_redirect("/perfil-inmueble?inmueble_id=" . $inmueble_id);

} else {
function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/perfil.css?cb=' . generate_random_string() . '">';

    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/css/datepicker.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/datepicker-full.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/locales/es.js"></script>';
    echo '<script src="'.get_bloginfo('stylesheet_directory').'/assets/ext/moment.min.js?cb=' . generate_random_string() . '"></script>';
    echo '<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>';

    
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">

    
    <div class="main">
    <form id="regForm" method="POST" enctype="multipart/form-data">
      <h1>Inmueble</h1>
        <div class="tab">Localización Inmueble:
          <p><input placeholder="Provincia..." oninput="this.className = ''" name="inmueble-provincia"></p>
          <p><input placeholder="Municipio..." oninput="this.className = ''" name="inmueble-municipio"></p>
          <p><input placeholder="Población..." oninput="this.className = ''" name="inmueble-poblacion"></p>
          <p><input validators="numeric" placeholder="Codigo postal..." oninput="this.className = ''" name="inmueble-codigopostal" type="number"></p>
          <p><input placeholder="Dirección..." oninput="this.className = ''" name="inmueble-direccion"></p>
        </div>
        <div class="tab" >Situación Inmueble:
          <p><select onchange="changeTipo(event)" class="js-choice" name="inmueble-tipo">
            <option value="">Tipo de inmueble</option>
            <option value="Piso">Piso</option>
            <option value="Casa">Casa</option> 
            <option value="Atico">Atico</option>          
            <option value="Chalet Independiente">Chalet Independiente</option>
            <option value="Chalet Pareado">Chalet Pareado</option>
            <option value="Chalet Adosado">Chalet Adosado</option>
            <option value="Garaje">Garaje</option>
            <option value="Trastero">Trastero</option>
            </select></p>
          <p><select class="js-choice" name="inmueble-estado">
            <option value="">Estado Inmueble</option>
            <option value="Buen estado">Buen estado</option>
            <option value="A Estrenar">A Estrenar</option>           
            <option value="A Reformar">A Reformar</option>
            <option value="Reformado">Reformado</option>
            </select></p>
          <p><select class="js-choice" name="inmueble-equipamiento">
            <option value="">Equipamiento</option>
            <option value="Amueblado">Amueblado</option>
            <option value="Semi-Amueblado">Semi-Amueblado</option>           
            <option value="Sin Amueblar">Sin Amueblar</option>
            </select></p>
          <p><select class="js-choice" name="inmueble-destino">
            <option value="">Fin del inmueble</option>
            <option value="Venta">Venta</option>
            <option value="Alquiler">Alquiler</option>           
            </select></p>
          <p><input placeholder="Otros..." class="not-required" name="inmueble-otros"></p>
        </div>
        <div class="tab">Superficie y características inmueble:
          <p><input validators="numeric" placeholder="Metros2 Construidos..." oninput="this.className = ''" name="inmueble-m2construidos" type="number"></p>
          <p><input validators="numeric" placeholder="Metros2 Utiles..." oninput="this.className = ''" name="inmueble-m2utiles" type="number"></p>
          <p class="solochalet solopiso"><input class="not-required" placeholder="Habitaciones..." oninput="this.className = ''" name="inmueble-habitaciones" type="number" min="1" max="10"></p>
          <p class="solochalet"><input class="not-required" placeholder="Superficie Parcela ..." oninput="this.className = ''" name="inmueble-superficie-parcela" type="number"></p>
          <p><label for="garaje">Garaje</label><input name="inmueble-garaje" id="garaje" class="not-required" type="checkbox"></p>
          <p class="solopiso"><label for="ascensor">Ascensor</label><input class="not-required" name="inmueble-ascensor" id="ascensor" type="checkbox"></p>
          <p class="solopiso"><label for="trastero">Trastero</label><input class="not-required" name="inmueble-trastero" id="trastero" type="checkbox"></p>
        </div>
        <div class="tab">Precio estimado y foto principal
          <p><input placeholder="Precio estimado..." oninput="this.className = ''" name="inmueble-precioestimado" type="number"></p>
        </div>
        <div style="overflow:auto;">
          <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
          </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>
      </form>
    </div>
</main><!-- #main -->
<script src="<?php echo get_bloginfo('stylesheet_directory').'/assets/js/validator.js'; ?>"></script>
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
  
  var elem = document.querySelector('input#datepicker');
  if (elem) {
    var datepicker = new Datepicker(elem, {
      autohide: true,
      language: 'es',
      maxDate: new Date(new Date().getFullYear() - 18, 1, 1),
      weekStart: 1,
      format: {
        toValue(date, format, locale) {
            return moment(date, 'D MMMM YYYY');;
        },
        toDisplay(date, format, locale) {
            var elem = document.querySelector('input[name="inmueble-owner-birth-date"]');
            elem.value = moment(date).format();
            return moment(date).format('D MMMM YYYY');
        },
      }
    });
  }
  
  var foto = document.querySelector("#foto");
  foto.onchange = function () {
    if (foto.files && foto.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      document.querySelector("#foto-preview").style.display = "block";
      document.querySelector("#foto-preview img").src = e.target.result;
    }
    
    reader.readAsDataURL(foto.files[0]); // convert to base64 string
  }
  }

  function changeTipo(e) {
    document.querySelectorAll('.solochalet').forEach(e => e.style.display='none');
    document.querySelectorAll('.solopiso').forEach(e => e.style.display='none');
    if (e.detail.value === "Piso" || e.detail.value === "Atico") {
      document.querySelectorAll('.solopiso').forEach(e => e.style.display='block'); 
    } else if (e.detail.value === "Casa" || e.detail.value.indexOf("Chalet") === 0) {
      document.querySelectorAll('.solochalet').forEach(e => e.style.display='block'); 

    }
  }
</script>
<?php
get_footer();
}