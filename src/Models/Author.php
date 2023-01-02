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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     ***************************************************/

    public function books() {

        return $this->hasMany(Book::class);

    }

    /***************************************************
     *
     * Get the full name of the author. Lastname + name
     *
     * @return String
     *
     ***************************************************/

    public function getFullNameAttribute() : string {

        return $this->lastname . " " . $this->name;
    }
}
