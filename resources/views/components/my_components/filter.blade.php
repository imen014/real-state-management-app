
<input type="text" id="myInput" name="myInput">
<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable td").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
