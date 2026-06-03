<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['cv_file'];

        $uploadDir = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/asset/doc/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($file['name']);
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($extension !== 'pdf') {
            $_SESSION['js_alert'] = 'Le fichier doit être un PDF.';
            header('Location: /admin/backoffice.php');
            exit;
        }

        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $_SESSION['cv_file_name'] = $fileName;
            $_SESSION['js_alert'] = 'Le CV a bien été importé.';
        } else {
            $_SESSION['js_alert'] = "L'upload a échoué : fichier non déplacé.";
        }

        header('Location: /admin/backoffice.php');
        exit;
    } else {
        $_SESSION['js_alert'] = "Erreur upload code : " . ($_FILES['cv_file']['error'] ?? 'inconnu');
        header('Location: /admin/backoffice.php');
        exit;
    }
}

header('Location: /admin/backoffice.php');
exit;
?>