<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

<script>
  // Inicializar componentes JS si hace falta (ejemplo dropdown)
  document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.dropdown-trigger');
    M.Dropdown.init(elems);
  });
</script>

</body>
<footer class="primary-color">
  <div class="container">
    <div class="row">
      <div class="col s6">
        <div class="custom-navbar primary-color">
          <img src="../assets/logo.png" alt="Logo" />
        </div>
      </div>
      <div class="col s6" style="text-align: right;">
        <p> © <?php echo date("Y"); ?> Derechos Reservados</p>
      </div>

    </div>
  </div>
</footer>

</html>