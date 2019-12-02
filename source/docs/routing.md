---
title: Routing
description: Laravel routing
extends: _layouts.documentation
section: content
---

# Routing

## 1, Route

### 1.1, Định nghĩa

Route định nghĩa là 1 tuyến đường, nó có vai trò là định hướng, chỉ đường cho yêu cầu 'request' của người dùng đi đến đâu.

Ví dụ khi ta truy cập 1 trang web Dimagesharevn.com/index, thì route sẽ nhận được 1 yêu cầu url, và nó sẽ xử lí request đó đến Controller.

### 1.2, Vị trí của các file Route

Phần Routing được chia ra ở 2 file là:
- Một route cho web là routes/web.php
- Một route cho api là routes/api.php

### 1.3,  Các phương thức trong Route

Các method mà Route hỗ trợ là:

- Route::get($uri, $callback); //Sử dụng để lấy thông tin. Ví dụ
- Route::get('/user/personal', 'UserController@personal'); // dùng để lấy dữ liệu personal trả về các view, hiển thị dữ liệu.
- Route::post($uri, $callback); // Thường được sử dụng để tạo mới dữ liệu, cũng có thể dùng để sửa hay xóa dữ liệu. Ví dụ:
- Route::post('/admins/users/create' ,'UserController@store'); // Dùng để tạo dữ liệu 1 user.
- Route::put($uri, $callback); // Thường được dùng để cập nhập dữ liệu có sẵn
- Route::put('/users/edit', 'UserController@update'); Dùng để cập nhập các thông tin của user.
- Route::patch($uri, $callback); // Thường dùng để cập nhập một phần của dữ liệu. Ví dụ
- Route::patch('/users/edit', 'UserController@update');
- Route::delete($uri, $callback); // Phương thúc dùng để xóa. Ví dụ:
- Route::delete('/admins/users/{user}', 'UserController@destroy'); // Dùng để xóa 1 user
- Route::options($uri, $callback);// dùng để hỏi server xem phương thức nào được hộ trợ ở URI
- Route::options('items', 'ItemController@options'); // xem /items hỗ trợ các phương thức nào (get, post, put, delete, ...)
- Route::match($methods, $uri, $callback); // Dùng để kết hợp các phương thức. VÍ dụ
- Route::match(['GET', 'POST', 'PUT'], '/match', Controller@match); // Route này sẽ nhận request với 3 method là PUT, POST, GET
- Route::any($uri, $callback); // Có thể nhận với bất kì yêu cầu nào. VÍ dụ
- Route::any('/user', 'Usercontroller@any'); // Route này sẽ nhận mọi method
- Route::redirect('/here', '/there'); // định hướng đến một url khác thực hiện chuyển hướng đơn giản. Ví dụ
- Route::redirect('/user', '/home'); // tự chuyển hướng đến home
- Route::view('/here', 'nameView'); // định hướng đến 1 view. Ví dụ:
- Route::view('/user', 'user.index'); // truy cập vào địa chỉ ta nhận lại 1 view.
- Route::fallback(function () { ..... }); // khi có một yêu cầu thực hiện tên một route nào đó nhưng lại không tồn tại route đó hay không có giá trị trả về, thì khi đó ta nhận lại một thông báo 404. Và khi đó ta có thể sử dụng Route::fallback chức năng này sẽ ghi đè lên trang 404 mặc định và đưa ra phần bổ sung hay thông báo. Ví dụ:
- Route::fallback(function () {
        return 'Hm, Bạn đã gặp lỗi rồi ư?';
        }); // Khi bạn gọi đến route nào đó không tồn tại thì sẽ hiển thị 'Hm, Bạn đã gặp lỗi rồi ư?'.

## 2, Thông số Route

Trên các url có thể kèm theo các thông số kèm theo
Ví dụ trong url có kèm theo thông só id của user:
Route::get('user/{id}', 'UserController@index');

### 2.1, Ràng buộc các tham số

Chúng ta có thể hạn chế định dạng của các tham số trong url bằng cách sử dụng where.
- Route::get('user/{name}', 'UserController@index')->where('name', '[A-Za-z]+');
yêu cầu {name} bắt buộc là các chữ cái, nó sẽ không nhận định dạng khác
- Route::get('user/{id}', 'UserController@index')->where('id', '[0-9]+');
Yêu cầu {id} bắt buộc phải là các số, không chấp nhận các kí tự chữ.

## 3, Đặt tên Routes

### 3.1, Cú pháp

Các route có thể được đặt tên để có thể chuyển hướng một cách dễ dàng
Route::get('user/profile', 'UserController@profile')->name('profile');

## 4, Nhóm các Route

Khi ta thấy các route có các thể nhóm lại để có thể xử lí hay yêu cầu chung thì ta có thể sử dụng Route::group

### 4.1, Namespaces

Ta có thể đặt Namespaces cho group:
Route::group(['namespace' => 'User'], function () {
        ... route
        });

### 4.2, Sub-Domain Routing

Các nhóm có thể sử dụng tên miền phụ, tên miền phụ cũng có thể có tham số như URL, tên miền phụ chỉ có cách chỉ định bằng cách gọi domain trước khi xác định nhóm:
Route::domain('{account}.myapp.com')->group(function () {
        Route::get('user/{id}', function ($account, $id) {
                //
                });
        });

### 4.3, Prefix

Prefix để đăng kí các tiền tố trong nhóm Url. Ví dụ muốn tiền tố tất cả route trong nhóm.
Route::prefix('admin')->group(function () {
        Route::get('users', function () {
                // Url sẽ là "/admin/users"
                });
        });

### 4.4, Route Name Prefixes

Ta muốn đăng kí tiền tố cho tên 'Ở phần 3' của route trong group. Ví dụ:
Route::name('admin.')->group(function () {
        Route::get('users', function () {
                })->name('users'); // name của route sẽ là admin.users
        });

## 5, Route model binding

Khi injecting id của một model nào đó thì bạn sẽ phải lấy id đó rồi truy vấn ra các thông tin khác. Vậy laravel giúp bạn thay vì injecting id, bạn có thể injecting toàn bộ thông tin của chủ thể id đó.

### 5.1, Implicit Binding

Laravel đã giúp bạn có truyền theo toàn bộ thông tin thay vì mỗi id của thông tin đó. Ví dụ
Thay vì
Route::get('api/users/{id}', 'UserController@index');
Thì ta có thể truyền
Route::get('api/users/{user}', 'UserController@index');
Có thể truyền theo cả 1 user và đây chứa được toàn bộ thông tin có thể là tên, tuổi, ...

## 6, Fallback Routes

Có thể sử dụng Route:fallback, khi có một yêu cầu thực hiện tên một route nào đó nhưng lại không tồn tại route đó hay không có giá trị trả về, thì khi đó ta nhận lại một thông báo 404. Và khi đó ta có thể sử dụng Route::fallback chức năng này sẽ ghi đè lên trang 404 mặc định và đưa ra phần bổ sung hay thông báo

## 7, Form Method Spoofing

Html không hỗ trợ các phương thức PUT, PATCH, DELETE. Do đó ta phải sử dụng _method trong form. Ví dụ
< form action="/foo/bar" method="POST">
< input type="hidden" name="_method" value="PUT">
< input type="hidden" name="_token" value="{{ csrf_token() }}">
< /form>

## 8, Các lỗi hay gặp
- Khi sử dụng thông số truyền theo url, nếu không đặt điều kiện hay ưu tiên đặt xuống phía cuối của Group có thể gây ra cho ứng dụng không xác định được sẽ gọi đến route nào. Ví dụ:
- Khi ta có sử dụng: Route::get('/User/{id}', 'UserController@show');(1)
- Và có một route khác: Route::get('/User/Update', 'UserController@update'); (2)
Thì nếu để (2) như vậy thì ứng dụng sẽ sai xót là gọi từ trên xuống và nhảy đến thằng (1).
Vì vậy ta có 2 cách để giải quyết là
Route::get('/User/{id}', 'UserController@show')->where('id', '[0-9]+'); //Thêm điều kiện của thông số
Đặt route số (2) lên trước route số (1)
