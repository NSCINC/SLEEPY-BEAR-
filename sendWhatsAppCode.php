<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = '+14155238886';
$token = 'important-usual';
$twilio = new Client($sid, $token);

$data = json_decode(file_get_contents('php://input'), true);
$phone = $data['phone'];
$code = $data['code'];

try {
    $message = $twilio->messages->create(
        "whatsapp:".$phone, // to
        [
            "from" => "+14155238886",
            "body" => "Seu código de verificação é: $code"
        ]
    );

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
