@extends('public.layout')
@push('styles')
    <style>

    </style>
@endpush
@section('content')
    <div class="main_banner"></div>
    <div class="page_content">
        <div class="container">
            <div class="box_title">
                <h1>{{ $page->name }}</h1>
                <div class="date-promotion">
                    <span>{{ $page->dateTime }}</span>
                </div>
            </div>
            <div class="article_content">
                {!! \Modules\AutoLink\Helpers\RenderAutoLink::handle($page->body) !!}
            </div>
            <div class="page_content-bt">
                <ul class="facebook">
                    <li><a href=""><i class="fas fa-thumbs-up"></i> thích <span>0</span></a></li>
                    <li><a href="#">chia sẻ</a></li>
                </ul>
                <ul class="save">
                    <ul>
                        <li><img src="{{ v(Theme::url('assets/img/icon/i-print.png')) }}" alt="print"></li>
                        <li><a href="#"><img src="{{ v(Theme::url('assets/img/icon/i-mail.png')) }}" alt=""></a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>

@endsection