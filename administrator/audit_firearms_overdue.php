<?php 
error_reporting(0); // Prevents any PHP notices from corrupting the PDF stream
if (ob_get_length()) ob_end_clean(); 

require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('includes/NCTD_Base_PDF.php');

class FirearmsAudit extends NCTD_Base_PDF {
    function Header() {
        // High-Contrast Tactical Header
        $this->SetFillColor(5, 7, 10);
        $this->Rect(0, 0, 210, 40, 'F');
        
        $this->SetFont('Courier', 'B', 16);
        $this->SetTextColor(0, 242, 255);
        $this->SetXY(0, 10);
        $this->Cell(0, 10, 'NCTD // OVERDUE_FIREARMS_AUDIT', 0, 1, 'C');
        
        $this->SetFont('Courier', '', 9);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 5, 'SENSITIVE_LOG_CLEARANCE_LEVEL_3', 0, 1, 'C');
        
        // Faded Watermark
        $this->SetAlpha(0.1);
        $this->RotatedText(35, 190, 'UNRETURNED_FIREARMS_AUDIT', 45);

        // Reset text color and draw a line
        $this->SetAlpha(1.0);
        $this->SetDrawColor(0, 242, 255);
        $this->Line(15, 32, 195, 32);
        $this->Ln(15);
    }
}

$pdf = new FirearmsAudit();
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();

// 1. Get Oldest Overdue Statistics using PDO
$stats_query = "SELECT booking_time AS oldest_date, firearm_name AS oldest_item 
                FROM bookings 
                WHERE TRIM(returns) = 'Not-Return' 
                  AND is_deleted = 0 
                ORDER BY STR_TO_DATE(booking_time, '%M %e, %Y') ASC 
                LIMIT 1";

$stats_stmt = $pdo->query($stats_query);
$stats = $stats_stmt->fetch(PDO::FETCH_ASSOC);

$pdf->SetY(45);
$pdf->SetX(15);
$pdf->SetFont('Courier', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(90, 6, 'OLDEST_RECORD_TIMESTAMP:', 0, 0);
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(90, 6, $stats['oldest_date'] ?? 'N/A', 0, 1);

$pdf->SetX(15);
$pdf->SetFont('Courier', '', 10);
$pdf->Cell(90, 6, 'LONGEST_OUTSTANDING_ITEM:', 0, 0);
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(90, 6, strtoupper($stats['oldest_item'] ?? 'NONE'), 0, 1);

$pdf->Ln(10);

// --- MAIN LOG TABLE ---
$pdf->SetFillColor(5, 7, 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(45, 8, 'BOOKING_TIME', 1, 0, 'C', true);
$pdf->Cell(55, 8, 'PERSONNEL', 1, 0, 'C', true);
$pdf->Cell(60, 8, 'FIREARM_NAME', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'SERIAL_NO', 1, 1, 'C', true);

$pdf->SetFont('Courier', '', 9);
$pdf->SetTextColor(0, 0, 0);

$main_query = "SELECT b.booking_time, o.full_name, b.firearm_name, b.firearm_serial_no 
               FROM bookings b 
               INNER JOIN officers o ON b.officerID = o.officerID 
               WHERE TRIM(b.returns) = 'Not-Return' 
                 AND b.is_deleted = 0 
               ORDER BY STR_TO_DATE(b.booking_time, '%M %e, %Y') ASC";

$main_stmt = $pdo->query($main_query);
while($row = $main_stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(45, 6, $row['booking_time'], 1);
    $pdf->Cell(55, 6, $row['full_name'], 1);
    $pdf->Cell(60, 6, $row['firearm_name'], 1);
    $pdf->Cell(30, 6, $row['firearm_serial_no'], 1, 1);
}

$pdf->Ln(10);
$pdf->Cell(0, 6, 'END_OF_REPORT', 0, 1, 'C');

$pdf->Output('I', 'UNRETURNED_FIREARMS_'.date('Ymd').'.pdf');
?>