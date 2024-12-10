@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('fptservice::fpt_services.fpt_service')]))
    @slot('subtitle', '')

    <li><a href="{{ route('admin.fpt_services.index') }}">{{ trans('fptservice::fpt_services.fpt_services') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('fptservice::fpt_services.fpt_service')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.fpt_services.update', $fptService) }}" class="form-horizontal" id="fpt-service-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}
        {!! $tabs->render(compact('fptService')) !!}
    </form>
@endsection

@include('fptservice::admin.fpt_services.partials.shortcuts')
