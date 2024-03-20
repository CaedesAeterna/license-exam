<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';


require_once './lib/dompdf/autoload.inc.php';

require_once 'get_hours.php';

requireLogin();

// reference the Dompdf namespace
use Dompdf\Dompdf;


if (!empty($_GET['project_id']) and !empty($_GET['type'])) {
    $project_id = $db->escape_string($_GET['project_id']);
    $type = $db->escape_string($_GET['type']);


    if (!empty($_GET['start_date']) and !empty($_GET['end_date'])) {
        $start_date = $db->escape_string($_GET['start_date']);
        $end_date = $db->escape_string($_GET['end_date']);

        if ($type == 'workers') {
            $data = getWorkerHours($_SESSION['id'], $start_date, $end_date);

            // echo $data;

            $dataObject = json_decode($data);
            $dataArray = (array) $dataObject->data; // Cast to array if you need associative array access


        } else if ($type == 'tasks') {
            $data = getTaskHours($_SESSION['id'], $project_id, $start_date, $end_date);
            $dataObject = json_decode($data);
            $dataArray = (array) $dataObject->data; // Cast to array if you need associative array access

        }
    } else {
        if ($type == 'workers') {
            $data = getWorkerHours($_SESSION['id']);

            // echo $data;

            $dataObject = json_decode($data);
            $dataArray = (array) $dataObject->data; // Cast to array if you need associative array access

            // foreach ($dataArray as $key => $value) {
            //     echo $key . ': ' . $value . '<br>';
            // }

        } else if ($type == 'tasks') {
            $data = getTaskHours($_SESSION['id'], $project_id);
            $dataObject = json_decode($data);
            $dataArray = (array) $dataObject->data; // Cast to array if you need associative array access

        }

    }


} else {
    die('{"success": "false","message": "Project id or type not provided"}');

}



// instantiate and use the dompdf class
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->setDefaultFont('Courier');
//$options->set('isRemoteEnabled', true);
//$options->set('chroot', '/srv/http/');

$dompdf->setOptions($options);

$options->set('chroot', './');

//echo '<pre>' . print_r($dompdf->getOptions()->getChroot(), true) . '</pre>';
//die();


// '<h1>hello world</h1><p style="color:red">This is a test</p><img src="a.jpg">'




$table = "
<table>";

foreach ($dataArray as $key => $value) {

    $table .= "
    <tr>
        <td> $key : </td>
        <td> $value </td>
    </tr>";
}
;



$table .= "</table>";

//echo $table;


$tpl = file_get_contents(API_DIR . 'tpl/pdf.test.template.html');



$tpl = str_replace('{list}', $table, $tpl);

// '<pre>' . print_r($dompdf->getOptions()->getChroot(), true) . '</pre>'
$tpl = str_replace('{title}', 'Statistics', $tpl);
//echo $tpl;

$dompdf->loadHtml($tpl);

//$dompdf->loadHtmlFile('pdf.test.template.html');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();




$dompdf->stream("Statistics.pdf", array("Attachment" => false));  // todo


