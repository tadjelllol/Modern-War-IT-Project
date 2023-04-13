<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $question = $_POST['question'];

  $apiKey = 'YOUR_API_KEY';
  $modelId = 'YOUR_MODEL_ID';
  $prompt = "Q: $question\nA:";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/engines/$modelId/completions");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'prompt' => $prompt,
    'max_tokens' => 100,
    'temperature' => 0.5,
    'n' => 1,
    'stop' => ['\n']
  ]));
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
  ]);
  $response = json_decode(curl_exec($ch));
  curl_close($ch);

  $answer = $response->choices[0]->text;
}
?>
