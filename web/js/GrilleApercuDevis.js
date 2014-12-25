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
    "MenuApercuDevis"
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules,MenuApercuDevis){    
return declare("GrilleApercuDevis", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
//        selectRowTriggerOnCell: true,
//        singleClickEdit: true,
//	autoWidth: true,
//        style: "width: 100%; height: 100%",
        selectRowMultiple: true,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,                                       
        class: 'grilledevis',
        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'ordre',name: 'Ordre',datatype: "string",width:'25px',style: "text-align: right"},                 
                    {field: 'reference',name: 'Référence',datatype: "string",width:'100px',style: "text-align: left", filterable: true}, 
                    {field: 'description',name: 'Libellé',datatype: "string",width:'250px',
                        style: "text-align: left",
                        editable: true,
                        editor: "dijit.Editor",   
                    },  
                    {field: 'quantite',name: 'Qt',datatype: "string",width:'50px',
                                        style: "text-align: center",
                                        editable: true,                                   
                                        editor: "dijit/form/NumberSpinner",
                    }, 
                    {field: 'prixht',name: 'Prix HT',datatype: "string",width:'100px',
                            style: "text-align: center",
                            editable: true,
                            editor: "dijit.form.CurrencyTextBox",
                            editorArgs: {
                                type: "dijit/form/CurrencyTextBox",
                                props: 'constraints:{fractional:true},currency: "EUR",lang: "fr-fr",'
                            },
                            formatter: function(rawData){
                                return isNaN(rawData.prixht) ? '' : parseFloat(rawData.prixht).toFixed(2)+' €';
                            },
                    },  
                    {field: 'remise',name: 'Remise<br>%',datatype: "string",width:'50px', 
                            style: "text-align: center",
                            editable: true,
                            editor: "dijit.form.CurrencyTextBox",
                            editorArgs: {
                                type: "dijit/form/CurrencyTextBox",                
                                props: 'constraints:{fractional:true},currency: "%",lang: "fr-fr",'
                            },
                            formatter: function(rawData){
                                return isNaN(rawData.remise) ? '' : parseFloat(rawData.remise).toFixed(2)+' %';
                            },                        
                    },
                    {field: 'totalht',name: 'Total HT',datatype: "string",width:'100px', 
                            style: "text-align: right",
                            editable: false,
                            editor: "dijit/form/CurrencyTextBox",
                            editorArgs: {
                                props: 'constraints:{fractional:true},currency: "EUR",lang: "fr-fr",disabled="true"'
                            },
                            formatter: function(rawData){
                                return isNaN(rawData.totalht) ? '' : parseFloat(rawData.totalht).toFixed(2)+' €';
                            },
                    },
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
            this.menu.bind(new MenuApercuDevis(), {
                                                hookPoint: "grid",
                                                selected: false
                                        });                
	},                        
    });   
});

