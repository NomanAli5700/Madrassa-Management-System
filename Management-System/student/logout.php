<?php
  session_start();
  session_destroy();

  header('Location: /MMS/login.php');
  ?>