<?php
namespace MicroweberPackages\DynamicText\Models;

use Illuminate\Database\Eloquent\Model;
use MicroweberPackages\Database\Traits\CacheableQueryBuilderTrait;
use MicroweberPackages\Database\Traits\HasCreatedByFieldsTrait;

class DynamicTextVariable extends Model
{
    use CacheableQueryBuilderTrait;
    use HasCreatedByFieldsTrait;

    protected $fillable = [
        'name',
        'content',
    ];

    public $translatable = ['name','content'];

}
