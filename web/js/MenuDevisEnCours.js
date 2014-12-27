define([
    "dojo/_base/declare",
    "dijit/Menu",
    "dijit/MenuItem",
    "dojo/Deferred",    
    "dijit/CheckedMenuItem",
    "dijit/MenuSeparator",
    "dijit/PopupMenuItem",
    "dojo/_base/array",
    'dijit/registry',  
    "dojo/store/Memory",    
    "dojo/_base/lang",
    "dojo/domReady!"
], function(declare,Menu, MenuItem, Deferred, CheckedMenuItem, MenuSeparator, PopupMenuItem,array,registry,Memory,lang){
    function asyncProcess(zone){
        var deferred = new Deferred();
        AjouterOnglet("zoneonglets",zone);        
        setTimeout(function(){
        deferred.resolve("success");
        }, 1000);
        return deferred;
    }      
    return declare("MenuDevisEnCours", Menu,{
        constructor: function(){ 
        },
        postCreate: function(){
            this.inherited(arguments); 
//            this.addChild(new MenuItem({
//                                label: "Ajouter un devis",
//                                onClick: function(){   
//                                            niveau++;                                    
//                                            var selection = grilleorganisations.select.row.getSelected();
//                                            if (selection.length==1){ 
//                                                var idorg = selection[0];                                               
//                                                var nomeorg = grilleorganisations.model.byId(selection).rawData.nom; 
//                                            var parametres_onglet = {
//                                                                        id : "new_devis_"+idorg,
//                                                                        title : "Création d'un nouveau devis de l'organisation : "+nomeorg,
//                                                                        href: "devis/new?idorg="+idorg+"&niveau="+niveau,
//                                                                        closable: true,
//                                                                        selected: true 
//                                                                    }; 
//                                            AjouterOnglet("zoneonglets",parametres_onglet);
//                                            }                                                                                                                              
//                                         }
//                            }));                             
            this.addChild(new MenuItem({
                                label: "Supprimer les devis sélectionnés",
                                onClick: function(){
                                                var lesdevis = grilledevisencours.select.row.getSelected();
                                                var iddossier = null;
                                                array.map(lesdevis, function(iddevis){  
                                                    
                                                    if (iddevis>0) {
                                                        var href = "devis/"+iddevis+"/delete";
                                                        Execute_href("DELETE",href,grilledevisencours);                                                     
                                                    } else {
                                                        iddossier = iddevis;
                                                    }  
                                                })                                               
                                         }
                            }));       
            this.addChild(new MenuItem({
                                label: "Editer le devis",
                                onClick: function(){
                                            niveau++;
                                            var selection = grilledevisencours.select.row.getSelected();
                                            array.map(selection, function(iddevis){  
                                                if (iddevis>0) {
                                                    var reference = grilledevisencours.model.byId(iddevis).rawData.reference; 
                                                    var parametres_onglet = {
                                                                                id : "update_devis_"+iddevis,
//                                                                                id : "update_devis_"+niveau,
                                                                                title : "Edition du devis : "+reference,
                                                                                href: "devis/"+iddevis+"/edit?niveau="+niveau,
                                                                                closable: true,
                                                                                selected: true 
                                                                            };
                                                    AjouterOnglet("zoneonglets",parametres_onglet);                                                 
                                                }
                                            }) 
//                                            if (selection.length==1){ 
//                                                var iddevis = selection[0]; 
//                                                var reference = grilledevis.model.byId(selection).rawData.reference; 
//                                                var parametres_onglet = {
//                                                                            id : "update_devis_"+iddevis,
//                                                                            title : "Edition du devis : "+reference,
//                                                                            href: "devis/"+iddevis+"/edit?niveau="+niveau,
//                                                                            closable: true,
//                                                                            selected: true 
//                                                                        };
//                                            AjouterOnglet("zoneonglets",parametres_onglet);                                                             
//                                            }                                                                                                                              
                                         }
                            }));   
            this.addChild(new MenuItem({
                                label: "Modifier le devis",
                                onClick: function(){
                                            niveau++;                                    
                                            var selection = grilledevisencours.select.row.getSelected();
                                            if (selection.length==1){ 
                                                var iddevis = selection[0]; 
                                                var reference = grilledevisencours.model.byId(selection).rawData.reference; 
                                                var parametres_onglet = {
//                                                                            id : "modifier_devis_"+iddevis,
//                                                                            id : "new_devis_"+grilleorganisations.select.row.getSelected()[0],
//                                                                            id : "modifier_devis_"+iddevis,
                                                                            id : "new_devis_"+niveau,
                                                                            title : "Modification du devis : "+reference,
//                                                                            href: iddevis+"/modifierdevis?niveau="+niveau,
                                                                            href: "devis/new?iddevis="+iddevis+"&niveau="+niveau,                                                                            
                                                                            closable: true,
                                                                            selected: true 
                                                                        };                                                                             
                                            AjouterOnglet("zoneonglets",parametres_onglet);                                        
                                            }                                                                                                                              
                                         }
                            }));          
            this.addChild(new MenuItem({
                                label: "Réception Commande",
                                onClick: function(){
                                            niveau++;                                      
                                            var selection = grilledevisencours.select.row.getSelected();
                                            if (selection.length==1){ 
                                                var iddevis = selection[0]; 
                                                var reference = grilledevisencours.model.byId(selection).rawData.reference; 
                                                var parametres_onglet = {
                                                                            id : "new_commande_"+iddevis,                                                    
//                                                                            id : "reception_commande_"+iddevis,
                                                                            title : "Réception Commande du Devis : "+reference,
//                                                                            href: iddevis+"/receptioncommande",
                                                                            href: "commandes/new?iddevis="+iddevis+"&niveau="+niveau,                                                                           closable: true,
                                                                            selected: true 
                                                                        };  
                                                AjouterOnglet("zoneonglets",parametres_onglet);                                                                          
//                                            var process = asyncProcess(parametres_onglet);
//                                            process.then(function(value){
////                                              Afficher_Produits("produits");
//                                              Afficher_Lignes_Devis("lignesdevis",iddevis);
//                                            },
//                                            function(error){
//                                              console.log('erreur');
//                                            });                                          
                                            }                                                                                                                              
                                         }
                            }));                                
//            this.addChild(new MenuItem({
//                                label: "Dupliquer le devis selectionné",
//                                onClick: function(){
//                                            niveau++;                                    
//                                            var selection = grilledevis.select.row.getSelected();
////                                            array.map(selection, function(devis){                                     
////                                                var href = devis+"/dupliquerdevis";
////                                                Executer_url(href,"POST")      
////                                            });   
//                                          if (selection.length==1){ 
//                                                var iddevis = selection[0]; 
//                                                var reference = grilledevis.model.byId(selection).rawData.reference; 
//                                                var parametres_onglet = {
//                                                                            id : "duppliquer_devis_"+iddevis,
//                                                                            title : "Dupliquer le devis : "+reference,
//                                                                            href: iddevis+"/dupliquerdevis?niveau="+niveau,
//                                                                            closable: true,
//                                                                            selected: true 
//                                                                        };   
//                                            AjouterOnglet("zoneonglets",parametres_onglet);                                                                              
////                                            var process = asyncProcess(parametres_onglet);
////                                            process.then(function(value){
////                                              Afficher_Produits("produits");
////                                              Afficher_Lignes_Devis("lignesdevis",iddevis);
////                                            },
////                                            function(error){
////                                              console.log('erreur');
////                                            });                                                                        
////                                                AjouterOnglet("zoneonglets",parametres_onglet); 
////                                                AfficherDialogue(parametres_onglet);                                                 
//                                            } 
//                                         }
//                            }));
            this.addChild(new MenuItem({
                                label: "Imprimer le devis sélectionné",
                                onClick: function(){
                                                var lesdevis = grilledevisencours.select.row.getSelected();
                                                array.map(lesdevis, function(iddevis){
                                                    var href = iddevis+"/imprimerdevis";
                                                    openpdf("POST",href)                                                    
//                                                    Executer_url(href,"POST")     
                                                });                                                                                                 
                                         }
                            })); 
            this.addChild(new MenuItem({
                                label: "Afficher le devis sélectionné",
                                onClick: function(){
                                                var lesdevis = grilledevisencours.select.row.getSelected();
                                                array.map(lesdevis, function(iddevis){
                                                    if (iddevis>0) {
                                                        var href = iddevis+"/afficherdevis";
                                                        window.open(href,'Devis en cours','_blank');                                                        
                                                    }    
                                                });                                                                                                 
                                         }
                            }));                                 
            this.addChild(new MenuItem({
                                label: "envoyer le devis sélectionné",
                                onClick: function(){
                                                niveau++;                                      
                                                var lesdevis = grilledevisencours.select.row.getSelected();
                                                array.map(lesdevis, function(iddevis){
//                                                    var href = iddevis+"/envoyerdevis";
//                                                    Executer_url(href,"POST") 
                                                    var reference = grilledevisencours.model.byId(iddevis).rawData.reference; 
                                                    var parametres_onglet = {
                                                                                id : "new_message_"+iddevis,                                                    
//                                                                              id : "reception_commande_"+iddevis,
                                                                                title : "Envoi du Devis : "+reference,
                                                                                href: iddevis+"/newMessage?niveau="+niveau,                                                                           closable: true,
                                                                                selected: true 
                                                                            };  
                                                    AjouterOnglet("zoneonglets",parametres_onglet);                                                      
                                                });                                                                                                 
                                         }
                            }));                              
            }                                                              
    })
});

