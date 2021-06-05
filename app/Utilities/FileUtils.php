<?php
/**
 * Created by PhpStorm.
 * User: Henrique
 * Date: 07/04/2020
 * Time: 00:31
 */

namespace App\Utilities;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileUtils
{
    const FOLDER_UPLOADS = 'uploads/images';
    const FOLDER_UPLOADS_MINI = 'uploads/mini';

    public static function saveImage( $file )
    {
        $destinationPath = public_path(self::FOLDER_UPLOADS);
        $extension = explode( '/', $file->getMimeType() )[1];
        $imageName = self::generateUniqueName($extension);

        $file->move( $destinationPath, $imageName);

        sleep(1);

        return '/' . self::FOLDER_UPLOADS . '/' . $imageName;
    }

    public static function saveImageWithMiniature( $file , $size )
    {
        $destinationPath = public_path('uploads' . DIRECTORY_SEPARATOR .'mini');
        $extension = explode( '/', $file->getMimeType() )[1];
        $imageName = self::generateUniqueName($extension);

        $resize_image = Image::make($file->getRealPath());

        $resize_image->resize($size, $size, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath . DIRECTORY_SEPARATOR . $imageName);

        $destinationPath = public_path(self::FOLDER_UPLOADS);
        $file->move( $destinationPath, $imageName);

        sleep(1);

        return ['/' . self::FOLDER_UPLOADS . '/' . $imageName, '/' . self::FOLDER_UPLOADS_MINI . '/' . $imageName];
    }

    public static function saveImageWithMaxSize( $file , $size )
    {
        $destinationPath = public_path('uploads' . DIRECTORY_SEPARATOR .'mini');
        $extension = explode( '/', $file->getMimeType() )[1];
        $imageName = self::generateUniqueName($extension);

        $resize_image = Image::make($file->getRealPath());

        $resize_image->resize($size, $size, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath . DIRECTORY_SEPARATOR . $imageName);

        Storage::delete( $file->getRealPath());

        sleep(1);

        return '/' . self::FOLDER_UPLOADS_MINI . '/' . $imageName;
    }


    public static function generateUniqueName( $extensuon )
    {
        return time() . '.' . $extensuon;
    }
}
