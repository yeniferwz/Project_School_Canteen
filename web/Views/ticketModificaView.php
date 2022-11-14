<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter"></div>
            <div class="column is-half">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="./?controller=index"><strong>Inici</strong></a></li>
                        <li><a href="./?controller=menu"><strong>Menú</strong></a></li>
                        <li class="is-active"><a href="#" aria-current="page">La teva comanda</a></li>
                    </ul>
                </nav>
                <progress class="progress is-orange" value="75" max="100">75%</progress>

                <div class="box">
                    <div class="content">
                        <br>
                        <h2 class="level-item has-text-centered"><strong>El teu ticket</strong></h2><br>
                        <form action="./?controller=finishModifica" method="POST" id="formulari2">
                            <ul>
                                <h5>Menjar</h5>
                                <hr>
                                <div class="columns">
                                    <div class="column is-three-fifths" id="nomMenjar">
                                    </div>
                                    <div class="column" id="cantMenjar">
                                    </div>
                                    <div class="column" id="preuMenjar">
                                    </div>
                                </div>
                            </ul>
                            <br>
                            <ul>
                                <h5>Beguda</h5>
                                <hr>
                                <div class="columns">
                                    <div class="column is-three-fifths" id="nomBeguda">
                                    </div>
                                    <div class="column" id="cantBeguda">
                                    </div>
                                    <div class="column" id="preuBeguda">
                                    </div>
                                </div>
                                <hr>
                            </ul>
                            <ul>
                                <div class="columns">
                                    <div class="column is-half">
                                        <h5><strong>TOTAL</strong></h5>
                                    </div>
                                    <div class="column">
                                    </div>
                                    <div class="column">
                                        <h5 id="preuTotal"><strong></strong></h5>
                                    </div>
                                </div>
                            </ul>
                            <br>
                            <div id="inputHidden"></div>
                            <div class="columns">
                                <div class="column is-half">
                                    <a href="./?controller=menu" style="width: 80%" class="button is-medium">Enrere</a>
                                </div>
                                <div class="column is-1"></div>
                                <div class="column is-half">
                                    <input type="submit" id="confirma" name="Update" class="button is-orange is-medium" style="width: 82%" value="Confirmar canvis"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="js/ticketModifica.js"></script>