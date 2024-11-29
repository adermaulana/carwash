<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require necessary files with proper error checking
require_once('../tcpdf/tcpdf.php');
if (!file_exists('../tcpdf/tcpdf.php')) {
    die('TCPDF library not found');
}

// Include database connection with error handling
require_once('../koneksi.php');
if (!$koneksi) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Sanitize and validate date inputs
$start_date = isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : null;
$end_date = isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : null;

// Validate date format (assuming YYYY-MM-DD)
function validateDate($date) {
    return $date && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date);
}

// Prepare WHERE clause with parameterized query
$where_conditions = ["transaksi_221061.status_221061 = 'Lunas'"];
$params = [];

if (validateDate($start_date) && validateDate($end_date)) {
    if (strtotime($start_date) > strtotime($end_date)) {
        die('Invalid date range: Start date cannot be after end date');
    }
    $where_conditions[] = "transaksi_221061.tanggal_221061 BETWEEN ? AND ?";
    $params[] = $start_date;
    $params[] = $end_date;
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Prepare the SQL query with prepared statement
$query = "SELECT 
            transaksi_221061.*, 
            pendaftaran_221061.total_biaya_221061,
            customer_221061.nama_221061,
                                                                jenis_cucian_221061.jenis_cucian_221061
          FROM 
            transaksi_221061
          JOIN 
            pendaftaran_221061 ON transaksi_221061.id_pendaftaran_221061 = pendaftaran_221061.id_pendaftaran_221061
                                                            JOIN 
                                                                jenis_cucian_221061 ON pendaftaran_221061.id_jenis_cucian_221061 = jenis_cucian_221061.id_jenis_cucian_221061
          JOIN 
            customer_221061 ON pendaftaran_221061.id_customer_221061 = customer_221061.id_customer_221061
          $where_clause
          ORDER BY 
            transaksi_221061.id_transaksi_221061 DESC";

// Prepare and execute the statement
$stmt = mysqli_prepare($koneksi, $query);

if (!$stmt) {
    die('Query preparation error: ' . mysqli_error($koneksi));
}

// Bind parameters if needed
if (!empty($params)) {
    $types = str_repeat('s', count($params)); // Assuming all are strings
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

// Execute the statement
if (!mysqli_stmt_execute($stmt)) {
    die('Query execution error: ' . mysqli_stmt_error($stmt));
}

// Get the result
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die('No results found');
}

// Inisialisasi TCPDF with more robust configuration
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('CAR WASH - Laporan Transaksi');
$pdf->SetSubject('Transaction Report');

// Set default header data
$pdf->SetHeaderData('', 0, 'CAR WASH - Laporan Transaksi', "Periode: " . 
    ($start_date ? $start_date : 'Semua Tanggal') . 
    " s/d " . 
    ($end_date ? $end_date : 'Sekarang'));

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Add a page
$pdf->AddPage();

// Prepare HTML content with improved formatting
$html = '<style>
    table { 
        border-collapse: collapse; 
        width: 100%; 
    }
    th { 
        background-color: #f2f2f2; 
        font-weight: bold; 
        text-align: center; 
    }
    td { 
        padding: 5px; 
        border: 1px solid #ddd; 
    }
</style>';

$html .= '<h2 style="text-align:center;">Laporan Transaksi</h2>';
$html .= '<table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nota Booking</th>
                    <th>Nama Pelanggan</th>
                    <th>Jenis Cucian</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';

$no = 1;
$total_biaya = 0;
while ($data = mysqli_fetch_array($result)) {
    $html .= '<tr>
                <td style="text-align:center;">' . $no++ . '</td>
                <td>' . htmlspecialchars($data['no_nota_221061']) . '</td>
                <td>' . htmlspecialchars($data['nama_221061']) . '</td>
                <td>' . htmlspecialchars($data['jenis_cucian_221061']) . '</td>
                <td style="text-align:center;">' . htmlspecialchars($data['tanggal_221061']) . '</td>
                <td style="text-align:right;">Rp. ' . number_format($data['total_biaya_221061'], 0, ',', '.') . '</td>
                <td style="text-align:center;">' . htmlspecialchars($data['status_221061']) . '</td>
              </tr>';
    $total_biaya += $data['total_biaya_221061'];
}

// Add total row
$html .= '<tr>
            <td colspan="4" style="text-align:right;"><strong>Total</strong></td>
            <td style="text-align:right;"><strong>Rp. ' . number_format($total_biaya, 0, ',', '.') . '</strong></td>
            <td></td>
          </tr>';

$html .= '</tbody></table>';

// Output PDF with improved error handling
try {
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('laporan_transaksi.pdf', 'I');
} catch (Exception $e) {
    die('PDF generation error: ' . $e->getMessage());
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>