---
title: Middlewares
description: Middlewares
extends: _layouts.documentation
section: content
---

# Middleware trong Laravel

## Tổng quan

- Giới thiệu
- Cách đăng ký
- Cách dùng


## 1, Giới thiệu

`Middleware` nói chung là 1 cơ chế  trung gian nằm giữa các request và response. Nó nhận các request, thi hành các mệnh lệnh tương ứng trên request đó. Sau khi hoàn thành nó response (trả về) hoặc chuyển kết quả ủy thác cho một Middleware khác trong hàng đợi.

Trong **Laravel**, Middleware cung cấp một giải pháp khá tiện ích cho việc lọc các HTTP requests vào ứng dụng của chúng ta.
Ví dụ, với bản Laravel mặc định, ta có thể được cung cấp middleware liên quan đến xác thực người dùng. Nếu người dùng chưa được xác thực, Laravel sẽ chuyển hướng người dùng đến trang đăng nhập và ngược lại

Trong cách viết bình thường của Middleware chúng ta sẽ thấy có $request và $next được truyền vào trong function handle. Bên cạnh đó ta hoàn toàn có thể truyền thêm biến.

Ta cũng có thể thực hiện các lệnh trước hoặc sau $next để đảm bảo được mục đích

```php
public function handle($request, Closure $next)
{

    //do something first
    $returnValue = $next($request);
    //do something later

    return $returnValue;
}
````

## 2, Cách đăng ký

Ta có thể gõ lệnh

```bash
php artisan make:middleware
```

Hoặc đơn giản là thêm vào  trong thư mục `app/Http/Middleware`


## 3, Cách dùng

Chúng ta chỉ nên dùng middleware cho 3 trường hợp sau:

##### Dùng middleware global

Chúng ta sẽ khai báo các middleware global trong **app/Http/Kernel.php**

```php
protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
];
```

Các middleware được khai báo trên đây sẽ được dùng cho mọi nơi ở ứng dụng

##### Dùng middleware cho các nhóm người dùng khác nhau

Bằng việc tạo thêm các nhóm người dùng qua việc chia route và định nghĩa trong **RouteServiceProvider**, ta có thể chỉ định các nhóm người dùng nào sẽ được áp dụng các middleware nào. Chúng ta sẽ khai báo các middleware theo nhóm trong mảng `$middlewareGroups`

Ví dụ

```php
 protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \App\Http\Middleware\CheckForMaintenanceMode::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'admin' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]
    ];
```

##### Dùng middleware cục bộ ngay trong các controller

Để đảm bảo việc middleware chỉ cần được thực thi ở 1 số nơi nhất định như là trước mỗi controller. ta hoàn toàn có thể sử dụng tại **function __contruct()**

Ví dụ

```php
class Controller extends AppController
{
    /**
     * Use middlewares
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
}
```
