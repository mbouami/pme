define([
    "dojo/_base/declare",
    'dijit/registry',       
    "dojo/_base/array",
    "gridx/Grid",
    "dojo/store/Memory",
    "dojo/dom",
    "gridx/core/model/cache/Sync", 
    "dojo/dom-construct",   
    'gridx/allModules',
    "MenuCommandes"
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,modules,MenuCommandes){    
return declare("GrilleActions", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
//        selectRowTriggerOnCell: true,
//        singleClickEdit: true,
//	autoWidth: true,
        selectRowMultiple: false,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,
        class: 'grilleactions',         
        store : new Memory({ data: null}),
        modules: [
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
        structure: [         
                {field: 'sujet',name: 'Sujet',datatype: "string",width:'150px'},            
                {field: 'createdAt',name: 'Date',datatype: "string",width:'100px'}, 
                {field: 'contact',name: 'Contact',datatype: "string",width:'100px'}       
            ],                                                                      
        constructor: function(){
            _this = this;               
        },        
	postCreate: function(){      
            this.inherited(arguments);            
	},                   
        onRowClick: function(evt){  
                      
        },
	RemoveElement : function(iddevis,dossier){
                this.store.remove(iddevis);
	},            
    });   
});

