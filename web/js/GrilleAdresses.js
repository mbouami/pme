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
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules){    
return declare("GrilleAdresses", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
        autoHeight: true,
        selectRowTriggerOnCell: true,
        singleClickEdit: true,
	autoWidth: true,
        selectRowMultiple: false,
//        selectRowTriggerOnCell: true,        
        cacheClass: Cache,        
        class: 'grilleadresses',         
        constructor: function(){
            _this = this;                                     
        },        
	postCreate: function(){      
            this.inherited(arguments);        
	},             
        onRowClick: function(evt){  
            console.log("adresse de "+this.row(evt.rowId).item().type);
        }
    });      
});

