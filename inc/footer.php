        </div> <!-- content div ends -->
      </div><!-- /.container -->


      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
      <script src="<?php echo DOCUMENT_ROOT . '/dist/js/bootstrap.min.js';?>"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="<?php echo DOCUMENT_ROOT . '/assets/js/ie10-viewport-bug-workaround.js';?>"></script>
      <!-- for pagination - start -->
      <script>
        $(document).ready(function () {
            $('#records-limit').change(function () {
                $('form').submit();
            })
        });
      </script>
      <!-- for pagination - end -->
      <div class="footer">
        <!--hr size=5 color=green/> -->
        &copy; Sri Raja Rajan College of Engg., and Tech. - 2022 - <?php echo date("Y");?>
        <span class='versionInfo'>&nbsp;|&nbsp; <?php echo VERSION_INFO; ?></span>
      </div>
    </div>
  </body>
</html>
