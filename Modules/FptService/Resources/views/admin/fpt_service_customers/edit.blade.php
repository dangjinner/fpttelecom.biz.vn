@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('fptservice::fpt_service_customers.fpt_service_customer')]))
    @slot('subtitle', '')

    <li><a href="{{ route('admin.fpt_service_customers.index') }}">{{ trans('fptservice::fpt_service_customers.fpt_service_customers') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('fptservice::fpt_service_customers.fpt_service_customer')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.fpt_service_customers.update', $fptServiceCustomer) }}" class="form-horizontal" id="fpt-service-customer-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}
        {!! $tabs->render(compact('fptServiceCustomer')) !!}
    </form>
@endsection

@include('fptservice::admin.fpt_service_customers.partials.shortcuts')
