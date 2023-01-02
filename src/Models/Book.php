<?php

namespace Ilbullo\Books\Models;

use Ilbullo\Books\Traits\HasPackageFactory;

class Book extends Model
{
    use HasPackageFactory;

    protected $fillable = [
        'title',
        'author_id',
        'path',
        'filetype'
    ];

    /***************************************************
     *
     * Get the author of the book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     ***************************************************/

    public function author() {

        return $this->belongsTo(Author::class);

    }

    /***************************************************
     *
     * Get the categories of the book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     ***************************************************/

    public function categories() {

        return $this->belongsToMany(Category::class,'book_categories','book_id','category_id');

    }

}
