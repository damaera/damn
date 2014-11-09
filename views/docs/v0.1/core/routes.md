###Routes.

Routes di Damn Framework terdapat pada file `/app/routes.php`. Dimana semua request dari user akan diproses disini. Request dari user akan ditangkap, kemudian bisa diarahkan ke controller, model, view atau membuat function closure.

#####Basic Routing.

Get route dari path `/`.
```php
get('/', function () {
	echo "hello, world!";
});
```

Get route dari `/index`.
```php 
get('/index', function () {
	echo "hello, world!";
});
```

Post data ke `/register`.
```php
post('/add' , function () {
	echo "it works!";
});
```

Jika menginginkan lebih banyak tipe http request, maka gunakan fungsi `on()`, code dibawah menghasilkan output yang sama seperti function `get('index')`.
```php
on('GET', '/index', function () {
	echo "hello, world!";
});
```

Route dengan beberapa tipe http method request.
```php
on(['GET', 'POST'], '/greet', function () {
	echo "hello, world!\n";
});
```

Atau menerima semua tipe http request method.
```
on('*', '/semua', function () {
	echo "it works!";
});

```


#####Routing dengan Parameter.

parameter diawali dengan titik dua, bisa dipanggil melalui parameter dari function maupun dengan fungsi `params()`
```
get('/user/:nama',function($n){
	echo "hai $n , selamat datang!\n";
	echo "bagaimana kabarmu".params('nama')." ? ";
});
```

Multiple parameter, ingat bahwa parameter pertama satu dan dua harus terisi.
```
get('/show/:satu/:dua',function($n1, $n2){
	echo "arg1 = $n1, arg2 = $n2. argumentnya antara lain ".params('first').' dan '.params('second');
});
```

optional parameter, Bisa /show , /show/satu ataupun /show/satu/dua , artinya parameter satu dan dua boleh tidak terisi.
``` 
get('/show(/:satu(/:dua))', function($n1, $n2){
	echo "arg1 = $n1, arg2 = $n2";
});
```

Regex Match, Regular expression match berada di akhir penulisan parameter dengan tanda @ sebagai awalan. Code dibawah hanya menerima parameter berupa angka/digit.
```
get('/get/:num@\d+', function($n){
   echo "$n adalah angka";
});
```

Misal ingin membuat parameter username dengan karakter yang sudah ditentukan dan minimal 3 karakter.
``` 
get('/user/:username@[a-z0-9_-]{3,}' , function($username){
	echo $username;
});

```

#####Grouped Routing

Kadang-kadang dibutuhkan grouping routes dalam membuat aplikasi. Misalnya pada saat membuat APIs.

```
prefix('users', function(){
	
	get('/all', function () {
		//list all user
		//route -> users/all
	});

	get('/:id', function ($id) {
		//show user by id
		//route -> users/id
	});

});
```

#####Redirect

HTTP redirect dilakukan dengan `redirect($route, $code = 302, $condition = true)`. Parameter `$code` merupakan code yang akan dilemparkan, misalnya `404`, `403` atau `301` dan sebagainya. Parameter ketiga adalah `$condition` bertipe `boolean`. Hanya jika bernilai `true` redirect bisa terjadi.

```
//simple redirect
get('/page1', function () {
	
	redirect('/page2');
	//jika ke path '/page1' maka redirect ke '/page2', dengan code '302' (default)

});

//redirect dengan custom code error
get('/url1', function() {
	
	redirect('/url2', 404);
	//jika ke path '/url1' maka redirect ke '/url2', dengan code '404'
	
});

//redirect dengan condition
post('/login', function(){
	
	redirect('/admin', 200, authenticated());
	//post data ke login
	//jika  authenticated == true, maka akan redirect ke admin dengan code 200

});
```

#####Parameter Bind and Filter

Kadang parameter digunakan berulang-ulang, misal `:username`. Dengan fungsi bind dan filters, route dapat menjalankan fungsi seperti filtering, string manipulation dan sebagainya.

Parameter yang diolah di `bind()` akan diolah, dan dikembalikan ke route. Ini tidak berpengaruh pada `params()` hanya parameter di fungsi saja.

```
// bind memerlukan value untuk dikembalikan (return)
bind('hashable', function ($hashable) {
	return md5($hashable);
});

// nilai hash berubah, tetapi params(hashable) tidak
get('/md5/:hashable', function ($hash) {
	echo $hash . '-' . params('hashable');
});
```

`filter()` tidak memerlukan nilai untuk dikembalikan. Hanya menjalankan fungsi. Nilai parameter tetap, tidak berubah.

```
// jika ada parameter 'delete_id', maka fungsi delete dijalankan
filter('delete_id', function(){
	// jalankan funngsi delete
});

post('/delete/:delete_id', function ($delete_id) {
	// nilai $delete_id tidak berubah, tetapi fungsi delete tetap berjalan
});
```


#####Before and After Route

Terkadang diperlukan fungsi yang dijalankan sebelum masuk ke request atau setelah fungsi dijalankan. `before()` untuk sebelum masuk request, kata lain dari before adalah middleware. `after()` dijalankan setelah route dijalankan.


```
// dijalankan sebelum semua request masuk
before(function ($method, $path) {
	// jalankan sesuatu, misal check header
});

// before route tertentu, dijalankan jika URI matches dengan Regex
before('^admin/', function ($method, $path){
	// misal check user admin
});

// dijalankan setelah semua request dijalankan
after(function ($method, $path){
	// misal hapus variabel, session dsb
});

// dijalankan hanya saat URI matches dengan Regex
after('^logoout/', function ($method, $path){
	// misal hapus temporary files
})
```

#####Error Handling

Membuat custom error handling dan memanggilnya.
```
// jika url tidak ditemukan, maka akan muncul "Not Found!"
error(404, function (){
	echo "Not Found!";
});

get('notfound', function(){
	error(404);
	//echo 'Not Found!'
});
```
