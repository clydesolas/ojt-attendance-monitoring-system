<?php
 include('db_connect.php');

require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    //continue here march 12
    //continue here march 12
    //continue here march 12
    //continue here march 12
    //continue here march 12
    //continue here march 12
    //continue here march 12
    //continue here march 12
    //continue here march 12
    //continue here march 12

    $sql = "SELECT * FROM tbl_events a, tbl_user b, tbl_borrower_class c 
    WHERE a.user_id = b.user_id 
    AND (a.status = 'DONE' or a.status = 'APPROVED')
    AND a.borrower_class_id = c.borrower_class_id 
    AND a.date_requested >= '$start_date' AND a.date_requested <= '$end_date'";

    $result = $connection->query($sql);

  
// Include the main TCPDF library (search for installation path).
require_once('../assets/global/vendor/tecnickcom/tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
        public function Header() {
            // Logo
            $image_file ='../assets/global/img/cvsu-logo2.png';
            $this->Image($image_file, 20, 10, 27, '', 'PNG', '', 'T', false, 0, '', false, false, 0, false, false, false);
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            $title = 'CAVITE STATE UNIVERSITY';
            $imusCampus = 'Imus Campus';
            $address = 'Cavite Civic Center Palico IV, Imus, Cavite';
            $phoneNumbers = '(046) 471-66-07 / (046) 471-67-70 / (046) 686-2349';
            $website = 'www.cvsu.edu.ph';

            $this->Cell(115, 1, $title, 0, 1, 'C'); // 'C' stands for center alignment
            $this->Cell(0, 1, $imusCampus, 0, 1, 'C');
            $this->SetFont('helvetica', '', 10);
            $this->Cell(0, 1, $address, 0, 1, 'C');
            $this->Cell(0, 1, $phoneNumbers, 0, 1, 'C');
            $this->Cell(0, 1, $website, 0, 1, 'C');
        
        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            $inf = 'Electronic Copy of SPO Accreditation | CvSU Imus';
            $this->Cell(10, 15, $inf, 0, 1, 'R');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetY(100);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Event Supply Management System');
    $pdf->SetTitle('Supply Office Accreditation');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->AddPage();
    $pdf->SetY(40);

    // Start building the HTML string for the Excel table
    $html = '<table border="1" style="width:100%;">';
    $html .= '<thead><tr><th style="width:35px">No.</th><th>Requested Date</th><th style="width:135px">Date of Activity</th><th>Name of Activity</th><th>Requested Supplies</th><th  style="width:100px">Dept./Office</th><th style="width:100px">Requested by</th></tr></thead>';
    $html .= '<tbody>';

    $i = 0;
    while ($row_data = $result->fetch_assoc()) {
        $i++;
        $username = ucwords($row_data['firstname'] . " " . $row_data['surname']);
        $requested_date = date("F j, Y - g:i A", strtotime($row_data['date_requested']));
        $event_id = $row_data['event_id'];

        if ($start_date == $end_date) {
            $timeframe = date("F j, Y -  g:i A", strtotime($row_data['start_date'])) . ' to ' . date("g:i A", strtotime($row_data['end_date']));
        } else {
            $timeframe = date("F j, Y - g:i A", strtotime($row_data['start_date'])) . ' to ' . date("F j, Y g:i A", strtotime($row_data['end_date']));
        }

        $activity_name = ucwords($row_data['event_name']);
        $borrower_class_name = $row_data['borrower_class_name'];
        // Facilities
        $sqlfac = mysqli_query($connection, "SELECT a.name FROM tbl_resources a, tbl_reserved_resources b, tbl_events c 
            WHERE a.resources_id = b.resources_id 
            AND a.type='FACILITY' 
            AND b.event_id = c.event_id 
            AND c.date_requested >= '$start_date' 
            AND c.date_requested <= '$end_date' 
            AND c.event_id =  '$event_id'") or die(mysqli_error($connection));

        $facilityNames = array(); // Initialize an array to store facility names

        if (mysqli_num_rows($sqlfac) > 0) {
            while ($row1 = mysqli_fetch_array($sqlfac)) {
                $facilityNames[] = $row1['name']; // Add facility_name to the array
            }
            $facilities = implode(', ', $facilityNames); // Join array elements with commas
        } else {
            $facilities = ''; // No facilities for this event
        }

        // Equipment
        $sqleqp = mysqli_query($connection, "SELECT a.name, b.quantity as bquantity 
            FROM tbl_resources a, tbl_reserved_resources b , tbl_events c
            WHERE a.resources_id = b.resources_id AND b.event_id = '$event_id' 
            AND a.type='EQUIPMENT'
            AND c.date_requested >= '$start_date' 
            AND c.date_requested <= '$end_date'
            AND c.event_id =  '$event_id'") or die(mysqli_error($connection));

        $equipmentString = ''; // Initialize equipment string

        if (mysqli_num_rows($sqleqp) > 0) {
            while ($row1 = mysqli_fetch_array($sqleqp)) {
                $equipmentString .= $row1['name'] . ' (' . $row1['bquantity'] . 'x), '; // Concatenate equipment name and quantity
            }
            $equipmentString = rtrim($equipmentString, ', '); // Remove trailing comma and space
        }

        $supplies = $facilities . ($equipmentString ? ', ' . $equipmentString : ''); 

        // Append row to HTML string
        $html .= '<tr>';
        $html .= '<td style="width:35px; text-align:center">' . $i . '</td>';
        $html .= '<td>' . $requested_date . '</td>';
        $html .= '<td  style="width:135px">' . $timeframe . '</td>';
        $html .= '<td>' . $activity_name . '</td>';
        $html .= '<td>' . $supplies . '</td>';
        $html .= '<td  style="width:100px">' . $borrower_class_name . '</td>';
        $html .= '<td style="width:100px">' . $username . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // Output the HTML table using writeHTML method
    $pdf->writeHTML($html, true, false, false, false, '');

    // ... (TCPDF output and footer code)
    
    //Close and output PDF document
    $pdf->Output('Supply_Office_Accreditation_'.$year.'.pdf', 'D');
}
