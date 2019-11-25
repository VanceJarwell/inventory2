<?php

namespace App\Http\Controllers;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function word(){
    	//import to the library
    	$templateProcessor = new TemplateProcessor('./templates/Certificate of Recognition.docx');
    	//get the template
    	//change the values
    	$templateProcessor->setValue('first_name', 'John');
    	$templateProcessor->setValue('last_name', 'Tam');
    	//save the file
    	$templateProcessor->saveAs('juan Tam certificate.docx');
    	return response()->download('juan Tam certificate.docx');

    }
    public function excel(){
    	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/form138.xlsx');

		$worksheet = $spreadsheet->getActiveSheet();

		$worksheet->getCell('A7')->setValue('Name: John');
		$worksheet->getCell('A8')->setValue('11-B');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
		$writer->save('form138.xls');
		return response()->download('form138.xls');
    }
}
