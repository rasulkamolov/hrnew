<?php
// === SETTINGS ===
$BOT_TOKEN = "8308079078:AAGSMTeUuzvYk8Uk1tKlnSEWCwVDcKhZrmY"; // Your Token
$TEACHER_CHAT_ID = "-1002768595242"; // Teachers Group
$STAFF_CHAT_ID = "-1002967460187";     // Staff Group

// CORS & Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Increase Limits for File Uploads
ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');
ini_set('memory_limit', '256M');

$response = ['ok' => false, 'error' => 'Unknown error'];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Only POST allowed");
    }

    $role = $_POST['role'] ?? 'teacher';
    $chat_id = ($role === 'staff') ? $STAFF_CHAT_ID : $TEACHER_CHAT_ID;

    // === 1. BUILD MESSAGE STRING (FULL DATA) ===
    $message = "";

    if ($role === 'staff') {
        $message .= "🆔 <b>YANGI ARIZA: XODIM (STAFF)</b>\n\n";
        $message .= "👤 <b>Ism:</b> " . clean($_POST['full_name']) . "\n";
        $message .= "📅 <b>Tug'ilgan sana:</b> " . clean($_POST['birthdate']) . "\n";
        $message .= "📞 <b>Tel:</b> " . clean($_POST['phone']) . "\n";
        $message .= "🏠 <b>Manzil:</b> " . clean($_POST['address']) . "\n";
        $message .= "🎓 <b>O'qish:</b> " . clean($_POST['education']) . "\n";
        $message .= "🌍 <b>Tillar:</b> " . clean($_POST['languages']) . "\n";
        $message .= "💼 <b>Tajriba:</b> " . clean($_POST['work_history']) . "\n";
        $message .= "🚪 <b>Bo'shash sababi:</b> " . clean($_POST['reason_leave']) . "\n";
        $message .= "💻 <b>Kompyuter:</b> " . clean($_POST['computer_skills']) . "\n";
        $message .= "💍 <b>Oila:</b> " . clean($_POST['marital_status']) . "\n";
        $message .= "⏳ <b>Muddat:</b> " . clean($_POST['duration']) . "\n";
        $message .= "❓ <b>Nega siz:</b> " . clean($_POST['why_you']) . "\n";
        $message .= "🏃 <b>Hozirda:</b> " . clean($_POST['current_activity']) . "\n";
        $message .= "🌐 <b>Social:</b> " . clean($_POST['socials']) . "\n";
    } else {
        // Teacher
        $message .= "👨‍🏫 <b>YANGI ARIZA: O'QITUVCHI</b>\n\n";
        $message .= "👤 <b>Ism:</b> " . clean($_POST['full_name']) . "\n";
        $message .= "📞 <b>Tel:</b> " . clean($_POST['phone']) . "\n";
        $message .= "📅 <b>Tug'ilgan sana:</b> " . clean($_POST['birthdate']) . "\n";
        $message .= "🕒 <b>Bo'sh vaqt (1-3-5):</b> " . clean($_POST['time135']) . "\n";
        $message .= "🕒 <b>Bo'sh vaqt (2-4-6):</b> " . clean($_POST['time246']) . "\n";
        $message .= "⏳ <b>Muddat:</b> " . clean($_POST['duration']) . "\n";
        $message .= "📊 <b>Daraja:</b> " . clean($_POST['levels']) . "\n";
        $message .= "🇷🇺 <b>Rus tili:</b> " . clean($_POST['russian']) . "\n";
        $message .= "⚒ <b>2-ish:</b> " . clean($_POST['second_job']) . "\n";
        $message .= "💼 <b>Tajriba:</b> " . clean($_POST['experience']) . "\n";
        $message .= "👨‍🎓 <b>O'quvchilar soni:</b> " . clean($_POST['students_taught']) . "\n";
        $message .= "🎓 <b>Ma'lumoti:</b> " . clean($_POST['education']) . "\n";
        $message .= "🧠 <b>Ustozlari:</b> " . clean($_POST['ielts_trainer']) . "\n";
        $message .= "💪 <b>Ustunligi:</b> " . clean($_POST['strengths']) . "\n";
        $message .= "🚀 <b>Strategiya:</b> " . clean($_POST['strategy']) . "\n";
        $message .= "🎯 <b>Maqsadlar:</b> " . clean($_POST['goals']) . "\n";
        $message .= "👪 <b>Ota:</b> " . clean($_POST['father']) . "\n";
        $message .= "👪 <b>Ona:</b> " . clean($_POST['mother']) . "\n";
        $message .= "💍 <b>Turmush o'rtoq:</b> " . clean($_POST['partner']) . "\n";
        $message .= "👥 <b>Qarindoshlar:</b> " . clean($_POST['relatives']) . "\n";
    }

    // === 2. SEND TEXT MESSAGE ===
    sendTelegram($BOT_TOKEN, 'sendMessage', [
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'HTML'
    ]);

    // === 3. HANDLE & SEND FILES ===
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    // Helper to upload and send
    function processFile($fieldName, $caption, $token, $chatId, $dir) {
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES[$fieldName]['tmp_name'];
            $name = basename($_FILES[$fieldName]['name']);
            $target = $dir . time() . "_" . $name;

            if (move_uploaded_file($tmpName, $target)) {
                $cFile = new CURLFile($target);
                sendTelegram($token, 'sendDocument', [
                    'chat_id' => $chatId,
                    'document' => $cFile,
                    'caption' => $caption
                ]);
            }
        }
    }

    // Send Photo (Both roles have this)
    processFile('photo', '#Foto', $BOT_TOKEN, $chat_id, $uploadDir);

    // Send IELTS Cert (Only Teacher has this)
    if ($role === 'teacher') {
        processFile('ielts_cert', '#Sertifikat', $BOT_TOKEN, $chat_id, $uploadDir);
    }

    $response['ok'] = true;

} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);

// === HELPER FUNCTIONS ===

function clean($data) {
    return htmlspecialchars($data ?? '-', ENT_QUOTES, 'UTF-8');
}

function sendTelegram($token, $method, $datas) {
    $url = "https://api.telegram.org/bot" . $token . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        // Log error if needed: error_log(curl_error($ch));
    }
    curl_close($ch);
    return $res;
}
?>