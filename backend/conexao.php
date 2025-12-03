<?php
$servidor = "localhost";   
$usuario  = "vitoria";        
$senha    = "senha123";    
$banco    = "free_mens";   

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $erro) {
    echo "Erro na conexão: " . $erro->getMessage();
    exit;
}
?>
