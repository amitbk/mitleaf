<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateStyle extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'template_id', 'style_id',
    ];
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
