let productos="";
let recibo="";

var model = {
	init: function() {
		productos=localStorage.getItem("carro");
		recibo=JSON.parse(localStorage.getItem("carro"));
	},
	getRecibo:function(){
		return recibo;
	},
};

var controller = {
	init: function() {
		model.init();
		view.init();
	},
	pedirRecibo:function(){
		return model.getRecibo();

	},
	/**
	 * @param  {} e --> to preventDefault
	 * Funcio que crida altres funcions per comprovar si les dades introduides de l'usuari al form estigui totes correctes
	 */
	confirma:function(e){
		let mensajeNOM = "";
		let mensajeCOGNOM = "";
		let mensajeCORREU = "";
		let mensajeTELF = "";
		e.preventDefault();
	
		const nom = document.getElementById('nom').value;
		const cognoms = document.getElementById('cognom').value;
		const correo = document.getElementById('correu').value;
		const tel = document.getElementById('telf').value;
	
		let noms_correcte = new Boolean(false);
		let cognoms_correcte = new Boolean(false);
		let correo_correcte = new Boolean (false);
		let tel_correcte = new Boolean (false);
	
		//VALIDAR EL NOMBRE Y APELLIDOS
		({ mensajeNOM, noms_correcte, mensajeCOGNOM, cognoms_correcte } = this.checkNomsCognoms(nom, mensajeNOM, noms_correcte, cognoms, mensajeCOGNOM, cognoms_correcte));
	
		//VALIDAR CORREO
		({ mensajeCORREU, correo_correcte } = this.checkCorreo(correo, mensajeCORREU, correo_correcte));
	
		//VALIDAR TELEFON
		({ mensajeTELF, tel_correcte } = this.checkTelefon(tel, mensajeTELF, tel_correcte));
	
		// document.getElementById("errorNOM").innerHTML = mensajeNOM;
		// document.getElementById("errorCOGNOM").innerHTML = mensajeCOGNOM;
		// document.getElementById("errorCORREU").innerHTML = mensajeCORREU;
		// document.getElementById("errorTELF").innerHTML = mensajeTELF;
		view.mensajesComp(mensajeNOM,mensajeCOGNOM,mensajeCORREU,mensajeTELF);
	
		this.validarRegex(noms_correcte, cognoms_correcte, correo_correcte, tel_correcte);
	
	},
	/**
	 * @param  {} nom
	 * @param  {} mensajeNOM
	 * @param  {} noms_correcte
	 * @param  {} cognoms
	 * @param  {} mensajeCOGNOM
	 * @param  {} cognoms_correcte
	 * Aquesta funcio fara la comprovacio dels camps del nom i cognom del formulari, si no estan buits retornara un true i vice versa.
	 */
	checkNomsCognoms:function(nom, mensajeNOM, noms_correcte, cognoms, mensajeCOGNOM, cognoms_correcte) {
		if (nom == "") {
			mensajeNOM += "<p style='color:red'>Introdueix el teu nom</p>";
		} else {
			noms_correcte = true;
		}
	
		if (cognoms == "") {
			mensajeCOGNOM += "<p style='color:red'>Introdueix el teu cognom</p>";
		} else {
			cognoms_correcte = true;
		}
		return { mensajeNOM, noms_correcte, mensajeCOGNOM, cognoms_correcte };
	},
	/**
	 * @param  {} correo
	 * @param  {} mensajeCORREU
	 * @param  {} correo_correcte
	 * Aquesta funcio fara la comprovacio del correo que tingui un domini fix de format @inspedralbes.cat, retorna true si compleix i vice versa
	 */
	checkCorreo:function(correo, mensajeCORREU, correo_correcte) {
		if (!((/inspedralbes.cat\s*$/.test(correo)))) {
			mensajeCORREU += "<p style='color:red'>El correu ha de ser de domini @inspedralbes.cat</p>";
		} else {
			correo_correcte = true;
		}
		return { mensajeCORREU, correo_correcte };
	},
	/**
	 * @param  {} tel
	 * @param  {} mensajeTELF
	 * @param  {} tel_correcte
	 * Aquesta funcio fara la comprovacio del numero de telefon, ha de comencar amb 6 o 7 i que contingui 9 valors, retornara un true si compleix i si no, un false
	 */
	checkTelefon:function(tel, mensajeTELF, tel_correcte) {
		let telRegex = new RegExp('^\([6-7]{1}\)([0-9]{8})$');
		if (!(telRegex.test(tel))) {
			mensajeTELF += "<p style='color:red'>El telèfon no és correcte</p>";
		} else {
			tel_correcte = true;
		}
		return { mensajeTELF, tel_correcte };
	},
	/**
	 * @param  {} noms_correcte variable booleana
	 * @param  {} cognoms_correcte variable booleana
	 * @param  {} correo_correcte variable booleana
	 * @param  {} tel_correcte variable booleana
	 * funcio que s'agafa totes les variables booleanes per pas de parametre de les funcions corresponents, si totes les variables son true, s'enviara les infos del usuari
	 */
	validarRegex:function(noms_correcte, cognoms_correcte, correo_correcte, tel_correcte) {
		if (noms_correcte == true && cognoms_correcte == true && correo_correcte == true && tel_correcte == true) {
			// model.esborraLS();
			view.enviaInfo();
			console.log("info correcte");
		}
	}
};


var view = {
	init: function() {
		this.imprimirTiket();
		let inputHidden=`<input type='hidden' name='rebut' value='${productos}'>`;
		document.getElementById("inputHidden").innerHTML=inputHidden;
		const form = document.getElementById('confirma');
		form.addEventListener('click',function(e){	
			controller.confirma(e);
		});
	},

	getnom:function(){
		return document.getElementById('nom').value;
	},
	getCognoms:function(){
		return document.getElementById('cognom').value;
	},
	getCorreo:function(){
		return document.getElementById('correu').value;
	},
	getTel:function(){
		return document.getElementById('telf').value;
	},
	/**
	 * funcio per imprimir totes les informacions del tiquet i pasar-li al html mitjancant DOM
	 */
	imprimirTiket:function(){
		let recibo=controller.pedirRecibo();
		let nomBeguda="";
		let cantBeguda="";
		let preuBeguda="";
		let nomMenjar="";
		let cantMenjar="";
		let preuMenjar="";
		let total=0;

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

		document.getElementById("nomMenjar").innerHTML=nomMenjar;
		document.getElementById("cantMenjar").innerHTML=cantMenjar;
		document.getElementById("preuMenjar").innerHTML=preuMenjar;
		document.getElementById("nomBeguda").innerHTML=nomBeguda;
		document.getElementById("cantBeguda").innerHTML=cantBeguda;
		document.getElementById("preuBeguda").innerHTML=preuBeguda;
		document.getElementById("preuTotal").innerHTML=total.toFixed(2)+" €";

	},
	enviaInfo:function() {
		document.getElementById("formulari").submit();
	},
	mensajesComp:function(mensajeNOM,mensajeCOGNOM,mensajeCORREU,mensajeTELF){
		document.getElementById("errorNOM").innerHTML = mensajeNOM;
		document.getElementById("errorCOGNOM").innerHTML = mensajeCOGNOM;
		document.getElementById("errorCORREU").innerHTML = mensajeCORREU;
		document.getElementById("errorTELF").innerHTML = mensajeTELF;
	}
};

controller.init();


//let recibo=JSON.parse(reciboStrng);
//console.log(recibo);
// let nomBeguda="";
// let cantBeguda="";
// let preuBeguda="";
// let nomMenjar="";
// let cantMenjar="";
// let preuMenjar="";
// let total=0;

// for (let i = 0; i < recibo.length; i++) {
// 	const element = recibo[i];
// 	console.log(element);
// 	if(element.tipus=="menjar"){
// 		nomMenjar+=`<p>${element.nom}</p>`;
// 		cantMenjar+=`<p>x ${element.quantitat}</p>`;
// 		preuMenjar+=`<p>${parseFloat(element.preu*element.quantitat).toFixed(2)}€</p>`;
// 	}else{
// 		nomBeguda+=`<p>${element.nom}</p>`;
// 		cantBeguda+=`<p>x ${element.quantitat}</p>`;
// 		preuBeguda+=`<p>${parseFloat(element.preu*element.quantitat).toFixed(2)}€</p>`;

// 	}
// 	total+=(element.preu*element.quantitat);
// }
//let inputHidden=`<input type='hidden' name='rebut' value='${productos}'>`;

// document.getElementById("nomMenjar").innerHTML=nomMenjar;
// document.getElementById("cantMenjar").innerHTML=cantMenjar;
// document.getElementById("preuMenjar").innerHTML=preuMenjar;
// document.getElementById("nomBeguda").innerHTML=nomBeguda;
// document.getElementById("cantBeguda").innerHTML=cantBeguda;
// document.getElementById("preuBeguda").innerHTML=preuBeguda;
// document.getElementById("preuTotal").innerHTML=total.toFixed(2)+" €";
// document.getElementById("inputHidden").innerHTML=inputHidden;


// function enviaInfo() {
// 	document.getElementById("formulari").submit();
// }

// function checkNomsCognoms(nom, mensajeNOM, noms_correcte, cognoms, mensajeCOGNOM, cognoms_correcte) {
// 	if (nom == "") {
// 		mensajeNOM += "Introdueix el teu nom";
// 	} else {
// 		noms_correcte = true;
// 	}

// 	if (cognoms == "") {
// 		mensajeCOGNOM += "Introdueix el teu cognom";
// 	} else {
// 		cognoms_correcte = true;
// 	}
// 	return { mensajeNOM, noms_correcte, mensajeCOGNOM, cognoms_correcte };
// }


// function checkCorreo(correo, mensajeCORREU, correo_correcte) {
// 	if (!((/inspedralbes.cat\s*$/.test(correo)))) {
// 		mensajeCORREU += "El correu ha de ser de domini @inspedralbes.cat";
// 		// document.getElementById("correu").style = "background:red";
// 	} else {
// 		// document.getElementById("correu").style = "background:green";
// 		correo_correcte = true;
// 	}
// 	return { mensajeCORREU, correo_correcte };
// }

// function checkTelefon(tel, mensajeTELF, tel_correcte) {
// 	let telRegex = new RegExp('^\([6-7]{1}\)([0-9]{8})$');
// 	if (!(telRegex.test(tel))) {
// 		mensajeTELF += "El telèfon no és correcte";
// 		// document.getElementById("telf").style = "background:red";
// 	} else {
// 		// document.getElementById("telf").style = "background:green";
// 		tel_correcte = true;
// 	}
// 	return { mensajeTELF, tel_correcte };
// }

// function esborraLS() {
// 	localStorage.removeItem("carro");
// }

// function validarRegex(noms_correcte, cognoms_correcte, correo_correcte, tel_correcte) {
// 	if (noms_correcte == true && cognoms_correcte == true && correo_correcte == true && tel_correcte == true) {
// 		esborraLS();
// 		enviaInfo();
// 		console.log("info correcte");
// 	}
// }

//const form = document.getElementById('confirma');

// function confirma(e){
// 	let mensajeNOM = "";
// 	let mensajeCOGNOM = "";
// 	let mensajeCORREU = "";
// 	let mensajeTELF = "";
// 	e.preventDefault();

// 	const nom = document.getElementById('nom').value;
// 	const cognoms = document.getElementById('cognom').value;
// 	const correo = document.getElementById('correu').value;
// 	const tel = document.getElementById('telf').value;

// 	let noms_correcte = new Boolean(false);
// 	let cognoms_correcte = new Boolean(false);
// 	let correo_correcte = new Boolean (false);
// 	let tel_correcte = new Boolean (false);

// 	//VALIDAR EL NOMBRE Y APELLIDOS
// 	({ mensajeNOM, noms_correcte, mensajeCOGNOM, cognoms_correcte } = checkNomsCognoms(nom, mensajeNOM, noms_correcte, cognoms, mensajeCOGNOM, cognoms_correcte));

// 	//VALIDAR CORREO
// 	({ mensajeCORREU, correo_correcte } = checkCorreo(correo, mensajeCORREU, correo_correcte));

// 	//VALIDAR TELEFON
// 	({ mensajeTELF, tel_correcte } = checkTelefon(tel, mensajeTELF, tel_correcte));

// 	document.getElementById("errorNOM").innerHTML = mensajeNOM;
// 	document.getElementById("errorCOGNOM").innerHTML = mensajeCOGNOM;
// 	document.getElementById("errorCORREU").innerHTML = mensajeCORREU;
// 	document.getElementById("errorTELF").innerHTML = mensajeTELF;

// 	validarRegex(noms_correcte, cognoms_correcte, correo_correcte, tel_correcte);

// }


// form.addEventListener('click',function(e){
// 	confirma(e);
// });