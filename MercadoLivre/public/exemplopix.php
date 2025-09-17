<?php
// Funções utilitárias para montar o payload PIX
function emvField($id, $value) {
    $len = str_pad(strlen($value), 2, "0", STR_PAD_LEFT);
    return $id . $len . $value;
}

function crc16_ccitt($input) {
    $crc = 0xFFFF;
    $poly = 0x1021;

    for ($i = 0; $i < strlen($input); $i++) {
        $crc ^= (ord($input[$i]) << 8);
        for ($j = 0; $j < 8; $j++) {
            if ($crc & 0x8000) {
                $crc = (($crc << 1) & 0xFFFF) ^ $poly;
            } else {
                $crc = ($crc << 1) & 0xFFFF;
            }
        }
    }
    return strtoupper(dechex($crc));
}

function calculate_crc16_for_payload($payload) {
    $payload_to_crc = $payload . "6304";
    $hex = crc16_ccitt($payload_to_crc);
    return str_pad($hex, 4, "0", STR_PAD_LEFT);
}

function gerarPayloadPix($pixKey, $nome, $cidade, $valor, $txid) {
    $payload = "";
    $payload .= emvField("00", "01");

    $mai = emvField("00", "br.gov.bcb.pix");
    $mai .= emvField("01", $pixKey);
    $payload .= emvField("26", $mai);

    $payload .= emvField("52", "0000");
    $payload .= emvField("53", "986");

    if (!empty($valor)) {
        $valor = number_format((float)$valor, 2, ".", "");
        $payload .= emvField("54", $valor);
    }

    $payload .= emvField("58", "BR");
    $payload .= emvField("59", mb_substr($nome, 0, 25));
    $payload .= emvField("60", mb_substr($cidade, 0, 15));

    if (!empty($txid)) {
        $adf = emvField("05", $txid);
        $payload .= emvField("62", $adf);
    }

    $crc = calculate_crc16_for_payload($payload);
    $payload .= emvField("63", $crc);

    return $payload;
}

// --- PROCESSA O FORMULÁRIO ---
$qrCodeUrl = "";
$payloadFinal = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pixKey  = $_POST["pixKey"];
    $nome    = $_POST["nome"];
    $cidade  = $_POST["cidade"];
    $valor   = $_POST["valor"];
    $txid    = $_POST["txid"];

    $payloadFinal = gerarPayloadPix($pixKey, $nome, $cidade, $valor, $txid);

    // Gera QR Code com Google Chart
    $qrCodeUrl = "https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=" . urlencode($payloadFinal);
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Gerador PIX</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
    form { background: #fff; padding: 20px; border-radius: 8px; max-width: 400px; margin-bottom: 20px; }
    label { display: block; margin-top: 10px; font-weight: bold; }
    input { width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc; }
    button { margin-top: 15px; padding: 10px; width: 100%; background: #0077cc; color: white; border: none; border-radius: 6px; cursor: pointer; }
    button:hover { background: #005fa3; }
    .resultado { background: #fff; padding: 20px; border-radius: 8px; }
    textarea { width: 100%; height: 80px; margin-top: 10px; }
  </style>
</head>
<body>
  <h1>Gerador de QR Code PIX</h1>

  <form method="POST">
    <label>Chave PIX:</label>
    <input type="text" name="pixKey" required placeholder="Digite sua chave PIX">

    <label>Nome do Recebedor:</label>
    <input type="text" name="nome" required placeholder="Ex: LOJA EXEMPLO LTDA">

    <label>Cidade:</label>
    <input type="text" name="cidade" required placeholder="Ex: SAO PAULO">

    <label>Valor (opcional):</label>
    <input type="text" name="valor" placeholder="Ex: 50.00">

    <label>TXID (opcional):</label>
    <input type="text" name="txid" placeholder="Ex: PEDIDO123">

    <button type="submit">Gerar QR Code</button>
  </form>

  <?php if (!empty($qrCodeUrl)): ?>
  <div class="resultado">
    <h2>QR Code PIX</h2>
    <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code PIX">
    <h3>Payload (copia e cola):</h3>
    <textarea readonly><?php echo $payloadFinal; ?></textarea>
  </div>
  <?php endif; ?>
</body>
</html>
