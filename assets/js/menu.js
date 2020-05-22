import $ from "jquery";

// Changement de la class sur le bouton sidebarCollapse en fonction de la taille de l'écran
// passera de 3x à 2x
function changeSizeBouton() {
  // Détection
  if("matchMedia" in window) { 
    let bouton = document.getElementById("sidebarCollapse");

    // Si l'écran est inférieur à 768px (jusqu'au taille de tablette), alors on remplace la classe "fa-3x" par "fa-2x"
    if(window.matchMedia("(max-width:768px)").matches) {  
      bouton.classList.replace('fa-3x', 'fa-2x');
    } else {
    // Sinon, on clear les classes pour éviter un doublon et on crée la classe "fa-3x"
      bouton.classList.remove("fa-3x", "fa-2x");
      bouton.classList.add("fa-3x");
    }
  }
}
window.addEventListener('resize', changeSizeBouton, false);

// Lorsqu'on clique sur le bouton menu, donne/enleve la classe "active" à sidebar
// Cela permet de la faire apparaitre ou disparaitre
$("#sidebarCollapse").click(function () {
  $("#sidebar").toggleClass("active");
  $("#sidebarCollapse").hide();
});

$("#btn-return").click(function () {
  $("#sidebar").toggleClass("active");
  $("#sidebarCollapse").show();
});