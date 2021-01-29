//TODO: replace with initials extraction logic.
var initials = "MM";
var colors = ["#007bff", "#6610f2", "#6f42c1", "#e83e8c", "#dc3545", "#fd7e14", " #ffc107", " #28a745", "#20c997", "#17a2b8", "#fff", "#6c757d", "#343a40", " #007bff", "#6c757d", "#343a40", "#007bff", "#6c757d", "#28a745", "#17a2b8", "#dc3545", " #f8f9fa", " #343a40"];

function creaImagen(initials, color) {

    // Create a rectangular canvas which will become th image.
    var canvas = document.createElement("canvas");
    var context = canvas.getContext("2d");
    canvas.width = canvas.height = 100;

    // Draw the circle in the background using the color.
    context.fillStyle = color;
    context.beginPath();
    context.ellipse(
        canvas.width / 2, canvas.height / 2, // Center x and y.
        canvas.width / 2, canvas.height / 2, // Horizontal and vertical "radius".
        0, // Rotation, useless for perfect circle.
        0, Math.PI * 2 // from and to angle: Full circle in radians.
    );
    context.fill();

    context.font = (canvas.height / 2) + "px roboto";
    context.fillStyle = "#fff";
    // Make the text's center overlap the image's center.
    context.textAlign = "center";
    context.textBaseline = "middle";
    context.fillText(initials, canvas.width / 2, canvas.height / 1.9);

    return canvas.toDataURL();
}
document.body.onload = function() {
    var nombre = document.querySelector("#user-name-and-lastname").value;
    var iniciales = nombre.split(' ')[0][0] + nombre.split(' ')[1][0];
    if (!iniciales) return;
    var imgs = document.querySelectorAll("img.user-logo-auto");
    for (var i = 0; i < imgs.length; i++) {
        imgs[i].src = creaImagen(iniciales.toUpperCase(), colors[nombre.length % colors.length]);
    }
}