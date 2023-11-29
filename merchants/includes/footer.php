<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->

   <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="../assets/js/admindashboard.js"></script>

<script>

const loadContent = (page)=>{
   const xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function(){
      if(this.readyState==4 && this.status==200)
      {
         document.getElementById("content").innerHTML = this.responseText;
      }
   };
   xhttp.open("GET",page,true);
   xhttp.send();
}

$(function() {
    //console.log('Script is executed.');
    
    // Use event delegation for dynamically added elements
    $(document).on('click', '.btn', function() {
        //console.log('Button clicked.');
        // Show the "Add Brand" modal
        $('#addBrandModal').modal('show');
    });
   //  $(document).on('click', '.close', function() {
   //    $('#addBrandModal').modal('hide');
   //  });

   //Category MOdal
   $(document).on('click', '#addCategoryButton', function() {
      $('#addCategoryModal').modal('show');
   });
});
</script>

