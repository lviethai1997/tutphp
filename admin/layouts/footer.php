                </div>
                <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
                </div>
                <!-- jQuery -->
                <script src="<?php echo base_url() ?>public/admin/vendor/jquery/jquery.min.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="<?php echo base_url() ?>public/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

                <!-- Metis Menu Plugin JavaScript -->
                <script src="<?php echo base_url() ?>public/admin/vendor/metisMenu/metisMenu.min.js"></script>

                <!-- DataTables JavaScript -->
                <script src="<?php echo base_url() ?>public/admin/vendor/datatables/js/jquery.dataTables.min.js">
                </script>
                <script
                    src="<?php echo base_url() ?>public/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js">
                </script>
                <script
                    src="<?php echo base_url() ?>public/admin/vendor/datatables-responsive/dataTables.responsive.js">
                </script>

                <!-- Custom Theme JavaScript -->
                <script src="<?php echo base_url() ?>public/admin/dist/js/sb-admin-2.js"></script>

                <!-- Page-Level Demo Scripts - Tables - Use for reference -->
                <script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});


$('#exampleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var modal = $(this);
    var dataString = 'id=' + recipient;

    $.ajax({
        type: "GET",
        url: "chitietTran.php",
        data: dataString,
        cache: false,
        success: function(data) {
            console.log(data);
            modal.find('.dash').html(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
})
                </script>

                </body>

                </html>