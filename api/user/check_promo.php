<?php
header("Content-Type: application/json");
require_once '../../config/database.php';

$base_price = 150000; // Harga dasar pendaftaran

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = isset($_POST['referral_code']) ? trim($_POST['referral_code']) : '';

    if (empty($code)) {
        echo json_encode(["status" => "success", "discount" => 0, "final_amount" => $base_price]);
        exit;
    }

    $stmt = $conn->prepare("SELECT discount_percentage FROM referral_codes WHERE code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $discount = $row['discount_percentage'];
        $discount_amount = ($discount / 100) * $base_price;
        $final_amount = $base_price - $discount_amount;

        echo json_encode([
            "status" => "success",
            "discount" => $discount,
            "final_amount" => $final_amount,
            "message" => "Kode referral berhasil diterapkan! Diskon $discount%"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "discount" => 0,
            "final_amount" => $base_price,
            "message" => "Kode referral tidak valid."
        ]);
    }
    $stmt->close();
}
$conn->close();
?>