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

<?php
$nom = $_POST["nom"];
$cognom = $_POST["cognom"];
$correu = $_POST["correu"];
$telefon = $_POST["telf"];
$productes = json_decode($_POST["rebut"]);
?>
<div class="contingut">
    <div class="columns esta-centrat">
        <div class="column is-one-third is-offset-one-quarter">
            <h1 class="title">Gràcies per la teva compra!</h1>
            <h2 class="subtitle">La teva comanda és la número <?= $idComanda; ?></h2>
            <p>Rebràs un correu de confirmació a <strong><?= $correu ?></strong>.<br>Aviat ens posarem mans a l'obra!</p>
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
<script>
    let idComanda = document.getElementById("comanda").value;
    let temps = new Date();
    let dia = temps.getDate();
    let mes = temps.getMonth() + 1;
    let any = temps.getFullYear();
    let dataActual = `"${dia}-${mes}-${any}"`;
    localStorage.setItem("diaComanda", dataActual);
    localStorage.setItem("idComanda", idComanda);
</script>