@extends('public.layout')

@push('styles')
    <style>
        .wrap_news-text .content {
            display: -webkit-box;
            -webkit-line-clamp: 4; /* Số dòng tối đa hiển thị */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        }
    </style>
@endpush

@section('content')
    <div class="main_banner">
        <div class="banner_slider">
            <ul class="slider_item">
                @foreach($banner->slides as $slide)
                    <li>
                        <a href="{{ $slide->call_to_action_url }}" @if($slide->open_in_new_window) target="_blank"
                           @endif class="destop"><img src="{{ $slide->file->path }}"
                                                      alt="{{ $slide->caption_1 }}"></a>
                        <a href="{{ $slide->call_to_action_url }}" @if($slide->open_in_new_window) target="_blank"
                           @endif class="mobile"><img src="{{ $slide->file->path }}" alt="{{ $slide->caption_1 }}"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="main_breadcrumb">
        <ul>
            <li><a href="">Trang chủ <img src="{{ v(Theme::url('assets/img/arrow-right-black.svg')) }}" alt="arrow">
                </a></li>
            <li><a href="{{ route('fpt.news') }}">Tin tức
                    @if(!empty($currentGroup))
                        <img src="{{ v(Theme::url('assets/img/arrow-right-black.svg')) }}" alt="arrow">
                    @endif
                </a></li>
            @if(!empty($currentGroup))
                <li><a href="{{ $currentGroup->url() }}">{{ $currentGroup->name }}</a></li>
            @endif
        </ul>
    </div>

    @if(count($groups) > 0)
        <div class="main_service">
            <div class="box_service">
                @foreach($groups as $group)
                    <div class="box_service-item">
                        <a href="{{ $group->url() }}" class="img">
                            <img src="{{ $group->logo->path }}" alt="{{ $group->name }}">
                        </a>
                        <a href="" class="title">{{ $group->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="page_news">
        <div class="container">
            <div class="news-title">
                <div class="img">
                    <img src="{{ v(Theme::url('assets/img/icon/latest-news.png')) }}" alt="">
                </div>
                <h2>tin mới nhất</h2>
            </div>
        </div>
        <div class="container">
            @if(count($posts) > 0)
                <div class="row wrap_news">
                    <div class="col-lg-8 col-md-8">
                        <div class="box_news-img">
                            <div class="img">
                                <div class="team_new">
                                    <img src="{{ v(Theme::url('assets/img/icon/new.png')) }}" alt="new">
                                </div>
                                <a href="{{ $posts[0]->url() }}"> <img src="{{ $posts[0]->logo->path }}"
                                                                       alt="{{ $posts[0]->name }}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="wrap_news-text">
                            <div class="title">
                                <h3><a href="{{ $posts[0]->url() }}">{{$posts[0]->name}}</a>
                                </h3>
                            </div>
                            <div class="date-promotion">
                                @foreach($posts[0]->groups as $group)
                                    <a href="{{ $group->url() }}" class="text-pink">{{ $group->name }}</a>
                                    <span class="text-pink">|</span>
                                @endforeach
                                <span>{{ $posts[0]->dateTime }}</span>
                            </div>
                            <div class="content">
                                {!! $posts[0]->description !!}
                            </div>
                            <a href="{{ $posts[0]->url() }}" class="read_more"> <i class="fas fa-angle-right"></i> Tìm
                                hiểu</a>

                        </div>
                    </div>
                </div>
            @endif

            <div class="box_list-news row">
                @foreach($posts as $index => $post)
                    @if($index > 0)
                        <div class="col-lg-4 col-md-4">
                            <div class="news_item">
                                <div class="new_img">
                                    <a href="{{ $post->url() }}"><img src="{{ $post->logo->path }}" alt=""></a>
                                </div>
                                <div class="wrap_news-text">
                                    <div class="title">
                                        <h3><a href="{{ $post->url() }}">
                                                {{ $post->name }}
                                            </a></h3>
                                    </div>
                                    <div class="date-promotion">
                                        @foreach($post->groups as $group)
                                            <a href="{{ $group->url() }}" class="text-pink">{{ $group->name }}</a>
                                            <span class="text-pink">|</span>
                                        @endforeach
                                        <span>{{ $post->dateTime }}</span>
                                    </div>
                                    <div class="content">
                                        {!! $post->description !!}
                                    </div>
                                    <a href="{{ $post->url() }}" class="read_more"> <i class="fas fa-angle-right"></i>
                                        Tìm hiểu</a>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="next_page">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection