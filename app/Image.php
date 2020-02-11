<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Image extends Model
{
    public function create_from_base64($data, $path)
    {
        // upload image
        $img = explode(',', $data);
        $ini =substr($img[0], 11);
        $type = explode(';', $ini);
        $image = str_replace(' ', '+', $img[1]);
        // $path = "images/templates/";
        $imageName = Auth::id()."_".date('yymd_his').".". $type[0];
        // return $imageName;
        file_put_contents($path.$imageName, base64_decode($image));
        $this->url = $path.$imageName;
        $this->save();
    }
}
