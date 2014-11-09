###Models.

Models terdapat dalam `app/models`. Model digunakan untuk berinteraksi dengan data. Tiap Model mempresentasi kan sebuah `table` dalam database.

#####Membuat dan Memanggil Model

Model juga merupakan Class, sehingga membuatnya cukup membuat file yang berisi class. Tetapi **Nama File dan Class dari Model Harus diakhiri dengan _"Model"_**. Misal nama Model adalah _user_, maka nama file didalam `app/models` harus _userModel.php_ dan nama Class harus _userModel_.

`model('namaModel')`

Didalam Model terdapat **_variabel spesial_** yaitu `table_name` dan `data`. Kedua variabel ini hanya berjalan ketika ada interaksi dengan database. **Ingat,** Config database terdapat di `app/config.php`

`table_name` merupakan variabel nama tabel yang akan digunakan dari sebuah database.

`data` merupakan hasil interaksi dari database. Variabel ini memang tidak di inisiasi di Model, namun variabel ini ada. `data` merupakan instance dari `Damn Query Builder`. Sehingga isinya adalah sebuah class untuk menjalankan SQL query.

**Contoh**

`app/models/userModel.php`

```
class userModel {
    
    //tabel user di database
    public $table_name = 'user';
    //disini tidak ada variabel 'data'

}
```


`app/controller/userController.php`

```
class userController {

    public function getData () {
        //memanggil model 'user', beserta data nya
        return model('user')->data;
        //data disini digunakan untuk menjalankan SQL query
    }

}
```

#####Damn Query Builder

Dari variabel `data` di Model, Terdapat `Damn Query Builder` didalamnya. `Damn Query Builder` merupakan `SQL` query builder yang minimalist, menggunakan `PDO` sebagai engine nya. Menggunakan `Chaining Method` supaya lebih fleksibel.

```
model('user')->data->select()->where('age > 20')->order_by('id DESC')->fetch();

//output
//SELECT * FROM user WHERE age > 20 ORDER BY id DESC
```


**Contoh Query Builder**

```
class userController {

    public function getAllUser () {
        //memanggil model user, beserta data nya
        $modelUser = model('user')->data;
        
        //Query Builder Dijalankan
        $modelUser
            ->select("id,nama")
            ->fetch();

        //SELECT id, nama FROM user , kemudian fetch(return berupa array atau objek)
        //user merupakan 'table_name' dari model 'user', bukan model 'user' itu sendiri
    }

}
```


Beberapa method dalam `Damn Query Builder`

Usage | Output beserta Keterangan
--- | ---
`raw($query, $params = array())` | membuat SQL query, misal `$data->raw("SELECT * FROM data WHERE id = ?", array(20))`
`select($string = "*")` |set `SELECT`, nilai defaultnya adalah `*`.
`where($string, $params = array())` | set `WHERE`\n misal `where("field > ? AND field < ?", array($x, $y))` , Ini merupakan Bound dari PDO.
`order_by($string)` | set `ORDER BY`.
`join($type, $table, $on)` | set `JOIN` ,  parameter `$type` untuk type join, misal `INNER` / `LEFT` / `RIGHT` atau yang lain. `$table` merupakan tabel lain yang ingin di join. `$on` merupakan ON dalam JOIN query, misal `tabel1.id = tabel2.id`.
`find($id)` | digunakan untuk mencari berdasarkan Primary Key, Otomatis mencari Primary key, kemudian dicocokan dengan `$id` lalu dikembalikan. Jika terdapat dua atau lebih Primary Key, maka yang digunakan adalah Primary Key pertama.
`insert($values = array())` | set `INSERT` , misal parameter `$values` berupa `array("key1 => "value1, "key2" => "value2")` , dimana keys adalah nama kolom dalam tabel, dan value merupakan nilainya.
`update($id, $values = array())` | set `UPDATE`, `$id` seperti dalam fungsi `find($id)`, dan parameter `$values` seperti dalam fungsi `insert()`
`delete($id)` | set `DELETE` berdasarkan `$id`, seperti dalam fungsi `find()`
`fetch()` | merupakan akhir dari `Chaining Method` digunakan untuk mengembalikan data berupa array / object. Parameter `$type` bernilai `string` atau `object`. Fungsi ini digunakan jika query terdapat `SELECT`
`execute()` | merupakan akhir dari `Chaining Method` digunakan untuk mengeksekusi query. Digunakan untuk `INSERT` , `UPDATE` dan `DELETE`.
 
**Contoh**
```

//misal nilai $table_name dari model 'user' adalah `user`
$data = $model('user')->data;

//show user with id > 2
$id = 2;

$users = $data
    ->select()
    ->where(
            'id > ?',
            array($id)
        )
    ->fetch();

print_r($users);
//SQL = SELECT * WHERE id > 2

$data
    ->delete($id)
    ->execute();
//user 2 deleted

```
