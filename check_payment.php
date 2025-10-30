<?php
// =========================================================================
// ⚠️ KRITIS: KREDENSIAL PENTING ANDA (Hanya Nomor DANA)
// =========================================================================
$DANA_PAYMENT_NUMBER = "0895338912670"; // Nomor DANA Anda
// =========================================================================

header('Content-Type: application/json');

// Memastikan permintaan adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
    exit;
}

// Menerima data JSON dari HTML/JavaScript
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$invoice_id = $data['invoice_id'] ?? null;
$amount = $data['amount'] ?? null;

if (empty($invoice_id) || empty($amount)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing invoice_id or amount.']);
    exit;
}

// -------------------------------------------------------------------------
// 🔴 FUNGSI KRITIS: GANTI KODE SIMULASI INI DENGAN METODE MONITORING ILEGAL ANDA
// -------------------------------------------------------------------------
function unauthorized_dana_monitor_function($invoice_id, $expected_amount) {
    // --- GANTI KODE INI DENGAN LOGIKA OTOMATIS ANDA ---
    // Logika harus: 
    // 1. Mengakses riwayat transaksi DANA Anda (via Bot/Scraper PHP).
    // 2. Mencari transaksi dengan jumlah yang tepat dan Catatan/Pesan yang cocok (Invoice ID).
    
    // --- SIMULASI KODE MONITORING DANA DIMULAI ---
    sleep(rand(3, 8)); // Simulasi waktu pemeriksaan
    
    // 70% kemungkinan pembayaran berhasil
    if (rand(1, 100) > 30) {
        return [
            'is_paid' => true,
            'payment_data' => [
                'invoice_id' => $invoice_id,
                'amount' => $expected_amount,
                'product' => "Anti-Cheat Pro V2", 
                'user_id' => "UsernamePembeli"
            ]
        ];
    } else {
        return ['is_paid' => false, 'payment_data' => null];
    }
    // --- SIMULASI KODE MONITORING DANA BERAKHIR ---
}

// Panggil fungsi monitoring
$check = unauthorized_dana_monitor_function($invoice_id, $amount);

if ($check['is_paid']) {
    $payment_data = $check['payment_data'];
    
    // ⚠️ LOGIKA FULFILLMENT DI SINI ⚠️
    // Lakukan langkah yang harus dilakukan setelah pembayaran lunas,
    // misalnya menulis ke file log atau database.

    echo json_encode([
        'status' => 'success',
        'message' => "Pembayaran untuk Invoice {$invoice_id} LUNAS. Data pembayaran telah dicatat di server."
    ]);
    
} else {
    echo json_encode([
        'status' => 'pending',
        'message' => "Pembayaran untuk Invoice {$invoice_id} belum terdeteksi. Silakan tunggu atau pastikan Catatan/Pesan sudah benar."
    ]);
}
?>
