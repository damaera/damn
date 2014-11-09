###Views.

Views terdapat dalam `app/views`. Menggunakan handlebars (lightcandy) sebagai templating engine.

#####Membuat dan Memanggil View.

View merupakan file `*.html` yang dimodifikasi sedemikian rupa. Untuk membuat View cukup dengan membuat `*.html` file di `app/views`. Sehingga misal jika ingin membuat `user` view, maka buat `user.html` di `app/views`.

View dapat diberi layout maupun tidak, jika view tanpa layout gunakan `view()`, dan view dengan layout gunakan `view_layout()`.

```
// memanggil home.html dalam folder app/views
get('/', function(){
    view('home');
});

// memanggil listAll.html dalam folder app/views/user
get('/', function(){
    view('user/listAll');
});
```

#####Assign Data

Templating Engine menggunakan `Handlebarsjs` versi PHP dari Lightcandy. Sehingga data yang diolah harus berada pada tag `{{ }}`

Untuk passing data disini, bisa menggunakan classObject ataupun array biasa. Untuk array caranya dengan `view('foo', array($value1, $value2, ... $valueN))`. Sedangkan untuk classObject bisa dengan berbagai cara, misal `view('foo', controller('foo'))`. atau pada `app/controllers/fooController.php` bisa dengan `view('foo', $this)`

Misal terdapat sebuah template seperti dibawah

`app/views/foo.html`
```
{{ title }} ,
Hello, {{ name }} !
```

**Contoh Dengan Array**

`app/routes.php`
```
get('/foo', function(){
    $value = array(
        "title" => "Welcome",
        "name"  => "World"
    );

    view('foo', $value);
});
```

**Contoh Dengan ClassObject**

`app/routes.php`
```
get('/foo', function(){
    controller('foo');
});
```

`app/controllers/fooController.php`
```
class fooController {
    
    function __construct () {
        view('foo', $this);
    }

    // Bisa dengan variabel, maupun method
    public $title  = "Welcome";

    public function name () {
        return 'World';
    }
}
```

**_Semua contoh diatas menghasilkan output yang sama, yaitu ketika mengakses url `/foo` akan muncul output seperti berikut_**

```
Welcome ,
Hello, World !
```

#####Variables

Misal data didefinisikan sebagai berikut

```<xmp>
$data = [
    "title"     => "I'm The King",
    "posts"     => [
        [
            "title"     => "Post #1",
            "id"        => 1,
            "content"   => "<b>The Lion</b>"
        ],
        [
            "title"     => "Post #2",
            "id"        => 2,
            "content"   => "<b>The Brave</b>"
        ]
];</xmp>
```

Contoh template dan Outputnya sebagai berikut. tag `{{ }}` otomatis mengubah value menjadi HTML Escaping. Jika tidak ingin nilai HTML escaping gunakan `{{{ }}}`.

**Variables**

```
* {{ title }}
* {{ time }}
* {{ post.0.content}}
* {{{ post.0.content}}}

Output:
<xmp>
* I'm The King
*
* &lt;b&gt;The Lion&lt;/b&gt;
* <b>The Lion</b></xmp>
```

#####Block Section



**If / Else**

Kita dapat membuat if/else block dengan variabel sebagai argument nya . Jika argument bernilai false, null atau "". Maka yang didalam `#if` tidak dijalankan.

```
$data = [
    "active" => true
]
```

```
{{ #if active}}
    This part will be shown if it is active
{{ else }}
    This part will not show if active is true
{{ /if }}

Output:
    This part will be shown if it is active
```

**Unless**

Unless merupakan kebalikan dari if/else. Block akan di render jika argument bernilai false, null atau "".

```
$data = [
    "active" => true
]
```

```
{{ #unless active}}
    This part will not show if active is true
{{ /unless }}

Output:
    
```

**Each**

Each merupakan block section untuk iterasi. Gunakan {{ this }} atau {{ . }} untuk mengiterasi jika tidak terdapat key dalam array (Indexed Array).

```<xmp>
$data = [
    "posts"     => [
        [
            "title"     => "Post #1",
            "id"        => 1,
            "content"   => "<b>The Lion</b>"
            "tags"      => [
                "Lion",
                "Heart",
                "King"
            ]
        ],
        [
            "title"     => "Post #2",
            "id"        => 2,
            "content"   => "<b>The Brave</b>"
            "tags"      => [
                "Warrior",
                "Knight",
                "Sword"
            ]
        ]
    ]
];</xmp>
```

```<xmp>
<ul>
{{ #each posts }}    
    <li>
        id : {{ id }} 
        title : {{ title }}
        content : {{{ content }}}
        tags : 
            {{ #each tags }}
                {{ this }}
            {{ else}}
                No tags found.
            {{ /each }}
    </li>
{{ /each }}
</ul>

output:
<ul>
    <li>
        id : 1
        title : Post #1
        content : <b>The Lion</b>
        tags :
            Lion
            Heart
            King
    </li>
    <li>
        id : 2
        title : Post #2
        content : <b>The Brave</b>
        tags :
            Warrior
            Knight
            Sword
    </li>
</ul></xmp>
```

#####@Special Variables

Terdapat 5 Special Variables dalam setiap `#each`, yaitu `@root`, `@index`, `@key`, `@first`, `@last`. Khusus untuk `@root`, tidak memerlukan berada di dalam `#each`. 

```
$data   = [
    "users" => [
    [
        "name"  => "Arjuna",
        "class" => "Archer"
    ],
    [
        "name"  => "Bima",
        "class" => "Ravager"
    ],
    [
        "name"  => "Krishna",
        "class" => "God"
    ]
];
```

```
{{ @root.users.0.name }}

{{ #each users }}
    {{ @index }}. {{ name }} : {{ class }} , first : {{ @first }}, last : {{ @last }}
{{ /each }}

Output:
    Arjuna

    0. Arjuna : Archer , first : true , last : false
    1. Bima : Ravager , first : false , last : false
    2. Krishna : God , first : false , last : true
```

#####No Parsing

Jika ingin tidak merender template. gunakan `{{=% %=}}` dan `%={{ }}=%`. Semua di dalam tag tersebut tidak di render. Fungsinya misal jika ingin sharing template dengan javascript client, seperti AngularJS.
```<xmp>
{{=% %=}}
<div ng-repeat="user in users">
    {{ user.name }} : {{ user.class }}
</div>
%={{ }}=%</xmp>
```

#####Partial
Partial artinnya include view lain ke dalam sebuah view, cara menggunakannya cukup dengan `{{> namaPartial }}`

`app/views/footer.html`
```<xmp>
<div class="footer">Ini footer</div>
</xmp>
```

```<xmp>
<html>
<head>
    <title></title>
</head>
<body>
    <div>Lorem Ipsum</div>
    {{> footer}}
</body>
</html></xmp>
```

Output
```<xmp>
<html>
<head>
    <title></title>
</head>
<body>
    <div>Lorem Ipsum</div>
    <div class="footer">Ini footer</div>
</body>
</html></xmp>
```

#####Custom Helper View

Helper dalam view, berfungsi untuk mengolah nilai. Misalnya untuk filtering, string manipulation atau yang lain. Custom helper terdapat pada `app/helpers.php`. Buat fungsi closure pada dalam array `$helpers`, dimana key merupakan nama helper nanti. _Fungsi helpers harus berada di dalam variabel `$helpers` berupa associative array_.

Argument dalam helpers dipisahkan dengan spasi, dimana nanti argument digunakan sebagai dalam closure. Jika ingin argument dalam bentuk string, bukan variabel. gunakan petik dua `"` , jangan gunakan petik satu `'`.

Terdapat 2 jenis yaitu Single tag helpers dan Block helpers.

**Single Tag Helper**

`app/helpers.php`
```
    "upperCase" => function ($string) {
        return strtoupper($string);
    },
    "formatDate" => function ($date , $format) {
        return date($format , $date);
    }
```

```
$data = [
    "word" => "horas !!",
    "date" => time()
];
```

```
* {{ upperCase word }} 
* {{ formateDate date "y-m-d"}}

Output

* HORAS !!
* 14-10-05
```

**Block Helper**

Mari buat tag `if` sendiri. Code dibawah ini sama seperti `{{#if}}` `{{/if}}`
```
    'customIf' => function ($conditional, $options) {
        if ($conditional) {
            return $options['fn']();
        } else {
            return $options['inverse']();
        }
    }
```

Membuat tag Each sendiri. Code dibawah ini sama seperti `{{#each}}` `{{/each}}`
```
    'customEach' => function ($context, $options) {
        $ret = '';
        foreach ($context as $cx) {
            $ret .= $options['fn']($cx);
        }
        return $ret;
    }
```