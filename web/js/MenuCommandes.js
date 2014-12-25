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
    return declare("MenuCommandes", Menu,{
        constructor: function(){ 
        },
        postCreate: function(){
            this.inherited(arguments);                             
            this.addChild(new MenuItem({
                                label: "Supprimer la commande sélectionnée",
                                onClick: function(){
                                                var lescommandes = grillecommandes.select.row.getSelected();
                                                array.map(lescommandes, function(idcommande){
                                                    if (idcommande>0) {
                                                        var href = "commandes/"+idcommande+"/delete";
                                                        Execute_href("DELETE",href,grillecommandes);                                                     
                                                    }   
                                                });                                                                                                 
                                         }
                            }));                                      
        }                                                              
    })
});

