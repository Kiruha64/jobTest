<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
/**
 *
 */
class FileSaverService
{
    /**
     * @param AuthManager $authManager
     */
    private function _makeDirectory()
    {
        $dir = 'uploads';
        $year = date('Y');
        $month = date('m');
        $day = date("d");

        if(!file_exists($dir)){
            mkdir($dir);
        }
        if(!file_exists($dir.'/'.$year)){
            mkdir($dir.'/'.$year);
        }
        if(!file_exists($dir.'/'.$year.'/'.$month)){
            mkdir($dir.'/'.$year.'/'.$month);
        }
        if(!file_exists($dir.'/'.$year.'/'.$month.'/'.$day)){
            mkdir($dir.'/'.$year.'/'.$month.'/'.$day);
        }
        return $this;
    }


    private function getExtension($image)
    {
        $ext = $image->extension();
        return $ext;
    }
    private function _makeFileName(){
        $this->image_name = Str::random(12).'-'.time().'.'.$this->getExtension($this->image);
        return $this;
    }
    public function save($image)
    {

        $this->_setImage($image)
            ->_makeFileName()
            ->_makeDirectory()
            ->_moveFile();

        $photo = new Photo();
        $photo->path = getenv('APP_URL').'/'.$this->path;
        ImageOptimizer::optimize($this->path);
        $photo->save();
        return $photo->id;
    }
    private function _setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    private function _moveFile()
    {
        $dir = 'uploads';
        $year = date('Y');
        $month = date('m');
        $day = date("d");
        $this->path = $dir.'/'.$year.'/'.$month.'/'.$day.'/'.$this->image_name;
        $this->image->move(public_path($dir.'/'.$year.'/'.$month.'/'.$day), $this->image_name);
        return $this;
    }

    public function livewireSave($image)
    {
        $dir = 'uploads';
        $photo = new Photo();
        $photo->path = $dir.'/'.$image;
        ImageOptimizer::optimize($photo->path);
        $photo->save();
        return $photo->id;
    }
}
