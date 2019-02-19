<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Drive;
use Illuminate\Https\Request;

class GoogleDriveController extends Controller
{
    public function __construct(Google_client $client){
        $this->middleware(function ($request, $next) use($client){
            $client->refreshToken(Auth::user()->refresh_token);
            $this->drive = new Google_Service_Drive($client);
        });
    }
    public function getFolders(){
        $this->ListFolders('root');
    }
    public function uploadFiles(Request $request){
        if($request->isMethod('GET')){
            return View('drive.upload');
        }else{
            $this->createFile($request->file('file'));
        }
    }
}
