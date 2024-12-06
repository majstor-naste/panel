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

echo ' <script> ' . "\n";
echo ' function clearContents() {' . "\n";
echo '     document.getElementById("inny").value = \'\';' . "\n";
echo '     document.getElementById("output").value = \'\';' . "\n";
echo '   }' . "\n";

echo '   function changeText(button, text, textToChangeBackTo) {' . "\n";
echo '     document.getElementById(button).innerHTML = text;' . "\n";
echo '     setTimeout(function() { document.getElementById(button).innerHTML = textToChangeBackTo; }, 5000);' . "\n";
echo '   }' . "\n";

echo '   $(function() { ' . "\n";
echo '    $("#copy").click(function() { ' . "\n";
echo '     var copyText = document.getElementById("output");' . "\n";
echo '     copyText.select();' . "\n";
echo '     document.execCommand("copy");' . "\n";
echo '   });' . "\n";
echo '   });' . "\n";


echo '    </script>' . "\n";
?>