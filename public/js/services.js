services = {

  allClasses: async function () {
    return $.when($.getJSON('/class'));
  },
  
  allMakes: async function () {
    return $.when($.getJSON('/make'));
  },

  addCar: async function (car) {
    return $.when($.post('/car', car));
  },
  findCarsByPlate: async function(plate) {
    return $.when($.getJSON('/car?plate=' + plate));
  }
};