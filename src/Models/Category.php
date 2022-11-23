<?php

namespace Ilbullo\Books\Models;

use Ilbullo\Books\Traits\HasPackageFactory;

class Category extends Model
{
    use HasPackageFactory;

    protected $fillable = [
        'name'
    ];

    /***************************************************
     *
     * Get all books of the category
     *
     * @return \Illuminate\Database\Eloquent\Collection
     *
     ***************************************************/

    public function books() {

        return $this->belongsToMany(Book::class,'book_categories','category_id','book_id');

    }
}
