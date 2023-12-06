 <!-- Bootstrap core JS-->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
   <script src="/kramzcommerce/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<!-- Core theme JS-->
    <script>
    feather.replace({ "aria-hidden": "true" });
    </script>
<script>
const carousel = new bootstrap.Carousel('#carouselExampleDark');
</script>

<!-- Navigation Script -->
<script>
  // Wait for the document to be fully loaded
  document.addEventListener('DOMContentLoaded', function () {
    // Activate the first tab on page load
    var myTab = new bootstrap.Tab(document.getElementById('description-tab'));
    myTab.show();

    // Handle tab clicks
    document.getElementById('myTab').addEventListener('click', function (event) {
      event.preventDefault();
      // Get the target tab and show it
      var targetTab = new bootstrap.Tab(event.target);
      targetTab.show();
    });
  });
</script>

<!-- Increment/Decrement Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var quantityInput = document.getElementById('quantityInput');
    var incrementBtn = document.getElementById('incrementBtn');
    var decrementBtn = document.getElementById('decrementBtn');

    incrementBtn.addEventListener('click', function () {
      // Increment the quantity when the + button is clicked
      quantityInput.value = parseInt(quantityInput.value, 10) + 1;
    });

    decrementBtn.addEventListener('click', function () {
      // Decrement the quantity when the - button is clicked, but ensure it doesn't go below 0
      quantityInput.value = Math.max(0, parseInt(quantityInput.value, 10) - 1);
    });
  });
</script>

