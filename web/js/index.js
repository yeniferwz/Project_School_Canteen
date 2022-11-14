    /**
     * Funcio que crea un cookie per restringir al usuari que no pogui fer mes de una comanda al dia, i que nomes podra editar-la
     */
    var miIndex=(function(){
    function init(){
        let temps=new Date();
        let dia=temps.getDate();
        let mes=temps.getMonth()+1;
        let any=temps.getFullYear();
        let dataActual=`"${dia}-${mes}-${any}"`;

		let usuari=localStorage.getItem("diaComanda");
		console.log("LA COOKIE ES "+usuari);
        let idComanda=localStorage.getItem("idComanda");

		if(usuari==dataActual){
			htmlStr=`<a class="arrow-button" href="./?controller=menuModifica&action=${idComanda}">EDITA LA COMANDA<span class="arrow"></span></a>`;
			document.getElementById("botoInicial").innerHTML=htmlStr;
		}else{
			htmlStr=`<a class="arrow-button" href="./?controller=menu">COMPRA ARA!<span class="arrow"></span></a>`;
			document.getElementById("botoInicial").innerHTML=htmlStr;
			localStorage.clear();
		}

        $(document).ready(function(){
            $(window).scroll(function() {
                EasyPeasyParallax();
            });
        });
        Slider();
    }
    /**
     * funcio que fa el titol del banner desaparegui mentre faci scroll down
     */
    function EasyPeasyParallax() {
        scrollPos = $(this).scrollTop();
        $('#banner').css({
            'background-position' : '50% ' + (-scrollPos/4)+"px"
        });
        $('#bannertext').css({
            'margin-top': (scrollPos/4)+"px",
            'opacity': 1-(scrollPos/250)
        });
    }
    /**
     * funcio que mostra una galeria de fotos slideshow
     */
    function Slider() {
        const carouselSlides = document.querySelectorAll('.slide');
        const btnPrev = document.querySelector('.prev');
        const btnNext = document.querySelector('.next');
        const dotsSlide = document.querySelector('.dots-container');
        let currentSlide = 0;
      
        const activeDot = function (slide) {
            document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
            document.querySelector(`.dot[data-slide="${slide}"]`).classList.add('active');
        };
        activeDot(currentSlide);
    
        const changeSlide = function (slides) {
            carouselSlides.forEach((slide, index) => (slide.style.transform = `translateX(${100 * (index - slides)}%)`));
        };
        changeSlide(currentSlide);
    
        btnNext.addEventListener('click', function () {
            currentSlide++; 
            if (carouselSlides.length - 1 < currentSlide) {
                currentSlide = 0;
            };
            changeSlide(currentSlide);
            activeDot(currentSlide);
        });
        btnPrev.addEventListener('click', function () {
            currentSlide--;
            if (0 >= currentSlide) {
                currentSlide = 0;
            }; 
            changeSlide(currentSlide);
            activeDot(currentSlide);
        });
    
        dotsSlide.addEventListener('click', function (e) {
            if (e.target.classList.contains('dot')) {
                const slide = e.target.dataset.slide;
                changeSlide(slide);
                activeDot(slide);
            }
        });
      };

      return{
        init:init
    }   

})();
miIndex.init();