@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('fptservice::fpt_service_customers.fpt_service_customer')]))

    <li><a href="{{ route('admin.fpt_service_customers.index') }}">{{ trans('fptservice::fpt_service_customers.fpt_service_customers') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('fptservice::fpt_service_customers.fpt_service_customer')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.fpt_service_customers.store') }}" class="form-horizontal" id="fpt-service-customer-create-form" novalidate>
        {{ csrf_field() }}
    </form>
@endsection

@include('fptservice::admin.fpt_service_customers.partials.shortcuts')
