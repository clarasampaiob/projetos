<?php
// diretório base da aplicação
// URL do Projeto
define('BASE_PATH', dirname(__FILE__));
define('BASE_URL', "http://localhost:8218");

// credenciais de acesso ao MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sys_unopar_2');

// configurações do PHP
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');