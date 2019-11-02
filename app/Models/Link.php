<?php

namespace App\Models;

use App\Exceptions\CodeGenerationException;
use App\Support\Math;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];


    public function getCode()
    {
        if(! $this->id) throw new CodeGenerationException;

        return (new Math)->toBase($this->id);
    }

    public static function byCode($code)
    {
        return static::where('code', $code);
    }

    public function shortenedUrl()
    {
        if(! $this->code) return;
        
        return env('APP_URL') . '/' . $this->code;
    }
}
