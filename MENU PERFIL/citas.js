

var fechas = [new Date(2020, 11, 12), new Date(2020, 11, 13), new Date(2020, 11, 14), new Date(2020, 11, 18)];



const elem = document.getElementById('foo');
const datepicker = new Datepicker(elem, {
  maxNumberOfDates: 5
  // ...options
}); 

datepicker.setDate( ...fechas );

const containerCitasProgramadas = document.getElementById("citas-programadas");

fechas.map(fecha => {
  
  containerCitasProgramadas.innerHTML += "<li><a>" + fecha.getDate() + "/" + (fecha.getMonth() + 1) + "</a> Bla bla bla</li>";;

});