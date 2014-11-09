###Request Header.

Mengambil header request dengan menggunakan `request_headers($name)`. Jika menganbil tanpa parameter, maka kembaliannya akan berupa associative array. Jika terdapat parameter, maka hanya akan mengembalikan 1 header saja.

```
// get semua header
$headers = request_headers();

// hanya satu header
$accept_encoding = request_headers('accept-encoding');
```