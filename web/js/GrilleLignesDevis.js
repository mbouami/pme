define([
    "dojo/_base/declare",
    'dijit/registry',    
    "dojo/_base/array",
    "gridx/Grid",
    "dojo/store/Memory",
    "gridx/core/model/cache/Sync", 
    "dijit/registry",
    'gridx/allModules',
    "dijit/form/CurrencyTextBox",    
    "MenuLignesDevis",
    "MyEditor",
    'dojo/domReady!'
], function(declare,registry,array,Grid,Memory,Cache,registry,modules,CurrencyTextBox,MenuLignesDevis,MyEditor){    
return declare("GrilleLignesDevis", Grid,{       
        loadingMessage: 'Chargement en cours ...', 
        noDataMessage: 'Aucun résultat trouvé.',
//        autoHeight: true,
//        selectRowTriggerOnCell: true,
//        singleClickEdit: true,
//	autoWidth: true,
        selectRowMultiple: true,
        selectRowTriggerOnCell: true,        
        cacheClass: Cache,       
        class: 'grillelignesdevis', 
        niveau : null,
//        store : new Memory({ data: null}),
        structure: [ 
                    {field: 'ordre',name: 'Ordre',datatype: "string",width:'25px',style: "text-align: right"},                 
                    {field: 'reference',name: 'Référence',datatype: "string",width:'100px',style: "text-align: left", filterable: true}, 
                    {field: 'description',name: 'Libellé',datatype: "string",width:'250px',
                        style: "text-align: left",
                        editable: true,
                        editor: "dijit/Editor",
//                        editor: MyEditor,                          
                    },  
                    {field: 'quantite',name: 'Qt',datatype: "string",width:'50px',
                                        style: "text-align: center",
                                        editable: true,                                    
                                        editor: "dijit/form/NumberSpinner",
                    }, 
                    {field: 'prixht',name: 'Prix HT',datatype: "string",width:'100px',
                            style: "text-align: center",
                            editable: true,
                            editor: CurrencyTextBox,
                            editorArgs: {
                                type: CurrencyTextBox,
                                props: 'constraints:{fractional:true},currency: "EUR",lang: "fr-fr"'
                            },
                            formatter: function(rawData){
                                return isNaN(rawData.prixht) ? '' : parseFloat(rawData.prixht).toFixed(2)+' €';
                            },
                    },  
                    {field: 'remise',name: 'Remise<br>%',datatype: "string",width:'50px', 
                            style: "text-align: center",
                            editable: true,
                            editor: CurrencyTextBox,
                            editorArgs: {
                                type: CurrencyTextBox,                
                                props: 'constraints:{fractional:true},currency: "%",lang: "fr-fr"'
                            },
                            formatter: function(rawData){
                                return isNaN(rawData.remise) ? '' : parseFloat(rawData.remise).toFixed(2)+' %';
                            },                        
                    },
                    {field: 'totalht',name: 'Total HT',datatype: "string",width:'100px', 
                            style: "text-align: right",
                            editable: false,
                            editor: CurrencyTextBox,
                            editorArgs: {
                                props: 'constraints:{fractional:true},currency: "EUR",lang: "fr-fr",disabled="true"'
                            },  
                            formatter: function(rawData){
                                return isNaN(rawData.totalht) ? '' : parseFloat(rawData.totalht).toFixed(2)+' €';
                            },
                    },              
                   ], 
	modules : [
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
                        modules.CellWidget,
                        modules.Edit, 
                        modules.SelectRow,
                        modules.ExtendedSelectRow,                        
                ],         
        constructor: function(args){
            _this = this;          
            this.niveau = args.niveau;
            this.store = new Memory({ data: JSON.parse(args.donnees)});
        },        
	postCreate: function(){      
            this.inherited(arguments);            
//            if (this.iddevis > 0) {
//                lignesdevisStore.query({ iddevis: this.iddevis }).then(function(lesproduits){                     
//                    _this.setStore(new Memory({data: lesproduits }));  
//                    _this.calculerTotaux();
//                });  
//            }                
            this.menu.bind(new MenuLignesDevis(), {
                                                hookPoint: "grid",
                                                selected: false
                                        });  
            this.edit.connect(this.edit, "onApply", function(cell, success) {
                _this.calculerTotalHtParLigne(cell, success);
            }) 
        },
        UpdateStore: function(store){ 
            this.setStore(store);
        },
        Ajouter_Item: function(item){
            this.store.add(item); 
        },         
	Ajouter_colonne : function(layout){
		this.setColumns(layout);
	},        
        calculerTotalHtParLigne : function(cell, applySuccess){
            var totalhtligne = parseFloat(this.cell(cell.row.index(), 4).data())*parseFloat(this.cell(cell.row.index(), 5).data())*(100-parseFloat(this.cell(cell.row.index(), 6).data()))/100;
            this.cell(cell.row.index(), 7).setRawData(totalhtligne);
            this.calculerTotaux();
        },
        calculerTotaux : function(){
            var totalht = 0;
            var champstauxtva = registry.byId("devis_tauxtva_"+this.niveau);
            var champstotalht = registry.byId("devis_totalht_"+this.niveau);     
            var champstotaltva = registry.byId("devis_totaltva_"+this.niveau);
            var champsfraisport = registry.byId("devis_fraisport_"+this.niveau); 
            var champstotalttc = registry.byId("devis_totalttc_"+this.niveau);  
            for (var i=0;i<this.rowCount();i++){                  
                totalht += parseFloat(this.cell(i, 7).data());   
            } 
            if (!champsfraisport.get('value')) champsfraisport.set('value',0);
            champstotalht.set('value',totalht);
            champstotaltva.set('value',champstauxtva.get('displayedValue')*totalht/100);
            champstotalttc.set('value',totalht+champstotaltva.get('value')+champsfraisport.get('value'));            
        },               
        DupliquerLesLignes : function(row){   
                            var data = {
                                            ordre:this.rowCount()+1,
                                            reference: row.rawData.reference,
                                            description: row.rawData.description,
                                            quantite: row.rawData.quantite,    
                                            prixht: row.rawData.prixht,      
                                            remise: row.rawData.remise, 
                                            totalht: row.rawData.totalht,     
                                        };                                          
                            this.Ajouter_Item(data);
                            this.calculerTotaux();
        },   
        SupprimerLesLignes : function(){   
            var selection = this.select.row.getSelected();
            for (i=0;i<selection.length;i++){
                this.store.remove(_this.model.byId(selection[i]).rawData.id);
            }          
//                    this.OrdonnerLesLignes();
            this.calculerTotaux();
        }, 
        OrdonnerLesLignes : function(){  
            for (var i=0;i<this.rowCount();i++){
                this.cell(i, 0).setRawData(i+1);
            } 
        },          
	getValeur : function(indicerow,indicecolumn){
                    return parseFloat(_this.cell(indicerow,indicecolumn).data()).toFixed(2);
        },     
	getDataJson : function(){
                var lignesdevis = _this.store.data;
//                var data = [lignedevis["ordre"],lignedevis["reference"],"coucou",5,"32.25",0,"25.26"]; 
            var data = [];                 
//                var sortie = null;
                array.map(lignesdevis, function(lignedevis,index){ 
                    data.push({
                    ordre:lignedevis["ordre"],
                    reference: lignedevis["reference"],
                    description: lignedevis["description"],
                    quantite: lignedevis["quantite"],    
                    prixht: lignedevis["prixht"],      
                    remise: lignedevis["remise"], 
                    totalht: lignedevis["totalht"],     
                        });                       
                });
                console.log(lignesdevis);
                return lignesdevis;
        },          
    });      
});

