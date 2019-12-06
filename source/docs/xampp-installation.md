---
title: Cài đặt Laravel trên XAMPP
description: Cài đặt Laravel trên XAMPP
extends: _layouts.documentation
section: content
---

# Cài đặt Laravel trên XAMPP

## Tổng quan

- Cài đặt Xampp
- Cài đặt Git
- Cài đặt Composer
- Cài đặt laravel

## 1. Cài đặt Xampp

##### 1.1 Dowload

[https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)

##### 1.2 Cài đặt

Bước 1: Tải phiên bản mới nhất của XAMPP về máy tính

Bước 2: Click đúp vào file cài đặt vừa tải về. Trên giao diện hiện ra nhấn Next để bắt đầu quá trình cài đặt.

Tiêp tục nhấn Next cho đến khi giao diện hiện thị như bên dưới rồi nhấn Finish để kết thúc cài đặt

![!](/assets/images/xampp/1.jpg)

Giao diện Xampp hiển thị như ảnh bên dưới là thành công

![!](/assets/images/xampp/2.png)


##### 1.3 Lỗi không khởi động được apache, cách khắc phục

Lỗi không khởi động được apache:

> phần mềm chiếm dụng cổng 80-http (cổng 443 -https )

Cách khắc phục:

> Nếu phần mềm đó chiếm dụng cổng 80, bạn cần chuyển Apache sang cổng khác (giả sử 8080).

> Nếu phần mềm đó chiếm dụng cổng 443, bạn cần chuyển Apache sang cổng khác (giả sử 4433).
> Khi đó, thay vì nhập trên thanh địa chỉ của trình duyệt Web là "localhost", bạn phải nhập là "localhost:8080" để có thể đi tới trang quản trị của XAMPP.

![!](/assets/images/xampp/3.png)

##### 1.4 Lỗi không khởi động được MySQL, cách khắc phục

*(Giống phần 1.3)*

##### 1.5 Tạo dự án đơn giản trên Xampp

Truy cập thư mục xampp ->htdocs -> tạo 1 folder mới ->tạo 1 file html -> mở file bằng notepat++

![!](/assets/images/xampp/4.png)

Chỉnh sửa trên file

![!](/assets/images/xampp/5.png)

Chạy đường dẫn localhost:8080 hiển thị như bên dưới:

![!](/assets/images/xampp/6.png)

![!](/assets/images/xampp/7.png)

## 2 Cài đặt Git

##### 2.1 Link dowload

[https://git-scm.com/download/win](https://git-scm.com/download/win)

##### 2.2 Cài đặt

Sau khi download xong bạn hãy chạy file đó và thực hiện các bước cài đặt như giao diện. Thực chất Git đã tự chọn các thông số tốt nhất khi cài đặt rồi nên bạn chỉ việc click Next là được.
Nhấ finish để hoàn thành cài đặt

![!](/assets/images/xampp/8.png)

Sau khi cài đặt xong, nhấn phải chuột vào một thư mục bất kỳ, một Context-Menu sẽ hiển thị, bạn có thể nhìn thấy các Menu-Item của Git, điều này chứng tỏ rằng bạn đã cài đặt Git thành công.

![!](/assets/images/xampp/9.png)

## 3 Cài đặt Composer

##### 3.1 Link dowload

[https://getcomposer.org/](https://getcomposer.org/)

##### 3.2 Cài đặt

Click đúp vào file cài đặt vừa tải về. Trên giao diện hiện ra nhấn Next để bắt đầu quá trình cài đặt.

Tiêp tục nhấn Next cho đến khi giao diện hiện thị như bên dưới rồi nhấn Install để kết thúc cài đặt

![!](/assets/images/xampp/10.png)

## 4 Cài đặt Laravel

Cài laravel thông qua composer

Bước 1: Truy cập thư mục cần tạo dự án

![!](/assets/images/xampp/11.png)

Bước 2: Gõ lệnh cmd cài đặt

Click chuột phải chọn Open PowerSell Window Here chạy lệnh

```bash
composer create-project --prefer-dist laravel/laravel [tên dự án]  (--prefer-dist: version ổn định nhất của laravel)
```

![!](/assets/images/xampp/12.png)

Thư viện của dự án sẽ được load về như hình bên dưới

![!](/assets/images/xampp/13.png)

Truy cập theo đường dẫn bên dưới trang chủ Laravel hiển thị như ảnh là thành công

![!](/assets/images/xampp/14.png)
