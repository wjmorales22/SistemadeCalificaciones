
    document.addEventListener("DOMContentLoaded", function () {
      const preguntas = [
        "Pregunta 1",
        "Pregunta 2",
        "Pregunta 3",
        "Pregunta 4",
        "Pregunta 5",
        "Pregunta 6",
        "Pregunta 7",
        "Pregunta 8",
        "Pregunta 9",
        "Pregunta 10",
      ];

      const container = document.getElementById("preguntas-container");

      preguntas.forEach((texto, index) => {
        const row = document.createElement("div");
        row.className = "row";
        row.style.marginBottom = "30px";

        const colTexto = document.createElement("div");
        colTexto.className = "col s12";
        colTexto.innerHTML = `<span class="black-text" style="font-weight:600; font-size:1.1rem;">${texto}</span>`;
        row.appendChild(colTexto);

        const colRadios = document.createElement("div");
        colRadios.className = "col s12";

        for (let n = 1; n <= 5; n++) {
          const label = document.createElement("label");
          label.style.marginRight = "20px";

          const input = document.createElement("input");
          input.type = "radio";
          input.name = "pregunta_" + index;
          input.value = n;

          const span = document.createElement("span");
          span.textContent = n;

          label.appendChild(input);
          label.appendChild(span);
          colRadios.appendChild(label);
        }

        row.appendChild(colRadios);
        container.appendChild(row);
      });

      document.getElementById("evalForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const respuestasList = document.getElementById("respuestas-list");
        respuestasList.innerHTML = "";

        preguntas.forEach((texto, index) => {
          const valorRadio = document.querySelector(`input[name="pregunta_${index}"]:checked`);
          const valor = valorRadio ? valorRadio.value : "sin calificar";
          const li = document.createElement("li");
          li.textContent = `${texto}: ${valor}`;
          respuestasList.appendChild(li);
        });

        document.getElementById("result").style.display = "block";

        this.reset();
      });
    });

    function limpiarSeleccion() {
      const radios = document.querySelectorAll('input[type="radio"]');
      radios.forEach((radio) => (radio.checked = false));
      document.getElementById("result").style.display = "none";
    }
  