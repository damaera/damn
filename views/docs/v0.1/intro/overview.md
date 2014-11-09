###Overview.

Damn Framework, adalah MVC framework yang di desain agar seminimal mungkin, tetapi tetap powerful. Memudahkan developer untuk mengembangkan proyek secara mudah, cepat dan bahagia.

Framework ini terdiri dari beberapa 4 bagian yaitu `Routes` , `Controllers` , `Models` dan `Views`.

Routes dalam Damn Framework menggunakan [dicpatch](https://github.com/noodlehaus/dispatch). Kemudian menggunakan [handlebars](http://handlebarsjs.com/) dalam PHP sebagai templating engine.

Komponen dari Damn Framework Dijelaskan seperti gambar dibawah.

![damn framework diagram](img/diagram.png "damn framework diagram")

User mengirim request ke Damn Application. Kemudian diterima oleh Route, Route mengolah request. Kemudian Route dapat memanggil, controller, model, view, ataupun menjalankan function closure.

Controller dapat berinteraksi dengan Model, dapat menginputkan dan mengoutputkan data ke model, dimana Model adalah yang berinteraksi dengan database.

Jika alur logic di controller sudah fix, maka data tersebut dapat di outputkan melalui view. View akan menampilkan render HTML ke user.