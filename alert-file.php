
<?php
// เรียกไฟล์เชื่อมต่อฐานข้อมูล
require_once 'db_connect.php';

function checkLowStock($conn) {
    // SQL: ดึงข้อมูลสินค้าที่จำนวน <= threshold
    $sql = "SELECT id, name, quantity, low_stock_threshold 
            FROM product 
            WHERE quantity <= low_stock_threshold";

    // เตรียมและรันคำสั่ง SQL
    $stmt = $conn->query($sql);

    // ตรวจสอบจำนวนสินค้า
    if ($stmt->rowCount() > 0) {
        echo "<div class='alert alert-warning'>";
        echo "<h4>⚠️ แจ้งเตือนสินค้าใกล้หมด</h4>";
        echo "<ul>";

        // ดึงข้อมูลสินค้า
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>สินค้า: {$row['name']} (คงเหลือ: {$row['quantity']})</li>";
        }

        echo "</ul>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-success'>สินค้าทั้งหมดอยู่ในปริมาณปกติ</div>";
    }
}


// เรียกใช้ฟังก์ชัน
checkLowStock($conn);
?>

