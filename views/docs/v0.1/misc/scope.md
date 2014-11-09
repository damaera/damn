###Scope.

Scope digunakan untuk menyimpan sebuah nilai untuk di ambil nanti. Bisa berupa variable, array maupun object.

```
// set scope
scope('user', 'Yudhistira');

// output 'Yudhistira'
scope('user');

// clear value
scope();

// output null
scope('user');
```