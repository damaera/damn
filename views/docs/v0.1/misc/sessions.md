###Sessions.

Untuk get/set session, gunakan fungsi `session()`. Otomatis `session_start()`, sehingga tidak perlu memanggil `session_start()` setiap fungsi `session()`.

```
// set a session value
session('auth', false);

// get a session value
$auth = session('auth');

// remove a session variable
session('auth', null);
```