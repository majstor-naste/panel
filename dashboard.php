<?php 
date_default_timezone_set("America/Sao_Paulo");
#######################CHECK ERROR ###################################

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL); 
include 'chk.php';
######################################################################

include ('includes/header.php');

?>
                <div class="header1">
						<center>
						    <br>
						     <img src="img/ibo1.png" alt="" height="100">
						    <br><br><br> 
													<a><p>
  <span>

    𝑫𝒂𝒔𝒉𝒃𝒐𝒂𝒓𝒅
  </span>

</p></a>
						</center>

						</div>




 

<style>


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

.header3 {
    padding: 1.25rem;
    border: 1px solid #9c9c9c;
    border-radius: 1.35rem;
    background-color: #252b3b;
}
</style>


<style>

.row {
    display: flex;
    margin-right: -0.75rem;
    margin-left: -0.75rem;
}

.dash {
  padding: 5px;
  background-color: tranparent;
  transition: transform .2s;
  width: 100%;
  height: 100%;
  margin: 0 auto;
  color: white;
  text-shadow: 2px 2px 4px #000000;
  border: 4px solid transparent;
  padding: 1px;
  border-radius: 15px;
}


.dash:hover {
  color: white;
  text-shadow: 2px 2px 4px #000000;
  padding: 5px;
  background-image: linear-gradient(to top right, #1d2426, transparent);
  transition: transform .2s;
  width: 100%;
  height: 100%;
  margin: 0 auto;
  
  padding: 1px; 
  border-radius: 15px;
}
.bg-primary {
    background-color: #1d222e !important;
    border: 1px solid #838594;
}


.fa-user-shield:before {
    content: "\f505";
    color: #718594;
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
    margin-top: -50px;
    margin-left: -60px;
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

p {
    text-transform: uppercase;
    letter-spacing: 0.5em;
    display: inline-block;
    position: absolute;
    top: auto;
    margin-left: -55px;
}
</style>
<?php 

echo ' <!-- Begin Page Content -->' . "\n";
echo '        <div class="container-fluid">' . "\n";
echo "\n";



echo '          <!-- Content Row -->' . "\n";
echo '          <div class="row">' . "\n";
echo "\n";
echo '            <!-- First Column -->' . "\n";
echo '            <div class="col-lg-12">' . "\n";
echo "\n";
echo '              <!-- Custom codes -->' . "\n";


echo '                <div class="header3">' . "\n";

?>
<!-- [ Main Content ] start -->
                <div class="row">
			
			<div class="col-lg-3 col-md-3 py-2" style="text-align: center;">
				<a href="./users.php" style="text-decoration: none;">
				<div class="dash card bg-primary  widget-block shadow py-2">
					<div class="card-block">
						<i class="fas fa-fw fa-user-plus" style="margin-top:7px;font-size:20px" aria-hidden="true"></i>
						<br
						<a>Usuarios</a>

					</div>
				</div>
				</a>
			</div>	
			
			<div class="col-lg-3 col-md-3 py-2" style="text-align: center;">
				<a href="./portals.php" style="text-decoration: none;">
				<div class="dash card bg-primary  widget-block shadow py-2">
					<div class="card-block">
						<i class="fas fa-fw fa fa-server" style="margin-top:7px;font-size:20px" aria-hidden="true"></i>
						<br
						<a>Servidores</a>

					</div>
				</div>
				</a>
			</div>	
			
			<div class="col-lg-3 col-md-3 py-2" style="text-align: center;">
				<a href="./note.php" style="text-decoration: none;">
				<div class="dash card bg-primary  widget-block shadow py-2">
					<div class="card-block">
						<i class="fas fa-fw fa fa-newspaper" style="margin-top:7px;font-size:20px" aria-hidden="true"></i>
						<br
						<a>Notificações</a>

					</div>
				</div>
				</a>
			</div>			
			
			
		
			
			
			<div class="col-lg-3 col-md-3 py-2" style="text-align: center;">
				<a href="./snoop.php" style="text-decoration: none;">
				<div class="dash card bg-primary  widget-block shadow py-2">
					<div class="card-block">
						<i class="fas fa-fw fa-eye" style="margin-top:7px;font-size:20px" aria-hidden="true"></i>
						<br
						<a>Conectado</a>

					</div>
				</div>
				</a>
			</div>	
						
			<div class="col-lg-3 col-md-3 py-2" style="text-align: center;">
				<a href="./profile.php" style="text-decoration: none;">
				<div class="dash card bg-primary  widget-block shadow py-2">
					<div class="card-block">
						<i class="fas fa-fw fa-user" style="margin-top:7px;font-size:20px" aria-hidden="true"></i>
						<br
						<a>ADM</a>

					</div>
				</div>
				</a>
			</div>	
			
			<div class="col-lg-3 col-md-3 py-2" style="text-align: center;">
				<a href="dns.com" style="text-decoration: none;">
				<div class="dash card bg-primary  widget-block shadow py-2">
					<div class="card-block">
						<i class="fas fa-fw fa fa-dot-circle-o" style="margin-top:7px;font-size:20px" aria-hidden="true"></i>
						<br
						<a>BRASIL PROJETOS</a>

					</div>
				</div>
				</a>
			</div>	
			
			
      </div>

                   
                    <!-- Column -->

<?php 


?>

</body>