<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
        $(document).ready(function() {
           $.ajax({
                url: '../controllers/remessas_enviadas_dao.php',
                success: function(data) {
                    $("#tbl").html(data);
                }
            });
        });
    </script>
<div class="container">
    <div class="shadow-lg mb-5 p-3 rounded border">
    <div class="table-responsive" id="tbl"></div>
    </div>
</div>