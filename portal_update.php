<?php

$db = new SQLite3('./a/.eggziedb.db');
$res = $db->query('SELECT * ' . "\n\t\t\t\t" . '  FROM portals ' . "\n\t\t\t\t" . '  WHERE id=\'' . $_GET['update'] . '\'');
$row = $res->fetchArray();
$portal = $row['url'];
$portalname = $row['name'];
$id = $row['id'];

if (isset($_POST['submit'])) {
	$db->exec('UPDATE portals SET url=\'' . $_POST['portal'] . '\',' . "\n" . '                                name=\'' . $_POST['name'] . '\'' . "\n\t\t\t\t\t\t" . '  WHERE ' . "\n\t\t\t\t\t\t\t" . '  id=\'' . $_POST['id'] . '\'');
	$db->close();
	header('Location: portals.php?success');
}

include 'includes/header.php';

?>
<style>

input, button, select, optgroup, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    background-color: #5c5c5c;
} 
p span {
    font: 700 2.5em/1 "Oswald", sans-serif;
    letter-spacing: 0;
    padding: 0.25em 0 0.325em;
    display: block;
    text-shadow: 0 0 80px rgba(255, 255, 255, 0.5);
    background: url(img/animated-text-fill.png) repeat-y;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: aitf 80s linear infinite;
    -webkit-transform: translate3d(0, 0, 0);
    -webkit-backface-visibility: hidden;
    margin-top: -45px;
    margin-left: -76px;
}

/* Animate Background Image */
@-webkit-keyframes aitf {
  0% {
    background-position: 0% 50%;
  }
  100% {
    background-position: 100% 50%;
  }
}

.bg-white {
    background-color: #1d222e !important;
}

.header1 {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
    border: 1px solid #9c9c9c;
    border-radius: 1.35rem;
    background-color: #252b3b;
    margin-left: 25px;
    margin-right: 25px;
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>

                <div class="header1">
						<center>
						    <br>
						     <img src="https://i.imgur.com/rH1PVWv.png" alt="" height="100">
						    <br><br><br> 
													<a><p>
  <span>

    𝑷𝒐𝒓𝒕𝒂𝒍𝒔
  </span>

</p></a>
						</center>

						</div>




<?php

echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";

if (isset($_GET['succes'])) {
	echo $msg_delete;
}

if (isset($_GET['success'])) {
	echo $msg_success;
}

echo '          <!-- Page Heading -->' . "\n";
echo '                <div class="card-body">' . "\n";
echo '                        <form method="post">' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="name"><strong>' . "\n";
echo '                                        Name</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input type="hidden" name="id" value="' . $id . '">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="name" name="name"  value="' . $portalname . '" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                        <div class="form-group">' . "\n";
echo '                                    <label class="control-label " style="color:' . $colour_head_18 . ';" for="portal"><strong>' . "\n";
echo '                                        Portal</strong>' . "\n";
echo '                                    </label>' . "\n";
echo '                                    <div class="input-group">' . "\n";
echo '                                        <input class="form-control" style="background-color:' . $colour_head_17 . ';color:' . $colour_head_10 . ';" class="form-control" id="portal" name="portal"  value="' . $portal . '" type="text"/>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    </div>' . "\n";
echo '                                    ' . "\n";
echo '                                <div class="form-group">' . "\n";
echo '                                    <div>' . "\n";
echo '                                        <button class="btn btn-success btn-icon-split" style="background-color:' . $colour_head_btn . ';border-color:' . $colour_head_btn . ';color:' . $colour_head_10 . ';" name="submit" type="submit">' . "\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check" style="color:' . $colour_head_10 . ';"></i></span><span class="text">Submit</span>' . "\n";
echo '                        </button>' . "\n";
echo '                                    </div>' . "\n";
echo "\n";
echo '                                </div>' . "\n";
echo '                            </form>' . "\n";
echo '                </div>' . "\n";
echo '              </div>' . "\n";
include 'includes/footer.php';
require 'includes/egz.php';
echo '</body>' . "\n";

?>