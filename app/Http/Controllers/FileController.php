<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyEvent;
include_once "../vendor/easyise/eisexlsx/eiseXLSX.php";
use eiseXLSX;

class FileController extends Controller
{
  public function uploadEventByCsv(){
    $csv_directory = "upload";
    if(!file_exists($csv_directory)){
        mkdir($csv_directory, 0777, true);
    }
    if(!is_writable($csv_directory)){
        chmod($csv_directory, 0777);
    }

    $preview = $config = $errors = [];
    $input = 'input-csv-file'; // the input name for the fileinput plugin
    if (empty($_FILES[$input])) {
        return [];
    }
    $path = $csv_directory.'/'; // your upload path
    $tmpFilePath = $_FILES[$input]['tmp_name']; // the temp file path
    $fileName = $_FILES[$input]['name']; // the file name
    setlocale(LC_ALL,'en_US.UTF-8');
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $fileName = uniqid(rand(), true).".".$ext;
    $fileSize = $_FILES[$input]['size']; // the file size
    $arrCsvData = [];
    
    //Make sure we have a file path
    if ($tmpFilePath != ""){
        //Setup our new file path
        $newFilePath = $path . $fileName;
        $newFileUrl = config('app.url') . "/" . $newFilePath;
        
        //Upload the file into the new path
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
            $fileId = $fileName; // some unique key to identify the file
            $preview[] = $newFileUrl;
            $config[] = [
                'key' => $fileId,
                'caption' => $fileName,
                'size' => $fileSize,
                'downloadUrl' => $newFileUrl, // the url to download the file
                'url' => url('edit/deletecsv'), // server api to delete the file based on key
            ];

            if($ext == 'csv'){ // parsing csv files
                $content = file_get_contents($newFilePath);
                if (!mb_check_encoding($content, "UTF-8")) {
                    if(mb_detect_encoding($content) == ""){
                        $content = mb_convert_encoding($content, "UTF-8",
                        "Shift-JIS, EUC-JP, JIS, SJIS, JIS-ms, eucJP-win, SJIS-win, ISO-2022-JP");
                     }else{
                        $content = mb_convert_encoding($content, "UTF-8");
                    }
                }
                $arrCsvData = array_map('str_getcsv', explode("\n", $content));
            }else if($ext == 'xlsx'){ // parsing xlsx file
                try {
                    $xlsx = new eiseXLSX($newFilePath);
                    $row_no = 1;
                    while(!empty($xlsx->data("A".$row_no))){
                        $rowExcelData = [];
                        $rowExcelData[] = $xlsx->data("A".$row_no); // 災害名
                        $rowExcelData[] = $xlsx->data("B".$row_no); // タイトル
                        $rowExcelData[] = $xlsx->data("C".$row_no); // 内容
                        $rowExcelData[] = $xlsx->data("D".$row_no); //日付
                        $rowExcelData[] = $xlsx->data("E".$row_no); //画像
                        $arrCsvData[] = $rowExcelData;
                        $row_no ++;
                    }        
            
                } catch(eiseXLSX_Exception $e) {
                    die($e->getMessage());
                }
            
            }
			
        } else {
            $errors[] = $fileName;
        }
    } else {
        $errors[] = $fileName;
    }

    $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true, 'arrCsvData' => $arrCsvData];
    if (!empty($errors)) {
        $img = count($errors) === 1 ? 'file "' . $error[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
        $out['error'] = 'アップロードできませんでした。' . $img . '. 後でもう一度やり直してください。';
    }

    // header('Content-Type: application/json');
    echo json_encode($out); 
    exit;
  }

  public function deleteEventCsv(){
    if(isset($_REQUEST["file"])){
        $file_name = $_REQUEST["file"];
        $csv_directory = "upload";
        $delete_file_path = $csv_directory.'/'.$file_name;
        if(is_file($delete_file_path))
            unlink($delete_file_path);
    }
    echo(json_encode($_REQUEST));
  }

  public function uploadEventUrlByCsv(){
    $csv_directory = "upload";
    if(!file_exists($csv_directory)){
        mkdir($csv_directory, 0777, true);
    }
    if(!is_writable($csv_directory)){
        chmod($csv_directory, 0777);
    }

    $preview = $config = $errors = [];
    $input = 'input-csv-file'; // the input name for the fileinput plugin
    if (empty($_FILES[$input])) {
        return [];
    }
    $path = $csv_directory.'/'; // your upload path
    $tmpFilePath = $_FILES[$input]['tmp_name']; // the temp file path
    $fileName = $_FILES[$input]['name']; // the file name
    setlocale(LC_ALL,'en_US.UTF-8');
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $fileName = uniqid(rand(), true).".".$ext;
    $fileSize = $_FILES[$input]['size']; // the file size
    $arrCsvData = [];
    
    //Make sure we have a file path
    if ($tmpFilePath != ""){
        //Setup our new file path
        $newFilePath = $path . $fileName;
        $newFileUrl = config('app.url') . "/" . $newFilePath;
        
        //Upload the file into the new path
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
            $fileId = $fileName; // some unique key to identify the file
            $preview[] = $newFileUrl;
            $config[] = [
                'key' => $fileId,
                'caption' => $fileName,
                'size' => $fileSize,
                'downloadUrl' => $newFileUrl, // the url to download the file
                'url' => url('urledit/deletecsv'), // server api to delete the file based on key
            ];

            if($ext == 'csv'){ // parsing csv files
                $content = file_get_contents($newFilePath);
                if (!mb_check_encoding($content, "UTF-8")) {
                    if(mb_detect_encoding($content) == ""){
                        $content = mb_convert_encoding($content, "UTF-8",
                        "Shift-JIS, EUC-JP, JIS, SJIS, JIS-ms, eucJP-win, SJIS-win, ISO-2022-JP");
                     }else{
                        $content = mb_convert_encoding($content, "UTF-8");
                    }
                }
                $arrCsvData = array_map('str_getcsv', explode("\n", $content));
            }else if($ext == 'xlsx'){ // parsing xlsx file
                try {
                    $xlsx = new eiseXLSX($newFilePath);
                    $row_no = 1;
                    while(!empty($xlsx->data("A".$row_no))){
                        $rowExcelData = [];
                        $rowExcelData[] = $xlsx->data("A".$row_no); // 日付
                        $rowExcelData[] = $xlsx->data("B".$row_no); // 種類
                        $rowExcelData[] = $xlsx->data("C".$row_no); // 災害名
                        $rowExcelData[] = $xlsx->data("D".$row_no); // Url
                        $rowExcelData[] = $xlsx->data("E".$row_no); // タイトル
                        $rowExcelData[] = $xlsx->data("F".$row_no); // 画像
                        $arrCsvData[] = $rowExcelData;
                        $row_no ++;
                    }        
            
                } catch(eiseXLSX_Exception $e) {
                    die($e->getMessage());
                }
            
            }
			
        } else {
            $errors[] = $fileName;
        }
    } else {
        $errors[] = $fileName;
    }

    $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true, 'arrCsvData' => $arrCsvData];
    if (!empty($errors)) {
        $img = count($errors) === 1 ? 'file "' . $error[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
        $out['error'] = 'アップロードできませんでした。' . $img . '. 後でもう一度やり直してください。';
    }

    // header('Content-Type: application/json');
    echo json_encode($out); 
    exit;
  }

  public function deleteEventUrlCsv(){
    if(isset($_REQUEST["file"])){
        $file_name = $_REQUEST["file"];
        $csv_directory = "upload";
        $delete_file_path = $csv_directory.'/'.$file_name;
        if(is_file($delete_file_path))
            unlink($delete_file_path);
    }
    echo(json_encode($_REQUEST));
  }

}


