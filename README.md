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

Change filesystem disk on ENV file to book

`FILESYSTEM_DISK=book`

Create .htaccess file with the code below to remove "public" from URL

```
<IfModule mod_rewrite.c>     
    <IfModule mod_negotiation.c>         
        Options -MultiViews -Indexes     
    </IfModule>
    RewriteEngine On

    # Handle Authorization MemberHeader
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Remove public URL from the path
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L,QSA]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
```

