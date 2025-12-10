<?php
$webhookurl = "https://discord.com/api/webhooks/1414307500554981456/QYLXkscxZ9vOnscYnShsJzdMhFhpSVZGReRVRzzcnqNKnY_BDFP12OardW0hksMW4DOo"; // <-- Buraya kendi Discord webhook linkini yapıştır

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$discord_data = [
    "embeds" => [[
        "title" => "New Contact Form Submission",
        "color" => hexdec("00FFFF"),
        "fields" => [
            ["name" => "Name", "value" => $name, "inline" => true],
            ["name" => "Email", "value" => $email, "inline" => true],
            ["name" => "Message", "value" => $message]
        ],
        "footer" => ["text" => "Mystralis Contact Form"]
    ]]
];

$payload = json_encode($discord_data);

$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

// JSON yanıt dön
header('Content-Type: application/json');
echo json_encode(["status" => "ok"]);
?>
