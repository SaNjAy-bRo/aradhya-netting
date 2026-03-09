<?php
// request-callback.php
// Final version — sends HTML email + redirects on success

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name  = htmlspecialchars(trim($_POST['name'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));

    // Configuration
    $to       = "urbaninvisiblegrills@gmail.com";
    $bcc      = "krishnark.design@gmail.com";
    $subject  = "New Callback Request - Urban Invisible Grills";
    $from     = "no-reply@urbaninvisiblegrills.com";
    $thankyou = "https://urbaninvisiblegrills.com/thankyou.html";

    // Build HTML message
    $message = "
    <html>
    <head>
      <title>New Callback Request</title>
      <style>
        body { font-family: Arial, sans-serif; color:#333; background:#f9f9f9; }
        .wrap { background:#fff; padding:20px; border-radius:8px; max-width:480px; margin:auto; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
        h2 { color:#182F89; margin-top:0; }
        table { width:100%; border-collapse:collapse; margin-top:10px; }
        td { padding:8px; border-bottom:1px solid #eee; }
      </style>
    </head>
    <body>
      <div class='wrap'>
        <h2>New Callback Request</h2>
        <table>
          <tr><td><strong>Name:</strong></td><td>{$name}</td></tr>
          <tr><td><strong>Phone:</strong></td><td>{$phone}</td></tr>
        </table>
        <p style='font-size:13px;color:#777;margin-top:20px;'>
          Submitted from: Urban Invisible Grills Website<br>
          IP: " . $_SERVER['REMOTE_ADDR'] . "<br>
          Date: " . date("Y-m-d H:i:s") . "
        </p>
      </div>
    </body>
    </html>
    ";

    // Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Urban Invisible Grills <{$from}>\r\n";
    $headers .= "Bcc: {$bcc}\r\n";
    $headers .= "Reply-To: {$from}\r\n";

    // Send email
    @mail($to, $subject, $message, $headers);

    // Redirect on success
    header("Location: $thankyou");
    exit;
}
?>
