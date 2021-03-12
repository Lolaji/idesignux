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
        $storage_disk = Storage::disk('s3');

        if ($request->post('flag') == 'create') {
            if ($storage_disk->makeDirectory("public/$path")) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        } else if ($request->post('flag') == 'delete') {
            if ($storage_disk->deleteDirectory("public/$path")) {
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
        // return $dir;

        $filename = $file->getClientOriginalName();
        
        // $innerFolder = Str::plural(explode('/', $file->getMimeType())[0]);
        // $addedPath = $dir.'/'.$innerFolder;

        $path = $file->storeAs($dir, $filename, 's3');

        Storage::disk('s3')->setVisibility($path, 'public');
    
        $response['filename'] = str_replace("$dir/", '', $path);

        return $response;
    }

    public function fetch(Request $request)
    {
        $fullpath = "public";
        $storage_instance = Storage::disk('s3');

        if ($request->get('path')) {
            $fullpath .= $request->get('path');
        }

        $directories = $storage_instance->directories($fullpath);
        $files = $storage_instance->files($fullpath);
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
