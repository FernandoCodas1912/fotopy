         </div>
         <!--end content -->
         <footer class="footer">
         2018 - <?php echo date('Y'); ?> © FOTOPY |  
         Generado en <strong>
         {elapsed_time}
         
         </strong> segundos | <?php echo 'Version '. CI_VERSION  ; ?>  
         </footer>
         </div><!-- end content page -->
         <!-- ============================================================== -->
         <!-- End Right content here -->
         <!-- ============================================================== -->

         <!-- jQuery  -->
         <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>


         <!-- App js -->
         <script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
         <script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>


         <!-- Jquery-Ui -->
         <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>

         <!-- BEGIN PAGE SCRIPTS -->
         <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/dist/fullcalendar.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/pages/jquery.fullcalendar.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/jquery-print/jquery.print.js"></script>

         <!-- Datatables-->
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/jszip.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/pdfmake.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.print.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.scroller.min.js"></script>

         <!-- Datatable init js -->
         <script src="<?php echo base_url(); ?>assets/pages/datatables.init.js"></script>
         <script src="<?php echo base_url(); ?>assets/scripts.js" type="text/javascript"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

         <!-- 
         <script src="<?php echo base_url(); ?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
         <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script> -->


         <script>
             var resizefunc = [];
             // Date Picker cuando hay un # antes, se refiere a id, cuando hay un . adelante se refiere a clase
             jQuery('#datepicker').datepicker();

             jQuery('.fecha-autoclose').datepicker({
                 format: "yyyy-mm-dd",
                 autoclose: true,
                 todayHighlight: true
             });


             jQuery('#datepicker-inline').datepicker();

             jQuery('#datepicker-multiple-date').datepicker({
                 format: "mm/dd/yyyy",
                 clearBtn: true,
                 multidate: true,
                 multidateSeparator: ","
             });
             // Time Picker
             jQuery('.hora').timepicker({
                 defaultTIme: false
             });
             jQuery('#timepicker2').timepicker({
                 showMeridian: false
             });
         </script>

         </body>

         </html>