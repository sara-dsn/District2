$(document).ready(function () {

    var btn=$("#bottom"); 
    var aff=$("#plats");
    var visible=$("#visible");
    var a = $("#afficher");
    var form=$("#ff");
    var test=$("#gg");
    var titre=$("#titre");
    var affiche = $("#txt");
    var pp=$("#pp");
    var affichage = $("#categorie");
    var tel=$("#smm");
    var btn2=("#btnplt");
form.hide();
pp.hide();
titre.hide();
btn.hide();
var quantityInput = document.getElementById('quantity');
var btnPlus = document.getElementById('btn-plus');
var btnMinus = document.getElementById('btn-minus');


// selecteur quantité :
btnPlus.addEventListener('click', function() {
quantityInput.value = parseInt(quantityInput.value) + 1;
});

btnMinus.addEventListener('click', function() {
if (parseInt(quantityInput.value) > 1) {
quantityInput.value = parseInt(quantityInput.value) - 1;
}
});

$.getJSON("plat.json", function (json) {
  
         var ctg = json.categorie;
         var plt = json.plat;
   
// BARRE DE RECHERCHE:  
    
$("#btn").click(function () {

search();

});

$("#recherche").on("keypress", function (e) {

if(e.which===13){
e.preventDefault();
search();
};
}); 

function search() {

a.empty();
test.empty();
visible.hide();
btn.show();
titre.hide();
pp.empty();
form.hide();
var input = $("#recherche").val();

$.getJSON("plat.json", function (json) {
 var plt = json.plat;
 


     var pla = plt.filter(function (p) {
         return p.libelle.toLowerCase().includes(input.toLowerCase());
     });  
 


 miseajour(pla);

 function miseajour(result) {
     
     $.each(result, function (element, uno) {
         var txt = $( ` 
     <div class="card   col-10 col-md-2 mx-1  ">
         <img class="card-img-top rounded img-fluid himg" src="asset/food/${uno.image}" alt="${uno.libelle}">
         <div class="card-body font-italic ">
             <h5 class="card-title  font-weight-bold ">${uno.libelle}</h5>
             <p class="card-text ">${uno.description} <br> Menu: ${uno.prix} € </p>
         </div> <div class="mt-auto mb-2 text-center"><a href="{{path('app_commande')}}&id=${uno.id_plat}" value="${uno.id_plat}" class="btn btn-warning di t">Commander</a></div>
     </div>`);
         a.append(txt);
     });
 }

});
};
   
     //  PLATS AFFICHAGE SELON CATEGORIE CLIQUÉE:                
$(".cat").click(function () {
var id=$(this).find(".id").attr("value");
       plat(id);
       btn.show();

   });
   function plat(id){
  test.empty();
  a.empty();
  pp.empty();

     $.each(plt, function (element, uno) {
         var idcat=uno.id_categorie;
         if (idcat == id){ 
                     var t = $( ` 
                 <div class="card size col-12 col-md-3 ml-3 mx-1 ">
                     <img class="card-img-top rounded himg img-fluid"  src="asset/food/${uno.image}" alt="${uno.libelle}">
                     <div class="card-body font-italic">
                         <h5 class="  card-title font-weight-bold ">${uno.libelle}</h5>
                         <p class="card-text ">${uno.description} <br> Menu: ${uno.prix} € </p>
                         
                     </div><div class="mt-auto mb-2 text-center"><a href="{{path('app_commande')}}&id=${uno.id_plat}" value="${uno.id_plat}" class="btn btn-warning di t">Commander</a></div>
                 </div> 
                 
`);
visible.hide();
test.append(t);
};
});
};})});