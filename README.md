<center>

# BELAJAR LARAVEL DASAR

</center>

<center>

## POINT UTAMA

</center>

### 1. Pengenalan Laravel

-   `Laravel` adalah framework di PHP yang pertama kali dibuat oleh _Tylor Otwell_ pada tahun 2011. `Laravel` juga merupakan framework _open source_ dan _gratis_.

-   `Laravel` membawa konsep `MVC` atau `(Model View Controller)`.

-   `Laravel` juga menggunakan _library_ PHP yang sudah populer, seperti :

    1. `Composer` sebagai project management,

    2. `Monolog` untuk _logging_,

    3. `PHPUnit` untuk _unit test_ dll.

---

### 2. Membuat Project

-   Kita bisa menggunakan `composer` untuk membuar project `laravel`, dengan menggunakan perintah.

    ```composer
    composer create-project laravel/larave=version nama-folder
    ```

    ![create-project](img/create-laravel.png)

-   Pada sesi kali ini saya menggunakan laravel versi `9.1.5`.

---

### 3. Struktur Project

-   Struktur project `laravel`

    ![folder & file laravel](img/image.png)

-   Kita juga bisa menggunakan perintah `php artisan` untuk melihat fitur apa yang bisa digunakan atau dipakai didalam project `laravel`

    ![php artisan](img/image-1.png)

-   Kita juga bisa menggunakan perintah `php artisan serve --help` untuk melihat detail informasi dari perintah yang ingin dijalankan.

-   Perintah `php artisan serve` bisa digunakan di untuk menjalankan project `laravel`.

---

### 4. Request Lifecycle

1. `public/index.php`

    - Entry point dari aplikasi `laravel` adalah sebuah file `index.php` yang berada didalam folder `public`.

    - Dimana semua _request_ akan masuk kedalam file ini.

2. `app/Console/Kernel.php`

    - Ada 2 jenis `kernel` di `laravel` yaitu, `HTTP Kernel` dan `Console kernel`.

    - `HTTP Kernel` digunakan untuk menangani _reguest_ berupa HTTP, sedangkan

    - `Console kernel` digunakan untuk menangani _request_ berupa perintah console.

3. Service Provider

    - Service provider bertanggung jawab melakukan _bootstraping_ semua komponen di `Laravel` seperti database, queue, validation, routing dll.

---

### 5. Testing

1. Membuat test

    - Terdapat 2 jenis `test` didalama `laravel` yaitu, `unit test` dan `feature test`.

    - `Unit test` menggunakan _class_ turunan dari `PHPUnit\Framework\Testcase`.

    - Ini digunakan untuk membuat `test` tanpa harus menggunakan fitur `laravel`.

    - `Integration test` bisa digunakan untuk mengakses atau memanggil database, controller, dll.

    - `Integration test` menggunakan _class_ turunan dari `Illuminate\Foundation\Testing\TestCase`.

    - Gunakan perintah `php artisan make:test NamaTest`, pada terminal untuk membuat Integration test dan secara otomatis file akan dibuat oleh `laravel` dan masuk kedalam folder `test/feature`.

    - Gunakan perintah `php artisan make:test NamaTest --unit` pada terminal untuk membuat Unit test dan secara otomatis akan masuk kedalam folder `tests/unit`.

    - Dan cara menjalankan test bisa menggunakan perintah `php artisan test` atau `run` langsung menggunakan fitur dari `laravel`.

---

### 6. Environment

1. Environment test

    - Kita bisa menggunakan `function env(key)` atau `Env::get(key)` untuk mendapatkan nilai dari environment variable.

    - Tapi sebelum itu kita harus `export` dulu environment nya. Bisa menggunakan `Git Bash` untuk windows.

        ```Git Bash
        export MAGANG="Gusti Alifiraqsha Akbar"
        vendor/bin/phpunit tests/Feature/EnvironmentTest.php
        ```

    - Atau kita bisa menambahkan environment variable sendiri ke file `.env`.

-   Kode unit test Environment

    ```PHP
    //kode berada di directory tests/Feature
        public function testGetEnv()
        {
                $magang = env('MAGANG');

                self::assertEquals('Gusti Alifiraqsha Akbar', $magang);
        }

        public function testDefaultEnv()
        {
            $author = Env('AUTHOR', 'Gusti');

            self::assertEquals('Gusti', $author);
        }
    ```

---

### 7. Configuration

-   `Laravel` mendukung penulisan konfigurasi menggunakan PHP Code, ini bisa digunakan jika konfigurasi tidak berubah - ubah.

-   `Laravel` menyimpan semua file konfigurasi didalam folder `config`.

-   Kode config

    ```PHP
    return[

    "author" => [
        "first" => env('NAME_FIRST', 'Gusti'),
        "last" => env('NAME_LAST', 'Akabr')
    ],
    "email" => "echo.alifiraqsha@gmail.com",
    "web" => "https://github.com/HOFi"

    ];
    ```

-   Kode unit test mengambil configurasi

    ```PHP
    //kode berada di directory tests/Feature
        public function testConfig()
        {
            $firstName = config('contoh.author.first');
            $lastName = config('contoh.author.last');
            $email = config('contoh.email');
            $web = config('contoh.web');

            self::assertEquals('Gusti', $firstName);
            self::assertEquals('Akabr', $lastName);
            self::assertEquals('echo.alifiraqsha@gmail.com', $email);
            self::assertEquals('https://github.com/', $web);
        }
    ```

1. Configuration Cache

    - Saat kita terlalu banyak membuat file konfigurasi, lama-lama akan membuat proses baca konfigurasi menjadi lambat.

    - `Laravel` memiliki perintah untuk `meng-cache` data konfigurasi yang dibuat agar menjadi sati file, ini bisa membuat proses baca menjadi lebih cepat dan ringan.

    - Gunakan perintah `php artisan config:cache`.

    - lalu jika kita ingin mengapusnya, bisa menggunakan perintah `php artisan config:clear`.

---

### 8. Dependency Injection

-   `Dependency Injection` adalah teknik sebuah object menerima object lain yang dibutuhkan.

-   Kode Dependency Injection

    ```PHP
    //kode berada di directory tests/Feature
        public function testDependencyInjection()
        {
            $foo = new Foo();
            $bar = new Bar($foo);

            self::assertEquals('Foo and Bar', $bar->bar());
        }
    ```

---

### 9. Service Container

-   `Service Container` adalah fitur yang digunakan untuk management `dependencies` dan juga `dependency injection`.

-   Kode membuat dependency

    ```PHP
    //kode berada di directory tests/Feature
        public function testDependency()
        {
            $foo1 = $this->app->make(Foo::class); //new Foo()
            $foo2 = $this->app->make(Foo::class); //new Foo()

            self::assertEquals('Foo', $foo1->foo());
            self::assertEquals('Foo', $foo2->foo());
            self::assertNotSame($foo1, $foo2);
    }
    ```

-   Kode mengubah dependency

    ```PHP
    //kode berada di directory tests/Feature
    public function testBind()
    {
        $this->app->bind(Person::class, function ($app){
            return new Person("Gusti", "Akbar");
        });

        $person1 = $this->app->make(Person::class); // closure() // new Person("Gusti", "Akbar");
        $person2 = $this->app->make(Person::class); // closure() // new Person("Gusti", "Akbar");

        self::assertEquals('Gusti', $person1->firstName);
        self::assertEquals('Gusti', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }
    ```

---

### 10. Service Provider

-   `Service provider` adalah penyedia `service` atau `dependency`.

-   Didalam `service provider`, biasanya kita melakukan registrasi dependency didalam `service container`.

-   Gunakan perintah `php artisan make:provider NamaServiceProvider`.

-   Kode service provider

    ```PHP
        public function register()
        {
            // echo "FooBarServiceProvider";
            $this->app->singleton(Foo::class, function ($app) {
                return new Foo();
            });
            $this->app->singleton(Bar::class, function ($app){
                return new Bar($app->make(Foo::class));
            });
        }
    ```

-   Kode unit test service provider

    ```PHP
    //kode berada di directory tests/Feature
        public function testServiceProvider()
        {
            $foo1 = $this->app->make(Foo::class);
            $foo2 = $this->app->make(Foo::class);

            self::assertSame($foo1,$foo2);

            $bar1 = $this->app->make(Bar::class);
            $bar2 = $this->app->make(Bar::class);

            self::assertSame($bar1, $bar2);

            self::assertSame($foo1, $bar1->foo);
            self::assertSame($foo2, $bar2->foo);
        }
    ```

---

### 11. Facades

-   `Facades` adalah _class_ yang menyediakan static akses ke fitur di `service container` atau `application`.

-   Kode config facades

    ```PHP
    //kode berada di directory tests/Feature
        public function testConfig()
        {
            $firstName1 = config('contoh.author.first');
            $firstName2 = Config::get('contoh.author.first');

            self::assertEquals($firstName1, $firstName2);

            var_dump(Config::all());
        }
    ```

---

### 12. Routing

-   `Routing` adalah proses menerima HTTP request dan menjalankan kode sesuai dengan URL yang diminta.

-   Salah satu contoh `routing` yang sederhana adalah menggunakan `path` dan `closure` sebagai `handler` nya.

-   Kode route

    ```PHP
    // kode berada di directory routes/web
    Route::get('/', function () {
    return view('welcome');
    });

    Route::get('/hofi', function (){
        return "Hello Gusti Alifiraqsha Akbar👋";
    });
    ```

-   Kita bisa melihat hasil dengan menambahkan `hofi` di URL.

---

### 13. Redirect

-   Router juga bisa digunakan untuk me-`redirect` dari satu halaman ke halaman lain.

-   Kode Redirect

    ```PHP
    // kode berada di directory routes/web
    Route::redirect('/instagram','/hofi');
    ```

-   Jadi saat kita menuliskan `instagram` di URL maka otomatis akan di `redirect` ke halaman `hofi`.

-   Gunakan perintah `php artisan route:list` untuk melihat routing yang ada atau sudah dibuat.

---

### 14. Fallback route

-   Kita bisa menggunakan _function_ `Route::fallback(closure)` untuk menampilkan halaman yang tidak ada di aplikasi laravel.

-   Kode fallback route

    ```PHP
    // kode berada di directory routes/web
    Route::fallback(function (){
    return "error 404 by HOFi";
    });
    ```

---

### 15. View

-   `View` adalah fitur dari `laravel` yang digunakan untuk mempermudah dalam pembiatan tampilan halaman web HTML.

-   Dengan menggunakan template engine `blade` untuk membuat kode `view`.

-   Untuk membuat menampilkan _variable_ di `blade`, gunakan `{{ $nama }}` nantinya _variable_ `$nama` bisa diambil secara otomatis dari data yang dikirim.

-   Kode blade

    ```HTML
    <html>
        <body>
            <h1>Hello{{$name}}</h1>
        </body>
    </html>
    ```

-   Setelah membuat `view` untuk menampilkan `view` tersebut gunakan _function_ `Route::view(uri,template,array)` atau `view(template, array)` didalam closure _function_ route.

-   2 Kode untuk menampilkan view

    ```PHP
    // kode berada di directory routes/web
    Route::view('/hello', 'hello', ['name' => 'Gusti']);

    Route::get('/hello-again', function (){
    return view('hello', ['name' => 'Gusti']);
    });
    ```

---

### 16. Route Parameter

-   `Route parameter` digunakan untuk menambahkan parameter di route URL, dan secara otomastis kita bisa mengambil data yang di closure _function_ yang digunakan di closure.

-   Kita juga bisa menambahkan `route parameter` asal namanya berbeda.

-   Kode route parameter

    ```PHP
    // kode berada di directory routes/web
    Route::get('/products/{id}', function ($productId){
    return "Product $productId";
    });

    Route::get('/products/{product}/items/{item}', function ($productId, $itemId){
        return "Product $productId, Item $itemId";
    });


    //kode berada di directory tests/Feature
    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
            ->assertSeeText("Product 1, Item XXX");

        $this->get('/products/2/items/YYY')
            ->assertSeeText("Product 2, Item YYY");
    }
    ```

1. Named route

    - Kita bisa menamakan `route`, yang bisa digunakan untuk mendapatkan informasi tentang `route` tersebut, misalnya me-`redirect` ke `route`.

-   Kode named route

    ```PHP
    // kode berada di directory routes/web
    Route::get('/categories/{id}', function ($categoryId){
    return "Category $categoryId";
    })->where('id', '[0-9]+')->name('category.detail'); //kode named route

    Route::get('/users/{id?}', function ($userId = '404'){
        return "User $userId";
    })->name('user.detail'); //kode named route


    //kode berada di directory tests/Feature
    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/12345');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }
    ```

---

### 17. Controller

-   Di `Laravel` bisa menggunakan `controller` sebagai tempat menyimpan logic dari `route`.

-   Gunakan perintah `php artisan make:controller NamaController`.

-   Kode controller

    ```PHP
    class HelloController extends Controller
    {
        return "Hello World";
    }
    ```

-   kode route ke controller

    ```PHP
    // kode berada di directory routes/web
    Route::get('/controller/hello', [\App\Http\Controllers\HelloController::class, 'hello']);


    //kode berada di directory tests/Feature
        public function testHello()
        {
            $this->get('/controller/hello/Gusti')
                ->assertSeeText("Halo Gusti");
        }
    ```

---

### 18. Request

-   Kita bisa menambahkan `request` di parameter _function_ di `router` atau di `controller` untuk melihat detail request dan secara otomatis PHP akan `laravel` akan melakukan dependency injection data request tersebut.

-   kode request

    ```PHP
    public function request(Request $request): string
    {
        return $request->path() . PHP_EOL .
            $request->url() . PHP_EOL .
            $request->fullUrl() . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->header('Accept');
    }
    ```

-   Kode unit test request

    ```PHP

        //kode berada di tests/Feature
     public function testRequest()
    {
        $this->get('/controller/hello/request', [
            "Accept" => "plain/text"
        ])->assertSeeText("controller/hello/request")
            ->assertSeeText("http://localhost/controller/hello/request")
            ->assertSeeText("GET")
            ->assertSeeText("plain/text");
    }
    ```

---

### 19. Request Input

-   Kode mengambil input

    ```PHP
        public function hello(Request $request): string
        {
            $name = $request->input('name');
            return "Hello $name";
        }
    ```

-   Kode route input

    ```PHP
    // kode berada di directory routes/web
    Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);

    Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);


    //kode berada di directory tests/Feature
        public function testInput()
        {
            $this->get('/input/hello?name=Gusti')
                ->assertSeeText('Hello Gusti');

            $this->post('/input/hello', [
                'name' => 'Gusti'
            ])->assertSeeText('Hello Gusti');
        }
    ```

---

### 20. Input Type

-   `Laravel` mempunyai _method_ untuk melakukan konversi tipe data secara otomatis, contohnya melakukan konversi tipe data `Date` dengan menggunakan _method_ `date(key, pattern, timezone)` pada _class_ request.

-   `Laravel` menggunakan _library_ `Carbon` untuk memanipulasi data `Date` dan `Time`.

-   Kode input type

    ```PHP
    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate->format('Y-m-d')
        ]);
    }
    ```

-   Kode unit test input type

    ```PHP
    // kode berada di directory routes/web
    Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);


    //kode berada di directory tests/Feature
       public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Elaina',
            'married' => 'true',
            'birth_date' => '2007-07-07'
        ])->assertSeeText('Elaina')->assertSeeText("true")->assertSeeText("2007-07-07");
    }
    ```

---

### 21. Filter Request Input

-   Laravel memiliki helper _method_ di _class_ request untuk melakukan `filter input`.

    ```PHP
    public function filterOnly(Request $request): string
    {
        $name = $request->only("name.first", "name.last");
        return json_encode($name); // digunakan untuk mengambil input yang kita sebutkan parameternya.
    }

    public function filterExcept(Request $request): string
    {
        $user = $request->except("admin");
        return json_encode($user); // digunakan untuk mengambil semua input, tapi tidak dengan yang disebutkan parameternya.
    }
    ```

-   Kode unit test filter request

    ```PHP
    // kode berada di directory routes/web
    Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);

    Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);

    //kode berada di directory tests/Feature
      public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Gusti",
                "middle" => "Alifiraqsha",
                "last" => "Akbar"
            ]
        ])->assertSeeText("Gusti")->assertSeeText("Akbar")
            ->assertDontSeeText("Alifiraqsha");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "akbar",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("akbar")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }
    ```

---

### 22. File Storage

-   `Laravel` mendukung _abstraction_ untuk management `file storage` menggunakan _library_ `Flysystem`.

-   Konfigurasi `file storage` terdapat di directory `config/filestytem.php`.

-   Kode konfigurasi file storage

    ```PHP
    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
    ]
    ```

-   Kode file storage

    ```PHP
     public function testStorage()
    {
        $filesystem = Storage::disk("local");

        $filesystem->put("file.txt", "Gusti Alifiraqsha Akbar");

        $content = $filesystem->get("file.txt");

        self::assertEquals("Gusti Alifiraqsha Akbar", $content);
    }
    ```

---

### 23. File Upload

-   `Laravel` juga menyediakan _method_ `file(key)` di request untuk mengambil request file upload.

-   Kode file upload

    ```PHP
     public function upload(Request $request): string
    {
        $picture = $request->file('picture');

        $picture->storePubliclyAs("pictures", $picture->getClientOriginalName(), "public");

        return "OK " . $picture->getClientOriginalName();
    }
    ```

-   Kode unit test file upload

    ```PHP
    // kode berada di directory routes/web
    Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']);

    // kode berada di directory tests/Feature
     public function testUpload()
    {
        $picture = UploadedFile::fake()->image('elaina.png');

        $this->post('/file/upload', [
            'picture' => $picture
        ])->assertSeeText("OK .png");
    }
    ```

-   Dan secara otomatis kita bisa mengaksesnya di URL
    ![alt text](img/memo.png)

---

### 24. Response

-   `Response` digunakan untuk mengembalikan respons dari server ke klien setelah melakukan suatu permintaan. Dalam konteks pengembangan web dengan Laravel, response dapat berupa tampilan `HTML, JSON`, file, atau respons lainnya sesuai dengan kebutuhan aplikasi.

-   Kode response

    ```PHP
    // kode berada di directory app/Http/Controllers
    public function response(Request $request): Response
    {
        return response("hello response");
    }

     // kode berada di directory routes
     Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
    ```

-   Unit test

    ```PHP
     public function response()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('hello response');
    }
    ```

### 25. Encryption

-   Di laravel kita bisa melakukan `encryption` untuk melakuka enkripsi secara otomatis.

-   Dan cara melakukan enkripsi di laravel kita membutuhkan `KEY` yang tersimpan didalam `config/app.php`.

-   kode `KEY` di folder config/app

    ```PHP
        'key' => env('APP_KEY'),
    ```

-   key ini bersifat auto generate saat project laravel, dan disarankan untuk merubah `KEY` setiap 1-2 bulan sekali.

-   Gunakan perintah `php artisan key:generate`, maka secara otomatis key akan digenerate.

-   Dan ini adalah contoh app key yang terdapat didalam file `.env`

    ```PHP
    APP_KEY=base64:8nCcrdqkZL8+uZ5uqhq9WNf65stngHbeJksTF9khXVg=
    ```

## PERTANYAAN & CATATAN TAMBAHAN

-   tidak ada

## KESIMPULAN

-   tidak ada
