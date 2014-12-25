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
    'gridx/allModules',
    "MenuDevis"
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules,MenuDevis){    
return declare("GrilleDevis", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
        selectRowTriggerOnCell: true,
//        singleClickEdit: true,
//	autoWidth: true,
        selectRowMultiple: false,
//        style: "width: 100%; height: 100%",
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,                                        
        class: 'grilledevis',    
        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'reference',name: 'Référence',width:'100px', expandLevel: 'all',widgetsInCell: true}, 
                    {field: 'createdAt',name: 'Date',width:'100px'},        
                    {field: 'contact',name: 'Contact',width:'100px'}, 
                    {field: 'referent',name: 'Le Référent',width:'250px'}   
                   ], 
	modules : [
                        modules.Tree,
                        modules.Pagination,
                        modules.PaginationBar,
                        modules.ColumnResizer,
        		modules.SelectRow,
        		modules.IndirectSelectColumn,
                        modules.VirtualVScroller,
                        modules.SingleSort,
                        modules.RowHeader,
                        modules.IndirectSelect,
                        modules.Filter,
                        modules.FilterBar,
                        modules.QuickFilter,
                        modules.Menu,
                        modules.Bar,        
                ],          
        constructor: function(){
            _this = this;               
        },        
	postCreate: function(){      
            this.inherited(arguments);
//            this.model.onDelete(console.log("suppppp"));          
            this.menu.bind(new MenuDevis(), {
                                                hookPoint: "grid",
                                                selected: false
                                        });              
	},
//        DeleteDossier : function() {
//            array.map(lesdevis, function(iddevis){  
//                if (iddevis>0) {
//                    var href = "devis/"+iddevis+"/delete";
//                    Executer_url(href,"DELETE");                                                        
//                } else {
//                    iddossier = iddevis;
//                }  
//            });
//            console.log(grilledevis.model.children(iddossier));     
//            console.log(grilledevis.model.size(iddossier));              
//        },
        onRowClick: function(evt){  
//            console.log(this.row(evt.rowId).item().cat);
//                        this.select.row.clear();
//                        this.row(evt.rowId).select();
                        grilleapercudevis.setStore(new Memory({data: this.row(evt.rowId).item().listeproduits }));                      
//                        dom.byId("zonemessage").innerHTML = this.row(evt.rowId).item().cat=="dossier"?"":"Référence : "+this.row(evt.rowId).item().reference; 
                        if (this.row(evt.rowId).item().cat=="devis") {
                            var tabdevis = registry.byId("zoneongletsapercu");
                            tabdevis.selectChild("apercu");                            
                            dom.byId("zonemessage").innerHTML = "Référence du Devis : "+this.row(evt.rowId).item().reference + (this.row(evt.rowId).item().devisparent==null?"":" (Annule et remplace le devis :"+this.row(evt.rowId).item().devisparent+")");  
                            dom.byId("totalht").innerHTML = "Total HT : "+this.row(evt.rowId).item().totalht+" €";
                            dom.byId("tauxtva").innerHTML = "Total TVA ("+this.row(evt.rowId).item().tauxtva+" %) : "+this.row(evt.rowId).item().totaltva+" €";
                            dom.byId("fraisport").innerHTML = "Frais de Port : "+this.row(evt.rowId).item().fraisport+" €";                            
                            dom.byId("totalttc").innerHTML = "Total TTC : "+this.row(evt.rowId).item().totalttc+" €";                            
                        } else {
                            dom.byId("zonemessage").innerHTML = "";  
                            dom.byId("totalht").innerHTML = "";
                            dom.byId("tauxtva").innerHTML = "";
                            dom.byId("fraisport").innerHTML = "";                             
                            dom.byId("totalttc").innerHTML = "";                               
                        }
        },
	RemoveElement : function(iddevis,dossier){
                this.store.remove(iddevis);
                if(this.store.query({id:dossier})[0].children.length==1){
                    this.store.remove(dossier);
                }
//                this.store.query({id:iddevis}).forEach(function(object){
//                            array.map(object.devis.items, function(item,index){ 
//                                if (item.id==dossier) {
//                                    array.map(item.children, function(devis,indice){
//                                        if (devis.id==iddevis){
//                                             item.children.splice(indice, 1) 
//                                        }
//                                    }) 
//                                }
//                                if (item.children.length==0){
//                                    object.devis.items.splice(index, 1)
//                                }                                
//                            }); 
//                });
	},      
	AddProduit : function(dossier,produit){
                this.store.query({id:dossier}).forEach(function(object){
                            array.map(object.children, function(item,index){ 
                                    item.unshift(produit);                    
                            }); 
                });
	},          
    });       
});

