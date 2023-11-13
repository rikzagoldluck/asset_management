<?php

namespace App\Controllers;

use BaconQrCode\Common\ErrorCorrectionLevel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeNone;
use Endroid\QrCode\Writer\PngWriter;
use FPDF;
use PhpOffice\PhpSpreadsheet\IOFactory;
use TCPDF;

class QrCodeController extends BaseController
{
    public function generatePdf()
    {
        // Load Excel file
        $spreadsheet = IOFactory::load('C:\xampp\htdocs\asset_management\core\app\Controllers\barcode.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        // Create a PDF document
        $pdf = new FPDF('L', 'cm');

        // Iterate through each row in the Excel file
        $pdf->AddPage();

        foreach ($worksheet->getRowIterator() as $key => $row) {
            echo 'tesst<br>';
            $cellIterator = $row->getCellIterator();

            // Assuming the first column contains the data for QR code
            $data = $cellIterator->current()->getValue();


            // Add a new page to the PDF

            // Position the QR code on the PDF
            $x = 0; // Set the X-coordinate
            $y = 0; // Set the Y-coordinate
            $this->qrcode($data);
            $pdf->Image(__DIR__ . '/qrcode.png', $x, $y, 2.6, 2.6);
        }

        // Output the PDF
        if ($pdf->Output(__DIR__ . '/output.pdf', 'F')) {
            echo 'ok';
        } else {
            echo 'err';
        }
    }

    public function qrcode($data)
    {
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setSize(300)
            ->setMargin(10)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        // $logo = Logo::create(__DIR__ . '/assets/symfony.png')
        //     ->setResizeToWidth(50)
        //     ->setPunchoutBackground(true);

        // Create generic label
        $label = Label::create($data)
            ->setTextColor(new Color(0, 0, 0));

        $result = $writer->write($qrCode, null, $label);
        $result->saveToFile(__DIR__ . '/qrcode.png');
        // return $result->getString();
    }

    public function barcode()
    {

        // create new PDF document
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);


        // set header and footer fonts
        // $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(10, 0, 10);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // set auto page breaks
        // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $preferences = array(
            'HideToolbar' => true,
            'HideMenubar' => true,
            'HideWindowUI' => true,
            'FitWindow' => true,
            'CenterWindow' => true,
            'DisplayDocTitle' => true,
            'NonFullScreenPageMode' => 'UseNone', // UseNone, UseOutlines, UseThumbs, UseOC
            'ViewArea' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'ViewClip' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'PrintArea' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'PrintClip' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'PrintScaling' => 'AppDefault', // None, AppDefault
            'Duplex' => 'DuplexFlipLongEdge', // Simplex, DuplexFlipShortEdge, DuplexFlipLongEdge
            'PickTrayByPDFSize' => true,
            'PrintPageRange' => array(1, 1, 2, 3),
            'NumCopies' => 2
        );

        // Check the example n. 60 for advanced page settings

        // set pdf viewer preferences
        $pdf->setViewerPreferences($preferences);
        // ---------------------------------------------------------

        // set a barcode on the page footer
        // $pdf->setBarcode(date('Y-m-d H:i:s'));

        // set font
        $pdf->SetFont('helvetica', '', 11);

        // add a page
        $pdf->AddPage();
        // define barcode style
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 0
        );

        // PRINT VARIOUS 1D BARCODES


        // CODE 128 AUTO
        // $pdf->Cell(0, 0, 'CODE 128 AUTO', 0, 1);
        $pdf->write1DBarcode('KS010001', 'C128', '', '', 28, 16, 0.4, $style, 'T');
        $pdf->write1DBarcode('KS010002', 'C128', '', '', 28, 16, 0.4, $style, 'T');
        $pdf->write1DBarcode('KS010003', 'C128', '', '', 28, 16, 0.4, $style, 'T');
        $pdf->write1DBarcode('KS010004', 'C128', '', '', 28, 16, 0.4, $style, 'N');

        $pdf->write1DBarcode('KS010005', 'C128', '', '', 28, 16, 0.4, $style, 'T');
        $pdf->write1DBarcode('KS010006', 'C128', '', '', 28, 16, 0.4, $style, 'T');
        $pdf->write1DBarcode('KS010005', 'C128', '', '', 28, 16, 0.4, $style, 'T');
        $pdf->write1DBarcode('KS010006', 'C128', '', '', 28, 16, 0.4, $style, 'N');

        // $pdf->write1DBarcode('KS010001', 'C128', 40, '', 28, 16, 0.4, $style, 'T');
        // $pdf->write1DBarcode('KS010002', 'C128', 40, '', 28, 16, 0.4, $style, 'T');
        // $pdf->write1DBarcode('KS010003', 'C128', 40, '', 28, 16, 0.4, $style, 'T');
        // $pdf->write1DBarcode('KS010004', 'C128', 40, '', 28, 16, 0.4, $style, 'T');
        // $pdf->write1DBarcode('KS010005', 'C128', 40, '', 28, 16, 0.4, $style, 'T');
        // $pdf->write1DBarcode('KS010006', 'C128', 40, '', 28, 16, 0.4, $style, 'T');
        $pdf->Ln();

        // // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // // TEST BARCODE STYLE

        // // define barcode style
        // $style = array(
        //     'position' => '',
        //     'align' => '',
        //     'stretch' => true,
        //     'fitwidth' => false,
        //     'cellfitalign' => '',
        //     'border' => true,
        //     'hpadding' => 'auto',
        //     'vpadding' => 'auto',
        //     'fgcolor' => array(0, 0, 128),
        //     'bgcolor' => array(255, 255, 128),
        //     'text' => true,
        //     'label' => 'CUSTOM LABEL',
        //     'font' => 'helvetica',
        //     'fontsize' => 8,
        //     'stretchtext' => 4
        // );

        // // CODE 39 EXTENDED + CHECKSUM
        // $pdf->Cell(0, 0, 'CODE 39 EXTENDED + CHECKSUM', 0, 1);
        // $pdf->SetLineStyle(array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
        // $pdf->write1DBarcode('CODE 39 E+', 'C39E+', '', '', 120, 25, 0.4, $style, 'N');

        // // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('example_027.pdf', 'D');

        //============================================================+
        // END OF FDLE
        //============================================================+
    }
}
