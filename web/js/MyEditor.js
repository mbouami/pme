define([
    "dojo/_base/declare",
    'dijit/registry',  
    "dijit/Editor",
    "dijit/_editor/plugins/FontChoice", // 'fontName','fontSize','formatBlock'
    "dijit/_editor/plugins/TextColor"             
],function(declare,registry,Editor){
    return declare("MyEditor", Editor,{
        extraPlugins: ['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true}],
        _this: null,
        constructor: function(){ 
              _this = this;
        },   
        
        postCreate: function(){
            this.inherited(arguments);
        }
    })
})
