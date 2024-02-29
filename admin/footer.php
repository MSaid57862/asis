
      
<!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; developed by <a href="">Nigeria Customs Service</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- RIGHT SIDE BAR CAN BE INCLUDED HERE -->


            

            
        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>
        <!-- third party js -->
        <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="../assets/js/pages/datatables.init.js"></script>
        <!-- Plugin js-->
        <script src="../assets/libs/parsleyjs/parsley.min.js"></script>

        <!-- Validation init js-->
        <script src="../assets/js/pages/form-validation.init.js"></script>
        <!-- Tost-->
        <script src="../assets/libs/jquery-toast-plugin/jquery.toast.min.js"></script>

        <!-- toastr init js-->
        <script src="../assets/js/pages/toastr.init.js"></script>
        <!-- App js -->
        <!-- ChartJS --><!-- SweetAlert2 -->
        <script src="../assets/sweetalert2/sweetalert2.min.js"></script>
        <!-- Toastr -->
        <script src="../assets/toastr/toastr.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="../assets/js/app.min.js"></script>

        <!-- MY JS FILE -->
        <script src="../assets/js/mine.js"></script>
        

        <script type="text/javascript">
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: true,
              timer: 10000
            });

            
            //setTimeout(document.getElementById('auto-close').click(),5000);
            // var successMsg = <?php //echo $_SESSION['successMsg'] ?>;
            // if(successMsg == 'true'){
            //   //$('#successMsg').click();
            //   alert('successMsg');
            // }

            $('.swalDefaultSuccess').click(function() {
              Toast.fire({
                icon: 'success',
                title: " Successful "
              })
            });
            $('.swalDefaultInfo').click(function() {
              Toast.fire({
                icon: 'info',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
              })
            });
            $('.errorMsg').click(function() {
              Toast.fire({
                icon: 'error',
                title: 'An error occured.',
                showConfirmButton: false,
              })
            });
            $('.swalDefaultWarning').click(function() {
              Toast.fire({
                icon: 'warning',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
              })
            });
            $('.swalDefaultQuestion').click(function() {
              Toast.fire({
                icon: 'question',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
              })
            });
        </script>
        
    </body>
</html>