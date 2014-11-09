###Structure.

Setelah berhasil meng-install, maka akan ada structure folder seperti berikut

```
your app folder
	|- app
		|- controllers
		|- models
		|- views
		-- config.php
		-- helpers.php
		-- routes.php
	|- asset
	|- lib
	|- tmp
	-- .htaccess
	-- damn
	-- index.php
```

Folder | Kegunaan
--- | ---
`/app/` | Merupakan letak dari code dari aplikasi yang akan dibuat, dimana di dalamnya terdapat config, routes, controllers, models dan views.
`/asset/` | Asset merupakan direktori yang digunakan untuk meletakkan asset static seperti CSS, javascript, images atau yang lainnya.
`/lib/` | Tempat untuk inti dari framework ini. Source code dari damn framework dan semua dependencies nya.
`/tmp/` | Untuk caching views (mustache).

berikut adalah penjelasan isi folder beserta isinya

Folder/File | Kegunaan
--- | ---
`/app/controllers/` | Folder dimana controller class berada. Controller merupakan class dimana logic diolah, interaksi dengan model atau render ke view. Untuk lebih jelasnya, lihat <a href="#/docs/v0.1/core/controllers">disini</a>
`/app/models/` | Folder dimana model berada. Model merupakan class untuk berinteraksi dengan data. Biasanya tiap model mempresentasikan table dalam database. Untuk lebih jelasnya, lihat <a href="#/docs/v0.1/core/models">disini</a>
`/app/views/` | Terdapat file HTML template, yang dapat digunakan oleh controller atau routes ataupun yang lainnya. Untuk lebih jelasnya, lihat <a href="#/docs/v0.1/core/models">disini</a>
`/app/config.php` | Konfigurasi dari aplikasi yang akan dibuat, terdapat konfigurasi database, base url, layout, cache dan views. Untuk lebih jelasnya, lihat <a href="#/docs/v0.1/core/config">disini</a>
`/app/helpers.php` | Merupakan template helper dari views <a href="#/docs/v0.1/core/helpers">disini</a>
`/app/routes.php` | Merupakan tempat dimana semua routing path beserta semua rulesnya. Menghubungkan route ke controller, action atau yang lainnya. Untuk lebih jelasnya, lihat <a href="#/docs/v0.1/core/routes">disini</a>