document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("evalForm");

  form.addEventListener("submit", function(event) {
    event.preventDefault();

    let suma = 0;
    let cantidad = 0;

    for (let i = 0; i < 10; i++) {
      // Obtener radio button seleccionado para la pregunta i
      const seleccionado = document.querySelector(`input[name="pregunta_${i}"]:checked`);
      if (seleccionado) {  // Solo si está seleccionado
        suma += parseInt(seleccionado.value, 10);
        cantidad++;
      }
    }

    // Calcular promedio solo si hay al menos un seleccionado
    const promedio = cantidad > 0 ? (suma / cantidad).toFixed(2) : 0;

    // Mostrar promedio en el elemento con id "promedio"
    const promedioElemento = document.getElementById("promedio");
    if (promedioElemento) {
      promedioElemento.textContent = `Promedio: ${promedio}`;
    }

    // Mostrar la tarjeta de resultados
    const resultTarjeta = document.getElementById("result");
    if (resultTarjeta) {
      resultTarjeta.style.display = "block";
    }

    // Opcional: resetear formulario si se desea
    // this.reset();
  });
});
