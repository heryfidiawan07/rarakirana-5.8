        </div><!-- End Page Content  -->
    </div><!-- Page Wrapper  -->

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#navbar-panel-name').text($('#panel-name').text());

            $('#dismiss').on('click', function () {
                $('.dsh-text').hide();
                $('#dismiss').hide();
                $('#openSidebar').show();
                // $('#openSidebar').css('display','unset');
                $('#sidebar').css('width','auto');
                $('#content').css('padding-left','65px');
                $('#sidebar-name').hide();
                // console.log(document.getElementById("sidebar").clientWidth);
            });

            $('#openSidebar').on('click', function () {
                $('#sidebar').css('width','auto');
                $('#content').css('padding-left','180px');
                $('.dsh-text').show();
                $('#dismiss').show();
                $('#openSidebar').hide();
                $('#sidebar-name').show();
                // console.log(document.getElementById("sidebar").clientWidth);
            });
        });
    </script>
</body>

</html>