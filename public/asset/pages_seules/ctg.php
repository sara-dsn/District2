
<div class="row d-flex justify-content-center ml-3 mr-3" >
               
               <div id="gg" class="row justify-content-center mt-4"></div>
               
           
            <div class="w-100 d-flex row">
                 <div class="row justify-content-center " id="afficher"></div>
              
            </div>
            <div class="col-12 text-center" > <a type="submit" id="bottom" href="categorie.php" class="btn btn-dark t text-center mt-4" >Précedent</a></div>
        </div>
        <div id="visible">
            <div class="col-12 d-flex justify-content-center">
              <h1 class="font-weight-bold font-italic">Nos Catégories </h1>
          </div>
            <div class="w-100 row d-flex justify-content-center">
                <div class="col-3 d-none d-md-block">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            <img src="asset/cat.fond/cuisinier.png" class="card-img-top img-fluid" alt="Cuisinier">
                       </div>
                  </div>
                </div>
            
                <div class="row col-12 col-md-9 mr-2" id="categorie"></div>
            </div>
        
            <div class="d-flex justify-content-between mt-4">
                <a type="submit" href="index.php" class="btn btn-dark t" >Précedent</a>
                <a type="submit" href="plats.php" class="btn btn-dark t" >Suivant</a>
            </div>
        </div>
        <?php
        include('footer.php');
        ?>
         </div>
         <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
        
         <script>
            
$(document).ready(function(){
    var btn=$("#bottom");
    var visible=$("#visible");
    var test=$("#gg"); 
      var a = $("#afficher");
   var affichage=$("#plats");
   btn.hide();
$.getJSON("plat.json", function(json){
 
    var ctg=json.categorie;
var plt=json.plat;


    for (i=0;i<ctg.length;i++){
var item=ctg[i];
var resultat=$( `<div class="t  card custom-card ml-4 col-12 col-md-3  mb-4 ">
                <img class="card-img-top img-fluid taille" src="asset/category/${item.image}" alt="${item.libelle}">
                <div class="card-body ">
                    <h3  value="${item.id_categorie}" class="card-title titre  text-center font-weight-bold font-italic id">${item.libelle}</h3>
                
                    <span class="stock text-danger "><span>
                </div>
            </div>`);
affichage.append(resultat);

var stock = resultat.find(".stock");
    stock.text(item.active === 'Yes' ? '' : 'Disponible prochainement');
    };
   
         
            $(".card").click(function () {
               
    var id=$(this).find(".id").attr("value");
              plat(id);
       
             
             
          });

          function plat(id){
            btn.show();
         test.empty();
         
            $.each(plt, function (element, uno) {
                var idcat=uno.id_categorie;
                if (idcat == id){ 
                            var t =$(  ` 
                        <div class="card col-12 col-md-3 mx-2 mb-3 ">
                            <img class="card-img-top img-fluid himg" src="asset/food/${uno.image}" alt="${uno.libelle}">
                            <div class="card-body ">
                                <h5 class="card-title font-weight-bold font-italic">${uno.libelle}</h5>
                                <p class="card-text text-center">${uno.description} <br> Menu: ${uno.prix} € </p>
                               <span class="stock2 text-danger"><span>
                                
                                
                            </div><div class="mt-auto mb-2 text-center"><a href="commande.php" class="btn btn-warning  text-center t">Commander</a></div>
                        </div> `);
                        
                     
visible.hide();

                            test.append(t);
                            var stock = t.find(".stock2");
    stock.text(uno.active === 'Yes' ? '' : 'Disponible prochainement');
                           
                };
                
                
                        });
          };
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
                        btn.show();
                       
                          a.empty();
                          var visible=$("#visible");
                         
                        visible.hide();
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
                                  <div class="card col-12 col-md-3 mx-1 ">
                                      <img class="card-img-top img-fluid himg"  src="asset/food/${uno.image}" alt="${uno.libelle}">
                                      <div class="card-body ">
                                          <h5 class="card-title font-weight-bold font-italic ">${uno.libelle}</h5>
                                          <p class="card-text  text-center">${uno.description} <br> Menu: ${uno.prix} €   </p> 
                                        <span class="stock5 text-danger"><span>  
                                        
                                              

                                      </div><div class="mt-auto mb-2 text-center"><a href="commande.php" class="btn btn-warning  text-center t">Commander</a></div>
                                  </div>`);
            
                                      a.append(txt);
                                      var stock = txt.find(".stock5");
    stock.text(uno.active === 'Yes' ? '' : 'Disponible prochainement');
                                  });
            
                                  rechercher(input);
            
                            };
                        });
                      };
                      
                    });
});




 
        </script>
</body>

</html> -->