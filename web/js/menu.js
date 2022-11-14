var miMenu=(function(){
    let datos = []; //vector que rep dades del json que em retorna
    let ruta="api/getMenus.php";
    let r2="http://localhost/Cantina/transversal_1-cantina-cantina-2/web/MVC/?controller=menu&action=fetchMenu";
    let r3="./?controller=menu&action=fetchMenu";
    let productesSeleccionats = [];

    function init(){
        fetch(r3)
        .then((response) => response.json())
        .then((data) =>{
            console.log(data)
            datos = data;
            renderProductes();
        });
    }
    
    function checkHora() {
        if ((hora == 11 && minuts > 30) || hora > 11) {
            datos = datos.tarda;
        } else {
            datos = datos.mati;
        }
    }
    
    /**
     * Funcio que es mostra els productes depenent de la hora local que esta.
     * Per l'altra banda, mostrara un missatge en el grid del producte per indicar si queda stocks o un warning de pocs stocks que queda i depenent d'aixo li mostrara butons o no
     */
    function renderProductes(){
        let temps = new Date();
        hora = temps.getHours();
        minuts=temps.getMinutes();
        const MINIM_STOCKS = 5;

        checkHora();

        //mostrar la galeria de productes del mati
        let htmlStr = `<div class="product-content" id="producte">`;
        for (let i = 0; i < datos.length; i++) {
            htmlStr+=`<div class='product-box'>
                    <img class='product-img' src = '${datos[i].UrlImg}' alt='' width='400px' height='400px'></a>
                    <h2 class='nom'>${datos[i].nom}</h2>
                    <span class='preu'>${parseFloat(datos[i].preu).toFixed(2)} €</span>`;
            if(datos[i].stock <= MINIM_STOCKS && datos[i].stock > 0){
                htmlStr += `<br><p style="font-size:14px; display:inline-block; color:orange;font-weight:bold;">Només queden ${datos[i].stock} unitats! </p>
                <i class='bx bx-plus-circle plus' id="botonPlus" onclick="miMenu.renderEstado(1,${datos[i].id}, '${datos[i].nom}', ${datos[i].preu},'${datos[i].tipus}','${datos[i].UrlImg}',${datos[i].stock})"></i>
                <i class='bx bx-minus-circle minus' onclick="miMenu.renderEstado(0,${datos[i].id}, '${datos[i].nom}', ${datos[i].preu},'${datos[i].tipus}','${datos[i].UrlImg}',${datos[i].stock})"></i>`;
            }else if(datos[i].stock == 0){
                htmlStr += `<p style="font-size:14px; color:red;font-weight:bold;">ESGOTAT</p>`;
            }else{
                htmlStr += `<br>
                    <i class='bx bx-plus-circle plus' id="botonPlus" onclick="miMenu.renderEstado(1,${datos[i].id}, '${datos[i].nom}', ${datos[i].preu},'${datos[i].tipus}','${datos[i].UrlImg}',${datos[i].stock})"></i>
                    <i class='bx bx-minus-circle minus' onclick="miMenu.renderEstado(0,${datos[i].id}, '${datos[i].nom}', ${datos[i].preu},'${datos[i].tipus}','${datos[i].UrlImg}',${datos[i].stock})"></i>`;
            }
            htmlStr += `</div>`;
        }
        htmlStr += `</div>`
        document.getElementById("llistaProductes").innerHTML = htmlStr;
        
        if(localStorage.length!=0){
            productesSeleccionats=JSON.parse(localStorage.getItem("carro"));
            renderTiket();
        }
    }
    
    /**
     * @param  {} operacio operacio que decideix fer l'usuari --> AFEGIR o TREURE quantitat del producte
     * @param  {} idProducte idProducte del vector que li retorna des del fetch (retorna un JSON)
     * @param  {} nom
     * @param  {} preu
     * @param  {} tipus
     * @param  {} imatge
     * @param  {} stock
     * En el moment que doni click AFEGIR de qualsevol producte, es guardara tota la info del producte al vector productesSeleccionats (previament inicialitzat)
     */
    function renderEstado(operacio, idProducte, nom, preu,tipus,imatge,stock){
        const AFEGIR = 1;
        const TREURE = 0;
        if(operacio == AFEGIR){
            //comprova que no pugui afegir mes productes
            if(productesSeleccionats.length == 0){
                productesSeleccionats[0] = {"id": idProducte, "nom": nom, "preu":preu.toFixed(2), "quantitat": 1, "tipus": tipus, "imatge":imatge, "stock":stock}
            }else{
                let compt = 0;
                for(let i = 0; i < productesSeleccionats.length ; i++){
                    if(idProducte == productesSeleccionats[i].id){
                        compt = 1;
                        if(productesSeleccionats[i].quantitat < parseInt(productesSeleccionats[i].stock)){
                            productesSeleccionats[i].quantitat += 1;
                        }
                    }
                }
                if(compt == 0){
                    productesSeleccionats.push({"id": idProducte, "nom": nom, "preu":preu.toFixed(2), "quantitat": 1, "tipus": tipus, "imatge":imatge, "stock":stock});
                }
            }
        }else{
            if(operacio == TREURE){
                if(productesSeleccionats != 0){
                    for(let  i = 0; i < productesSeleccionats.length; i++){
                        if(idProducte == productesSeleccionats[i].id){
                            if(productesSeleccionats[i].quantitat == 1){
                                productesSeleccionats.splice(i,1);
                            }else{
                                productesSeleccionats[i].quantitat -= 1;
    
                            }
                        }
                    }
                }
            }
        }
        renderTiket();
    }
    
    /**
     * Un tiquet al costat de la navegacio dels productes per mostrar items seleccionats en detalls i mostrara el preu.
     */
    function renderTiket(){
        let nomProducte = "";
        let preuProducte = "";
        let quantitatProducte = "";
        let preuTotal = 0;
        let paperera="";
    
        for(let i = 0; i <productesSeleccionats.length; i++){
            nomProducte += `<p>${productesSeleccionats[i].nom}</p>`;
            quantitatProducte += `<p>${productesSeleccionats[i].quantitat}</p>`;
            preuProducte += `<p>${productesSeleccionats[i].preu} €</p>`;
            preuTotal += (productesSeleccionats[i].preu * productesSeleccionats[i].quantitat);
            paperera+= `<i class="bx bxs-trash-alt esborrar" onclick="miMenu.esborrarProducte(${productesSeleccionats[i].id});"></i><br>`;
        }
    
        document.getElementById("nomProducte").innerHTML = nomProducte;
        document.getElementById("quantitatProducte").innerHTML = quantitatProducte;
        document.getElementById("preuProducte").innerHTML = preuProducte;
        document.getElementById("remove").innerHTML = paperera;
        localStorage.setItem("carro",JSON.stringify(productesSeleccionats));
    
        //Aquesta area sera disabled MENTRE no hem afegir ningun producte
        let botoString = "";
        let quantitatTotal = "";
        if(productesSeleccionats.length >= 1){
            botoString += `<a href="./?controller=ticket" class="button is-orange centrat" id="veureTicket" style="float:right; margin-right:20px">VEURE TICKET</a>`;
            quantitatTotal += "<hr style='width:100%'><strong><p class='preuTotal'>TOTAL: "+preuTotal.toFixed(2)+" €</strong></p>";
        }
        document.getElementById("preuTotal").innerHTML = quantitatTotal;
        document.getElementById("veureTicket").innerHTML = botoString;
    }
    
    /**
     * @param  {} id parametre de la funcio, es un id del producte del JSON
     * Funcio que compara el id del productesSeleccionats i el id del vector datos (JSON que li retorna del fetch)
     */
    function esborrarProducte(id){
        for(let i = 0; i < productesSeleccionats.length; i++){
            if(productesSeleccionats[i].id === id){
                productesSeleccionats.splice(i,1);
            }
        }
        localStorage.setItem("carro",JSON.stringify(productesSeleccionats));
        console.log("select "+ producte);
        renderTiket();
    }

    return{
        init:init,
        renderEstado:renderEstado,
        esborrarProducte:esborrarProducte
    }   
})();

miMenu.init();
