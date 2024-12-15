@if(!empty($fptCategory))
    <div class="main_package" style="width: 100%;">
        <div class="box_package fpt_category_shortcode_slider">
            @foreach($fptCategory->fptServices as $service)
               @include('public.partials.fpt_service')
            @endforeach
        </div>
    </div>
@endif