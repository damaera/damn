###Config.

Config dari Damn Application dapat ditemukan di satu file yaitu `/app/config.php`. Isi dari file tersebut adalah seperti ini.

```php
define('BASE_URL', 'http://localhost/damn/');
 
//development or production mode
define('PHASE', 'development');
 
/*
DATA BASE
*/
define('DB_TYPE' , 'mysql');
define('DB_HOST' , '127.0.0.1');
define('DB_NAME' , '');
define('DB_USER' , '');
define('DB_PASS' , '');
 
/*
View directory, cache, and default layout
*/
define('VIEW_CACHE', './tmp/cache');
define('VIEW_LAYOUT', 'layout');
```

- `BASE_URL` merupakan root dari Application yang kita buat.
- `PHASE` : jika kita masih develop Application, pilih development. Jika sudah jadi, pilih production.
- `DB_TYPE`, Damn Framework menggunakan PDO. Bisa dikatakan database yang didukung PDO, didukung oleh Damn Framework, antara lain `mysql` , `pgsql` , `sqlite` dan lain sebagainya.
- `DB_HOST` Host dari database. biasanya `localhost` atau `127.0.0.1`.
- `DB_NAME` Nama database.
- `DB_USER` Username dari database.
- `DB_USER` Password dari database.
- `VIEW_CACHE` folder yang digunakan untuk caching dari views (mustache).
- `VIEW_LAYOUT` set layout default. jika diset ke `layout` maka layout default dari views adalah `layout.mustache.html` di dalam folder `VIEW_DIR`.