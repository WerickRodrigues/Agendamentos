<?php
function getSalas() {
    return json_decode(file_get_contents('salas.json'), true);
}

function getReservas() {
    return json_decode(file_get_contents('reservas.json'), true);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Reservas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Reservas</h1>
    <table class ="table">
        <tr>
            <th class ="table">Sala</th>
            <th class ="table">Usuário</th>
            <th class ="table">Data</th>
            <th class ="table">Hora de Início</th>
            <th class ="table">Hora de Fim</th>
        </tr>
        <?php
        $salas = getSalas();
        $reservas = getReservas();
        foreach ($reservas as $reserva) {
            $sala_nome = '';
            foreach ($salas as $sala) {
                if ($sala['id'] == $reserva['sala_id']) {
                    $sala_nome = $sala['nome'];
                    break;
                }
            }
            echo "<tr>
                <td>{$sala_nome}</td>
                <td>{$reserva['usuario']}</td>
                <td>{$reserva['data_reserva']}</td>
                <td>{$reserva['hora_inicio']}</td>
                <td>{$reserva['hora_fim']}</td>
            </tr>";
        }
        ?>
    </table>
    <a href="index.php">
    <button class="back">Voltar</button>  
    </a>
    
      <a href="grafico.php">
      <button class="graf">Relatorio</button>  
      </a>
</body>
</html>
