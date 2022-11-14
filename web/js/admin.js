// function marcarFet(id){
//    console.log("Boto fet => "+id);
//    fetch("./index.php?controller=admin&action=fet,"+id)
//         .then((response) => response)
//         .then((data) =>{
//            console.log("DATA");
//            window.location.reload();
//            document.inerHTML=data;
//         });
// }

var model = {
   init: function() {
   },
   /**
    * @param  {} id
    * Avisa para cambiar el estado de la comanda y pide el html de la pagina actualizada y avisa al controller al recivirla
    */
   getComanda: function(id) {
      fetch("./index.php?controller=admin&action=fet,"+id)
      .then((response) => response)
      .then((data) =>{
         window.location.reload();
         controller.htmlActualitzat(data);
      });
   }
};


var controller = {

   init: function() {
   },

   //pide el html al controller
   btnPulsado(id){
      let html=model.getComanda(id);
   }, 
   //Pide a la vista que imprima el nuevo html
   htmlActualitzat:function(html){
      view.reload(html);
   }

};


var view = {
   init: function() {

   },
   //Avisa al controller que boton se ha pulsado
   btnPulsado:function(id){
      controller.btnPulsado(id);
   },

   //cambia el html del documento
   reload:function(html){
      document.innerHTML=html;
   }
};

controller.init();