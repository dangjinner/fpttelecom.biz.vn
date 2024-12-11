@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('fptservice::fpt_categories.fpt_categories'))

    <li class="active">{{ trans('fptservice::fpt_categories.fpt_categories') }}</li>
@endcomponent

@section('content')
    <div class="box box-default">
        <div class="box-body clearfix">
            <div class="col-md-4">
                <div class="row">
                    <button class="btn btn-default add-root-fpt_category">{{ trans('fptservice::fpt_categories.tree.add_root_fpt_category') }}</button>
                    <button class="btn btn-default add-sub-fpt_category disabled">{{ trans('fptservice::fpt_categories.tree.add_sub_fpt_category') }}</button>

                    <div class="m-b-10">
                        <a href="#" class="collapse-all">{{ trans('fptservice::fpt_categories.tree.collapse_all') }}</a>
                        |
                        <a href="#" class="expand-all">{{ trans('fptservice::fpt_categories.tree.expand_all') }}</a>
                    </div>

                    <div class="fpt_category-tree"></div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-wrapper fpt_category-details-tab">
                    <ul class="nav nav-tabs">
                        <li class="general-information-tab active"><a data-toggle="tab"
                                                                      href="#general-information">{{ trans('fptservice::fpt_categories.tabs.general') }}</a>
                        </li>
                        <li class="image-tab"><a data-toggle="tab"
                                                 href="#image">{{ trans('fptservice::fpt_categories.tabs.image') }}</a>
                        </li>
                        <li class="seo-tab hide"><a data-toggle="tab"
                                                    href="#seo">{{ trans('fptservice::fpt_categories.tabs.seo') }}</a>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('admin.fpt_categories.store') }}" class="form-horizontal"
                          id="fpt_category-form" novalidate>
                        {{ csrf_field() }}

                        <div class="tab-content">
                            <div id="general-information" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="id-field" class="hide">
                                            {{ Form::text('id', trans('fptservice::attributes.id'), $errors, null, ['disabled' => true]) }}
                                        </div>

                                        {{ Form::text('name', trans('fptservice::attributes.name'), $errors, null, ['required' => true]) }}
                                        {{ Form::wysiwyg('description', trans('fptservice::attributes.description'), $errors, null, ['required' => false]) }}
                                        {{ Form::checkbox('is_searchable', trans('fptservice::attributes.is_searchable'), trans('fptservice::fpt_categories.form.show_this_fpt_category_in_search_box'), $errors) }}
                                        {{ Form::checkbox('is_active', trans('fptservice::attributes.is_active'), trans('fptservice::fpt_categories.form.enable_the_fpt_category'), $errors) }}
                                    </div>
                                </div>
                            </div>
                            <div id="image" class="tab-pane fade">
                                <div class="logo">
                                    @include('media::admin.image_picker.single', [
                                        'title' => trans('fptservice::fpt_services.form.logo'),
                                        'inputName' => 'files[logo]',
                                        'file' => (object) ['exists' => false],
                                    ])
                                </div>
                                <div class="banner">
                                    @include('media::admin.image_picker.single', [
                                        'title' => trans('fptservice::fpt_services.form.banner'),
                                        'inputName' => 'files[banner]',
                                        'file' => (object) ['exists' => false],
                                    ])
                                </div>
                            </div>
                            <div id="seo" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="hide" id="slug-field">
                                            {{ Form::text('slug', trans('fptservice::attributes.slug'), $errors) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-fpt_category">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-primary" data-loading>
                                        {{ trans('admin::admin.buttons.save') }}
                                    </button>

                                    <button type="button" class="btn btn-link text-red btn-delete p-l-0 hide"
                                            data-confirm>
                                        {{ trans('admin::admin.buttons.delete') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="overlay loader hide">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
