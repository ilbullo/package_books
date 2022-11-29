<?php

namespace Ilbullo\Books\Models;

use Ilbullo\Books\Traits\HasPackageFactory;

class Author extends Model
{
    use HasPackageFactory;

    protected $fillable = [
        'name',
        'lastname'
    ];

    /***************************************************
     *
     * Get the books of the author
     *
     * @return \Illuminate\Database\Eloquent\Collection
     *
     ***************************************************/

    public function books() {

        return $this->hasMany(Book::class);

    }

    public function getFullNameAttribute() {

        return $this->lastname . " " . $this->name;
    }
}
