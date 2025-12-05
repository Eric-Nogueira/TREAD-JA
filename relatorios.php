<?php
require __DIR__ . '/includes/app.php';

use WilliamCosta\DatabaseManager\Database;

header('Content-Type: application/json; charset=utf-8');

$dados = [];
try {
	$conn = new Database();

	$dados['total_jovens'] = (int) $conn->execute("SELECT COUNT(*) FROM jovem", [])->fetchColumn();
    $dados['total_vagas'] = (int) $conn->execute("SELECT COUNT(*) FROM vaga", [])->fetchColumn();
    $dados['total_aprovados'] = (int) $conn->execute("SELECT COUNT(*) FROM matricula WHERE status_matricula='Aprovado'", [])->fetchColumn();
    $dados['total_empresas'] = (int) $conn->execute("SELECT COUNT(*) FROM empresa", [])->fetchColumn();
    $dados['total_candidaturas'] = (int) $conn->execute("SELECT COUNT(*) FROM candidata_se", [])->fetchColumn();

	echo json_encode($dados);
} catch (\Exception $e) {
	http_response_code(500);
	echo json_encode(['error' => $e->getMessage()]);
}
?>