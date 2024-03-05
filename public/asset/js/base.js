$(document).ready(function () {

    //alert("abracadabra");
    var btn=$("#bottom"); 
    var btn3=$("#btnplt");
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
    btn3.hide();
    btn.hide();
    $.getJSON("plat.json", function (json) {
        var plt = json.plat;
        var ctg = json.categorie;
        
 
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
            btn3.show();
            a.empty();
            test.empty();
            visible.hide();
            btn.show();
            titre.hide();
            pp.empty();
            form.hide();
            var input = $("#recherche").val();
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
                                <div class="mt-auto  text-center"> <a href="{{ path('add',{'id':${ uno.id }}) }}" id="btnplt" type="submit" value="${ uno.id }" class="btn  col-4 t"><img class="img-fluid " src="{{asset('asset/cat.fond/panierbtn.png')}}" alt="ajouter au panier"></a></div>
                                </div>`);
                    a.append(txt);
                });
            }
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
                            <div class="mt-auto  text-center"> <a href="{{ path('add',{'id':${ uno.id }}) }}" id="btnplt" type="submit" value="${ uno.id }" class="btn  col-4 t"><img class="img-fluid " src="{{asset('asset/cat.fond/panierbtn.png')}}" alt="ajouter au panier"></a></div>
                            </div>`);
                    visible.hide();
                    test.append(t);
                    btn3.show();

                };
            });
        };
    });

    //Formulaire contact 
    $("#monbouton").click(function (e) {
        
        contact(e);
    });

    //Formulaire commande 
    $("#bouton").click(function (e) {
    
        commande(e);
    });



    //Formulaire contact 
    function contact(e) {
    
        // $("#pre").hide();
        // $("#email").hide();
        // $("#tel").hide();
        // $("#dem").hide();
    
    
        var envoi = true;
        var nom = $("#n").val();
        if (nom === "") {
            envoi = false;
            $("#nom").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#nom").hide();
        
        };
        var prenom = $("#p").val();
        if (prenom === "") {
            
            envoi = false;
            $("#pre").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#pre").hide();
    
        };
    
    
        var email = $("#e").val();
        if (email === "") {
            
            envoi = false;
            $("#email").show();
            
            e.preventDefault();
        
        }
        else if (envoi == true) {
            $("#email").hide();
        
        };


        var tel = $("#t").val();
        if (tel === "") {
        
            envoi = false;
            $("#tel").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#tel").hide();
        
        };
        var demande = $("#d").val();
        if (demande === "") {
            envoi = false;
            $("#dem").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#dem").hide();
        
        };
    };





    //Formulaire commande :
    function commande(e) {
    
        var envoi = true;
        
        $("#nompre").hide();
        $("#email").hide();
        $("#tel").hide();
        $("#adresse").hide();

        var nompre = $("#np").val();
        if (nompre === "") {
            envoi = false;
            $("#nompre").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#nompre").hide();
        
        };


        var email = $("#e2").val();
        if (email === "") {
            envoi = false;
            $("#email2").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#email2").hide();
    
        };


        var tel = $("#t2").val();
        if (tel === "") {
            envoi = false;
            $("#tel2").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#tel2").hide();
        
        };

        var adresse = $("#a").val();
        if (adresse === "") {
            envoi = false;
            $("#adresse").show();
            e.preventDefault();
        }
        else if (envoi == true) {
            $("#adresse").hide();
        
        };
    };
});