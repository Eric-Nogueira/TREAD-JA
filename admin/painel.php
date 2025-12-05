<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo - TREAD JA</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; margin: 0; padding: 20px; }
        .card { background: #FFF; padding: 20px; border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 250px; margin: 10px; display: inline-block; }
        h1 { margin-bottom: 30px; }
        .card h2 { font-size: 22px; }
        .card p { font-size: 28px; font-weight: bold; }
    </style>

    <script>
        function carregarDados() {
            fetch("../relatorios.php")
                .then(r => r.json())
                .then(data => {
                    document.getElementById("totalJovens").innerText = data.total_jovens;
                    document.getElementById("totalVagas").innerText = data.total_vagas;
                    document.getElementById("totalAprovados").innerText = data.total_aprovados;
                    document.getElementById("totalEmpresas").innerText = data.total_empresas;
                    document.getElementById("totalCandi").innerText = data.total_candidaturas;
                });
        }

        setInterval(carregarDados, 2000);
        window.onload = carregarDados;
    </script>
</head>

<body>
<h1>Painel Administrativo</h1>

<div class="card">
    <h2>Total de Jovens</h2>
    <p id="totalJovens">...</p>
</div>

<div class="card">
    <h2>Total de Vagas</h2>
    <p id="totalVagas">...</p>
</div>

<div class="card">
    <h2>Aprovados</h2>
    <p id="totalAprovados">...</p>
</div>

<div class="card">
    <h2>Empresas</h2>
    <p id="totalEmpresas">...</p>
</div>

<div class="card">
    <h2>Candidaturas</h2>
    <p id="totalCandi">...</p>
</div>

</body>
</html>