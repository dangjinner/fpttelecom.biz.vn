@extends('admin::layout')

@section('title', trans('fpt::fpt.fpt'))

@section('content_header')
    <h3>{{ trans('fpt::fpt.fpt') }}</h3>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}">{{ trans('admin::dashboard.dashboard') }}</a></li>
        <li class="active">{{ trans('fpt::fpt.fpt') }}</li>
    </ol>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.fpt.settings.update') }}" class="form-horizontal" id="fpt-settings-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('settings')) !!}
    </form>
@endsection