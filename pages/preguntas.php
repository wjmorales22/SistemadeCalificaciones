<?php
// Definir preguntas
$preguntas = [
    'Pregunta 1',
    'Pregunta 2',
    'Pregunta 3',
    'Pregunta 4',
    'Pregunta 5',
    'Pregunta 6',
    'Pregunta 7',
    'Pregunta 8',
    'Pregunta 9',
    'Pregunta 10'
];

// Procesar envío
$respuestas = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($preguntas as $index => $texto) {
        $clave = 'pregunta_' . $index;
        $respuestas[$index] = $_POST[$clave] ?? null;
    }
}
?>

<?php include "../layout/header.php" ?>

<main>
    <div class="container">
        <h4>Evaluación</h4>
        <form id="evalForm" novalidate>
            <div id="preguntas-container"></div>

            <button class="btn waves-effect waves-light" type="submit">
                Enviar
                <i class="material-icons right">send</i>
            </button>

            <button type="button" class="btn grey lighten-1 black-text" style="margin-left: 10px;"
                onclick="limpiarSeleccion()">
                Limpiar selección
                <i class="material-icons right">clear</i>
            </button>
        </form>

        <div id="result" class="card green lighten-4" style="margin-top: 30px; display:none;">
            <div class="card-content">
                <span class="card-title">Respuestas recibidas:</span>
                <ul id="respuestas-list"></ul>
            </div>
        </div>
    </div>
</main>


<!-- Materialize JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<script src="../js/formulario.js"></script>
<?php include "../layout/footer.php" ?>