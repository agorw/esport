import $ from "jquery";

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