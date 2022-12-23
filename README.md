# PACKAGE BOOKS

Handle an e-book personal library. 
You can create authors and categories for each book you add. 
Every book has one or more categories and an author. 
You can use the searchbar to find a book or an author or a category from database. 

Books are stored under storage folder and than books/AUTHOR_ID folder.

### How install the package

`composer require ilbullo/books`

Than load migrations with the artisan command to generate the tables on database

`php artisan migrate`

Create the storage link using artisan command

`php artisan storage:link`
