<?php
/**
 * Template Name: page-mensajes.html
 * The template for displaying mensajes.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/mensajes.css">';
}
add_action('wp_head', 'myCss');

$selected_user_id = 1;

get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="chat">
            <div class="contactos">
                <?php
foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user) {
                ?>
                <div class="contacto" id="user-<?php echo $user->ID ?>" onclick="setUserId(<?php echo $user->ID ?>)">
                    <img class="contacto-img" src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" />
                    <div class="contacto-name"><?php echo $user->display_name; ?></div>
                    <div class="contacto-unread"></div>
                </div>
                <?php
    $selected_user_id = $user->ID;
}
                ?>
            </div>
            <div class="mensajes-enviar">
                <div class="mensajes">

                </div>
                <div class="enviar">
                    <textarea id="msg"></textarea>
                    <button onclick="enviarMsg()">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var contactos = document.querySelectorAll(".contacto");
        for (var i = 0; i < contactos.length; i++) {
            var name = contactos[i].querySelector(".contacto-name").textContent;
            var img = contactos[i].querySelector(".contacto-img");
            img.src = window.creaImagen(name);
        }

        cargaMensajes();
    }, false);

var userId = <?php echo $selected_user_id ?>;
function setUserId(uid) {
    userId = uid;
}

function cargaMensajes() {

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/chat-xhr?action=get_messages");
    xhr.onload = function () {
        var msgs = JSON.parse(xhr.response);
        document.querySelector(".mensajes").innerHTML = "";
        document.querySelector("#msg").value = "";
        
        if (userId && msgs[userId]) {
            for (var i = 0; i < msgs[userId].length; i++) {
                if (!msgs[userId][i].name) continue
                var container = document.createElement("div");
                container.classList.add("mensaje");
                container.classList.add(msgs[userId][i].user);

                var author = document.createElement("div");
                author.classList.add("author");

                var authorImg = document.createElement("img");
                authorImg.classList.add("author-img");
                authorImg.src = window.creaImagen(msgs[userId][i].name);

                var authorName = document.createElement("div");
                authorName.classList.add("author-name");
                authorName.textContent = msgs[userId][i].name;

                author.appendChild(authorImg);
                author.appendChild(authorName);

                container.appendChild(author);

                var mensajeTxt = document.createElement("div");
                mensajeTxt.textContent = msgs[userId][i].message;
                mensajeTxt.classList.add("mensaje-txt");

                container.appendChild(mensajeTxt);


                document.querySelector(".mensajes").appendChild(container);
                document.querySelector(".mensajes").scrollTop = document.querySelector(".mensajes").scrollHeight;
                

            }
        }
    }
    xhr.send();
}

function enviarMsg() {
    var txt = document.querySelector("#msg");

    var fd = new FormData();
    fd.append("message", txt.value);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/chat-xhr?action=put_messages&user_id=" + userId);

    xhr.onload = cargaMensajes;
    xhr.send(fd);

}


</script>

<?php
get_footer();