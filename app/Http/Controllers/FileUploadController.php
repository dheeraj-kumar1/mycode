<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Uploadcsv;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FileUploadController extends Controller
{

  public function index()
  {
    // echo 'hii';
    $groups = Group::all();
    return view('upload-view.index', compact('groups'));
  }

  public function store(Request $request)
  {

    $Filedata = array();

    if ($request->has('submit')) {


      if ($request->submit != null) {

        // return view('upload-view.index');
        // Session::flash('message','Please Choose a file.');

        $file = $request->file('file');

        // File Details 
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        //adding timestamp with filename
        $time = date("d-m-Y") . "-" . time();
        $filename = $time . "-" . $filename;
        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {

          // Check file size
          if ($fileSize <= $maxFileSize) {

            // File upload location
            $location = 'uploads';
            // dd($file->move($location,$filename));die;
            // Upload file
            $file->move($location, $filename);

            // Import CSV to Database
            $filepath = public_path($location . "/" . $filename);

            // Reading file
            $file = fopen($filepath, "r");

            $importData_arr = array();
            $i = 0;

            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
              $num = count($filedata);
              if ($i == 0) {
                for ($v = 0; $v < $num; $v++) {
                  $RowData_arr[$i][] = $filedata[$v];
                }
              }
              // Skip first row (Remove below comment if you want to skip the first row)
              //  if($i == 0){
              //     $i++;
              //     continue; 
              //  }
              for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
              }
              $i++;
            }
            fclose($file);
            // print_r($importData_arr);exit;
            $Filedata['csv_data'] = $importData_arr;
            $Filedata['row_name'] = $RowData_arr;
            // return $importData_arr;
            // Insert to MySQL database

            // foreach($importData_arr as $importData){

            //   $insertData = array(
            //      "name"=>$importData[1],
            //      "email"=>$importData[2]);
            $insertData['filedata'] = json_encode($importData_arr);
            $insertData['csv_filename'] = $filename;

            $id =  Uploadcsv::insertData($insertData);
            // // print_r($insertData);die;
            // $insertData->save();
            // $id = $insertData->id();
            $Filedata['inserted_id'] = $id;
            $Filedata['group_id'] = $request->group_id;
            // }


            // Session::flash('message','Import Successful.');
          } else {
            Session::flash('message', 'File too large. File must be less than 2MB.');
          }
        } else {
          Session::flash('message', 'Invalid File Extension.');
        }
      }
      $Filedata['main_rows'] = [
        'full_name' => 'Full Name',
        'company_name' => 'Company Name',
        'title' => 'Title',
        'first_name' => 'First Name',
        'surname' => 'Surname',
        'friendly_name' => 'Friendly Name',
        'email' => 'Email',
        'mobile_phone' => 'Mobile Phone',
        'home_phone' => 'Home Phone',
        'work_phone' => 'Work Phone',
        'fax' => 'Fax',
        'notes' => 'Notes',
        'address_line1' => 'Address Line 1',
        'address_line2' => 'Address Line 2',
        'town' => 'Town/City',
        'county' => 'County',
        'postcode' => 'Postcode',
        'country' => 'Country',
        'date_registered' => 'Date Registered',
        'registration_complete' => 'Registration Complete',
        'reg_website' => 'Registered via Website?',
        'branches' => 'Branches',
        'source' => 'Source',
        'grouping' => 'Grouping',
        'property_email' => 'Property Details via Email',
        'property_sms' => 'Property Details via SMS',
        'other_marketing' => 'Other Marketing via Email',
        'consent_updated' => 'Consent Last Updated',
        'consent_link' => 'Manage Consent Link',
        'delete_before' => 'Do not Delete Before',
        'finance_status' => 'Finance Status',
        'finance_status_notes' => 'Finance Status Notes',
        'chain_status' => 'Chain Status',
        'chain_status_notes' => 'Chain Status Notes'
      ];
    }


    // Redirect to index
    return view('upload-view.index', compact('Filedata'));
    // return view('upload-view.index');
    // return redirect()->action('FileUploadController@index');
  }
  public function update(Request $request, $id)
  {

    $csv = Uploadcsv::find($id);
    dd($request);
    exit;
    // if ($request->submit != null ){

    // }
    return view('upload-view.index');
  }

  public function contactSave(Request $request)
  {
    $csv = DB::table('temp_csv_data')->find($request->csv_id);
    $data = json_decode($csv->filedata);
    foreach ($data as $key => $value) {
      if ($key != 0) {
        foreach ($request->fields as $index => $field) {
          $client[$field] = $value[$index];
          $client['group_id'] = $request->group_id;
        }
        $countClient[$key] = Client::create($client);
      }else{
          if(count($value) != count($request->fields)){
            return back()->with('fail', 'Please Select all dropdown');
          }
      }
    }
    if ((count($countClient)+1) == count($data)) {
      return back()->with('sucess', 'Sucessfully saved!!');
    }else{
      return back()->with('fail', 'Something went wrong');
    }
  }
}
