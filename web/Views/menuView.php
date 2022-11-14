<div class="columns">
    <div class="column is-6 fil-ariadna">
        <nav class="breadcrumb" aria-label="breadcrumbs">
        <br>
            <ul>
                <li><a href="./?controller=index"><strong>Inici</strong></a></li>
                <li class="is-active"><a href="#" aria-current="page">Menú</a></li>
            </ul>
        </nav>
        <progress class="progress is-orange" value="25" max="100"></progress>
    </div>
</div>

<div class="columns">
    <div class="column is-three-fifths">
        <div id="llistaProductes"></div>
    </div>
    <div class="column is-one-third">
        <div class="sticky">
            <div class="box boxCistell">
                <h2 class="cart-title">El teu cistell</h2><br><br>
                <div class="columns">
                    <div class="column is-half" id="nomProducte"></div>
                    <div class="column auto" id="quantitatProducte"></div>
                    <div class="column auto" id="preuProducte"></div>
                    <div class="column is-1" id="remove"></div>
                </div>
                <div class="columns">
                    <div class="column" id="preuTotal"></div>
                </div>
            </div>
            <div class="buttons">
                <p><a href="./?controller=index" class="button" onclick="miMenu.esborraLS();">CANCEL·LA</a></p>
                <p>
                <div class="container" id="veureTicket">
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="column auto"></div>
</div>

</div>
<script src="./js/menu.js"></script>