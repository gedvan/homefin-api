<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'parent_id'];

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function subcategories() {
        return $this->hasMany(self::class, 'parent_id');
    }

    protected static function booted()
    {
        parent::booted();
        static::saving(function (Category $category) {
            if ($category->parent_id) {
                $parent = $category->parent;
                // Impede que categorias sejam criadas com mais de um nível de profundidade
                if ($parent->parent_id) {
                    throw new \Exception('A categoria não pode ter nível maior do que 1.');
                }
                // Impede que o tipo da categoria-filha seja diferente do tipo da categoria-pai
                if ($category->type) {
                    if ($category->type != $parent->type) {
                        throw new \Exception('O tipo da subcategoria não pode ser diferente do tipo da categoria-pai.');
                    }
                }
                else {
                    $category->type = $parent->type;
                }
            }
        });
    }

}
