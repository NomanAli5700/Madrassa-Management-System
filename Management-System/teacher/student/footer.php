
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