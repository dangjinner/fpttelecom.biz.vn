@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('group::groups.groups'))

    <li class="active">{{ trans('group::groups.groups') }}</li>
@endcomponent

@section('content')
    <div class="box box-default">
        <div class="box-body clearfix">
            <div class="col-lg-2 col-md-3">
                <div class="row">
                    <button class="btn btn-default add-root-group">{{ trans('group::groups.tree.add_root_group') }}</button>
                    <button class="btn btn-default add-sub-group disabled">{{ trans('group::groups.tree.add_sub_group') }}</button>

                    <div class="m-b-10">
                        <a href="#" class="collapse-all">{{ trans('group::groups.tree.collapse_all') }}</a> |
                        <a href="#" class="expand-all">{{ trans('group::groups.tree.expand_all') }}</a>
                    </div>

                    <div class="group-tree"></div>
                </div>
            </div>

            <div class="col-lg-10 col-md-9">
                <div class="tab-wrapper group-details-tab">
                    <ul class="nav nav-tabs">
                        <li class="general-information-tab active"><a data-toggle="tab"
                                                                      href="#general-information">{{ trans('group::groups.tabs.general') }}</a>
                        </li>
                        @hasAccess('admin.media.index')
                        <li class="image-tab"><a data-toggle="tab" href="#image">{{ trans('group::groups.tabs.image') }}</a></li>
                        @endHasAccess
                        <li class="seo-tab hide"><a data-toggle="tab"
                                                    href="#seo">{{ trans('group::groups.tabs.seo') }}</a></li>
                    </ul>

                    <form method="POST" action="{{ route('admin.groups.store') }}" class="form-horizontal"
                          id="group-form" novalidate>
                        {{ csrf_field() }}

                        <div class="tab-content">
                            <div id="general-information" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div id="id-field" class="hide">
                                            {{ Form::text('id', trans('group::attributes.id'), $errors, null, ['disabled' => true]) }}
                                        </div>

                                        {{ Form::text('name', trans('group::attributes.name'), $errors, null, ['required' => true]) }}
                                        {{-- {{ Form::wysiwyg('content', trans('post::attributes.content'), $errors, null, ['required' => true]) }} --}}
                                        {{ Form::checkbox('is_searchable', trans('group::attributes.is_searchable'), trans('group::groups.form.show_this_group_in_search_box'), $errors) }}
                                        {{ Form::checkbox('is_active', trans('group::attributes.is_active'), trans('group::groups.form.enable_the_group'), $errors) }}
                                    </div>
                                </div>
                            </div>
                            <div id="image" class="tab-pane fade">
                                <div class="logo">
                                    @include('media::admin.image_picker.single', [
                                    'title' => trans('group::groups.form.logo'),
                                    'inputName' => 'files[logo]',
                                    'file' => (object) ['exists' => false],
                                    ])
                                </div>
                            </div>
                            <div id="seo" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="hide" id="slug-field">
                                            {{ Form::text('slug', trans('group::attributes.slug'), $errors) }}
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            {{ Form::text('meta[meta_title]', trans('fptservice::attributes.meta_title'), $errors) }}
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            {{ Form::text('meta[meta_keyword]', trans('fptservice::attributes.meta_keyword'), $errors) }}
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div>
                                            {{ Form::textarea('meta[meta_description]', trans('fptservice::attributes.meta_description'), $errors) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
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
