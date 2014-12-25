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
return declare("GrilleServices", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
        autoHeight: true,
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
//                    modules.Filter,
//                    modules.FilterBar,
//                    modules.QuickFilter, 
                    modules.Menu,                                        
                ],          
        structure: [         
                {field: 'service',name: 'Service',datatype: "string",width:'200px'}                  
            ],                                                             
        class: 'grilleservice',                 
        constructor: function(args){
            _this = this;
            this.id = args.id;
            this.store = args.store;              
        },         
	postCreate: function(){      
            this.inherited(arguments);            
	},                   
        onRowClick: function(evt){  
                      
        },
	AddElement : function(taux){
                this.store.add(taux);
	},         
	RemoveElement : function(id){
                this.store.remove(id);
	},        
    });   
});

