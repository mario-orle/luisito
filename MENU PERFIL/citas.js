

var fechas = [new Date(2020, 11, 12), new Date(2020, 11, 13), new Date(2020, 11, 14),new Date(2020, 11, 15), new Date(2020, 11, 18)];



const elem = document.getElementById('foo');
const datepicker = new Datepicker(elem, {
  maxNumberOfDates: 1,
  weekStart: 1,
  language: 'es'
  // ...options
});

datepicker.setDate( ...fechas );

const containerCitasProgramadas = document.getElementById("citas-programadas");

fechas.map(fecha => {
  
  containerCitasProgramadas.innerHTML += "<li><a>" + fecha.getDate() + "/" + (fecha.getMonth() + 1) + "</a> 12-DICIEMBRE 18:30 JOSECARLOS</li>";;

});