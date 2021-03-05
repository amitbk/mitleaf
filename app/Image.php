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
        $old_image = Image::find($old_image_id);
        if($old_image)
          $old_image->delete();

        return true;
    }

    /**
     * Delete image file and database entry
     *
     * @return Boolean
     */
    public function delete()
    {
        // delete file first
        if(file_exists($this->url))
            unlink($this->url);
        return parent::delete();
    }

    public function createAndSaveLogo($firm)
    {
      $image = static::generateTextLogo($firm->name);
      // $image->save("images/assets/");
      $public = public_path('/');
      $path = "images/assets/".$firm->id;
      if(!is_dir($public.$path))
          mkdir($public.$path, 0755, true);
      $fullpath= $path."/".Auth::id()."_".uniqid().".jpg";
      $image->save($public.$fullpath);
      $this->url = $fullpath;
      return $this->url;
    }
    public static function generateTextLogo($text = "FLYMIT")
    {
      header('Content-type: text/plain; charset=utf-8');
      $width       = 300;
      $height      = 100;
      $center_x    = $width / 2;
      $center_y    = $height / 2;
      $max_len     = 36;
      $font_size   = 30;
      $font_height = 20;

      // $text = "FLYMIT Infotech /Sangamner";
      $lines = explode("/", wordwrap($text, $max_len));
      $y     = $center_y - ((count($lines) - 1) * $font_height);
      $img   = \Image::canvas($width, $height, '#fff');

      foreach ($lines as $line)
      {
          $img->text(trim($line), $center_x, $y, function($font) use ($font_size){
              $font->file(public_path('fonts/poppins.ttf'));
              $font->size($font_size);
              $font->color('#000');
              $font->align('center');
              $font->valign('center');
          });

          $y += $font_height * 2;
      }

      return $img;
    }
}
