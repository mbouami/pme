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
    "MenuContacts"
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules,MenuContacts){    
return declare("GrilleContacts", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
////        selectRowTriggerOnCell: true,
////        singleClickEdit: true,
	autoWidth: true,
        selectRowMultiple: false,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,
        class: 'grillecontacts',
        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'nom',name: 'Contact',datatype: "string",width:'150px', filterable: true}, 
                    {field: 'tel',name: 'Téléphone',datatype: "string",width:'100px'},  
                    {field: 'mobile',name: 'Mobile',datatype: "string",width:'100px'},                  
                    {field: 'email',name: 'Mel',datatype: "string",width:'150px'},
                    {field: 'centresinteret',name: 'Centres d\'Intérêt',datatype: "string",width:'150px'},        
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
//            this.store = new Memory({ data: null});
        },        
	postCreate: function(){      
            this.inherited(arguments);
            this.menu.bind(new MenuContacts(), {
                                                hookPoint: "grid",
                                                selected: false
                                        });             
	},
	RemoveElement : function(idcontact){
                this.store.remove(idcontact);
	},         
    });     
});

