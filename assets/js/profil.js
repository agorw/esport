/* formulaire profil ajout de la premiere ville et pays france avec code postal */
if (document.getElementById("profil_code_postal")) {
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
      ville.value = data.places[0]["place name"];
    };
  }
});
};
