<?php

namespace Ilbullo\Books\Helpers;

class BookLink {

    /******************************************
     * Handle how create the URL link for
     * download books
     * @param Int $author
     * @param String $path
     * @return String
     ******************************************/

    public static function link($author, $path) :string {
        return url('storage/books/'.$author . "/" .$path);
    }

    /******************************************
     * Handle how create the path for retreive
     * books
     * @param Int $author
     * @param String $path
     * @return String
     ******************************************/

    public static function path($author, $path) : string {
        return public_path() . '/storage/books/' . $author . '/' .$path;
    }

    public static function storeLink($author_id) {
        return 'public/books/' . $author_id . "/";
    }

}
