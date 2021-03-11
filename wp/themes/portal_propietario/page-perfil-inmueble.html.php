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

    
}
add_action('wp_head', 'myCss');

$inmueble = get_post($_GET["inmueble_id"]);


get_header();
?>

<main id="primary" class="site-main">

    
<div class="main">
            <div class="main-datos">
                <div class="texto">
                  <h3>Datos del Inmueble </h3>
                  <hr />
                  <div class="datos-inmuebles">
                    <h4>Piso en Calle Fermin Muruguja, 24(28006)</h4>
                    <h4>Madrid</h4>
                    <p>120m2 - 3Hab. - Atico Exterior</p>
                  </div>
                </div>
                <div class="precios">
                  <div class="venta">
                    <h1>198.000€</h1>
                    <p>Precio de Venta</p>
                  </div>
                  <div class="valoracion">
                    <h1>156.000€</h1>
                    <p>Precio Recomendado</p>
                  </div>
                </div>
              </div>
            <div class="perfil-inmueble">
                <div class="colum-left">
                    <h2>Perfil Inmueble</h2>
                    <hr>
                    <div class="img-home">
                        <img src="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-foto-principal', true); ?>" width="100%">
                    </div>
                    <h3>CARACTERISTICAS</h3>
                    <hr>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2utiles', true); ?>" name="name" class="question" placeholder="" id="MU" required
                                autocomplete="off" />
                            <label for="MU">
                                <span>Metros Utiles</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true); ?>" name="name" class="question" placeholder="" id="MC" required
                                autocomplete="off" />
                            <label for="MC">
                                <span>Metros Construido</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-equipamiento', true); ?>" name="name" class="question" placeholder="" id="AM" required
                                autocomplete="off" />
                            <label for="AM">
                                <span>Amueblado</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-certificadoenergetico', true); ?>" name="name" class="question" placeholder="" id="CE" required
                                autocomplete="off" />
                            <label for="CE">
                                <span>Certificado energetico</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true); ?>" name="name" class="question" placeholder="" id="PI" required
                                autocomplete="off" />
                            <label for="PI">
                                <span>Piso</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-ascensor', true); ?>" name="name" class="question" placeholder="" id="AS" required
                                autocomplete="off" />
                            <label for="AS">
                                <span>Ascensor</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-garaje', true); ?>" name="name" class="question" placeholder="" id="GA" required
                                autocomplete="off" />
                            <label for="GA">
                                <span>Garaje</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-trastero', true); ?>" name="name" class="question" placeholder="" id="TR" required
                                autocomplete="off" />
                            <label for="TR">
                                <span>Trastero</span>
                            </label>
                        </div>
                    </form>
                    <form>
                        <div class="first-block formulario">
                            <input type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true); ?>" name="name" class="question" placeholder="" id="PR" required
                                autocomplete="off" />
                            <label for="PR">
                                <span>PRECIO DE VENTA</span>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="colum-rigth">
                    <h3>Resumen Inmueble</h3>
                    <img src="casa1.jpg" width="100%">
                    <hr />
                    <form>
                        <div class="sec-block formulario">
                            <textarea name="message" rows="2" class="question" placeholder="" id="msg" required
                                autocomplete="off">
                                <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-descripcion', true); ?>
                              </textarea>
                            <label for="msg">
                                <span>Describa su Inmueble:</span>
                            </label>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class=bg-fotos>
                <div class="btn-imagenes">
                  <h2>Fotografias <input class="botons editar" type="submit" value="EDITAR"> <input class="botons" type="submit"
                      value="EXAMINAR"> <input class="botons guardar" type="submit" value="GUARDAR">
                    <hr />
                  </h2>
                  <div class="fotos">
                    <div class="card-scroller">
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa2.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Lateral casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa3.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Interior casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa4.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Jardin casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                      <div class="card">
                        <img src="casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                          <span><b>Frontal casa</b></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
  
  var elem = document.querySelector('input#datepicker');
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
          var elem = document.querySelector('input[name="owner-birth-date"]');
          elem.value = moment(date).format();
          return moment(date).format('D MMMM YYYY');
      },
    }
  }); 
</script>
<?php
get_footer();