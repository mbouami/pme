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
    "dojo/domReady!"
], function(declare,Menu, MenuItem,Deferred, CheckedMenuItem, MenuSeparator, PopupMenuItem,array,registry){
    function asyncProcess(zone){
        var deferred = new Deferred();
        AjouterOnglet("zoneonglets",zone);        
        setTimeout(function(){
        deferred.resolve("success");
        }, 1000);

        return deferred.promise;
    }
    return declare("MenuOrganisations", Menu,{
        constructor: function(){ 
        },
        postCreate: function(){
            this.inherited(arguments); 
            this.addChild(new MenuItem({
                                label: "Création d'un nouveau devis",
                                onClick: function(){
                                            niveau++;                                    
                                            var selection = grilleorganisations.select.row.getSelected();
                                            if (selection.length==1){ 
                                                var idorg = selection[0]; 
                                                var nomeorg = grilleorganisations.model.byId(selection).rawData.nom; 
                                                var parametres_onglet = {
//                                                                            id : "new_devis_"+idorg,
                                                                            id : "new_devis_"+niveau,
                                                                            title : "Création d'un nouveau devis pour : "+nomeorg,
                                                                            href: "devis/new?idorg="+idorg+"&niveau="+niveau,
                                                                            closable: true,
                                                                            selected: true 
                                                                        };                                                                        
                                                AjouterOnglet("zoneonglets",parametres_onglet);                                                                            
                                            }                                                                                                                              
                                         }
                            })); 
            this.addChild(new MenuItem({
                                label: "Ajouter un contact",
                                onClick: function(){
                                            niveau++;
                                            var selection = grilleorganisations.select.row.getSelected();
                                            if (selection.length==1){ 
                                                var idorg = selection[0]; 
                                                var nomeorg = grilleorganisations.model.byId(selection).rawData.nom; 
                                            var parametres_onglet = {
//                                                                        id : "new_contact_"+idorg,
                                                                        id : "new_contact_"+niveau,
                                                                        title : "Création d'un nouveau contact de l'organisation : "+nomeorg,
                                                                        href: "contacts/new?idorg="+idorg+"&niveau="+niveau,
//                                                                        href: "gestion/Contacts/create?idorg="+idorg,                                                                        
                                                                        closable: true,
                                                                        selected: true 
                                                                    };                        
                                            AjouterOnglet("zoneonglets",parametres_onglet);                                            
                                            }                                                                                                                              
                                         }
                            }));                             
            this.addChild(new MenuItem({
                                label: "Ajouter une organisation",
                                onClick: function(){
                                            niveau++;                                    
                                            var parametres_onglet = {
                                                                        id : "new_organisation_"+niveau,
                                                                        title : "Création d'une nouvelle organisation : ",
                                                                        href: "organisations/new?niveau="+niveau,
                                                                        closable: true,
                                                                        selected: true 
                                                                    };                        
                                            AjouterOnglet("zoneonglets",parametres_onglet);                                                                                                    
                                         }
                            }));       
            this.addChild(new MenuItem({
                                label: "Editer l'organisation",
                                onClick: function(){
                                            niveau++;                                    
                                            var selection = grilleorganisations.select.row.getSelected();
                                            if (selection.length==1){ 
                                                var idorg = selection[0]; 
                                                var nomeorg = grilleorganisations.model.byId(selection).rawData.nom; 
                                                var parametres_onglet = {
                                                                            id : "update_organisation_"+idorg,
                                                                            title : "Edition de l'organisation : "+nomeorg,
                                                                            href: "organisations/"+idorg+"/edit?niveau="+niveau,
                                                                            closable: true,
                                                                            selected: true 
                                                                        };                        
                                                AjouterOnglet("zoneonglets",parametres_onglet);                                             
                                            }                                                                                                                              
                                         }
                            }));   
            this.addChild(new MenuItem({
                                label: "Supprimer l'organisation sélectionnée",
                                onClick: function(){
                                                var lesorganisations = grilleorganisations.select.row.getSelected();
                                                array.map(lesorganisations, function(idorganisation){                                     
//                                                    var href = "gestion/Organisations/delete/"+idorganisation;
                                                    var href = "organisations/"+idorganisation+"/delete";
                                                    Executer_url(href,"DELETE")      
                                                });                                                                                                 
                                         }
                            }));     
            this.addChild(new MenuItem({
                                label: "Mettre à jour model",
                                onClick: function(){                                   
                                         }
                            }));                              
        },        
    })
});

