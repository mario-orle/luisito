window.initChoices = function () {
    var choicesObjs = document.querySelectorAll('.js-choice,.js-choices');
    var choices = [];
    for (var i = 0; i < choicesObjs.length; i++) {
      choices.push(new Choices(choicesObjs[i], {
        itemSelectText: 'Click para seleccionar',
        searchEnabled: false,
        shouldSort: false
      }));
    }
    window.choicesObjs = choices;
  }
  
  document.addEventListener('DOMContentLoaded', function () {
    window.initChoices();
  }, false);