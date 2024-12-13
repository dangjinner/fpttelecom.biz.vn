@extends('public.layout')

@section('content')
    <div class="main_banner">
        <div class="banner_slider">
            <ul class="slider_item">
                @foreach($banner->slides as $slide)
                    <li>
                        <a href="{{ $slide->call_to_action_url }}" @if($slide->open_in_new_window) target="_blank" @endif class="destop"><img src="{{ $slide->file->path }}"
                                                                                                                                              alt="{{ $slide->caption_1 }}"></a>
                        <a href="{{ $slide->call_to_action_url }}" @if($slide->open_in_new_window) target="_blank" @endif class="mobile"><img src="{{ $slide->file->path }}" alt="{{ $slide->caption_1 }}"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="main_breadcrumb">
        <ul>
            <li><a href="">Trang chủ <img src="{{ v(Theme::url('assets/img/arrow-right-black.svg')) }}" alt="arrow"> </a></li>
            <li><a href="{{ route('fpt.news') }}">Tin tức <img src="{{ v(Theme::url('assets/img/arrow-right-black.svg')) }}" alt="arrow"> </a></li>
            @foreach($post->groups as $index => $group)
                @if($index === 0)
                    <li><a href="{{ $group->url() }}">{{ $group->name }}</a></li>
                    @break
                @endif
            @endforeach
        </ul>
    </div>

    @if($group && count($group->children) > 0)
        <div class="main_service">
            <div class="box_service">
                @foreach($group->children as $subGroup)
                    <div class="box_service-item active">
                        <a href="#" class="img">
                            <img src="{{ $subGroup->logo() }}" alt="{{ $subGroup->name }}">
                        </a>
                        <a href="{{ $subGroup->url() }}" class="title">{{ $subGroup->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="page_content">
        <div class="container">
            <div class="box_title">
                <h1>{{ $post->name }}</h1>
                <div class="date-promotion">
                    @foreach($post->groups as $group)
                        <a href="{{ $group->url() }}" class="text-pink">{{ $group->name }}</a>
                        <span class="text-pink">|</span>
                    @endforeach
                    <span>{{ $post->dateTime }}</span>
                </div>
            </div>
            <div class="article_content">
               {!! \Modules\AutoLink\Helpers\RenderAutoLink::handle($post->content) !!}
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

    <div class="other_news">
        <div class="container">
            <div class="box_title">
                <img src="{{ v(Theme::url('assets/img/other-news.png')) }}" alt="other-news">
                <h3>tin khác</h3>
            </div>
            <div class="other_news-list slider_other_news">
                @foreach($otherPosts as $otherPost)
                    <div class="list_item">
                        <a href="{{ $otherPost->url() }}">
                            <div class="img"><img src="{{ $otherPost->logo->path }}" alt="{{ $otherPost->name }}"></div>
                            <div class="text">{{ $otherPost->name }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection