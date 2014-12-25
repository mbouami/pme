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
    "MenuCommandes"
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules,MenuCommandes){    
return declare("GrilleCommandes", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
//        selectRowTriggerOnCell: true,
//        singleClickEdit: true,
	autoWidth: true,
        selectRowMultiple: false,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,
        store : new Memory({ data: null}),
        modules: [
                    modules.VirtualVScroller,
                    modules.IndirectSelect,
                    modules.SingleSort,
                    modules.RowHeader,
                    modules.SelectRow,
                    modules.SelectColumn,
                    modules.Filter,
                    modules.FilterBar,
                    modules.QuickFilter, 
                    modules.Menu,                                        
                ],          
        structure: [         
                {field: 'dossier',name: 'Dossier',datatype: "string",width:'150px'},            
                {field: 'referenceclient',name: 'Référence Client',datatype: "string",width:'150px'},                 
                {field: 'numcommande',name: 'Numéro Commande',datatype: "string",width:'80px', filterable: true},  
                {field: 'contact',name: 'Contact',datatype: "string",width:'100px'},       
                {field: 'createdAt',name: 'Date',datatype: "string",width:'100px'}
            ],                                                             
        class: 'grillecommandes',         
        constructor: function(){
            _this = this;               
        },        
	postCreate: function(){      
            this.inherited(arguments);
            this.menu.bind(new MenuCommandes(), {
                                                hookPoint: "grid",
                                                selected: false
                                        });              
	},                   
        onRowClick: function(evt){  
                        this.select.row.clear();
                        this.row(evt.rowId).select();
                        grilleapercudevis.setStore(new Memory({data: this.row(evt.rowId).item().listeproduits })); 
                        if (this.row(evt.rowId).item().cat=="commande") {
                            var tabdevis = registry.byId("zoneongletsapercu");
                            tabdevis.selectChild("apercu");                            
                            dom.byId("zonemessage").innerHTML = "NumCommande : "+this.row(evt.rowId).item().numcommande;  
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
	},            
    });   
});

