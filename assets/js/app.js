import $ from "jquery";
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import "./common";
// any CSS you import will output into a single css file (app.css in this case)
import "../scss/app.scss";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log("***********************************");
console.log("************( ^)< MIAOU************");
console.log("**********( <  )*******************");
console.log("***********// \\\\**** BY AgorW******");
console.log("***********************************");

let codePostal = document.getElementById("profil_code_postal");
let pays = document.getElementById("profil_pays");
let ville = document.getElementById("profil_ville");
codePostal.addEventListener("change", function () {
  if (codePostal.value != "") {
    let ajax = new XMLHttpRequest();
    ajax.responseType = "json";
    ajax.open("GET", "http://api.zippopotam.us/fr/" + codePostal.value);
    ajax.send();
    ajax.onload = () => {
      let data = ajax.response;
      console.log(data);
      pays.value = data.country;
      let i = 0;
      ville.innerHTML = "<option value='select'>Selectionnez </option>";
      for (let item in data.places) {
        ville.innerHTML +=
          "<option value='" +
          data.places[i]["place name"] +
          "'>" +
          data.places[i]["place name"] +
          "</option>";
        i++;
      }
    };
  }
});
