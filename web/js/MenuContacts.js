define([
    "dojo/_base/declare",
    "dijit/Menu",
    "dijit/MenuItem",
    "dijit/CheckedMenuItem",
    "dijit/MenuSeparator",
    "dijit/PopupMenuItem",
    "dojo/_base/array",
    'dijit/registry',    
    "dojo/domReady!"
], function(declare,Menu, MenuItem, CheckedMenuItem, MenuSeparator, PopupMenuItem,array,registry){
    return declare("MenuContacts", Menu,{
        constructor: function(){ 
        },
        postCreate: function(){
            this.inherited(arguments); 
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
                                                                        closable: true,
                                                                        selected: true 
                                                                    };                        
                                            AjouterOnglet("zoneonglets",parametres_onglet);                                            
                                            }                                                                                                                              
                                         }
                            }));                             
            this.addChild(new MenuItem({
                                label: "Supprimer les contacts sélectionnés",
                                onClick: function(){
                                                var contacts = grillecontacts.select.row.getSelected();
                                                array.map(contacts, function(idcontact){                                     
                                                var href = "contacts/"+idcontact+"/delete";
                                                Execute_href("DELETE",href,grillecontacts);
                                                });                                                                                                
                                         }
                            }));       
            this.addChild(new MenuItem({
                                label: "Editer le contact",
                                onClick: function(){
                                            niveau++;
                                            var selection = grillecontacts.select.row.getSelected();
                                            if (selection.length==1){ 
                                                var idcontact = selection[0]; 
                                                var nomecontact = grillecontacts.model.byId(selection).rawData.nom; 
                                                var parametres_onglet = {
                                                                            id : "update_contact_"+idcontact,
//                                                                            id : "update_contact_"+niveau,
                                                                            title : "Edition du contact : "+nomecontact,
                                                                            href: "contacts/"+idcontact+"/edit?niveau="+niveau,
                                                                            closable: true,
                                                                            selected: true 
                                                                        };                        
                                                AjouterOnglet("zoneonglets",parametres_onglet);                                             
                                            }                                                                                                                              
                                         }
                            }));   
        },        
    })
});

