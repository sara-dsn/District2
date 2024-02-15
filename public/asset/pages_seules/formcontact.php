<!doctype html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/css/style.css">
  <title>Contact</title>
</head>

<body>
  <div class="parallax-body">

    <div class="container-fluid ">

      <?php
        include('header.php');
      ?>
      <div class="w-100 d-flex row">
        <div class="row justify-content-center " id="afficher"></div>
      </div>
      <div class="row d-flex justify-content-center ml-3 mr-3" >        
        <div id="gg" class="row justify-content-center mt-4"></div>
      </div>
      <div class="col-12 text-center"> <a type="submit" id="bottom" href="contact.php" class="btn btn-dark t text-center mt-4" >Précedent</a></div>
      <div id="visible">
    



       <div class="container-fluid col-12 mb-4 mt-1">
          <div class="col-12 d-flex justify-content-center">
            <h1 class="font-weight-bold font-italic">Formulaire de contact </h1>
          </div>
          <div class="row ">
            <div class="col-2 d-none d-md-block ">
              <div class="card border-0 bg-transparent  ">
               <div class="card-body">
                 <img src="asset/cat.fond/cuisinier.png" class="card-img-top img-fluid" alt="Cuisinier">
                </div>
             </div>
            </div>
            <form action="fomulaire.php" method="post" class="col-12 col-md-8">
              <div class="form-row w-100 ">
                <div class="col-12 col-md-6  pl-3 mb-4 mt-4 ">
                 <label class="font-weight-bold font-italic text-right">Nom</label>
                  <input name="nom" type="text" id="n" class="form-control">
                  <div id="nom"class="alert alert-danger border-0 alert-dismissible bg-transparent fade show" role="alert">
                   <strong>Ce champ est obligatoire</strong>
                 </div>
                </div>

                <div class="col-12 col-md-6 mb-4 mt-4">
                  <label class="font-weight-bold font-italic text-right">Prénom</label>
                  <input name="prenom" type="text" id="p" class="form-control">
                  <div id="pre" class="alert alert-danger alert-dismissible bg-transparent border-0 fade show"role="alert">
                    <strong>Ce champ est obligatoire</strong>
                  </div>
                </div>
              </div>
              <div class="form-row w-100">
                <div class="col-12 col-md-6  mb-4 pl-3 mt-4">
                  <label class="font-weight-bold font-italic text-right">Email</label>
                  <input name="email" type="text" id="e" class="form-control">
                 <div id="email" class="alert alert-danger alert-dismissible bg-transparent border-0 fade show" role="alert">
                   <strong>Ce champ est obligatoire</strong>
                  </div>
               </div>
               <div class="col-12 col-md-6    mb-4 mt-4">
                  <label class="font-weight-bold font-italic text-right">Téléphone</label>
                  <input name="telephone" type="text" id="t" class="form-control">
                  <div id="tel"class="alert border-0 alert-danger alert-dismissible bg-transparent fade show" role="alert">
                   <strong>Ce champ est obligatoire </strong>
                 </div>
               </div>
              </div>
              <div class="col-12 form-group ">
                <label class="font-weight-bold font-italic text-right">Votre Demande</label>
                <textarea name="demande" class="form-control mr-4" id="d" rows="4"></textarea>
                <div id="dem" class="alert alert-danger alert-dismissiblaction bg-transparent border-0 fade show" role="alert">
                 <strong>Ce champ est obligatoire</strong>
                </div>
              </div>
              <div class="container-fluid col-12 ">
                <div class=" text-center ">
                  <input name="envoyer" type="submit" id="monbouton" class="btn btn-dark font-weight-bold font-italic text-right t" value="Envoyer">
                </div>
              </div>

            </form>


          </div>
        </div>
      

    
        <div class="d-flex justify-content-between mt-4">
          <a type="submit" href="plats.php" class="btn btn-dark t" >Précedent</a>
          <a type="submit" href="index.php" class="btn btn-dark t" >Suivant</a>
        </div>
      </div>
    </div>
    <?php
      include('footer.php');
    ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    
  <script src="asset/js/script.js"></script>
  <script>
            
    $(document).ready(function(){

      var a = $("#afficher");
      var affichage=$("#plats");
      var visible=$("#visible");
      var a=$("#gg");
    
      var btn=$("#bottom");
      btn.hide();
   

            
      $("#btn").click(function () {
        search();
      
;      });

      $("#recherche").on("keypress", function (e) {
        if(e.which===13){
          e.preventDefault();
          search();
        };
      });

      function search() {
        btn.show(); 
        a.empty();
        
     
        var input = $("#recherche").val();
  
        $.getJSON("plat.json", function (json) {
          var plt = json.plat;

          var pla = plt.filter(function (p) {
            return p.libelle.toLowerCase().includes(input.toLowerCase());
          }); 

          miseajour(pla);

          function miseajour(result) {
                               
            $.each(result, function (element, uno) {
             var txt = $(`<div class="card w-25 mx-1 ">
             <img class="card-img-top img-fluid" src="asset/food/${uno.image}" alt="${uno.libelle}">
             <div class="card-body font-weight-bold font-italic">
              <h5 class="card-title ">${uno.libelle}</h5>
             <p class="card-text">${uno.description} <br> Menu: ${uno.prix} € </p>
             <span class="stock5 text-danger"><span>
          
           

             </div>  <div class="mt-auto mb-2 text-center"> <a href="commande.html" class="btn btn-warning">Commander</a></div>
              </div>`);
            
              a.append(txt);
              var stock = txt.find(".stock5");
    stock.text(uno.active === 'Yes' ? '' : 'Disponible prochainement');
            });
            
                visible.hide();
          };
        });
      };
    });
</script>
</body>

</html>