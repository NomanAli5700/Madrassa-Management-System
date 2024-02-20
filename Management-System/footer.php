<script src="../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../dist/js/demo.js"></script>

<script>
  (function(){
    var path = window.location.href;
     //console.log(path);
    $(".nav__link").each(function () {
      var href = $(this).attr('href');
      // console.log(href);
     
      if (path === decodeURIComponent(href)) 
      {
      
        $(this).addClass('active');
       var parent = $(this).closest('.has-treeview');
      
        parent.addClass('menu-open');
        $(parent).find('.nav-link ').first().addClass('active');
        //console.log(parent);
        
      };
     
    
    });
  }());
</script> 





 <!-- JQuery -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</body>
</html>