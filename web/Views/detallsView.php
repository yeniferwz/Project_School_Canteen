
<div class="colums">
    <div class="column is-6 is-offset-3 contingut">
        <br><br>
        <div class="box">
            <div class="content">
                <h1 class="level-item has-text-centered"><strong>Comanda #<?php echo $id; ?></strong></h1><br>
                <?php
                for ($i = 0; $i < sizeof($lineas); $i++) {
                ?>
                    <div class="columns">
                        <div class="column is-4 text-centrat">
                            <p> <?php
                                if ($prod[$i]["idProducte"] == $lineas[$i]["idProducte"]) {
                                    echo $prod[$i]["nomProducte"];
                                } else {
                                    $trobat = false;
                                    $product = 0;
                                    while ($trobat == false) {
                                        if ($product < count($lineas)) {
                                            if ($prod[$product]["idProducte"] == $lineas[$i]["idProducte"]) {
                                                echo $prod[$product]["nomProducte"];
                                            }
                                            $product++;
                                        }
                                    }
                                }
                                ?> </p>
                        </div>
                        <div class="column is-3">
                            <p> x<?php echo $lineas[$i]["quantitat"] ?> </p>
                        </div>
                        <div class="column is-3">
                            <p> <?php echo number_format($lineas[$i]["preuUnitari"], 2) ?> € </p>
                        </div>
                        <div class="column is-3">
                            <p> <?php echo number_format($lineas[$i]["preuTotal"], 2) ?> € </p>
                        </div>
                    </div>
                <?php
                }
                ?>
                <br>
            </div>
        </div>
        <a href="./?controller=admin" style="width: 20%" class="button is-info is-medium">Enrere</a>

    </div>