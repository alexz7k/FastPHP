<?php
// Recupera dados do formulário da requisição
$endereco = $_POST["endereco"] ?? "";
$categoria = $_POST["categoria"] ?? "";
$preco = $_POST["preco"] ?? "";
$nome_vendedor = $_POST["nome_vendedor"] ?? "";
$telefone_vendedor = $_POST["telefone_vendedor"] ?? "";
$email_vendedor = $_POST["email_vendedor"] ?? "";
$status = $_POST["status"] ?? "";

// Parâmetros de conexão com o banco de dados
$dbUrl = "mysql:host=localhost;dbname=fastimoveis;charset=utf8mb4";
$dbUser = "root";
$dbPassword = "";

try {
    // Conecta ao banco de dados
    $conn = new PDO($dbUrl, $dbUser, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para inserir um novo registro
    $sql = "INSERT INTO imoveis (endereco, categoria, preco, nome_vendedor, telefone_vendedor, email_vendedor, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $endereco);
    $stmt->bindParam(2, $categoria);
    $stmt->bindParam(3, $preco);
    $stmt->bindParam(4, $nome_vendedor);
    $stmt->bindParam(5, $telefone_vendedor);
    $stmt->bindParam(6, $email_vendedor);
    $stmt->bindParam(7, $status);

    // Executa a consulta SQL para inserir o novo registro
    $stmt->execute();

    $rowsAffected = $stmt->rowCount();

    if ($rowsAffected > 0) {
        // Registro foi adicionado com sucesso
        header("Location: painel.php");
        exit();
    } else {
        // Falha na inserção do registro
        header("Location: sua_pagina_de_falha.php");
        exit();
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    header("Location: sua_pagina_de_erro.php");
    exit();
} finally {
    // Fecha os recursos
    $stmt = null;
    $conn = null;
}
?>
