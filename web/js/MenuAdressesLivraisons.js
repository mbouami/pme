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
    return declare("MenuAdressesLivraisons", Menu,{
        constructor: function(grille){ 
            _grille = grille;
        },
        postCreate: function(){
            this.inherited(arguments); 
            this.addChild(new MenuItem({
                                label: "Ajouter une adresse",
                                onClick: function(){   
                                            niveau++;    
                                            console.log(_grille);
//                                            var selection = grilleorganisations.select.row.getSelected();
//                                            if (selection.length==1){ 
//                                                var idorg = selection[0];                                               
//                                                var nomeorg = grilleorganisations.model.byId(selection).rawData.nom; 
//                                            var parametres_onglet = {
//                                                                        id : "new_adresse_"+niveau,
//                                                                        title : "Création d'une nouvelle adresse : "+nomeorg,
//                                                                        href: "devis/new?idorg="+idorg+"&niveau="+niveau,
//                                                                        closable: true,
//                                                                        selected: true 
//                                                                    };                                                                
//                                            AjouterOnglet("zoneonglets",parametres_onglet);
//                                            }                                                                                                                              
                                         }
                            }));                             
            this.addChild(new MenuItem({
                                label: "Supprimer l'adresse sélectionnée",
                                onClick: function(){
                                            console.log(_grille);                                    
//                                                var lesdevis = grilledevis.select.row.getSelected();
//                                                var iddossier = null;
//                                                array.map(lesdevis, function(iddevis){  
//                                                    if (iddevis>0) {
//                                                        var href = "devis/"+iddevis+"/delete";
//                                                        Execute_href("DELETE",href,grilledevisencours);
//                                                    } else {
//                                                        iddossier = iddevis;
//                                                    }  
//                                                })                                               
                                         }
                            }));                                                         
            }                                                              
    })
});

