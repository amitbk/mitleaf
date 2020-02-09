<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateStyle extends Model
{
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
