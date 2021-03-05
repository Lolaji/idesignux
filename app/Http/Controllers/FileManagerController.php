<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManagerController extends Controller
{
    public function delsert (Request $request)
    {
        $response = ['success'=>false, 'message'=> ''];
        $path = $request->post('path');

        if ($request->post('flag') == 'create') {
            if (Storage::makeDirectory("public/$path")) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        } else if ($request->post('flag') == 'delete') {
            if (Storage::deleteDirectory("public/$path")) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        }
        return $response;
    }
    public function upload (Request $request) 
    {
        $file = $request->file('file');
        
        $dir = $this->__setFolder($request->post('foldername'));

        $filename = $file->getClientOriginalName();
        
        // $innerFolder = Str::plural(explode('/', $file->getMimeType())[0]);
        // $addedPath = $dir.'/'.$innerFolder;

        $path = $file->storeAs($dir, $filename);
    
        $response['filename'] = str_replace("$dir/", '', $path);

        return $response;
    }

    public function fetch(Request $request)
    {
        $fullpath = "public";

        if ($request->get('path')) {
            $fullpath .= $request->get('path');
        }

        $directories = Storage::directories($fullpath);
        $files = Storage::files($fullpath);
        return [
            'directories' => $directories,
            'files' => $files,
            'path' => $fullpath
        ];
    }

    private function __setFolder ($folder=null)
    {
        $dir = 'public';

        if (!is_null($folder)) {
            if (strpos($folder, ',') !== false) {
                $folder = str_replace(',', '/', $folder);
                $dir = "public/$folder";
            } else {
                $dir = "public/$folder";
            }
        }

        return $dir;
    }
}
