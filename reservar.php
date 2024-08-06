<?php
function getSalas() {
    return json_decode(file_get_contents('salas.json'), true);
}

function getReservas() {
    return json_decode(file_get_contents('reservas.json'), true);
}

function saveReservas($reservas) {
    file_put_contents('reservas.json', json_encode($reservas, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sala_id = $_POST['sala'];
    $usuario = $_POST['usuario'];
    $data_reserva = $_POST['data_reserva'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];

    $reservas = getReservas();
    $reservas[] = [
        'sala_id' => $sala_id,
        'usuario' => $usuario,
        'data_reserva' => $data_reserva,
        'hora_inicio' => $hora_inicio,
        'hora_fim' => $hora_fim
    ];

    saveReservas($reservas);

    echo "<p>Reserva realizada com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Reserva</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Fazer Reserva</h1>
    <form action="reservar.php" method="POST">
    <div class="container">
        <label class = "cadas" for="sala">Sala:</label>
        <select class = "cadas" name="sala" id="sala">
            <?php
            $salas = getSalas();
            foreach ($salas as $sala) {
                echo "<option value='{$sala['id']}'>{$sala['nome']}</option>";
            }
            ?>
        </select>
        <br>
        <label class = "cadas" for="usuario">Seu Nome:</label>
        <input class = "cadas" type="text" name="usuario" id="usuario" required>
        <br>
        <label class = "cadas" for="data_reserva">Data:</label>
        <input class = "cadas" type="date" name="data_reserva" id="data_reserva" required>
        <br>
        <label class = "cadas" for="hora_inicio">Hora de Início:</label>
        <input class = "cadas" type="time" name="hora_inicio" id="hora_inicio" required>
        <br>
        <label class = "cadas" for="hora_fim">Hora de Fim:</label>
        <input class = "cadas" type="time" name="hora_fim" id="hora_fim" required>
        <br>
        <button class = "var" type="submit">Reservar</button>
            </div>
    </form>
    <a href="index.php">
    <button class="back">Voltar</button>  
    </a>
</body>
</html>
