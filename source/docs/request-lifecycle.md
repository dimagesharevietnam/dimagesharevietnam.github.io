---
title: Request Lifecycle
description: Vòng đời của một request
extends: _layouts.documentation
section: content
---

# Request Lifecycle

Bài viết này sẽ trình bày về vòng đời của một request (cụ thể hơn là xử lý một HTTP Request) trong ứng dụng web được xây dựng dựa trên framework Laravel

![laravel request lifecycle](/assets/images/request_lifecycle.png)

## Điểm tiếp nhận

Điểm tiếp nhận của mọi request tới Laravel đều được xử lý ở file `public/index.php`. Tất cả các request đều được web server (Apache, Nginx) chuyển tiếp đến đây. Thực tế thì mọi xử lý của Laravel cũng đều diễn ra duy nhất ở file này. Chúng ta cùng phân tích cụ thể các đoạn code được viết trong file này.

## Nạp các thư viện cần thiết

```php
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__.'/../vendor/autoload.php';
```

> Việc nạp này được xử lý với sự giúp đỡ của [composer](https://getcomposer.org/). Vì vậy một cách đơn giản hơn để biết được ứng dụng yêu cầu những thư viện cần thiết nào là đọc nội dung của file `composer.json` nằm folder source code.


## Tạo application instance

```
/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';
```

Tiếp theo Laravel sẽ tạo ra một application instance từ file `boostrap/app.php`. Chúng ta cụ thể xem file này thực hiện những nhiệm vụ gì.

## Khai báo các thành phần quan trọng

Việc đầu tiên mà file `bootstrap/app.php` xử lý là tạo application instance:

```php
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);
```

Tiếp theo, file `bootstrap/app.php` sẽ khai báo các thành phần quan trọng, thực chất các thành phần này là những hạt nhân `kernel`của ứng dụng, bao gồm:

##### Nhân ứng dụng HTTP (Http Kernel):

```php
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);
```

Thực tế, khai báo này binding interface `Http\Kernel` với file `app/Http/Kernel.php` trong source code. Cụ thể 2 thành phần quan trọng nhất cần quan tâm là:

**Khai báo bootstrappers trong `Illuminate/Foundation/Http/Kernel.php`**

```php
/**
 * The bootstrap classes for the application.
 *
 * @var array
 */
protected $bootstrappers = [
    \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
    \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
    \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
    \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
    \Illuminate\Foundation\Bootstrap\BootProviders::class,
];
```

Đây là những class sẽ được thực thi trong quá trình khởi động application

**Khai báo middlewares trong `app\Http\Kernel.php`

```php
 /**
 ¦* The application's global HTTP middleware stack.
 ¦*
 ¦* These middleware are run during every request to your application.
 ¦*
 ¦* @var array
 ¦*/
 protected $middleware = [...];
 ```

 Đây là những global middleware, tức là những middleware sẽ được chạy qua tất cả các request

 ```php
 /**
 ¦* The application's route middleware groups.
 ¦*
 ¦* @var array
 ¦*/
 protected $middlewareGroups = [...];
 ```

 Đây là những group middleware, được chỉ định cho những route-group cụ thể.

 ```php
 /**
 ¦* The application's route middleware.
 ¦*
 ¦* These middleware may be assigned to groups or used individually.
 ¦*
 ¦* @var array
 ¦*/
 protected $routeMiddleware = [...];
 ```

Đây là những middleware lẻ, được chỉ định cho những route cụ thể.

##### Nhân ứng dụng Console (Console Kernel)

*Laravel coi Console là một ứng dụng độc lập với ứng dụng HTTP*

```php
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);
```

Tạm thời chúng ta bỏ qua tìm hiểu Kernel này và sẽ nhắc lại trong một bài viết khác.

##### Bộ xử lý ngoại lệ (Exception Handler)

```php
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

```

Ở phần này chúng ta cần chú ý nhất 2 xử lý:

- `report(Exception $e)` Viết thông tin exception ra các file log
- `render($request, Exception $e)` Tạo response trong các trường hợp ngoại lệ (ví dụ hiển thị màn hình 404, hiển thị lỗi validation, ...)

Cuối cùng application instance được trả về cho file `public/index.php`

```php
/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
*/

return $app;
```

## Xử lý request

Đoạn code nằm trong file `public/index.php` này rất ngắn nhưng bao hàm toàn bộ xử lý logic của Laravel:

```php
/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
```

Cụ thể:

**Tạo instance nhân HTTP Kernel**

```php
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
```

**Lấy thông tin về request**

```php
$request = Illuminate\Http\Request::capture()
```

**Xử lý request thành response**

```php
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
```

Đi sâu hơn hàm `handle` này làm gì?

```php
// File: vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php

/**
 * Handle an incoming HTTP request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */

$response = $this->sendRequestThroughRouter($request);

// Xử lý exception
// Xử lý event

return $response;
```

Hàm `sendRequestThroughRouter`

```php
/**
 * Send the given request through the middleware / router.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
protected function sendRequestThroughRouter($request)
{
    $this->app->instance('request', $request); // Tạo instance request

    Facade::clearResolvedInstance('request');

    $this->bootstrap(); // Chạy bootstrappers đã định nghĩa

    return (new Pipeline($this->app))
              ->send($request)
              ->through($this->app->shouldSkipMiddleware() ? [] : $this->middleware) // Chạy các middleware được chỉ định
              ->then($this->dispatchToRouter()); // Chuyển tiếp đến Router
}
```

Sau khi thực hiện toàn bộ các xử lý qua bootstrappers và middlewares, request sẽ được chuyển tới Router. Ở đây Router sẽ chuyển tiếp xử lý đến khối MVC mà chúng ta sẽ chủ yếu sẽ coding sau này.

**Gửi trả response**

```php
$response->send();
```

Response trả về sẽ là một gói tin HTTP response và sau đó sẽ được web browser (Apache, Nginx) trả lại cho client.

**Xử lý kết thúc**

```php
$kernel->terminate($request, $response);
```

Đây là thao tác xử lý sau khi response đã được gửi đi, có thể liên quan tới việc ghi log, quản lý bộ nhớ, xóa các thông tin ghi tạm, cache, ...

## Tổng kết

Việc hiểu về vòng đời của một request có thể giúp ta hiểu hơn về cấu trúc của một ứng dụng web viết bằng Laravel.

Ngoài ra việc quan trọng hơn là giúp chúng ta phân biệt được những điểm, vị trí code mà chúng ta có thể can thiệp để thêm xử lý, cũng như đặt những điểm debug hợp lý.

Vậy ngoài cấu trúc sẵn có của Laravel, chúng ta có thể can thiệp vào những điểm nảo?

##### 1. Bootstrappers

Có hai bootstrappers cần quan tâm:

```php
\Illuminate\Foundation\Bootstrap\RegisterProviders::class,
\Illuminate\Foundation\Bootstrap\BootProviders::class,
```

Hai bootstrapper này sẽ đăng ký và khởi tạo những logic mà chúng ta đã đăng ký trong file `config/app.php`. Official Docs của Laravel cũng nhấn mạnh rằng chúng ta cần tập trung vào việc sử dụng `ServiceProvider`. Trong thực tế, chúng ta cũng sẽ đăng ký toàn bộ các service xử lý logic trong các file ServiceProvider nằm trong thư mục `app/Providers`

Chúng ta sẽ tìm hiểu sâu hơn về ServiceProvider ở một bài viết khác.

##### 2. Middlewares

Chúng ta hoàn toàn có thể tạo ra các middleware để xử lý request và đăng ký trong file `app/Htt/Kernel.php`

##### 3. Router

Đây là vị trí mà chúng ta sẽ chỉ định xử lý request bằng `Controller` nào.

##### 4. Khối MVC

Đây là khối `Controller-Model-View` mà chúng ta đã rất quen thuộc. Toàn bộ xử lý cụ thể, chi tiết cho 1 request sẽ được viết trong khối này.
