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
    return declare("MenuApercuDevis", Menu,{
        constructor: function(){ 
        },
        postCreate: function(){
            this.inherited(arguments);                           
            this.addChild(new MenuItem({
                                label: "Supprimer les devis sélectionnés",
                                onClick: function(){
//                                                var lesdevis = grilledevis.select.row.getSelected();
                                                var iddevis = grilleapercudevis.model.byIndex(0).rawData.iddevis;
//                                                var iddossier = null;
//                                                array.map(lesdevis, function(iddevis){  
//                                                    if (iddevis>0) {
                                                        var href = "devis/"+iddevis+"/delete";
                                                        Executer_url(href,"DELETE");                                                        
//                                                    } else {
//                                                        iddossier = iddevis;
//                                                    }  
//                                                })                                               
                                         }
                            }));       
            this.addChild(new MenuItem({
                                label: "Editer le devis",
                                onClick: function(){
                                            niveau++;
                                            var selection = grilledevis.select.row.getSelected();
                                            if (selection.length==1){ 
                                                var iddevis = selection[0]; 
                                                var reference = grilledevis.model.byId(selection).rawData.reference; 
                                                var parametres_onglet = {
//                                                                            id : "update_devis_"+iddevis,
                                                                            id : "update_devis_"+niveau,
                                                                            title : "Edition du devis : "+reference,
                                                                            href: "devis/"+iddevis+"/edit?niveau="+niveau,
                                                                            closable: true,
                                                                            selected: true 
                                                                        };
                                            AjouterOnglet("zoneonglets",parametres_onglet);               
//                                            var process = asyncProcess(parametres_onglet);
//                                            process.then(function(value){
//                                              Afficher_Produits("produits");
//                                              Afficher_Lignes_Devis("lignesdevis",iddevis);
//                                            },
//                                            function(error){
//                                              console.log('erreur');
//                                            });                                                
                                            }                                                                                                                              
                                         }
                            }));   
            this.addChild(new MenuItem({
                                label: "Modifier le devis",
                                onClick: function(){                                                                    
                                            niveau++;                                    
                                            var iddevis = grilleapercudevis.model.byIndex(0).rawData.iddevis;
                                            var reference = grilledevis.model.byId(iddevis).rawData.reference;
                                            var parametres_onglet = {
//                                                                            id : "modifier_devis_"+iddevis,
//                                                                            id : "new_devis_"+grilleorganisations.select.row.getSelected()[0],
//                                                                        id : "modifier_devis_"+iddevis,
                                                                        id : "modifier_devis_"+niveau,
                                                                        title : "Modification du devis : "+reference,
                                                                        href: iddevis+"/modifierdevis?niveau="+niveau,
                                                                        closable: true,
                                                                        selected: true 
                                                                    };                                                                             
                                            AjouterOnglet("zoneonglets",parametres_onglet);                                                                                                                            
                                         }
                            }));          
            this.addChild(new MenuItem({
                                label: "Réception Commande",
                                onClick: function(){
                                            niveau++;                                    
                                            var iddevis = grilleapercudevis.model.byIndex(0).rawData.iddevis;
                                            var reference = grilledevis.model.byId(iddevis).rawData.reference;
                                            var parametres_onglet = {
//                                                                        id : "reception_commande_"+iddevis,
                                                                        id : "reception_commande_"+niveau,
                                                                        title : "Réception Commande du Devis : "+reference,
                                                                        href: iddevis+"/receptioncommande",
                                                                        closable: true,
                                                                        selected: true 
                                                                    };
                                            var process = asyncProcess(parametres_onglet);
                                            process.then(function(value){
                                                Afficher_Lignes_Devis("lignesdevis",iddevis);
                                            },function(error){
                                                console.log('erreur');
                                            });                                             
                                }
                            }));                                
            this.addChild(new MenuItem({
                                label: "Dupliquer le devis selectionné",
                                onClick: function(){
                                    niveau++;                                    
                                    var iddevis = grilleapercudevis.model.byIndex(0).rawData.iddevis;
                                    var reference = grilledevis.model.byId(iddevis).rawData.reference;
                                        var parametres_onglet = {
//                                                                    id : "dupliquer_devis_"+iddevis,
                                                                    id : "dupliquer_devis_"+niveau,
                                                                    title : "Dupliquer le devis : "+reference,
                                                                    href: iddevis+"/dupliquerdevis?niveau="+niveau,
                                                                    closable: true,
                                                                    selected: true 
                                                                };   
                                    AjouterOnglet("zoneonglets",parametres_onglet);                    
                                }
                            }));
            this.addChild(new MenuItem({
                                label: "Imprimer le devis sélectionné",
                                onClick: function(){
                                                var iddevis = grilleapercudevis.model.byIndex(0).rawData.iddevis;
                                                var href = iddevis+"/imprimerdevis";
                                                Executer_url(href,"POST");                                                                                               
                                         }
                            }));        
            this.addChild(new MenuItem({
                                label: "envoyer le devis sélectionné",
                                onClick: function(){
                                                var iddevis = grilleapercudevis.model.byIndex(0).rawData.iddevis;
                                                var href = iddevis+"/envoyerdevis";
                                                Executer_url(href,"POST");                                                   
                                         }
                            }));                              
            }                                                              
    })
});

