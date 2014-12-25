define([
    "dojo/_base/declare",
    "dijit/registry",
    "gridx/Grid",
    "dojo/store/Memory",
    "gridx/core/model/cache/Sync", 
    'gridx/allModules',
    'dojo/domReady!'    
], function(declare,registry,Grid,Memory,Cache,modules){    
return declare("GrilleProduits", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
        autoHeight: true,
        selectRowTriggerOnCell: true,
        singleClickEdit: true,
	autoWidth: true,
        selectRowMultiple: true,       
        cacheClass: Cache,        
        class: 'grilleproduits',
        id: null,
        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'reference',name: 'Référence',datatype: "string",width:'100px', filterable: true}, 
                    {field: 'libelle',name: 'Libellé',datatype: "string",width:'250px'}    
                   ], 
	modules : [
                        modules.Pagination,
                        modules.PaginationBar,
                        modules.ColumnResizer,
        		modules.SelectRow,
        		modules.IndirectSelectColumn,
                        modules.VirtualVScroller,
                        modules.Filter,
                        modules.FilterBar,
                        modules.QuickFilter,
                        modules.Menu,
                        modules.Bar,        
                ],         
        constructor: function(args){
            _this = this;
            this.id = args.id;
            this.store = args.store;              
        },        
	postCreate: function(){      
            this.inherited(arguments);          
	},             
        onRowClick: function(evt){  
                        var quantite = registry.byId("devis_quantite_"+this.niveau);  
                        var grillelignesdevis = registry.byId("grillelignesdevis_"+this.niveau);             
                        if (this.row(evt.rowId).isSelected()) {
//                                    this.row(evt.rowId).select();                        
                            var data = {
                                ordre:grillelignesdevis.rowCount()+1,
                                reference: this.model.byId(evt.rowId).rawData.reference,
                                description: this.model.byId(evt.rowId).rawData.libelle,
                                quantite: quantite.get('value'),    
                                prixht: this.model.byId(evt.rowId).rawData.prixht,      
                                remise: 0, 
                                totalht: this.model.byId(evt.rowId).rawData.prixht*quantite.get('value'),     
                                        };  
//                            grillelignesdevis.store.add(data);                                        
                            grillelignesdevis.Ajouter_Item(data);
                        } else {
                            grillelignesdevis.store.remove(evt.rowId);
                            var results = grillelignesdevis.store.query({ reference: this.model.byId(evt.rowId).rawData.reference });
                            array.map(results, function(lignedevis,index){ 
                                grillelignesdevis.store.remove(lignedevis.id);
                            })                            
//                            for (i=0;i<results.length;i++){
//                                grillelignesdevis.store.remove(results[i].id);
//                            } 
//                            
//grillelignesdevis.store.query({reference:this.model.byId(evt.rowId).rawData.reference}).then(function(results){
//                            array.map(results, function(lignedevis,index){ 
//                                grillelignesdevis.store.remove(lignedevis.id);
//                            })    
//});                            
                            grillelignesdevis.OrdonnerLesLignes();                                      
                        } 
                        grillelignesdevis.calculerTotaux();
        }
    });       
});

