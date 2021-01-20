function editar(e){
var inputs = e.currentTarget.parentElement.parentElement.querySelectorAll("input[readonly]")
var botonguardar = e.currentTarget.parentElement.querySelector(".guardar");
botonguardar.style.display ="inline-block"
e.currentTarget.style.display ="none"
    console.log(inputs);
    Array.from(inputs).forEach(function (input){
    input.removeAttribute("readonly")
    })
}
function guardar(e){
    var inputs = e.currentTarget.parentElement.parentElement.querySelectorAll("input")
    var botoneditar = e.currentTarget.parentElement.querySelector(".editar");
    botoneditar.style.display ="inline-block"
    e.currentTarget.style.display ="none"
        console.log(inputs);
        Array.from(inputs).forEach(function (input){
        input.setAttribute("readonly","true")
        })
    }
