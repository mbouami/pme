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
                                                                            id : "new_devis_"+niveau,
                                                                            title : "Modification du devis : "+reference,
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
                                                adressesStores.query("?iddevis="+iddevis+"&idtype=2").then(function(adresses){ 
                                                            StoreAdressesLivraisons = new Memory({data: adresses});
                                                });        
                                                adressesStores.query("?iddevis="+iddevis+"&idtype=1").then(function(adresses){ 
                                                            StoreAdressesFacturation = new Memory({data: adresses});
                                                });                 
                                                var parametres_onglet = {
                                                                            id : "new_commande_"+iddevis,                                                    
//                                                                            id : "reception_commande_"+iddevis,
                                                                            title : "Réception Commande du Devis : "+reference,
//                                                                            href: iddevis+"/receptioncommande",
                                                                            href: "commandes/new?iddevis="+iddevis+"&niveau="+niveau,                                                                           closable: true,
                                                                            selected: true 
                                                                        };  
                                                AjouterOnglet("zoneonglets",parametres_onglet);                                         
                                            }                                                                                                                              
                                         }
                            }));                                
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

