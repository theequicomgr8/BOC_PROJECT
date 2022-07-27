<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use PDF;
use DB;

class AgreementController extends Controller
{
    public function fileUpload()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        //print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
            //dd($current_url);
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        
        return view('admin.pages.file-upload',$dbresponse);
    }
    public function agreement_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);

        if($file_upload){
        $user_id = Session::get('UserID');   
        $table = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    public function agreement_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        //dd($user_id);
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
        return response()->download($filebase_url);
    }

    ///print renewal agreement code 
    public function renewalAgreement()
    {
        $np_code = Session::get('UserName');        
        // $np_code = 100012;        
        $table = '[BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [NP Code] = '" . $np_code ."' ");
        
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        // print_r($dbresponse);die;
        return view('admin.pages.print.renewal-agreement-from',$dbresponse);
    }
    public function renewalAgreementUpload(Request $request)
    {
        // $np_code = Session::get('UserName'); 
        // print_r($np_code);die;
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);

        if($file_upload){
        $np_code = Session::get('UserName');   
          
        $table = '[BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [NP Code] = '" . $np_code . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    public function renewalAgreementDownload()
    {
        $np_code = Session::get('UserName');        
        $table = '[BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [NP Code] = '" . $np_code ."' ");
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
        return response()->download($filebase_url);
    }

    /* ----------------- Internet Website Upload and download image --------------------*/

    public function intWebfileUpload()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        //print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
            //dd($current_url);
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        
        return view('admin.pages.agreement.intWeb-file-upload',$dbresponse);
    }
    public function intWeb_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        // $path = 'E:\Published_APP\BOC\BOC_FTP/'; 
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "E:\Published_APP\BOC\BOC_FTP/" . $fileName);

        if($file_upload){
        $user_id = Session::get('UserID');   
        $table = '[BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    public function intWeb_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        //dd($user_id);
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
        return response()->download($filebase_url);
    }


    //for soleright start
    public function solerightUpload($id)
    {
      $user_id = Session::get('UserID');        
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [OD Category]='0' And [OD Media ID]='".$id."' ");
        
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";  
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        
        return view('admin.pages.agreement.soleright-fileupload',$dbresponse);
    }

    //sole right pdf upload function sk 
    public function soleright_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        // $path = 'C:\xampp\htdocs\BOC8_FEB\public/'; 

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
        
        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');   
        $od_media_id=$request->od_media_id;
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' And [OD Category]='0' And [OD Media ID]='".$od_media_id."' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }
    //by sk
    public function soleright_download_file()
    {
        
        $user_id = Session::get('UserID');  
        $odMediaID = Session::get('od_media_id');        
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [OD Category]='0' AND [OD Media ID]='".$odMediaID."' ");
        
        $fileName = @$response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
      return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\BOC8_FEB\public/'.$fileName);
    }
    

    //for soleright renewal sk
    public function solerenewalAgreement()
    {
        $user_id = Session::get('UserName');        
        // $np_code = 100012;        
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10")) 
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        return view('admin.pages.agreement.soleright-renewal-fileupload',$dbresponse);
    }







    //soleright renewal file upload
    public function solerenewalAgreementupload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        // $path = 'C:\xampp\htdocs\personal\public/'; 

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
        
        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');   
            
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }   
    }



    // renewal file download
    public function soleright_renewal_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
      return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\personal\public/'.$fileName);
    }






    //private  start
    public function privateUpload()
    {
      $user_id = Session::get('UserID');        
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [OD Category]='1' ");
        
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";  
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        
        return view('admin.pages.agreement.private-fileupload',$dbresponse);
    }

    //private file upload
    public function private_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        // $path = 'C:\xampp\htdocs\personal\public/'; 

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
        
        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');   
          
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' And [OD Category]='1' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    public function private_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [OD Category]='0' ");
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
      return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\BOC_LATEST\public/'.$fileName);
    }



    //private renewal start
    public function privaterenewalAgreement()
    {
        $user_id = Session::get('UserName');        
        // $np_code = 100012;        
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        return view('admin.pages.agreement.private-renewal-fileupload',$dbresponse);
    }  

    //private renewal file upload
    public function privaterenewalAgreementupload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        // $path = 'C:\xampp\htdocs\personal\public/'; 

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
        
        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');   
          
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }   
    }

    //private renewal file download
    public function private_renewal_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
      return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\personal\public/'.$fileName);
    }






    //personal start
    public function personalUpload()
    {
      $user_id = Session::get('UserID');        
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [OD Category]='0' ");
        
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";  
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        
        return view('admin.pages.agreement.personal-fileupload',$dbresponse);
    } 

    //personal file upload
    public function personal_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        // $path = 'C:\xampp\htdocs\personal\public/'; 

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
        
        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');   
          
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' And [OD Category]='0' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    //personal file download
    public function personal_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [OD Category]='0' ");
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
      return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\BOC_LATEST\public/'.$fileName);
    }



    //personal renewal
    public function personalrenewalAgreement()
    {
        $user_id = Session::get('UserName');        
        // $np_code = 100012;        
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        return view('admin.pages.agreement.personal-renewal-fileupload',$dbresponse);
    }

    //personal renewal file upload
    public function personalrenewalAgreementupload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        // $path = 'C:\xampp\htdocs\personal\public/'; 

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
        
        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');   
          
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }   
    }

    //personal renewal file download
    public function personal_renewal_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
      return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\personal\public/'.$fileName);
    }

    //Digital Cinema
     public function digitalcinemaUpload()
    {
      $user_id = Session::get('UserID');        
        $table = '[BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [Empanelment Category]='7' ");
        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = 'G:\Published_APP\BOC\BOC_FTP/'.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();   
        }
        

        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";  
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
            
              }   
        }
        
        return view('admin.pages.agreement.digital-media-file-upload',$dbresponse);
    } 

//Digital Agreement file upload
    public function digital_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);  
        $fileName = time().'.'.$request->file->extension();
        
        $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
        // $path = 'C:\xampp\htdocs\personal\public/'; 

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
        
        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');   
          
        $table = '[BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set  [Agr File Name] = '" . $fileName . "',[Agr File Path] ='".$path."' where [User ID] = '" . $user_id . "' And [OD Category]='7' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');  
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }
        //personal file download
    public function Digital_download_file()
    {
        $user_id = Session::get('UserID');        
        $table = '[BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response =DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [Empanelment Category]='7' ");
        
        $fileName = $response[0]->{'Agreement File Name'};
        $file_path = 'G:\Published_APP\BOC\BOC_FTP/'.$fileName;
        $current_url = url()->current();

      if(strpos($current_url,"192.168.10"))
      {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
      }
      else
      {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
    
      }
      return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\BOC_LATEST\public/'.$fileName);
    }

        /* AV Producer File download */
     public function avProducerfileUpload()
     {
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
            //dd($current_url);
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();
        }


        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;

              }
        }

        return view('admin.pages.AvTvAgreement.av-producer-fileupload',$dbresponse);
    }
    public function avProducer_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);
        $fileName = time().'.'.$request->file->extension();
        // $path = 'E:\Published_APP\BOC\BOC_FTP/';
        $path = 'G:\Published_APP\BOC\BOC_FTP/';
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        if($file_upload){
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    public function avProducer_download_file()
    {
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        //dd($user_id);
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();
        if(strpos($current_url,"192.168.10"))
        {
            $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
        }
        else
        {
            $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
        }
        return response()->download($filebase_url);
    }

     /* Community Radio Station File download */
     public function commuRadiofileUpload()
     {
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - Community Radio$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
            //dd($current_url);
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();
        }


        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
              {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
              }
              else
              {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;

              }
        }

        return view('admin.pages.AvTvAgreement.commu-radio-fileupload',$dbresponse);
    }
    public function commuRadio_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);
        $fileName = time().'.'.$request->file->extension();
        // $path = 'E:\Published_APP\BOC\BOC_FTP/';
        $path = 'G:\Published_APP\BOC\BOC_FTP/';
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        if($file_upload){
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - Community Radio$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    public function commuRadio_download_file()
    {
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - Community Radio$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");
        //dd($user_id);
        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();
        if(strpos($current_url,"192.168.10"))
        {
            $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
        }
        else
        {
            $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
        }
        return response()->download($filebase_url);
    }

        //AVTV Upload agreement
        public function avtvUpload()
        {
          $user_id = Session::get('UserID');
            $table = '[BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2]';
            $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");

            // print_r($response);die;
            if(count($response) > 0)
            {
                $fileName = $response[0]->{'Agr File Name'};
                $file_path = $response[0]->{'Agr File Path'}.$fileName;
                $current_url = url()->current();
            }
            else
            {
                $fileName = "";
                $file_path = "";
                $current_url = url()->current();
            }


            if($fileName == "")
            {
                $dbresponse['filebase_url'] = "";
            }
            else
            {
                if(strpos($current_url,"192.168.10"))
                  {
                    $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
                  }
                  else
                  {
                    $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;

                  }
            }

            return view('admin.pages.AvTvAgreement.avtv-upload',$dbresponse);
        }

        //personal file upload
        public function avtv_file_upload(Request $request)
        {
            $request->validate([
                'file' => 'required|mimes:pdf',
            ]);
            $fileName = time().'.'.$request->file->extension();

            $path = 'G:\Published_APP\BOC\BOC_FTP/';
            // $path = 'C:\xampp\htdocs\personal\public/';

            // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
            $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);

            // dd($file_upload);
            if($file_upload){
            $user_id = Session::get('UserID');
            $table = '[BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2]';
            $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
            if($sql){
                return back()->with('success','You have successfully upload file!');
            }else{
                return back()->with('failed','Some error occured!');
            }
            }else{
                return back()->with('failed','File not uploaded!');
            }
        }

        //personal file download
        public function avtv_download_file()
        {
            $user_id = Session::get('UserID');
            $table = '[BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2]';
            $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");

            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();

          if(strpos($current_url,"192.168.10"))
          {
            $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
          }
          else
          {
            $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;

          }
          return response()->download($filebase_url);
            // return response()->download('C:\xampp\htdocs\BOC_LATEST\public/'.$fileName);
        }

    //AVTV Upload agreement
    public function FMUpload()
    {
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");

        // print_r($response);die;
        if(count($response) > 0)
        {
            $fileName = $response[0]->{'Agr File Name'};
            $file_path = $response[0]->{'Agr File Path'}.$fileName;
            $current_url = url()->current();
        }
        else
        {
            $fileName = "";
            $file_path = "";
            $current_url = url()->current();
        }


        if($fileName == "")
        {
            $dbresponse['filebase_url'] = "";
        }
        else
        {
            if(strpos($current_url,"192.168.10"))
                {
                $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
                }
                else
                {
                $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;

                }
        }

        return view('admin.pages.AvTvAgreement.pvt-fm-upload',$dbresponse);
    }

    //personal file upload
    public function FM_file_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);
        $fileName = time().'.'.$request->file->extension();

        $path = 'G:\Published_APP\BOC\BOC_FTP/';
        // $path = 'C:\xampp\htdocs\personal\public/';

        // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
        $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);

        // dd($file_upload);
        if($file_upload){
        $user_id = Session::get('UserID');

        $table = '[BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "', [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' ");
        if($sql){
            return back()->with('success','You have successfully upload file!');
        }else{
            return back()->with('failed','Some error occured!');
        }
        }else{
            return back()->with('failed','File not uploaded!');
        }
    }

    //personal file download
    public function FM_download_file()
    {
        $user_id = Session::get('UserID');
        $table = '[BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2]';
        $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' ");

        $fileName = $response[0]->{'Agr File Name'};
        $file_path = $response[0]->{'Agr File Path'}.$fileName;
        $current_url = url()->current();

        if(strpos($current_url,"192.168.10"))
        {
        $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
        }
        else
        {
        $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
        }
        return response()->download($filebase_url);
        // return response()->download('C:\xampp\htdocs\BOC_LATEST\public/'.$fileName);
    }

    public function bulkUpload()
       {
         $user_id = Session::get('UserID');        
           $table = '[BOC$Vend Emp Bulk SMS$3f88596c-e20d-438c-a694-309eb14559b2]';
           $response = DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [Empanelment Category]='7' ");
           // print_r($response);die;
           if(count($response) > 0)
           {
               $fileName = $response[0]->{'Agr File Name'};
               $file_path = 'G:\Published_APP\BOC\BOC_FTP/'.$fileName;
               $current_url = url()->current();
           }
           else
           {
               $fileName = "";
               $file_path = "";
               $current_url = url()->current();   
           }
           
   
           if($fileName == "")
           {
               $dbresponse['filebase_url'] = "";  
           }
           else
           {
               if(strpos($current_url,"192.168.10"))
                 {
                   $dbresponse['filebase_url'] = "http://192.168.10.60/BOC_FTP/".$fileName;
                 }
                 else
                 {
                   $dbresponse['filebase_url'] = "http://104.211.206.19/BOC_FTP/".$fileName;
               
                 }   
           }
           
           return view('admin.pages.agreement.bulk-sms-file-upload',$dbresponse);
       } 
   
   //Digital Agreement file upload
     public function bulksms_file_upload(Request $request)
       {
           $request->validate([
               'file' => 'required|mimes:pdf',
           ]);  
           $fileName = time().'.'.$request->file->extension();
           
           $path = 'G:\Published_APP\BOC\BOC_FTP/'; 
           // $path = 'C:\xampp\htdocs\personal\public/'; 
   
           // $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  "G:\Published_APP\BOC\BOC_FTP/" . $fileName);
           $file_upload = move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $fileName);
           
           // dd($file_upload);
           if($file_upload){
           $user_id = Session::get('UserID');   
             
           $table = '[BOC$Vend Emp Bulk SMS$3f88596c-e20d-438c-a694-309eb14559b2]';
           $sql =  DB::update("update $table set [Agr File Path] = '" . $path . "',  [Agr File Name] = '" . $fileName . "' where [User ID] = '" . $user_id . "' And [OD Category]='7' ");
           if($sql){
               return back()->with('success','You have successfully upload file!');
           }else{
               return back()->with('failed','Some error occured!');  
           }
           }else{
               return back()->with('failed','File not uploaded!');
           }
       }
           //personal file download
       public function bulk_download_file()
       {
           $user_id = Session::get('UserID');        
           $table = '[BOC$Vend Emp Bulk SMS$3f88596c-e20d-438c-a694-309eb14559b2]';
           $response =DB::select("select [Agr File Path],[Agr File Name] from $table where [User ID] = '" . $user_id ."' And [Empanelment Category]='7' ");
           
           $fileName = $response[0]->{'Agr File Name'};
           $file_path = 'G:\Published_APP\BOC\BOC_FTP/'.$fileName;
           $current_url = url()->current();
   
         if(strpos($current_url,"192.168.10"))
         {
           $filebase_url = "http://192.168.10.60/BOC_FTP/".$fileName;
         }
         else
         {
           $filebase_url = "http://104.211.206.19/BOC_FTP/".$fileName;
       
         }
         return response()->download($filebase_url);
           // return response()->download('C:\xampp\htdocs\BOC_LATEST\public/'.$fileName);
       }
    
}