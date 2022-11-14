<div class="colums">
    <div class="column is-7 is-offset-one-fifth contingut">
        <br><br>
        <div class="box">
            <div class="content">
                <h1 class="level-item has-text-centered"><strong>Comandes d'avui</strong></h1>
                <br>
                <?php
                for ($i = 0; $i < sizeof($comandes); $i++) {
                ?>
                    <div class="columns">
                        <div class="column is-2 is-offset-1 text-centrat">
                            <p> <?php echo $comandes[$i]["dataComanda"] ?> </p>
                        </div>
                        <div class="column is-1 text-centrat">
                            <p> <?php echo $comandes[$i]["idComanda"] ?> </p>
                        </div>
                        <div class="column is-4 text-centrat">
                            <p> <?php echo $comandes[$i]["correu"] ?> </p>
                        </div>
                        <div class="column ">
                            <div class="buttons" style="margin-left:22px">
                                <a class="button is-warning" style="width:90px" href="./?controller=detalls&action=<?php echo $comandes[$i]['idComanda'] ?>">Detalls</a>
                                <?php
                                if ($comandes[$i]["fet"] == 0) {
                                ?>
                                    <button class="button is-success" style="width:100px" onclick="view.btnPulsado(<?php echo $comandes[$i]['idComanda'] ?>)">Marcar feta</button>
                                <?php
                                } else {
                                ?>
                                    <button class="button is-success" style="width:90px" disabled>Feta</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <a href="./?controller=index" style="width: 100%" class="button is-info is-medium">TORNA A L'INICI</a>
    </div>
</div>

<script src="./js/admin.js"></script>