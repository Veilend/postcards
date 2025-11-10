<?php
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $dateNow = date('Ymd_His');
    $fileName = "postcard_{$dateNow}.png";
    $destPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        http_response_code(200);
        echo json_encode(['message' => 'Файл успешно загружен', 'filename' => $fileName]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка при сохранении файла']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Нет файла для загрузки']);
}
?>
