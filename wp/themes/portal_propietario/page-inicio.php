<?php
/**
 * Template Name: INDEX
 * The template for displaying index
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

get_header();
?>

	<main id="primary" class="site-main">
  <div class="main">
      <div class="main-container">
        <div class="slider">
          <div class="slideshow-container">

            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
              <div class="numbertext">1 / 3</div>
              <img src="casa1.jpg" style="width:100%;height: 255px;">
              <div class="slidertext">FRONTAL CASA</div>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">2 / 3</div>
              <img src="casa2.jpg" style="width:100%;height: 255px;">
              <div class="slidertext">FRONTAL CASA</div>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">3 / 3</div>
              <img src="casa3.jpg" style="width:100%;height: 255px;">
              <div class="slidertext">FRONTAL CASA</div>
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
          </div>
          <br>

         
        </div>
        <div class="inmuebles">
          <div class="text-inmuebles">
            <h2>RESUMEN INMUEBLE</h2>
            <ul>
              <li>ESTADO DE VENTA/ALQUILE</li>
              <li>ESTADO DOCUMENTACIÓN</li>
              <li>DETALLES ASESOR</li>
            </ul>
          </div>
        </div>

        <div class="grafica">
          <div class="text-grafica">
            <h2>GRAFICA</h2>
            <ul>
              <li>VISITAS AL INMUEBLE</li>
              <li>CITAS SOLICITADAS</li>
            </ul>
          </div>
        </div>
      </div>
        <div class= "main-container">
          <div class="main-calendar">
            <div id="foo" ></div>
          </div>
        <div class="chat">
          <div class="textchat">
            <h2>CHAT</h2>
            <ul>
              <li>CHAT ASES0R</li>
            </ul>
          </div>
        </div>
    </div>

  </div>
	</main><!-- #main -->

<?php
get_footer();
