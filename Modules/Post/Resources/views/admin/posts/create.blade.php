@extends('admin::layout')

@component('admin::components.page.header')
@slot('title', trans('admin::resource.create', ['resource' => trans('post::posts.post')]))

<li><a href="{{ route('admin.posts.index') }}">{{ trans('post::posts.posts') }}</a></li>
<li class="active">{{ trans('admin::resource.create', ['resource' => trans('post::posts.post')]) }}</li>
<div class="button-hidden-sidebarright" style="text-align: left;font-size: 1.5rem;margin-left: -65px;">
    <i aria-hidden="true" class="fa fa-arrows-h"></i>
</div>
@endcomponent
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css">
<style>
    .form-group.status {
        border: 1px solid #ccc;
        padding: 5px 20px;
        display: none;
    }

    .form-group.categories {
        height: 300px;
        overflow-y: scroll;
        border: 1px solid #ccc;
        padding: 5px 0 5px 20px;
    }

    .form-group.tags {
        height: 200px;
        overflow-y: scroll;
        border: 1px solid #ccc;
        padding: 5px 0 5px 20px;
    }

    div.form-check input[type="checkbox"] {
        float: left;
        margin-right: 10px;
    }

    div.form-check label {
        font-weight: 100;
        font-size: 14px;
        font-family: "Roboto", sans-serif;
        float: left;
        width: calc(100% - 23px);
    }

    .form-group .control-label.text-left {
        font-size: 1.2em;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .image-holder:hover {
        cursor: pointer;
    }

    .single-image,
    .single-image>.image-holder,
    #meta_keyword,
    .bootstrap-tagsinput {
        width: 100% !important;
    }

    .list-criteria-seo {
        list-style: none;
    }

    .list-criteria-seo>li {
        font-size: 15px;
        line-height: 28px;
        position: relative;
        clear: both;
        color: #5a6065;
        margin: 1px 0 5px 0;
    }

    .list-criteria-seo i.fa-times-circle {
        color: #f29c96;
        font-size: 1.5em;
        padding-right: 5px;
    }

    .list-criteria-seo i.fa-check-circle {
        color: #58bb58;
        font-size: 1.5em;
        padding-right: 5px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 25px;
        width: 25px;
        left: 4px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .list_select_sidebar {
        display: flex;
        justify-content: center;
    }

    .list_select_sidebar .form-check {
        margin-right: 15px;
    }

    .list_select_sidebar .form-check input {
        display: none;
    }

    .list_select_sidebar .form-check label {
        width: 100%;
        background: #eee;
        padding: 4px;
    }

    .list_select_sidebar .form-check label:hover {
        cursor: pointer;
    }

    .list_select_sidebar .form-check input:checked+label {
        background: #0074a2;
    }
    .media-picker-modal{
        z-index: 1500 !important;
    }
    .column-first-button{
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .sidebar-left{
        transition: .3s width ease-in;
    }
    .sidebar-left.show-full-width{
        width: 100%;
    }
    .sidebar-right{
        transition: .3s all ease-in;
    }
    .sidebar-right.hidden-sidebar{
        transform: translateX(100%);
    }
    .button-hidden-sidebarright i{
        cursor: pointer;
        font-size: 20px;
        transition: .3s all;
    }
    .button-hidden-sidebarright i.active{
        transform: translateX(240px);
    }
    #mm {
        font-size: 12px;
        line-height: 2;
        color: #32373c;
        border-color: #7e8993;
        box-shadow: none;
        border-radius: 3px;
        height: 30px !important;
    }
    #edit_timestamp input{
        font-size: 12px;
        line-height: 2;
        color: #32373c;
        border-color: #7e8993;
        box-shadow: none;
        border-radius: 3px;
        height: 30px !important;
        border: 1px solid #7e8993;
    }
    #timestamp{
        font-size: 14px;
    }
    a[href="#edit_timestamp"]{
        font-size: 14px;
        text-decoration: underline;
    }
</style>
@endpush
@section('content')
<form method="POST" action="{{ route('admin.posts.store') }}" class="form-horizontal" id="post-create-form" novalidate>
    {{ csrf_field() }}

    {{-- {!! $tabs->render(compact('post')) !!} --}}
    <div class="row wrapper-content">
        <div class="col-lg-9 col-md-9 sidebar-left">
            @include('post::admin.posts.tabs.general')
            @include('post::admin.posts.tabs.shortcode')
            @include('post::admin.posts.tabs.seo')
            <div id="options-group" class="sortable">
                <div class="content-accordion panel-group options-group-wrapper" id="option-0">
                    <div class="panel panel-default option">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#thumbnailSidebar-0" href="#thumbnailSidebar"
                                    aria-expanded="true" class="" style="position: relative;
                                                    text-decoration: none;
                                                    overflow: hidden;">

                                    <span class="pull-left">Thumbnail + Sidebar + Table Of Content</span>
                                </a>
                            </h4>
                        </div>

                        <div id="thumbnailSidebar" class="panel-collapse collapse" aria-expanded="true" style="">
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="meta-title" class="col-md-5 control-label text-left">
                                        {{ trans('post::sidebar.is_thumbnail') }}
                                    </label>

                                    <div class="col-md-7">
                                        <label class="switch">
                                            <input type="hidden" value="0" name="is_thumbnail_display">
                                            <input type="checkbox" name="is_thumbnail_display" id="is_thumbnail_display"
                                                value="1" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="meta-title" class="col-md-5 control-label text-left">
                                        {{ trans('post::sidebar.is_toc') }}
                                    </label>

                                    <div class="col-md-7">
                                        <label class="switch">
                                            <input type="hidden" value="0" name="is_toc">
                                            <input type="checkbox" name="is_toc" id="is_toc" value="1" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label for="meta-title" class="col-md-12 control-label text-left">
                                        {{ trans('post::sidebar.sidebar_layout') }}
                                    </label>

                                    <div class="col-md-12 list_select_sidebar">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="sidebar_layout"
                                                value="default" id="sidebar_default" checked>
                                            <label class="form-check-label" for="sidebar_default">
                                                <img src="{{ url('storage/media/lc7RgJnTMV4HSPBhbutgH9ZnYnguftCpVi0QKsyc.png') }}"
                                                    alt="">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="sidebar_layout"
                                                value="sidebar_left" id="sidebar_left">
                                            <label class="form-check-label" for="sidebar_left">
                                                <img src="{{ url('storage/media/GmNKu0Q6ATJXwDME9B5QtVm4Bya5gRrvqvDez9iX.png') }}"
                                                    alt="">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="sidebar_layout"
                                                value="sidebar_right" id="sidebar_right">
                                            <label class="form-check-label" for="sidebar_right">
                                                <img src="{{ url('storage/media/SuMGfPmuQIBp9VYAzAMTryH9NuQ9q2xZ7Lnk090E.png') }}"
                                                    alt="">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="sidebar_layout"
                                                value="no_siderbar" id="no_siderbar">
                                            <label class="form-check-label" for="no_siderbar">
                                                <img src="{{ url('storage/media/Fhf8YQ17i7Qen1ksaGqiOXfZpz1wRDQRSZNL5OlU.png') }}"
                                                    alt="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 sidebar-right">
            <div class="form-group status">
                <div class="control-label text-left">{{trans('post::attributes.is_active')}}</div>
                <div class="checkbox">
                    <input type="hidden" value="0" name="is_active">
                    <input type="checkbox" name="is_active" class="" id="is_active" value="1">
                    <label for="is_active">{{ trans('post::posts.form.enable_the_post') }}</label>
                </div>
            </div>

            <div class="form-group categories">
                <div class="control-label text-left">{{trans('post::attributes.groups')}}</div>
                @foreach ($groups as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" name="groups[]" type="checkbox" value="{{ $key }}"
                        id="defaultCheck{{$key}}">
                    <label class="form-check-label" for="defaultCheck{{$key}}">
                        {{ $value }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="form-group tags">
                <div class="control-label text-left">{{trans('post::attributes.tags')}}</div>
                @foreach ($tags as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $key }}"
                        id="defaultCheckTags{{$key}}">
                    <label class="form-check-label" for="defaultCheckTags{{$key}}">
                        {{ $value }}
                    </label>
                </div>
                @endforeach
            </div>
            <div id="options-group" class="form-group">
                <div class="content-accordion panel-group options-group-wrapper" id="option-0">
                    <div class="panel panel-default option">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#box-puslish" aria-expanded="true" class="" style="position: relative;
                                                    text-decoration: none;
                                                    overflow: hidden;">

                                    <span class="pull-left">Publish</span>
                                </a>
                            </h4>
                        </div>

                        <div id="box-puslish" class="panel-collapse collapse in" aria-expanded="true" style="">
                            <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                                <div class="column-first-button">
                                    <button type="submit" class="btn btn-light" id="saveDraft">Save Draft</button>
                                    <button type="button" class="btn btn-light" id="preview">Preview</button>
                                </div>
                                <div style="margin-bottom: 30px;">
                                    <span id="timestamp"> Published <b>immediately </b> </span>
                                    <a data-toggle="collapse" href="#edit_timestamp" role="button" aria-expanded="false" aria-controls="edit_timestamp">
                                        Edit
                                    </a>
                                    <div class="collapse" id="edit_timestamp">
                                        <div class="card card-body">
                                            <div class="timestamp-wrap">
                                                <label>
                                                    <select id="mm" name="mm" data-month="{!! date('m', strtotime($post->created_at)) !!}">
                                                        <option value="01" data-text="Jan">01-Jan</option>
                                                        <option value="02" data-text="Feb">02-Feb</option>
                                                        <option value="03" data-text="Mar">03-Mar</option>
                                                        <option value="04" data-text="Apr">04-Apr</option>
                                                        <option value="05" data-text="May">05-May</option>
                                                        <option value="06" data-text="Jun">06-Jun</option>
                                                        <option value="07" data-text="Jul">07-Jul</option>
                                                        <option value="08" data-text="Aug">08-Aug</option>
                                                        <option value="09" data-text="Sep">09-Sep</option>
                                                        <option value="10" data-text="Oct">10-Oct</option>
                                                        <option value="11" data-text="Nov">11-Nov</option>
                                                        <option value="12" data-text="Dec">12-Dec</option>
                                                    </select>
                                                </label>
                                                <label>
                                                    <input type="text" id="dd" value="{{ date('d', strtotime($post->created_at)) }}" size="2"
                                                        maxlength="2">
                                                </label>,
                                                <label>
                                                    <input type="text" id="yy" value="{{ date('Y', strtotime($post->created_at)) }}" size="4"
                                                        maxlength="4">
                                                </label>at
                                                <label>
                                                    <input type="text" id="hh" value="{{ date('h', strtotime($post->created_at)) }}" size="2"
                                                        maxlength="2">
                                                </label>:
                                                <label>
                                                    <input type="text" id="mn" value="{{ date('i', strtotime($post->created_at)) }}" size="2"
                                                        maxlength="2">
                                                </label>
                                            </div>
                                        </div>
                                        <p>
                                            <a data-toggle="collapse" href="#edit_timestamp" role="button" aria-expanded="false"
                                                aria-controls="edit_timestamp" class="btn btn-default" id="timestamp-ok">OK</a>
                                            <a data-toggle="collapse" href="#edit_timestamp" role="button" aria-expanded="false"
                                                aria-controls="edit_timestamp">Cancel</a>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" data-loading id="savePublish">
                                        {{ trans('admin::admin.buttons.publish') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('post::admin.posts.tabs.images')
            <input type="hidden" name="over_image" id="over_image" class="image-picker-tiny">
            <input type="hidden" name="created_at" id="created_at">
            <input type="hidden" name="user_id" value="{{ $currentUser->id }}">
        </div>
    </div>
</form>

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>
    function convertToSlug(str){
        return str.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
    }
    function removeVietnameseTones(str) {
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
        str = str.replace(/đ/g,"d");
        str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
        str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
        str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
        str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
        str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
        str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
        str = str.replace(/Đ/g, "D");
        // Some system encode vietnamese combining accent as individual utf-8 characters
        // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
        str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣ huyền, sắc, ngã, hỏi, nặng
        str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛ Â, Ê, Ă, Ơ, Ư
        // Remove extra spaces
        // Bỏ các khoảng trắng liền nhau
        str = str.replace(/ + /g," ");
        str = str.trim();
        // Remove punctuations
        // Bỏ dấu câu, kí tự đặc biệt
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
        return str;
    }

    function seo_check(){
        var meta_keyword = $('#meta-keyword').val().split(",");
        var meta_title = '';
        var meta_description = '';
        var content = '';
        var content_html = '';
        if($('#meta-title').val()){
            meta_title = removeVietnameseTones( $('#meta-title').val().toLowerCase() );
        }
        if($('#meta-description').val()){
            meta_description = removeVietnameseTones( $('#meta-description').val().toLowerCase() );
        }
        if( tinyMCE.get("content").getContent() ){
            content = removeVietnameseTones( tinyMCE.get("content").getContent({format : 'text'}).toLowerCase() );

            content_html = tinyMCE.get("content").getContent().toLowerCase();
        }

        var doc = new DOMParser().parseFromString(content_html, 'text/html');

        var list_tag_heading = doc.querySelectorAll('h1, h2, h3, h4, h5, h6');

        var length_word_content = content.split(' ').length;
        var flag_title = false;
        var flag_description = false;
        var flag_content = false;
        var flag_length_word_content = false;
        var flag_slug = false;
        var flag_key_word_heading = false;
        meta_keyword.forEach(function(item, index){
            var item_convert = removeVietnameseTones(item.toLowerCase());
            if(meta_title.includes(item_convert) && item_convert != ''){
                flag_title = true;
            }
            if(meta_description.includes(item_convert) && item_convert != ''){
                flag_description = true;
            }
            if( (content.startsWith(item_convert) || content.includes(item_convert)) && item_convert != ''){
                flag_content = true;
            }
            if(length_word_content >= 600){
                flag_length_word_content = true;
            }
            if(convertToSlug(meta_title).includes(item_convert) && item_convert != '' ){
                flag_slug = true;
            }

            if(list_tag_heading.length > 0){
                for (let i = 0; i < list_tag_heading.length; i++) {
                    if( removeVietnameseTones(list_tag_heading[i].textContent).includes(item_convert) && item_convert != '' ){
                        flag_key_word_heading = true;
                    }
                }
            }
        });

        // Check SEO title
        if(flag_title) {
            $('.seo-check-keywordInTitle i').removeClass('fa-times-circle');
            $('.seo-check-keywordInTitle i').addClass('fa-check-circle');
        }else{
            $('.seo-check-keywordInTitle i').removeClass('fa-check-circle');
            $('.seo-check-keywordInTitle i').addClass('fa-times-circle');
        }

        // Check SEO description
        if(flag_description) {
            $('.seo-check-keywordInMetaDescription i').removeClass('fa-times-circle');
            $('.seo-check-keywordInMetaDescription i').addClass('fa-check-circle');
        }else{
            $('.seo-check-keywordInMetaDescription i').removeClass('fa-check-circle');
            $('.seo-check-keywordInMetaDescription i').addClass('fa-times-circle');
        }

        // Check SEO content
        if(flag_content) {

            $('.seo-check-keywordIn10Percent i').removeClass('fa-times-circle');
            $('.seo-check-keywordIn10Percent i').addClass('fa-check-circle');

            $('.seo-check-keywordInContent i').removeClass('fa-times-circle');
            $('.seo-check-keywordInContent i').addClass('fa-check-circle');
        }else{
            $('.seo-check-keywordIn10Percent i').removeClass('fa-check-circle');
            $('.seo-check-keywordIn10Percent i').addClass('fa-times-circle');

            $('.seo-check-keywordInContent i').removeClass('fa-check-circle');
            $('.seo-check-keywordInContent i').addClass('fa-times-circle');
        }

        // Check length word content
        if(flag_length_word_content) {
            $('.seo-check-lengthContent i').removeClass('fa-times-circle');
            $('.seo-check-lengthContent i').addClass('fa-check-circle');
        }else{
            $('.seo-check-lengthContent i').removeClass('fa-check-circle');
            $('.seo-check-lengthContent i').addClass('fa-times-circle');
        }

        // Check seo slug
        if(flag_slug) {
            $('.seo-check-keywordInPermalink i').removeClass('fa-times-circle');
            $('.seo-check-keywordInPermalink i').addClass('fa-check-circle');
        }else{
            $('.seo-check-keywordInPermalink i').removeClass('fa-check-circle');
            $('.seo-check-keywordInPermalink i').addClass('fa-times-circle');
        }

        // Check seo heading key word
        if(flag_key_word_heading) {
            $('.seo-check-keywordInHeadingContent i').removeClass('fa-times-circle');
            $('.seo-check-keywordInHeadingContent i').addClass('fa-check-circle');
        }else{
            $('.seo-check-keywordInHeadingContent i').removeClass('fa-check-circle');
            $('.seo-check-keywordInHeadingContent i').addClass('fa-times-circle');
        }
    }
    $(document).ready(function(){
        $('#meta-keyword').tagsinput({
            confirmKeys: [13, 188]
        });
        $('#meta-keyword').on('keypress', function(e){
            if (e.keyCode == 13){
                e.keyCode = 188;
                e.preventDefault();
            };
        });
        // tinyMCE.activeEditor.on('keyup', function (e) {
        //     seo_check();
        // });
        tinyMCE.activeEditor.on('change', function (e) {
            seo_check();
        });
        $('#meta-keyword').on('itemAdded', function(event){
            seo_check();
        });
        $('#meta-keyword').on('itemRemoved', function(){
            seo_check();
        });
        $('#meta-title').on('change', function(){
            seo_check();
        });
        $('#meta-descripiton').on('change', function(){
            seo_check();
        });
    });
</script>
<script>
    function selectDate(){
        var currentMonth = $("#mm").data('month');
        $("#mm").val(currentMonth);
    }
    function checkMinute(){
        if($('#mn').val() >= 60){
            return false;
        }
        return true;
    }

    function checkDate(){
        if($('#dd').val() > 31){
            return false;
        }
        return true;
    }

    function fillDate(){
        var d = new Date();
        var seconds = d.getSeconds();
        var yearD = d.getFullYear();
        var monthD = `${ ('0' + (d.getMonth()+1)).slice(-2) }`;
        var dayD = `${ ('0' + (d.getDate())).slice(-2) }`;
        var hourD = d.getHours();
        var minuteD = d.getMinutes();

        var year = $('#yy').val(yearD);
        var month = $('#mm').val(monthD);
        var day = $('#dd').val(dayD);
        var hour = $('#hh').val(hourD);
        var minute = $('#mn').val(minuteD);


        var stringBack = `${yearD}/${monthD}/${dayD} ${hourD}:${minuteD}:${seconds}`;
        $('#created_at').val(stringBack);
    }
    $(document).ready(function(){
        $('#preview').click(function(){
            const title = $('#name').val();
            var is_toc = 0;
            // if($('#is_toc').is(':checked')){
            //     is_toc = 1;
            // }
            var data = tinyMCE.get("content").getContent({format: 'html'});
            $.ajax({
                method:'POST',
                data: {
                    data,
                    title,
                    is_toc
                },
                dataType: 'html',
                url: '{{ route("pages.post.redirectPreview") }}',
                success: function(respone){
                    window.open( '{{ route("pages.post.preview") }}', '_blank');
                }
            });
        });
        $('#saveDraft').click(function(){
            $('#is_active').prop('checked', false);
        });
        $('#savePublish').click(function(){
            $('#is_active').prop('checked', true);
        });
        $('.button-hidden-sidebarright i').click(function(){
            $(this).toggleClass('active');
            $('.wrapper-content').find('div.sidebar-right').toggleClass('hidden-sidebar');
            $('.wrapper-content').find('div:first-child').toggleClass('show-full-width');
        });
        fillDate();
        $('#timestamp-ok').on('click', function(e){
            if( !checkMinute() || !checkDate()){
                e.stopPropagation();
                return false;
            }
            var monthText = $("#mm option:selected").data('text');

            var year = $('#yy').val();
            var month = $('#mm').val();
            var day = $('#dd').val();
            var hour = $('#hh').val();
            var minute = $('#mn').val();

            var d = new Date();
            var seconds = d.getSeconds();
            var yearD = d.getFullYear();
            var monthD = `${ ('0' + (d.getMonth()+1)).slice(-2) }`;
            var dayD = `${ ('0' + (d.getDate())).slice(-2) }`;
            var hourD = d.getHours();
            var minuteD = d.getMinutes();

            var stringFront = `${monthText}/${day}/${year} at ${hour}:${minute}`;
            var stringBack = `${year}/${month}/${day} ${hour}:${minute}:${seconds}`;
            $('#timestamp b').text(stringFront);
            $('#created_at').val(stringBack);
        });
    });
</script>
@include('post::admin.posts.sections.ckeditor_script')
@endpush
