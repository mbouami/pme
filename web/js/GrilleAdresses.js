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
    "MenuAdresses"    
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules,MenuAdresses){    
return declare("GrilleAdresses", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
        selectRowTriggerOnCell: true,
//        singleClickEdit: true,
//	autoWidth: true,
        selectRowMultiple: false,
        style: "width: 300px; height: 100px",
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,       
        class: 'grilleadresses',  
        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'adresse',name: 'Adresse',width:'300px', expandLevel: 'all',widgetsInCell: true}
                   ], 
	modules : [
                        modules.Tree,
//                        modules.Pagination,
//                        modules.PaginationBar,
                        modules.ColumnResizer,
        		modules.SelectRow,
        		modules.IndirectSelectColumn,
                        modules.VirtualVScroller,
                        modules.SingleSort,
                        modules.RowHeader,
                        modules.IndirectSelect,
//                        modules.Filter,
//                        modules.FilterBar,
//                        modules.QuickFilter,
                        modules.Menu,
//                        modules.Bar,        
                ],          
        constructor: function(){
            _this = this;  
        },        
	postCreate: function(){      
            this.inherited(arguments);  
//            this.menu.bind(new MenuAdresses(_this.id), {
//                                                id:_this.id,
//                                                hookPoint: "grid",
//                                                selected: false
//                                        });             
	},             
        onRowClick: function(evt){  
            console.log("adresse de "+this.row(evt.rowId).item().type);
        }
    });      
});

