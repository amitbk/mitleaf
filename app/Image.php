<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Image extends Model
{
    /**
     * Create image from base64 data, store at specified path and delete old image if any.
     *
     * @param  string  $data = base64 data
     * @param  string  $path = where to store?
     * @param[]  int  $old_image_id = delete old image if any.
     * @return true
     */
    public function create_from_base64($data, $path, $old_image_id=null)
    {
        // upload image
        $img = explode(',', $data);
        $ini =substr($img[0], 11);
        $type = explode(';', $ini);
        $image = str_replace(' ', '+', $img[1]);
        // $path = "images/templates/";
        $imageName = Auth::id()."_".date('yymd_his').".". $type[0];
        // return $imageName;
        if(!is_dir($path))
          mkdir($path, 0755, true);

        file_put_contents($path.$imageName, base64_decode($image));
        $this->url = $path.$imageName;
        $this->thumbnail = $path.$imageName;
        $this->free = $path.$imageName;

        $this->save();

        // old image will be deleted
        if($old_image_id)
        {
            $old_image = Image::find($old_image_id);
            if($old_image)
            {
                if(file_exists($old_image->url))
                    unlink($old_image->url);
                $old_image->delete();
            }
        }

        return true;
    }
}
