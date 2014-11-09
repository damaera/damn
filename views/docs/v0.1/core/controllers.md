###Controllers.

Controllers terletak pada `app/controllers`. Controller merupakan class dimana logic diolah, interaksi dengan model atau render ke view.

#####Membuat dan Memanggil Controller

Controller merupakan Class, sehingga membuatnya cukup membuat file yang berisi class. Tetapi **Nama File dan Class dari Controller Harus diakhiri dengan _"Controller"_**. Misal nama controller adalah _user_, maka nama file didalam `app/controllers` harus _userController.php_ dan nama Class harus _userController_.

Berikut adalah berbagai kombinasi dari pemanggilan controller

`controller(namaController, parameter)` : Memanggil Controller, ke fungsi `__construct`. Parameter berupa `array`, sehingga misal ingin mengolah parameter, maka memanggil controller dengan `controller('namaController', array($param1, $param2, $param3))`. Kemudian dalam fungsi `__construct`, array tersebut dijalankan berupa parameter, bukan array lagi. Sehingga ditulis `__construct($param1, $param2, $param3)`.

`controller(namaController.namaAction, parameter)` : Memanggil Action dalam Controller. Action merupakan `public function` dalam Controller. Parameternya sama seperti diatas.

**Contoh Sederhana**

`app/controllers/userController.php`
```
class userController {

	function __construct () {
		return $this->list();
	}

	public function list () {        
		// list all user
	}
	
	public function show ($id) {        
		//show user by id
	}

}
```

`app/routes.php`

```
//misal memanggil dari routes

get('user', function () {
	controller('user');
	//list all user
});

get('user/:id', function ($id) {
	//memanggil action show pada controller
	controller('user.show', array($id));
	//show user by id
});

```
