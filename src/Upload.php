<?php
/**
 * Created by PhpStorm.
 * User: John Doe
 * Date: 8/3/2017
 * Time: 12:27 AM
 */

namespace Helper;

use Intervention\Image;
use Illuminate\Support\Facades\Storage;


class Upload
{
    public static function image($file , $folder , $name = null , $width = 500 , $height = 500){
        $name = $name == null ? $file->hashName() : $name.'.'.$file->getClientOriginalExtension();
        $image = Image::make($file)->fit($width,$height, function ($const){
            $const->upSize();
        });

        Storage::disk('public')->put($folder.'/'.$name,$image->stream());
        return $folder.'/'.$name;
    }

    public static function file($file, $folder, $name = null, $disk = 'public'){
        $name = $name == null ? $file->hashName() : $name.'.'.$file->getClientOriginalExtension();
        Storage::disk($disk)->putFileAs($folder, $file, $name);
        return $folder.'/'.$name;
    }

}