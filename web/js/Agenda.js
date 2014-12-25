define([
            "dojo/_base/declare",
            "dojox/calendar/Calendar",
            "dojo/request/xhr",
            "dojo/store/Memory",
            "dojo/store/Observable",              
            "dojo/date",
            "dojo/request",
            "dojo/dom-class",
            "dojo/dom-attr",
            "dojo/dom-construct",
            "dojo/date/locale",
            "dijit/Menu",
            "dijit/MenuItem",           
            "dijit/form/Textarea",
            "dijit/form/FilteringSelect",
            "dijit/form/TextBox",
            "dojox/form/CheckedMultiSelect",                
],function(declare,Calendar,xhr,Memory,Observable,date,request,domClass,domAttr,domConstruct,locale,Menu,MenuItem){
    return declare("Agenda", Calendar,{
        start: null,
        end : null,
        pMenu: null,
        id: null,
        createOnGridClick: true,
//        selectionMode: "none",
//        resizeEnabled: false,
        editable: false,
        _this: null,
        constructor: function(){ 
              _this = this;
        },   
        
        postCreate: function(){
//            this.inherited(arguments);
//            menuagenda = new MenuAgenda();
//            menuagenda.bindDomNode(this.domNode); 
        },
//        onGridClick: function(e){
//            console.log('onExpandRendererClick');
//        },
        onGridDoubleClick: function(e){    
            var colView = this.columnView;
            var cal = this.dateModule;
            var start = this.floorDate(e.date, "minute", colView.timeSlotDuration);           
            var end = cal.add(start, "minute", colView.timeSlotDuration*8);
            var d=start.valueOf()/1000;            
////                dijit.byId(zoneevenement).set({'href':'pnevenements/new/0/'+d.toPrecision(10),
////                                               'title':'Nouvel évenement'});
//            var item = {
//                    summary: "Nouvel Evenement",
//                    startTime: start,
//                    endTime: end,
//            };
//            this.store.add(item);
            var href = "pnevenements/new?start="+d;
            AfficherDialogue(href,"nouvel évenement"); 
        },      
                
//        UpdateStore: function(donnees){ 
//
//            var mystore = new Observable(new Memory({data: donnees}));
//            this.set("store", mystore);
//            this.store.put(mystore);
//        },
                
        getStart: function(){
            return this.start;
        },
        getEnd: function(){
            return this.end;
        },  
        getId: function(){
            return this.id;
        },   
        setId: function(val){
            this.id = val;
        },                 
//        onItemDoubleClick: function(e){
//            this.setId(e.item.id);
//            var lien = 'pnevenements/'+e.item.id+'/edit';
//            var titre = 'Propriété de l\'évenement';            
//            dijit.byId(zoneevenement).set('title',titre);
//            dijit.byId(zoneevenement).set('href',lien);  
//        },
//        onItemContextMenu: function(e){
//            this.setId(e.item.id);
//            dojo.stopEvent(e.triggerEvent);
//            pMenu._openMyself({ 
//                    target: e.renderer.domNode, 
//                    coords: {x: e.triggerEvent.pageX, y: e.triggerEvent.pageY} 
//            });
//        },
        onItemClick: function(e){
            this.setId(e.item.id);
//            console.log(this.getId()+"onItemClick :"+e.item.startTime+"---"+e.item.endTime);
        },
        deleteItem: function(){
            if (this.getId() != null) {
                    var lien = 'suppression/'+this.getId();
                    xhr(lien, {
                      handleAs: "json"
                    }).then(function(data){
                        if (data.action=="delete" && data.erreur==false){
                            _this.store.remove(_this.getId());
                            _this.setId(null);
                        }
                    }, function(err){
                        console.log(err);
                    }, function(evt){
                      // Handle a progress event from the request if the
                      // browser supports XHR2
                        console.log(err);                      
                    });                
            }
        },                
        onItemDoubleClick: function(e){
            this.setId(e.item.id);
            var lien = 'pnevenements/'+e.item.id+'/edit';
            var titre = 'Propriété de l\'évenement'; 
            AfficherDialogue(lien,titre);
        },
//        onItemEditBegin: function(e){
//            console.log("Begin :"+e.item.startTime+"---"+e.item.endTime);
//        },
        onItemEditBegin: function(e){
            console.log(e.item.id+"Begin :"+e.item.startTime+"---"+e.item.endTime);
        },
        onItemEditEnd: function(e){
            console.log(e.item.id+"End :"+e.item.startTime+"---"+e.item.endTime);
//            debutdate.set("value", e.item.startTime);
//            debuttemp.set("value", e.item.startTime);
//            findate.set("value", e.item.endTime);
//            fintemp.set("value", e.item.endTime);
        }
    })
    
})
