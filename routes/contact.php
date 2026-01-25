<?php

require_once __DIR__ . '/database/db.php';


require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$nom     = htmlspecialchars(trim($_POST['name'] ?? ''));
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$message = trim($_POST['message'] ?? '');

$erreurs = [];

if (empty($nom)) {
    $erreurs[] = "Veuillez entrer votre nom !!!";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "Veuillez entrer votre adresse mail !!!";
}

if (empty($message)) {
    $erreurs[] = "Vous me contactez sans laisser de message ???";
}

if (empty($erreurs)) {

    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO messages (name, email, message)
            VALUES (:name, :email, :message)
        ");
        $ok = $stmt->execute([
            ':name'    => $nom,
            ':email'   => $email,
            ':message' => $message,
        ]);

        if (!$ok) {
            $info = $stmt->errorInfo();
            die('Erreur INSERT DB : ' . $info[0] . ' / ' . $info[1] . ' / ' . $info[2]);
        }
    } catch (PDOException $e) {
        die('Exception PDO (DB) : ' . $e->getMessage());
    }

    
    $mail = new PHPMailer(true);

    try {
        $mail->CharSet  = 'UTF-8';
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'imailer@ikokesha.com';
        $mail->Password   = 'IloveFlorent1234$';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('imailer@ikokesha.com', "Israël Kokesha");
        $mail->addAddress('israelkokesha2@gmail.com');
        $mail->addReplyTo($email, $nom);
        $mail->Subject = "Nouveau message depuis ton portfolio";
        $mail->Body    = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

        $mail->send();

        // Redirection après succès
        header('Location: index.php?success=1');
        exit;

    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du formulaire. Veuillez réessayer plus tard.";
    }

} else {
    echo '<p style="color:red;">Erreurs:<br>';
    foreach ($erreurs as $erreur) {
        echo '- ' . $erreur . '<br>';
    }
    echo '</p>';
}
