<?php include "../layout/header.php" ?>

<main>
    <div class="container row">
        <div class="col s6">
            <h4>Evaluación</h4>
            <form id="evalForm" novalidate>
                <div id="preguntas-container" class="section"></div>
                <button class="btn waves-effect waves-light" type="submit" style="margin-top: 20px;">
                    Enviar
                    <i class="material-icons right">send</i>
                </button>
                <button type="button" class="btn grey lighten-1 black-text" style="margin-left: 10px; margin-top: 20px;"
                    onclick="limpiarSeleccion()">
                    Limpiar selección
                    <i class="material-icons right">clear</i>
                </button>
            </form>
        </div>
        <div class="col s6">
            <div id="result" class="card green lighten-4" style="margin-top: 30px; display:none;">
                <div class="card-content">
                    <span class="card-title">Respuestas recibidas:</span>
                    <ul id="respuestas-list" class="collection"></ul>
                    <div id="promedio" style="margin-top: 10px; font-weight: 600; font-size: 1.2rem;"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="../assets/js/formulario.js"></script>
<script src="../assets/js/promedio.js"></script>

<?php include "../layout/footer.php" ?>