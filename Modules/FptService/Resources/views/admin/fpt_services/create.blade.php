@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('fptservice::fpt_services.fpt_service')]))

    <li><a href="{{ route('admin.fpt_services.index') }}">{{ trans('fptservice::fpt_services.fpt_services') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('fptservice::fpt_services.fpt_service')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.fpt_services.store') }}" class="form-horizontal" id="fpt-service-create-form" novalidate>
        {{ csrf_field() }}
        {!! $tabs->render(compact('fptService')) !!}
    </form>
@endsection

@include('fptservice::admin.fpt_services.partials.shortcuts')
