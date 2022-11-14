	/**
	 * Revealing Module, imprimeix les informacions del tiquet amb DOM
	 */
	var miTiket=(function(){
	function init(){
		let recibo=JSON.parse(localStorage.getItem("carro"));
		let productos=localStorage.getItem("carro");
		console.log(recibo);
		let nomBeguda="";
		let cantBeguda="";
		let preuBeguda="";
		let nomMenjar="";
		let cantMenjar="";
		let preuMenjar="";
		let total=0;
		let idComanda=localStorage.getItem("idComanda");

		for (let i = 0; i < recibo.length; i++) {
			const element = recibo[i];
			console.log(element);
			if(element.tipus=="menjar"){
				nomMenjar+=`<p>${element.nom}</p>`;
				cantMenjar+=`<p>x ${element.quantitat}</p>`;
				preuMenjar+=`<p>${parseFloat(element.preu*element.quantitat).toFixed(2)}€</p>`;
			}else{
				nomBeguda+=`<p>${element.nom}</p>`;
				cantBeguda+=`<p>x ${element.quantitat}</p>`;
				preuBeguda+=`<p>${parseFloat(element.preu*element.quantitat).toFixed(2)}€</p>`;

			}
			total+=(element.preu*element.quantitat);
		}
		let inputHidden=`<input type='hidden' name='rebut' value='${productos}'>`;
		inputHidden+=`<input type='hidden' name='id_Comanda' value='${idComanda}'>`;

		document.getElementById("nomMenjar").innerHTML=nomMenjar;
		document.getElementById("cantMenjar").innerHTML=cantMenjar;
		document.getElementById("preuMenjar").innerHTML=preuMenjar;
		document.getElementById("nomBeguda").innerHTML=nomBeguda;
		document.getElementById("cantBeguda").innerHTML=cantBeguda;
		document.getElementById("preuBeguda").innerHTML=preuBeguda;
		document.getElementById("preuTotal").innerHTML=total.toFixed(2)+" €";
		document.getElementById("inputHidden").innerHTML=inputHidden;

	}
	
	return{
        init:init
    }  

})();
miTiket.init();


