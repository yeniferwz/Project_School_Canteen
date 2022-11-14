
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
                            <br><h2 class="level-item has-text-centered"><strong>El teu ticket</strong></h2><br>
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
                                        <h4><strong>TOTAL</strong></h4>
                                    </div>
                                    <div class="column">
                                    </div>
                                    <div class="column">
                                        <h4 id="preuTotal"><strong></strong></h4>
                                    </div>
                                </div>
                            </ul>
                            <br>
                        </div>
                    </div>
                    <!-- END box -->
                    <div class="columns">
                        <div class="column is-half">
                            <a href="./?controller=menu" style="width: 80%" class="button is-medium">Enrere</a>
                        </div>
                        <div class="column is-1"></div>
                        <div class="column is-half">
                            <input href="./?controller=finish" class="button is-orange is-medium" style="width: 82%" id = "confirma"  value="Confirma">
                        </div>
                    </div>
                </div>
                <div class="column is-one-quarter boxcolumn">
                    <div class="box form">
                        <div class="content">
                            <fieldset class="dadesPersonals">
                                <form action="./?controller=finish" method="POST" id="formulari" name = "myForm">
                                    <legend>Les teves dades</legend><br>
                                        <div class="input-control">
                                            <label>Nom
                                            <input name="nom" type="text" id ="nom" required></label>
                                            <div id="errorNOM" class="errorNOM"></div>
                                            <br>
                                        </div>
                                        <div class="input-control">
                                            <label>Cognom
                                            <input name="cognom" type="text" id="cognom"></label>
                                            <div id="errorCOGNOM" class="errorCOGNOM"></div>
                                            <br>
                                        </div>
                                        <div class="input-control">
                                            <label>Correu
                                            <input name="correu" type="text" id="correu"></label>
                                            <div id="errorCORREU" class="errorCORREU"></div>
                                            <br>
                                        </div>
                                        <div class="input-control">
                                            <label>Telèfon
                                            <input name="telf" type="text" id="telf"></label>
                                            <div id="errorTELF" class="errorTELF"></div>
                                        </div>
                                        <div id="inputHidden"></div>
                                </form>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="js/ticket.js"></script>