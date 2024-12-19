@extends('public.layout')

@section('content')
    <div class="main_banner">
        <div class="page_banner">
            @php
                $bannerPath = $fptCategory->banner->path;
                if (empty($bannerPath) && !empty($fptCategory->parent)) {
                    $bannerPath = $fptCategory->parent->banner->path;
                }
            @endphp
            <img src="{{ $bannerPath }}" alt="banner">
        </div>
        <div class="page_banner-mb">
            <img src="{{ $bannerPath }}" alt="banner">
        </div>
    </div>
    <div class="breadcrumb_sv">
        <div class="list_service">
            <ul>
                @foreach($fptCategories as $category)
                    <li class="@if($category->id === $fptCategory->id) active @endif">
                        <a href="{{ route('fpt.services.category', ['slug' => $category->slug]) }}">
                            <img src="{{ $category->logo->path }}" alt="{{ $category->name }}">
                            <span>{{ $category->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="main_package" style="margin-bottom: 100px;">
        <div class="package_title">
           {!! $fptCategory->description !!}
        </div>
        <div class="box_package silder_package">
            @foreach($fptCategory->fptServices as $service)
                @include('public.partials.fpt_service')
            @endforeach
        </div>
    </div>
@endsection