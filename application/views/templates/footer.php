<!--**********************************
            Content body start
        ***********************************-->

<!--**********************************
            Content body end
        ***********************************-->

<!--**********************************
            Footer start
        ***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="http://webdigitalcenter.my.id/" target="_blank">DC</a> 2023</p>
    </div>
</div>
<!--**********************************
            Footer end
        ***********************************-->

<!--**********************************
           Support ticket button start
        ***********************************-->

<!--**********************************
           Support ticket button end
        ***********************************-->


</div>
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="<?= base_url(); ?>assets/vendor/global/global.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/js/custom.min.js"></script>
<script src="<?= base_url(); ?>assets/js/deznav-init.js"></script>
<script src="<?= base_url(); ?>assets/vendor/owl-carousel/owl.carousel.js"></script>
<script src="<?= base_url(); ?>assets/js/xlsx.full.min.js"></script>

<!-- Chart piety plugin files -->
<script src="<?= base_url(); ?>assets/vendor/peity/jquery.peity.min.js"></script>

<!-- Apex Chart -->
<script src="<?= base_url(); ?>assets/vendor/apexchart/apexchart.js"></script>

<!-- Dashboard 1 -->
<script src="<?= base_url(); ?>assets/js/dashboard/dashboard-1.js"></script>

<!-- Datatable -->
<script src="<?= base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins-init/datatables.init.js"></script>
<script>
    function htmlTableToExcel(type) {
        var data = document.getElementById('tblToExcl');
        var excelFile = XLSX.utils.table_to_book(data, {
            sheet: "sheet1"
        });
        XLSX.write(excelFile, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        });
        XLSX.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel.' + type);
    }

    function carouselReview() {
        /*  testimonial one function by = owl.carousel.js */
        jQuery('.testimonial-one').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 30,
            nav: false,
            dots: false,
            left: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                484: {
                    items: 2
                },
                882: {
                    items: 3
                },
                1200: {
                    items: 2
                },

                1540: {
                    items: 3
                },
                1740: {
                    items: 4
                }
            }
        })
    }
    jQuery(window).on('load', function() {
        setTimeout(function() {
            carouselReview();
        }, 1000);
    });
</script>

</body>

</html>