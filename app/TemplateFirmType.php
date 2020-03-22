<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateFirmType extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'template_id', 'firm_type_id'
    ];
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
