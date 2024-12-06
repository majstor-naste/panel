<?php
	/* SERVER SETTINGS */ /* CONFIGURAÇÕES DO SERVIDOR */
	define("OFFICE_KEY", "licSA32dfoldj");

	/* OFFICE PANEL DATABASE SETTINGS */ /* CONFIGURAÇÕES DO BANCO DE DADOS DO PAINEL OFFICE */
    define("OFFICE_DB_HOST", "localhost");
    define("OFFICE_DB_PORT", "3306");
    define("OFFICE_DB_NAME", "panel");
    define("OFFICE_DB_USER", "root");
    define("OFFICE_DB_PASS", "");

 	/* XTREAM PANEL DATABASE SETTINGS */ /* CONFIGURAÇÕES DO BANCO DE DADOS DO SERVIDOR XTREAM CODES */
define('DB_HOST', '');
define('DB_PORT', '7999');
define('DB_NAME', 'xtream_iptvpro');
define('DB_USER', '');
define('DB_PASS', '');

	/* ALLOWED EMAILS FOR TESTS */ /* EMAILS PERMITIDOS PARA TESTES */
	define ("ALLOWED_EMAILS", serialize (array ("root@localhost.com", "exemplo2@gmail.com")));
?>