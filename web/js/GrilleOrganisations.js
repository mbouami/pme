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
    "MenuOrganisations"
], function(declare,registry,array,Grid,Memory,dom,Cache,domConstruct,registry,modules,MenuOrganisations){    
return declare("GrilleOrganisations", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
        singleClickEdit: true,
//	autoWidth: true,
//        style: "width: 100%; height: 100%",
        selectRowMultiple: false,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,
        class: 'grilleorganisations', 
        idselectionne:null,
        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'nom',name: 'Organisation',datatype: "string",width:'150px', filterable: true},
                    {field: 'tel',name: 'Téléphone',datatype: "string",width:'100px'},  
                    {field: 'fax',name: 'Fax',datatype: "string",width:'100px'},         
                    {field: 'nomville',name: 'Ville',datatype: "string",width:'auto', filterable: true},   
                    {field: 'referent',name: 'Le référent',datatype: "string",width:'auto', filterable: true},    
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
//            if (userrole=='ROLE_ADMIN') {
//                iduser = 0;
//            } else {
//                iduser = userid;
//            }
//            organisationsStore.query('/'+iduser).then(function(results){
//                _this.setStore(new Memory({data: results.resultats }));             
//            });            
//            devisencoursStore.query('/'+iduser).then(function(results){
//                grilledevisencours.setStore(new Memory({data: results.resultat }));             
//            });              
//            this.store.query({idreferent:userid}).forEach(function(object){
//                            array.map(object.devis.items, function(item,index){ 
//                                if (item.cat=='dossier') {
//                                    array.map(item.children, function(devis,indice){
//                                        if (devis.id==iddevis){
//                                             item.children.splice(indice, 1) 
//                                        }
//                                    }) 
//                                }
////                                if (item.children.length==0){
////                                    object.devis.items.splice(index, 1)
////                                }                                
//                            });                
//            });
            this.menu.bind(new MenuOrganisations(), {
                                                hookPoint: "grid",
                                                selected: false
                                        });               
	},
        
        getIdSelectionne: function() {
            return this.idselectionne;
        },
        
        onRowClick: function(evt){    
            this.idselectionne= evt.rowId;               
//            this.select.row.clear();
//            this.row(evt.rowId).select();
            var detail = registry.byId("detail");
            detail.set('href','organisations/'+evt.rowId+'/show');
            detailorganisationstore.query("?id="+evt.rowId).then(function(results){
                grillecontacts.setStore(new Memory({data: results.resultat.contacts }));   
                grilledevis.setStore(new Memory({
                                                    data: results.resultat.devis,
                                                    getChildren : function(item){
                                                        return item.children;    
                                                    },
                                                    hasChildren : function(id, item){
                                                        return item && item.children && item.children.length;
                                                    }
                                                }));              
                grillecommandes.setStore(new Memory({data: results.resultat.commandes }));
                grilleactions.setStore(new Memory({data: results.resultat.actions }));                
            });                                  
            grilleapercudevis.setStore(new Memory({data: null })); 
        },           
        UpdateStore: function(store,layout){ 
            this.setStore(store); 
            this.structure=layout;
        },
        Ajouter_Ligne: function(ligne){
            this.store.put(ligne); 
        },       
	getStore : function(){
		return _this.store;
	},                
	getSelected : function(){
            var elementsselectionnes = this.select.row.getSelected(); 
//            console.log('Selected Rows is: ' + elementsselectionnes);            
            return elementsselectionnes
	},
	Ajouter_colonne : function(layout){
		this.setColumns(layout);
	},
	RemoveElement : function(idorg,iddevis,dossier){
                this.store.query({id:idorg}).forEach(function(object){
                            array.map(object.devis.items, function(item,index){ 
                                if (item.id==dossier) {
                                    array.map(item.children, function(devis,indice){
                                        if (devis.id==iddevis){
                                             item.children.splice(indice, 1) 
                                        }
                                    }) 
                                }
                                if (item.children.length==0){
                                    object.devis.items.splice(index, 1)
                                }                                
                            }); 
                });
	},      
//	AddDevis : function(idorg,devis){
////console.log(this.store.query({id:idorg}));            
//                this.store.query({id:idorg}).forEach(function(object){
//                            array.map(object.devis.items, function(item,index){ 
//                                if (item.id==devis.dossier) {
//                                    item.children.unshift(devis)
//                                }                          
//                            }); 
//                });
////console.log(this.store.query({id:idorg}));                  
//	},         
	AddDevis : function(lesresultats){          
                var dossiertrouve = false;
                this.store.query({id:lesresultats.idorg}).forEach(function(object){
                            array.map(object.devis.items, function(item,index){ 
                                if (item.id==lesresultats.resultat.children[0].dossier) {
                                    dossiertrouve = true
                                    item.children.unshift(lesresultats.resultat.children[0])
                                }                          
                            }); 
                });
                if (dossiertrouve==false) { 
                    if (this.idselectionne==lesresultats.idorg) {
                        grilledevis.store.add(lesresultats.resultat); 
                    };                    
                    this.store.query({id:lesresultats.idorg}).forEach(function(object){
                        object.devis.items.unshift(lesresultats.resultat);                    
                    });                     
                }               
	}, 
        
    });   
});

