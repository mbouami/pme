define([
    "dojo/_base/declare",
    "dijit/Menu",
    "dijit/MenuItem",
    "dijit/CheckedMenuItem",
    "dijit/MenuSeparator",
    "dijit/PopupMenuItem",
    "dojo/_base/array",
    'dijit/registry',  
    "dojo/store/Memory",    
    "dojo/_base/lang",
    "dojo/domReady!"
], function(declare,Menu, MenuItem, CheckedMenuItem, MenuSeparator, PopupMenuItem,array,registry,Memory,lang){
    return declare("MenuLignesDevis", Menu,{
        constructor: function(){ 
        },
        postCreate: function(){
            this.inherited(arguments); 
            this.addChild(new MenuItem({
                                label: "Dupliquer les lignes sélectionnées",
                                onClick: function(){           
                                            var grillelignesdevis = registry.byId("grillelignesdevis_"+niveau);
                                            var selection = grillelignesdevis.select.row.getSelected();
                                            for (i=0;i<selection.length;i++){
                                                grillelignesdevis.DupliquerLesLignes(grillelignesdevis.model.byId(selection[i]));
                                            }  
                                            grillelignesdevis.select.row.clear();
                                         }
                            }));         
            this.addChild(new MenuItem({
                                label: "Suprimer les lignes sélectionnées",
                                onClick: function(){      
                                                var grillelignesdevis = registry.byId("grillelignesdevis_"+niveau);
                                                grillelignesdevis.SupprimerLesLignes(); 
                                                
                                         }
                            }));                              
        },        
    })
});

