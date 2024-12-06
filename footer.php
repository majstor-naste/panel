<?php
    include_once ('./sys/functions.php');
    $logged_user = getLoggedUser();
    $server_name = getServerProperty('server_name');
?>
<footer class="main-footer text-sm">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#"><?php echo $server_name; ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.3.1
    </div>
</footer>

