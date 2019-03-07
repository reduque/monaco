<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function saveFile($file, $path, $fileName = "", $extension="")
    {
        if ($file) {
            $foto = json_decode($file);
            if(is_object($foto)){
                if($extension=="") list(,$extension) = explode('/', $foto->output->type);
                $picture = $foto->output->image;
            }else{
                if($extension==""){
                    list($extension,) = explode(';', $file);
                    list(,$extension) = explode('/', $extension);
                }

                $picture = $file;
            }

            $fileName= $fileName . "." . $extension;
            $filepath = $path . $fileName;

            $Base64Img=$picture;
            list(, $Base64Img) = explode(';', $Base64Img);
            list(, $Base64Img) = explode(',', $Base64Img);
            $image = base64_decode($Base64Img);
            $filepath = 'uploads/' . $filepath;
            file_put_contents($filepath, $image);

        }
        return $fileName;
    }

    public function deleteFile($file)
    {
        try {
            unlink('uploads/' . $file);
        } catch (Exception $e) {
            \Log::info('Error creating item: ' . $e);
        }
    }

    public function createFoldes($path)
    {
        $path='uploads/' . $path;
        @mkdir ($path,0755);
        return $path;
    }

    public function getExtension($str)
    {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }

}
