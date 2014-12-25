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
    "MenuDevisEnCours"
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules,MenuDevisEnCours){    
return declare("GrilleDevisenCours", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
//        singleClickEdit: true,
//	autoWidth: true,
        selectRowMultiple: false,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,                                       
        class: 'grilledevis',  
        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'reference',name: 'Référence',datatype: "string",width:'auto'},  
                    {field: 'dossier',name: 'Dossier',datatype: "string",width:'auto'},          
                    {field: 'organisation',name: 'Organisation',datatype: "string",width:'auto'},  
                    {field: 'datedevis',name: 'Date',datatype: "string",width:'auto'},        
                    {field: 'contact',name: 'Contact',datatype: "string",width:'auto'},  
                    {field: 'referent',name: 'Le référent',datatype: "string",width:'auto'},  
                    {field: 'mail',name: '@',width:'20px'}       
                   ], 
	modules : [
//                        modules.Tree,
                        modules.Pagination,
                        modules.PaginationBar,
                        modules.ColumnResizer,
        		modules.SelectRow,
        //		modules.ExtendedSelectRow,
        //		modules.CellWidget,
        //		modules.Edit,
        		modules.IndirectSelectColumn,
        //		modules.SingleSort,
                        modules.VirtualVScroller,
        //                modules.SingleSort,
        //                modules.RowHeader,
        //                modules.IndirectSelect,
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
            this.menu.bind(new MenuDevisEnCours(), {
                                                hookPoint: "grid",
                                                selected: false
                                        });                
//            devisencoursStore.query().then(function(results){
//                _this.setStore(new Memory({data: results.resultat }));             
//            });                
	},
        onRowClick: function(evt){  
            grilleapercudevis.setStore(new Memory({data: this.row(evt.rowId).item().listeproduits }));
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
        getNomDossier: function(iddevis){
            return this.store.query({id:iddevis})[0].dossier;
//            return this.row(iddevis).item().dossier;
        },
	RemoveElement : function(iddevis){  
                var dossier = this.getNomDossier(iddevis);
                this.store.remove(iddevis);            
                grilledevis.RemoveElement(iddevis,dossier);
	},           
    });     
});

