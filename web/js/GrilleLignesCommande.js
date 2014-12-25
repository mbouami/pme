define([
    "dojo/_base/declare",
    'dijit/registry',    
    "dojo/_base/array",
    "gridx/Grid",
    "dojo/store/Memory",
    "dojo/dom",
    "gridx/core/model/cache/Sync", 
    "dojo/dom-construct",
    "dijit/registry",
    "dojo/Deferred",
    "dojo/_base/lang",
    'gridx/allModules',
    'dojo/parser',
    'dijit/_WidgetBase', 
    'dijit/_TemplatedMixin', 
    'dojo/domReady!'
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,Deferred,lang,modules, parser, _WidgetBase, _TemplatedMixin){    
return declare("GrilleLignesCommande", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
//        selectRowTriggerOnCell: true,
//        singleClickEdit: true,
	autoWidth: true,
        selectRowMultiple: true,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,       
        class: 'grillelignescommande',         
        constructor: function(){
            _this = this;                                     
        },        
	postCreate: function(){      
            this.inherited(arguments);
            if (this.iddevis > 0) {
                lignesdevisStore.query({ iddevis: this.iddevis }).then(function(lesproduits){                     
                    _this.setStore(new Memory({data: lesproduits }));  
                    _this.calculerTotaux();
                });  
            }                
//            menuorganisations = new MenuContacts();
//            this.menu.bind(new MenuLignesDevis(), {
//                                                hookPoint: "grid",
//                                                selected: false
//                                        });  
//            this.edit.connect(this.edit, "onApply", function(cell, success) {
//                _this.calculerTotalHtParLigne(cell, success);
//            }) 
        },
        UpdateStore: function(store){ 
            this.setStore(store);
        },
        Ajouter_Item: function(item){
            this.store.add(item); 
        },         
	Ajouter_colonne : function(layout){
		this.setColumns(layout);
	},        
        calculerTotalHtParLigne : function(cell, applySuccess){
            var totalhtligne = parseFloat(this.cell(cell.row.index(), 3).data())*parseFloat(this.cell(cell.row.index(), 4).data())*(100-parseFloat(this.cell(cell.row.index(), 5).data()))/100;
            this.cell(cell.row.index(), 6).setRawData(totalhtligne);
            this.calculerTotalHt();
        },
        calculerTotalHt : function(){
            var totalht = 0;
            var champstotalht = registry.byId("commande_totalht");
            for (var i=0;i<this.rowCount();i++){
                totalht += parseFloat(this.cell(i, 6).data());             
            }
            champstotalht.set('value',totalht);                      
        },
        calculerTotaux : function(){
            var totalht = 0;
            var tauxtva = registry.byId("commande_tauxtva");
            var totalht = registry.byId("commande_totalht");     
            var totaltva = registry.byId("commande_totaltva");
            var fraisport = registry.byId("commande_fraisport"); 
            var totalttc = registry.byId("commande_totalttc");            
            totaltva.set('value',tauxtva.get('displayedValue')*totalht.get('value')/100);
            totalttc.set('value',totalht.get('value')+totaltva.get('value')+fraisport.get('value'));            
        },        
        DupliquerLesLignes : function(row){   
                            var data = {
                                            ordre:this.rowCount()+1,
                                            reference: row.rawData.reference,
                                            description: row.rawData.description,
                                            quantite: row.rawData.quantite,    
                                            prixht: row.rawData.prixht,      
                                            remise: row.rawData.remise, 
                                            totalht: row.rawData.totalht,     
                                        };                                          
                            this.Ajouter_Item(data);
                            this.calculerTotalHt();
        },   
        SupprimerLesLignes : function(){   
            var selection = this.select.row.getSelected();
            for (i=0;i<selection.length;i++){
                this.store.remove(grillelignescommande.model.byId(selection[i]).rawData.id);
            }          
//                    this.OrdonnerLesLignes();
            this.calculerTotalHt();
        }, 
        OrdonnerLesLignes : function(){  
            for (var i=0;i<this.rowCount();i++){
                this.cell(i, 0).setRawData(i+1);
            } 
        },          
	getValeur : function(indicerow,indicecolumn){
                    return parseFloat(_this.cell(indicerow,indicecolumn).data()).toFixed(2);
        },     
	getDataJson : function(){
                var lignesdevis = _this.store.data;
//                var data = [lignedevis["ordre"],lignedevis["reference"],"coucou",5,"32.25",0,"25.26"]; 
            var data = [];                 
//                var sortie = null;
                array.map(lignesdevis, function(lignedevis,index){ 
                    data.push({
                    ordre:lignedevis["ordre"],
                    reference: lignedevis["reference"],
                    description: lignedevis["description"],
                    quantite: lignedevis["quantite"],    
                    prixht: lignedevis["prixht"],      
                    remise: lignedevis["remise"], 
                    totalht: lignedevis["totalht"],     
                        });
////                    sortie[index].push({ordre:lignedevis["ordre"]});
////                    sortie[index].push({ordre:lignedevis["ordre"]});
//                    sortie.push({"ordre":lignedevis["ordre"],
//                        "reference":lignedevis["reference"],
//                        "description":lignedevis["description"],
//                        "quantite":lignedevis["quantite"],    
//                        "prixht":lignedevis["prixht"],      
//                        "remise":lignedevis["remise"]});                        
                });
                console.log(lignesdevis);
                return lignesdevis;
        },          
    });      
});

