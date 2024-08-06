<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Reservas por Sala</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        canvas {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Gráfico de Reservas por Sala</h1>
    <canvas id="myChart"></canvas>
    <script>
        <?php
            // Lê os arquivos JSON
            $salas_json = file_get_contents('salas.json');
            $reservas_json = file_get_contents('reservas.json');
            $salas = json_decode($salas_json, true);
            $reservas = json_decode($reservas_json, true);

            // Conta o número de reservas por sala
            $reservas_por_sala = array();
            foreach ($salas as $sala) {
                $reservas_por_sala[$sala['id']] = 0;
            }
            foreach ($reservas as $reserva) {
                $reservas_por_sala[$reserva['sala_id']]++;
            }

            // Prepara os dados para o gráfico
            $labels = array();
            $data = array();
            foreach ($salas as $sala) {
                $labels[] = $sala['nome'];
                $data[] = $reservas_por_sala[$sala['id']];
            }
        ?>

        // Passa os dados do PHP para o JavaScript
        const labels = <?php echo json_encode($labels); ?>;
        const data = <?php echo json_encode($data); ?>;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico (barra)
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Reservas',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
