<?php
$supported = ['en', 'lt', 'ru'];

function clean_text($value, $limit = 5000) {
  $value = trim((string)$value);
  $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value);
  if (function_exists('mb_substr')) {
    return mb_substr($value, 0, $limit, 'UTF-8');
  }
  return substr($value, 0, $limit);
}

function clean_header($value) {
  return trim(preg_replace('/[\r\n]+/', ' ', (string)$value));
}

function encode_header_value($value) {
  $value = clean_header($value);
  if (function_exists('mb_encode_mimeheader')) {
    return mb_encode_mimeheader($value, 'UTF-8', 'B', "\r\n");
  }
  return '=?UTF-8?B?' . base64_encode($value) . '?=';
}

function redirect_back($lang, $status) {
  global $supported;
  if (!in_array($lang, $supported, true)) {
    $lang = 'en';
  }
  header('Location: index.php?lang=' . rawurlencode($lang) . '&' . $status . '=1#contact');
  exit;
}

$lang = $_POST['lang'] ?? 'en';
if (!in_array($lang, $supported, true)) {
  $lang = 'en';
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  redirect_back($lang, 'error');
}

if (!empty($_POST['website'] ?? '')) {
  redirect_back($lang, 'sent');
}

$name = clean_text($_POST['name'] ?? '', 120);
$email = clean_header($_POST['email'] ?? '');
$message = clean_text($_POST['message'] ?? '', 5000);

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  redirect_back($lang, 'error');
}

$to = 'info@baogroup.eu';
$subject = 'New message from baogroup.eu';
$encodedSubject = encode_header_value($subject);
$replyName = encode_header_value($name ?: 'Website visitor');

$body =
  "New message from baogroup.eu\n\n" .
  "Name: {$name}\n" .
  "Email: {$email}\n" .
  "Language: {$lang}\n\n" .
  "Message:\n{$message}\n";

$headers = [
  'MIME-Version: 1.0',
  'Content-Type: text/plain; charset=UTF-8',
  'From: BaoGroup <info@baogroup.eu>',
  'Reply-To: ' . $replyName . ' <' . $email . '>',
  'X-Mailer: PHP/' . phpversion()
];

$sent = mail($to, $encodedSubject, $body, implode("\r\n", $headers));

redirect_back($lang, $sent ? 'sent' : 'error');
