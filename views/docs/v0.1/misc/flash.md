###Flash.

Flash messages atau sering disebut Cross-request messages. Digunakan untuk mengirimkan pesan antar halaman.

```
// misal set an error message setelah password salah, kemudian redirect
flash('error', 'Maaf, password anda salah');
redirect('/some-page');

// .. kemudian di /some-page , maka akan muncul 'Maaf, password anda salah'
$message = flash('error');
```