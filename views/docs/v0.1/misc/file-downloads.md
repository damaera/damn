###File Downloads.

Jika ingin pushing file ke client menggunakan Content-Disposition header. Gunakan fungsi `send($path, $file, $expired)`. Dimana `$path` merupakan route path, `$file` merupakan filename, `$expired` adalah cache lifespan in seconds.

```
// push a pdf that can be cached for 180 days
send('/path/to/file/to/push.pdf', 'ebook.pdf', 60*60*24*180);
```