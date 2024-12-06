<?php

echo ' <script> ' . "\n";
echo '$(document).ready(function () {' . "\n";
echo '    $(\'#flash-msg\').delay(3000).fadeOut(\'slow\');' . "\n";
echo '});' . "\n";
echo '  </script>' . "\n";
echo ' <script>' . "\n";
echo '$(\'#confirm-delete\').on(\'show.bs.modal\', function(e) {' . "\n";
echo '    $(this).find(\'.btn-ok\').attr(\'href\', $(e.relatedTarget).data(\'href\'));' . "\n";
echo '});' . "\n";
echo '    </script>' . "\n";

?>