define([
    "dojo/_base/declare",
    "dijit/MenuBar",
    "dijit/PopupMenuBarItem",
    "dijit/Menu",
    "dijit/MenuItem",
    "dijit/DropDownMenu",
    "dojo/_base/array",
    "dojo/domReady!"
], function(declare,MenuBar, PopupMenuBarItem, Menu, MenuItem, DropDownMenu,array){
    return declare("Menuapplication", MenuBar,{
        constructor: function(){ 
        },   
        
        postCreate: function(){
            this.inherited(arguments);
//            if (usergroupe=="Administrateurs"){
                var pSubMenu = new DropDownMenu({});
                pSubMenu.addChild(new MenuItem({
                    label: "Editer le compte",
                    onClick: function(){
                        niveau++;                        
                        var parametres_onglet = {
                                                    id : "edit_referent",
                                                    title : "Edition du compte",
                                                    niveau: niveau,
                                                    href: "referents/"+userid+"/edit?niveau="+niveau,
                                                    signatures: userid+"/signatures",
                                                    closable: true,
                                                    selected: true 
                                                };
                        EditerReferent("zoneonglets",parametres_onglet);                         
                    }
                }));                 
                pSubMenu.addChild(new MenuItem({
                    label: "Ajouter un referent",
                    onClick: function(){
                        niveau++;                        
                        var parametres_onglet = {
                                                    id : "new_referent",
                                                    title : "Ajouter un nouveau référent",
                                                    href: "referents/new?niveau="+niveau,
                                                    closable: true,
                                                    selected: true 
                                                };
                        AjouterOnglet("zoneonglets",parametres_onglet); 
                    }
                }));           
//                pSubMenu.addChild(new MenuItem({
//                    label: "Générer Organisation",
//                    onClick: function(){
////                        console.log(JSON.stringify(genererOrganisation()));
//                        var href = "genererorganisation?org="+JSON.stringify(genererOrganisation());
//                        Executer_url(href,"POST");                        
//                    }
//                }));                
//                pSubMenu.addChild(new MenuItem({
//                    label: "Générer Un nouveau Contact",
//                    onClick: function(){
//                        var idorg = grilleorganisations.getSelected();
////                        grilleorganisations.store.query({ id: idorg }).then(function(organistaion){ 
////                                                                                console.log(organistaion);                      
////                                                                    });
////                        var organisation=grilleorganisations.store.query({ id: idorg });
//////                        console.log(organisation[0].devis.items[0].children);       
////                        console.log(organisation[0].devis);  //                                           
//////                        array.map(organisation[0].devis, function(devis){                                     
//////                                console.log(devis);    
//////                        });                          
//                        if (idorg > 0) {
//                            var href = idorg+"/generercontact?contact="+JSON.stringify(genererContact(idorg));
//                            Executer_url(href,"POST");                               
//                        }    
//                        
//                    }
//                }));                 
                this.addChild(new PopupMenuBarItem({
                    label: "Fichier",
                    popup: pSubMenu
                }));                
//            }
//            if (usergroupe=="Administrateurs"){
                var pSubMenu2 = new DropDownMenu({});
                pSubMenu2.addChild(new MenuItem({
                    label: "TauxTVA",
                    onClick: function(){  
                        niveau++;                        
                        var parametres_onglet = {
                                                    id : "liste_tauxtva",
                                                    title : "Liste des Taux de TVA",
//                                                    href: "referents/new?niveau="+niveau,
                                                    href: "affichertauxtva",
                                                    closable: true,
                                                    selected: true 
                                                };
//                        AjouterOnglet("zoneonglets",parametres_onglet); 
                        AfficherDialogue(parametres_onglet);
                    }                
                }));
                pSubMenu2.addChild(new MenuItem({
                    label: "Modèles",
                    onClick: function(){  
                        niveau++;                        
                        var parametres_onglet = {
                                                    id : "liste_modeles",
                                                    title : "Liste des modèles",
//                                                    href: "referents/new?niveau="+niveau,
                                                    href : "affichermodeles",
//                                                    href : "modelescourriers/new",
                                                    closable: true,
                                                    selected: true 
                                                };
//                        AjouterOnglet("zoneonglets",parametres_onglet); 
                        AfficherDialogue(parametres_onglet);
                    }                    
                }));                
                pSubMenu2.addChild(new MenuItem({
                    label: "Statuts",
                    onClick: function(){  
                        niveau++;                        
                        var parametres_onglet = {
                                                    id : "liste_statuts",
                                                    title : "Liste des statuts",
//                                                    href: "referents/new?niveau="+niveau,
                                                    href: "afficherstatuts",
                                                    closable: true,
                                                    selected: true 
                                                };
                        AfficherDialogue(parametres_onglet);
                    }                    
                }));
                pSubMenu2.addChild(new MenuItem({
                    label: "Services",
                    onClick: function(){  
                        niveau++;                        
                        var parametres_onglet = {
                                                    id : "liste_services",
                                                    title : "Liste des services",
//                                                    href: "referents/new?niveau="+niveau,
                                                    href: "afficherservices",
                                                    closable: true,
                                                    selected: true 
                                                };
                        AfficherDialogue(parametres_onglet);
                    }                    
                }));
                pSubMenu2.addChild(new MenuItem({
                    label: "Centres d'intérêts",
                    onClick: function(){  
                        niveau++;                        
                        var parametres_onglet = {
                                                    id : "liste_centres_interets",
                                                    title : "Liste des centres d'intérêts",
//                                                    href: "referents/new?niveau="+niveau,
                                                    href: "affichercentresinterets",
                                                    closable: true,
                                                    selected: true 
                                                };
                        AfficherDialogue(parametres_onglet);
                    }                    
                }));            
                this.addChild(new PopupMenuBarItem({
                    label: "Paramètres",
                    popup: pSubMenu2
                }));    
//            }
//            var pSubMenu2 = new DropDownMenu({});
//            pSubMenu2.addChild(new MenuItem({
//                label: "Cut",
//                iconClass: "dijitEditorIcon dijitEditorIconCut"
//            }));
//            pSubMenu2.addChild(new MenuItem({
//                label: "Copy",
//                iconClass: "dijitEditorIcon dijitEditorIconCopy"
//            }));
//            pSubMenu2.addChild(new MenuItem({
//                label: "Paste",
//                iconClass: "dijitEditorIcon dijitEditorIconPaste"
//            }));
//            this.addChild(new PopupMenuBarItem({
//                label: "Edit",
//                popup: pSubMenu2
//            }));
            this.startup(); 
        },        
    })
})


