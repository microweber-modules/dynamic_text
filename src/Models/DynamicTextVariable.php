<?php
namespace MicroweberPackages\DynamicText\Models;

use Illuminate\Database\Eloquent\Model;
use MicroweberPackages\Database\Traits\CacheableQueryBuilderTrait;
use MicroweberPackages\Multilanguage\Models\Traits\HasMultilanguageTrait;

class DynamicTextVariable extends Model
{
    use HasMultilanguageTrait;
    use CacheableQueryBuilderTrait;

    protected $fillable = [
        'name',
        'content',
    ];
    
    public $translatable = ['content'];

}
