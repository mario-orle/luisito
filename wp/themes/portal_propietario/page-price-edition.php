<?php
/**
 * Template Name: page-admin-asesor.html
 * The template for displaying admin-asesor.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

include_once "self/graph-raw.php";
include_once "self/graph-stuff.php";
include_once "self/schema-raw.php";


function myCss() {
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/json-editor/2.5.4/jsoneditor.js" integrity="sha512-9bJkXpGLgRZNxbRXoeGekuQB6Ea7Z0R7BrBRiCP16F8HEPHfjh4B3GjbCditEB4xeBXIKRuAC6KosK/oKDxxgQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';

}
add_action('wp_head', 'myCss');

$ccaaelegida = $_GET["ccaa"];
$provinciaelegida = $_GET["provincia"];
$municipioelegido = $_GET["municipio"];
$poblacionelegida = $_GET["poblacion"];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && current_user_can('administrator')) {

    $entityBody = file_get_contents('php://input');

    saveGraphDataById($poblacionelegida ?: $municipioelegido ?: $provinciaelegida ?: $ccaaelegida, json_decode($entityBody, true));

}

function selectLocationCreate($field, $values, $label = '', $fn = "editar", $selected) {
?>
    <label for="<?php echo $field; ?>"><?php echo $label ?: $field; ?></label>
    <select class="controls js-choices" onchange="<?php echo $fn ?>(event)">
        <option value="">Elige</option>
<?php
foreach ($values as $key => $value) {
?>
        <option <?php if ($selected == $value["id"]) { echo 'selected="selected"'; }?> value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
<?php
}
?>
    </select>
<?php
}


get_header();
?>

<main id="primary" class="site-main" style="padding-left: 300px; padding-top: 150px;">
    <div>
<?php 
    $ccaas = (getCCAA());
    selectLocationCreate("ccaa", $ccaas, "CCAA", "editarCCAA", $ccaaelegida);
?>
    </div>
<?php if ($ccaaelegida) { ?>
    <div>
<?php 
    $provincias = (getPROVINCIA($ccaaelegida));
    selectLocationCreate("provincias", $provincias, "Provincia", "editarProvincia", $provinciaelegida);
?>
    </div>
<?php } ?>
<?php if ($ccaaelegida && $provinciaelegida) { ?>
    <div>
<?php 
    $municipios = (getMUNICIPIO($provinciaelegida));
    selectLocationCreate("municipios", $municipios, "Municipio", "editarMunicipio", $municipioelegido);
?>
    </div>
<?php } ?>
<?php if ($ccaaelegida && $provinciaelegida && $municipioelegido) { ?>
    <div>
<?php 
    $poblaciones = (getPOBLACION($municipioelegido));
    if (count($poblaciones) > 0) {
        selectLocationCreate("poblaciones", $poblaciones, "Población", "editarPoblacion", $poblacionelegida);
    }
?>
    </div>
<?php } ?>
<?php if ($ccaaelegida) { ?>
    <button type="button" class="savebutton" onclick="guarda()">Guardar</button>
    <div id="editor"></div>
    <button type="button" class="savebutton" onclick="guarda()">Guardar</button>
<?php } ?>
<script>

const datosElegidos = <?php echo json_encode(getGraphDataById($poblacionelegida ?: $municipioelegido ?: $provinciaelegida ?: $ccaaelegida)); ?>;
const ultimoElemento = datosElegidos[datosElegidos.length - 1];
const schema = <?php echo returnFullDataOfSchema(); ?>;
const container = document.getElementById("editor");
const options = {
    startval: ultimoElemento,
    schema,
    iconlib: "fontawesome4",
    disable_collapse: true,
    disable_array_delete: true,
    disable_array_reorder: true,
    no_aditional_properties: true,
    disable_edit_json: true,
    disable_properties: true,
    form_name_root: ultimoElemento.name,
    show_errors: 'always'
}
const editor = new JSONEditor(container, options)
JSONEditor.defaults.custom_validators.push(function(schema, value, path) {
  var errors = [];
  if(schema.format==="mesano") {

    const [mes, ano] = value.split(' ');
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'Mayo', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    

    if (!meses.includes(mes)) {
        errors.push({
            path: path,
            property: 'format',
            message: 'El mes debe especificarse como \'' + meses.join('\', \'') + '\''
        });
    }
    if (!(ano.length === 4 && !Number.isNaN(ano))) {
        errors.push({
            path: path,
            property: 'format',
            message: 'El año debe especificarse con 4 cifras'
        });
    }
  }
  return errors;
});
function editarCCAA(e) {
    var params = new URLSearchParams(location.search);
    params.set('ccaa', e.detail.value);
    params.delete('provincia');
    params.delete('municipio');
    params.delete('poblacion');
    window.location.search = params.toString();
}
function editarProvincia(e) {
    var params = new URLSearchParams(location.search);
    params.set('provincia', e.detail.value);
    params.delete('municipio');
    params.delete('poblacion');
    window.location.search = params.toString();
}
function editarMunicipio(e) {
    var params = new URLSearchParams(location.search);
    params.set('municipio', e.detail.value);
    params.delete('poblacion');
    window.location.search = params.toString();
}
function editarPoblacion(e) {
    var params = new URLSearchParams(location.search);
    params.set('poblacion', e.detail.value);
    window.location.search = params.toString();
}

function guarda() {
    const errors = editor.validate();
    if (errors.length) {
        alert('Hay errores en los datos, por favor, revise');
        return;
    }
    fetch('', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(editor.getValue())
    }).then(res => res.text());

}

</script>
</main><!-- #main -->

<style>
.je-indented-panel {
    border: none!important;
    border-left: none!important;
}
#editor > .je-object__container {
    border: 5px ridge;
    background: #acacac;
}
.je-child-editor-holder {
    background: #fff;
    padding: 10px;
    border: 2px ridge;
}

#editor input {
    width: 94%;
    padding: 18px;
    display: block;
}
.savebutton {
    display: block;
    cursor: pointer;
    color: #ffffff;
    font-weight: bold;
    text-decoration: none;
    width: 170px;
    margin-top: 15px;
    text-align: center;
    margin-left: auto;
    margin-right: 10px;
    box-shadow: 0px 0px 0px 2px #777;
    background: linear-gradient(to bottom, rgb(128, 123, 123) 5%, rgb(65, 54, 54) 100%);
    background-color: #4c5463;
    border-radius: 5px;
    font-size: 13px;
    padding: 5px 15px;
    text-shadow: 0px 1px 0px #283966;
    height: 30px;
}
</style>
<?php
get_footer();