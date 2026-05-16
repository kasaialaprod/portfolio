<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['cv_file'];

        $uploadDir = __DIR__ . '/../asset/doc/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($file['name']);
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($extension !== 'pdf') {
            header('Location: /admin/backoffice.php?error=type');
            exit;
        }

        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $_SESSION['cv_file_name'] = $fileName;
            header('Location: /admin/backoffice.php?success=1');
            exit;
        } else {
            header('Location: /admin/backoffice.php?error=move');
            exit;
        }
    } else {
        header('Location: /admin/backoffice.php?error=upload');
        exit;
    }
}

header('Location: /admin/backoffice.php');
exit;
?>