@extends('_layouts.master')

@section('body')
<section class="container max-w-6xl mx-auto px-6 py-10 md:py-12">
    <div class="flex flex-col-reverse mb-10 lg:flex-row lg:mb-24">
        <div class="mt-8">
            <h1 id="intro-docs-template">{{ $page->siteName }}</h1>

            <h2 id="intro-powered-by-jigsaw" class="font-light mt-4">{{ $page->siteDescription }}</h2>

            <ul class="list-disc list-inside text-lg">
                <li>Tài liệu đào tạo thành viên mới</li>
                <li>Quy ước sử dụng trong công việc</li>
                <li>Báo cáo tìm hiểu công nghệ mới</li>
            </ul>
        </div>

        <img src="/assets/img/logo-large.svg" alt="{{ $page->siteName }} large logo" class="mx-auto mb-6 lg:mb-0 ">
    </div>

    <hr class="block my-8 border lg:hidden">

    <div class="md:flex -mx-2 -mx-4">
        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <h3 id="intro-laravel" class="text-2xl text-blue-900 mb-0">
                <img src="/assets/img/laravel-icon.svg" class="h-16 w-16 inline-block" alt="laravel icon">
                Laravel
            </h3>
            <p>
                Laravel là một framework cho việc xây dựng ứng dụng web với cấu trúc, cú pháp rõ ràng, đơn giản và thông minh. Laravel hướng tới mục đích tạo ra một môi trường phát triển dễ chịu đối với nhà phát triển mà không phải đánh đổi những chức năng của hệ thống.
            </p>
            <a href="/docs/getting-started" title="Tìm hiểu" class="bg-blue-500 hover:bg-blue-600 font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Tìm hiểu</a>
        </div>

        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <h3 id="intro-vuejs" class="text-2xl text-blue-900 mb-0">
                <img src="/assets/img/vuejs-icon.svg" class="h-16 w-12 inline-block" alt="vuejs icon">
                VueJS
            </h3>
            <p>
                Vue là một framework cải tiến cho việc xây dựng giao diện người dùng. Phần thư viện gốc chỉ tập chung vào việc phát triển view layer, và việc dễ dàng tích hợp với các thư viện khác cũng như các dự án đã xây dựng từ trước.
            </p>
            <a href="/docs/getting-started" title="Tìm hiểu" class="bg-blue-500 hover:bg-blue-600 font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Tìm hiểu</a>
        </div>

        <div class="mx-3 px-2 md:w-1/3">
            <h3 id="intro-docker" class="text-2xl text-blue-900 mb-0">
                <img src="/assets/img/docker-icon.svg" class="h-16 w-16 inline-block" alt="docker icon">
                Docker
            </h3>
            <p>
                Docker là một nền tảng mã nguồn mở cho việc phát triển, chuyển giao và thực thi các ứng dụng. Docker cho phép tách ứng dụng với các yêu cầu về hạ tầng nhằm đẩy nhanh tốc độ chuyển giao sản phẩm.<br/>&nbsp;
            </p>
            <a href="/docs/getting-started" title="Tìm hiểu" class="bg-blue-500 hover:bg-blue-600 font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Tìm hiểu</a>
        </div>
    </div>
</section>
@endsection
