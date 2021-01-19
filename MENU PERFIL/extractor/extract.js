const { JSDOM } = require('jsdom');
const fs = require("fs");

var beautify_html = require('js-beautify').html;

async function taka() {
    const options = {
        resources: 'usable',
    };

    var allFiles = fs.readdirSync(process.cwd() + "/");

    var allHTML = allFiles.filter(f => f.endsWith(".html"));

    for (let i = 0; i < allHTML.length; i++) {
        const htmlFile = allHTML[i];

        const dom = await JSDOM.fromFile(process.cwd() + '/' + htmlFile, options);

        const contentDiv = dom.window.document.querySelector("DIV.main");

        if (contentDiv) {
            Array.from(contentDiv.querySelectorAll("IMG[src]")).map(img => {
                const nameImg = img.src.split("/");
                img.src = "<?php echo get_template_directory() . '/assets/img/'?>" + nameImg[nameImg.length - 1];
            });


            var template = `<?php
/**
 * Template Name: ${'page-' + htmlFile.toLowerCase()}
 * The template for displaying ${htmlFile.toLowerCase()}
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/${htmlFile.toLowerCase().replace(/\.html$/, '.css')}">';
}
add_action('wp_head', 'myCss');


get_header();
?>

    <main id="primary" class="site-main">
        ${beautify_html(contentDiv.outerHTML)}
    </main><!-- #main -->

<?php
get_footer();`


            fs.writeFileSync(process.cwd() + '/extractor/extraction/page-' + htmlFile.toLowerCase() + ".php", beautify_html(template));
        }

    };
}

taka();