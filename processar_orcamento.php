<?php
// Dados de conexão com o banco
$host = 'localhost';
$db = 'dj_site';
$user = 'root';
$pass = '';

// Criar conexão
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Receber os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$tipo_evento = $_POST['tipo_evento'];
$data_evento = $_POST['data_evento'];
$mensagem = $_POST['mensagem'];

// Inserir no banco
$sql = "INSERT INTO orcamentos (nome, email, telefone, tipo_evento, data_evento, mensagem)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nome, $email, $telefone, $tipo_evento, $data_evento, $mensagem);

if ($stmt->execute()) {
    echo "<h2 style='color: white; text-align: center;'>Orçamento enviado com sucesso!</h2>";
} else {
    echo "<h2 style='color: red; text-align: center;'>Erro ao enviar: " . $conn->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
🧱 3. SQL para criar a tabela no banco
Execute isso no seu phpMyAdmin ou via terminal:

sql
Copiar código
CREATE TABLE orcamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(20),
  tipo_evento VARCHAR(100),
  data_evento DATE,
  mensagem TEXT,
  data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);