require([
    "dojo/store/JsonRest",
    "dojo/domReady!"], 
function(JsonRest) {
        organisationsStore = new JsonRest({target: "listeorganisations"});
        adressesStores = new JsonRest({target: "listeadresses"});
        contactsStore = new JsonRest({target: "listecontacts"});   
        produitsStore = new JsonRest({target: "listeproduits"});   
        devisStore = new JsonRest({target: "/public/gestionzen/gestion/Devis/listedevis"});
        devisencoursStore = new JsonRest({target: "devisencours"});         
        lignesdevisStore = new JsonRest({target: "lignesdevis"});     
        lignescommandeStore = new JsonRest({target: "lignescommande"}); 
        organisationstore = new JsonRest({target: "listeorganisations"}); 
        detailorganisationstore = new JsonRest({target: "detailorganisation"});              
        contactstore = new JsonRest({target: "listecontacts"});  
        devisencoursStore = new JsonRest({target: "devisencours"});  
        modelecourrierStore = new JsonRest({target: "detailmodele"});  
        detaildevisStore = new JsonRest({target: "detaildevis"});   
        villesstore = new JsonRest({target: "listevilles"});  
        produitsStore = new JsonRest({target: "listeproduits"});
        tauxtvaStore = new JsonRest({target: "listetauxtva"});
        servicesStore = new JsonRest({target: "listeservices"}); 
        statutsStore = new JsonRest({target: "listestatuts"});
        centresinteretsStore = new JsonRest({target: "listecentresinterets"});
        modelesStore = new JsonRest({target: "listemodeles"});        
});

