<?php
// Clear any previous output buffers to prevent PDF corruption
if (ob_get_length()) ob_end_clean();

require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || ($_SESSION["user_role"] !== 'Armourer' && $_SESSION["user_role"] !== 'Administrator')) {
    header("location: login");
    exit();
}

if($_SESSION["user_role"] != 'Armourer' && $_SESSION["user_role"] != 'Administrator') {
    die("UNAUTHORIZED_ACCESS_EXCEPTION: AUDIT_CLEARANCE_REQUIRED");
}

if (!file_exists('fpdf/fpdf.php')) {
    die("[CRITICAL_ERROR]: FPDF library missing.");
}
require_once('fpdf/fpdf.php');

class NCTDAudit extends FPDF {
    function Header() {
        // High-Contrast Tactical Header
        $this->SetFillColor(5, 7, 10);
        $this->Rect(0, 0, 210, 35, 'F');
        
        $this->SetFont('Courier', 'B', 16);
        $this->SetTextColor(0, 242, 255);
        $this->SetXY(0, 10);
        $this->Cell(0, 10, 'NCTD // MASTER ARMOURY AUDIT', 0, 1, 'C');
        
        $this->SetFont('Courier', '', 9);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 5, 'SENSITIVE_LOG_CLEARANCE_LEVEL_1', 0, 1, 'C');

        // Header Watermark
        $this->SetFont('Courier', 'B', 16);
        $this->SetTextColor(220, 220, 220); // Very light grey
        $this->SetXY(0, 22);
        $this->Cell(0, 7, 'CONFIDENTIAL AUDIT LOG', 0, 1, 'C');
        
        // Reset text color for table or document
        $this->SetTextColor(0, 0, 0);
        $this->Ln(12);
    }

    function SectionHeader($title) {
        $this->SetFont('Courier', 'B', 11);
        $this->SetFillColor(20, 24, 33);
        $this->SetTextColor(0, 242, 255);
        $this->Cell(0, 7, $title, 0, 1, 'L', true);
        $this->Ln(2);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Courier', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 10, 'Page '.$this->PageNo().' // SYSTEM_AUDIT_ENGINE_V2', 0, 0, 'C');
    }
}

$pdf = new NCTDAudit();
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();

// Report type: master, overdue, inventory, or faulty
$report_type = $_GET['type'] ?? 'master';

// --- 1. OVERDUE AMMUNITION LOG ---
if ($report_type == 'master' || $report_type == 'overdue') {
    $pdf->SectionHeader('Unreturned Ammunition Log');
    
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->SetFillColor(5, 7, 10);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(45, 7, 'BOOKING_TIME', 1, 0, 'C', true);
    $pdf->Cell(55, 7, 'PERSONNEL', 1, 0, 'C', true);
    $pdf->Cell(60, 7, 'ITEM', 1, 0, 'C', true);
    $pdf->Cell(20, 7, 'CATEGORY', 1, 1, 'C', true);
    
    $pdf->SetFont('Courier', '', 9);
    $pdf->SetTextColor(0, 0, 0);

    $sql_overdue = "SELECT a.booking_time, o.full_name, CONCAT(am.ammo_name, ' (', am.ammo_type, ')') AS item, 'AMMO' as cat 
    FROM ammo_bookings a INNER JOIN ammunitions am ON a.ammoID = am.ammoID 
    INNER JOIN officers o ON a.officerID = o.officerID WHERE a.ammo_returns = 'Not-Return'";
    
    $stmt = $pdo->query($sql_overdue);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(45, 6, $row['booking_time'], 1);
        $pdf->Cell(55, 6, $row['full_name'], 1);
        $pdf->Cell(60, 6, $row['item'], 1);
        $pdf->Cell(20, 6, $row['cat'], 1, 1);
    }
    $pdf->Ln(5);
}

// --- 2. FIREARM INVENTORY & HEALTH ---
if ($report_type == 'master' || $report_type == 'inventory') {
    $pdf->SectionHeader('Firearm Inventory & Maintenance Status');
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->SetFillColor(5, 7, 10);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(50, 7, 'FIREARM_NAME', 1, 0, 'C', true);
    $pdf->Cell(50, 7, 'SERIAL_NO', 1, 0, 'C', true);
    $pdf->Cell(45, 7, 'CALIBER', 1, 0, 'C', true);
    $pdf->Cell(45, 7, 'STATE', 1, 1, 'C', true);
    
    $pdf->SetFont('Courier', '', 9);
    $pdf->SetTextColor(0, 0, 0);

    $sql_firearms = "SELECT firearm_name, firearm_serial_no, firearm_caliber, booking_status FROM firearms";
    $stmt_firearms = $pdo->query($sql_firearms);
    while($row = $stmt_firearms->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(50, 6, $row['firearm_name'], 1);
        $pdf->Cell(50, 6, $row['firearm_serial_no'], 1);
        $pdf->Cell(45, 6, $row['firearm_caliber'], 1);
        $pdf->Cell(45, 6, $row['booking_status'], 1, 1);
    }
    $pdf->Ln(5);
}

// --- 3. FAULTY EQUIPMENT ---
if ($report_type == 'master' || $report_type == 'faulty') {
    $pdf->SectionHeader('Faulty Assets Log');
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->SetFillColor(5, 7, 10);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(50, 7, 'SERIAL_NO', 1, 0, 'C', true);
    $pdf->Cell(55, 7, 'EQUIPMENT/ITEM', 1, 0, 'C', true);
    $pdf->Cell(40, 7, 'FAULTY_TYPE', 1, 0, 'C', true);
    $pdf->Cell(35, 7, 'NATURE', 1, 1, 'C', true);
    
    $pdf->SetFont('Courier', '', 9);
    $pdf->SetTextColor(0, 0, 0);

    $sql_faulty = "SELECT faulty_firearm_serial_no AS serial, faulty_firearm_name AS item, faulty_type, faulty_nature FROM faulty_weapons
    UNION ALL
    SELECT faulty_ammo_serial_no AS serial, faulty_ammo_manufacturer AS item, faulty_type, 'N/A' FROM faulty_ammo";
    
    $stmt_faulty = $pdo->query($sql_faulty);
    while($row = $stmt_faulty->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(50, 6, $row['serial'], 1);
        $pdf->Cell(55, 6, $row['item'], 1);
        $pdf->Cell(40, 6, $row['faulty_type'], 1);
        $pdf->Cell(35, 6, $row['faulty_nature'], 1, 1);
    }
    $pdf->Ln(5);
}

// --- 4. PERSONNEL STATUS (ARMOURY STAFF) ---
if ($report_type == 'master' || $report_type == 'personnel') {
    $pdf->SectionHeader('Personnel Clearance & Access Log');
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->SetFillColor(5, 7, 10);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(60, 7, 'FULLNAME', 1, 0, 'C', true);
    $pdf->Cell(40, 7, 'SERVICE_NO', 1, 0, 'C', true);
    $pdf->Cell(40, 7, 'RANK', 1, 0, 'C', true);
    $pdf->Cell(40, 7, 'ROLE', 1, 1, 'C', true);
    
    $pdf->SetFont('Courier', '', 9);
    $pdf->SetTextColor(0, 0, 0);

    $sql_admin = "SELECT fullname, service_no, rank, user_role FROM admin_lists";
    $stmt_admin = $pdo->query($sql_admin);
    while($row = $stmt_admin->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(60, 6, $row['fullname'], 1);
        $pdf->Cell(40, 6, $row['service_no'], 1);
        $pdf->Cell(40, 6, $row['rank'], 1);
        $pdf->Cell(40, 6, $row['user_role'], 1, 1);
    }
}

// Output PDF
$pdf->Output('I', 'MASTER_REPORT_'.date('Ymd').'.pdf');
?>