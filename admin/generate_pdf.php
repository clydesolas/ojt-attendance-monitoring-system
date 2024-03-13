<?php
 include('db_connect.php');

require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT
    employee_id,
    log_date,
    COALESCE(DATE_FORMAT(
        CASE
            WHEN am_in IS NOT NULL THEN am_in
            ELSE pm_in
        END, '%h:%i %p'), '-') as time_in,
    COALESCE(DATE_FORMAT(
        CASE
            WHEN pm_out IS NOT NULL THEN pm_out
            ELSE am_out
        END, '%h:%i %p'), '-') as time_out,
    am_work_hours,
    pm_work_hours,
    am_work_hours + pm_work_hours as total_work_hours
FROM (
    SELECT
        employee_id,
        DATE(datetime_log) as log_date,
        MIN(CASE WHEN HOUR(datetime_log) < 12 AND log_type =  1 THEN datetime_log END) as am_in,
        MAX(CASE WHEN HOUR(datetime_log) < 13  AND log_type =  4 THEN datetime_log END) as am_out,
        MIN(CASE WHEN HOUR(datetime_log) >= 12  AND log_type =  1 THEN datetime_log END) as pm_in,
        MAX(CASE WHEN HOUR(datetime_log) >= 12  AND log_type =  4 THEN datetime_log END) as pm_out,
        COALESCE(TIMESTAMPDIFF(HOUR, 
            MIN(CASE WHEN HOUR(datetime_log) < 12 AND log_type =  1  THEN datetime_log END), 
            MAX(CASE WHEN HOUR(datetime_log) < 13 AND log_type =  4  THEN datetime_log END)
        ), 0) as am_work_hours,
        COALESCE(TIMESTAMPDIFF(HOUR, 
            MIN(CASE WHEN HOUR(datetime_log) >= 12 AND log_type =  1  THEN datetime_log END), 
            MAX(CASE WHEN HOUR(datetime_log) >= 12 AND log_type =  4 THEN datetime_log END)
        ), 0) as pm_work_hours
    FROM
        attendance
    WHERE
        employee_id = '$id'
        AND log_type IN (1, 4)
    GROUP BY
        employee_id,
        log_date
) AS subquery;
";

    $result = $conn->query($sql);
    if (!$result) {
        die("Error: " . $conn->error);
    }
    
    $sql2 = "SELECT * FROM faculty WHERE id_no = '$id'";
    $result2 = $conn->query($sql2);

    if (!$result2) {
        die("Error: " . $conn->error);
    }

    $row = $result2->fetch_assoc();

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
        public function Header() {
            // Logo
            $image_file ='cvsu-logo2.png';
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
            $inf = 'Electronic Copy of DTR | CvSU Imus';
            $this->Cell(10, 15, $inf, 0, 1, 'R');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetY(100);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('BSIT');
    $pdf->SetTitle('OJT Attendance Management System');

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
    $topMargin = 40; 
    $pdf->SetMargins(PDF_MARGIN_LEFT, $topMargin, PDF_MARGIN_RIGHT);
    $pdf->SetFont('freeserif', '', 11, '', true);

    $pdf->SetY(38);
    $head = "<b style='font-size:10px;  font-weight: bold;text-align: center'>On-the-Job Training (OJT) Program</p>";
    $pdf->writeHTML($head, true, false, false, false, 'C');
    
    $pdf->SetY(48);
    $head = "<b style='font-size:10px; font-weight: bold;text-align: center'>DAILY TIME RECORD</p>";
    $pdf->writeHTML($head, true, false, false, false, 'C');

    $program_code = $row['program_code'];
    $total_hours = $row['total_hours'];
    $pdf->SetY(57);
    $fullname = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];

    $firstrow = '
        <table style="width: 100%;">
            <tr>
                <td style="width:7%;">Name:</td>
                <td style="width:40%; border-bottom: .3px solid black;">'.$fullname.'</td>
                <td style="width:13%;"></td>
                <td style="width:15%;">Program Code:</td>
                <td style="width:25%; border-bottom: .3px solid black;">'.$program_code.'</td>
            </tr>
        </table>';
    
    $pdf->writeHTML($firstrow, true, false, false, false, 'l');
    
   
    $pdf->SetY(62);
    $secondrow = '<table style="width: 100%;">
                    <tr>
                    <td style="width:33%;">Total No. of Hours to be completed:</td>
                    <td style="width:14% ; border-bottom: .3px solid black;">'.$total_hours.'</td>
                    </tr>
                </table>';
    $pdf->writeHTML($secondrow, true, false, false, false, 'L');

    $pdf->SetY(69);
    $semester = $row['semester'];
    $academic_year = $row['academic_year'];
    $check1 = $semester == 'FIRST' ? "\xE2\x9C\x93" : '';
    $check2 = $semester == 'SECOND' ? "\xE2\x9C\x93" : '';
    $check3 = $semester == 'SUMMER' ? "\xE2\x9C\x93" : '';

    $thirdrow = "<table style='width: 100%; font-size:10px;'>
                    <tr>
                        <td>( $check1 ) 1st Semester</td>
                        <td>($check2 ) 2nd Semester</td>
                        <td>( $check3 ) Summer</td>
                        <td>Academic Year <u>$academic_year</u></td>
                    </tr>
                </table>";

    $pdf->writeHTML($thirdrow, true, false, false, false, 'L');


    $pdf->SetY(79);
    

    // Start building the HTML string for the Excel table
    $html = '<table border=".1" style="width:100%;">';
    $html .= '<thead>
    <tr>
    <th style="font-weight:bold; text-align: center">Date</th>
    <th style="font-weight:bold; text-align: center">Time In</th>
    <th style="font-weight:bold; text-align: center">Time Out</th>
    <th style="font-weight:bold; text-align: center">Hours</th>
    <th style="font-weight:bold; text-align: center">Signature</th>
    </tr>
    </thead>';
    $html .= '<tbody>';
        $average_hour = 0;

    $i = 0;
    while ($row_data = $result->fetch_assoc()) {
        $i++;
        $date = date("F j, Y", strtotime($row_data['log_date']));
        $morningTimeIn = $row_data['time_in'];
        $morningTimeOut = $row_data['time_out'];
        $sumHours = $row_data['total_work_hours'];
        $average_hour = $average_hour + $sumHours;
        $signature=' ';
         // Append row to HTML string
        $html .= '<tr>';
        $html .= '<td style="text-align: center">' . $date . '</td>';
        $html .= '<td style="text-align: center">' . $morningTimeIn . '</td>';
        $html .= '<td style="text-align: center">' . $morningTimeOut . '</td>';
        $html .= '<td style="text-align: center">' . $sumHours . '</td>';
        $html .= '<td style="text-align: center">' . $signature . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // Output the HTML table using writeHTML method
    $pdf->writeHTML($html, true, false, false, false, '');
    $fourthrow = '<p>Total No. of Hours:</p> <div style = "width: 15px; border: 1px solid black">'.$average_hour.'</div>';

    $pdf->writeHTML($fourthrow, true, false, false, false, 'L');
    
    //Close and output PDF document
    $pdf->Output('dtr_.pdf', 'D');
}
