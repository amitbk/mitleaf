<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateStyle extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'template_id', 'style_id', 'ratio', 'x_axis', 'y_axis', 'data'
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
