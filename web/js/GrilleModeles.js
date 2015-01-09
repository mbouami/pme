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
return declare("GrilleModeles", Grid,{       
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
                {field: 'modele',name: 'Liste de modèles',datatype: "string",width:'200px'}                  
            ],                                                             
        class: 'grillemodeles',                 
        constructor: function(args){
            _this = this;
            this.id = args.id;
            this.store = args.store;              
        },         
	postCreate: function(){      
            this.inherited(arguments);            
	},                   
        onRowClick: function(evt){  
            modelecourrierStore.query("?id="+evt.rowId).then(function(modeleencours){
                var descriptionmodele = dijit.registry.byId('descriptionmodele');   
                var sujetmodele = dijit.registry.byId('sujetmodele');                   
                descriptionmodele.set('value',(modeleencours.resultat.description!==null)?modeleencours.resultat.description:' ');   
                sujetmodele.set('value',(modeleencours.resultat.sujet!==null)?modeleencours.resultat.sujet:' ');                  
            })                      
        },
	Updatemodele : function(){
            var descriptionmodele = dijit.registry.byId('descriptionmodele');
            var sujetmodele = dijit.registry.byId('sujetmodele');
                Execute_href('post',this.select.row.getSelected()[0]+'/'+sujetmodele.value+'/'+descriptionmodele.value+'/updatemodele',null);                
	},        
	AddElement : function(taux){
                this.store.add(taux);
	},         
	RemoveElement : function(id){
                this.store.remove(id);
	},        
    });   
});

