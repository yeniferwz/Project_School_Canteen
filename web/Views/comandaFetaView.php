<div class="columns">
    <div class="column is-6 fil-ariadna">
        <nav class="breadcrumb" aria-label="breadcrumbs">
            <br>
            <ul>
                <li><a href="./?controller=index"><strong>Inici</strong></a></li>
                <li><a href="./?controller=menu"><strong>Menú</strong></a></li>
                <li><a href="./?controller=ticket"><strong>La teva comanda</strong></a></li>
                <li class="is-active"><a href="#" aria-current="page">Confirmació</a></li>
            </ul>
        </nav>
        <progress class="progress is-orange" value="100" max="100"></progress>
    </div>
</div>
<div class="contingut">
    <div class="columns esta-centrat">
        <div class="column is-one-third is-offset-one-quarter">
            <h1 class="title">La teva comanda ja està preparada!</h1>
            <h2 class="subtitle">Recorda que el teu número de comanda és <?= $id; ?>.</h2>
            <p>Ja la pots recollir a la cantina!</p>
            <br>
            <input type="hidden" value="<?= $idComanda ?>" id="comanda">
            <a href="./?controller=index" class="button is-orange">TORNA A L'INICI</a>
        </div>
        <div class="column">
            <br>
            <img src="./img/making.gif" alt="Sandwich" style="width:200px;height:200px;">
        </div>
    </div>
</div>

<br>