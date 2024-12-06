{{--Feature 1--}}
@for($i = 1; $i <= 4; $i++)
    <div>
        <h5 style="margin-bottom: 10px; color: #0a53be; font-weight: bold">Feature {{ $i }}</h5>
        @include('media::admin.image_picker.single', [
            'title' => trans('fpt::fpt.form.home_page_feature_logo'),
            'inputName' => "home_page_feature_{$i}_logo",
            'file' => $featureLogos[$i],
        ])
        <div class="media-picker-divider"></div>
        {{ Form::text("home_page_feature_{$i}_name", trans('fpt::fpt.form.home_page_feature_name'), $errors, $settings) }}
        {{ Form::text("home_page_feature_{$i}_desc", trans('fpt::fpt.form.home_page_feature_desc'), $errors, $settings) }}
        {{ Form::text("home_page_feature_{$i}_url", trans('fpt::fpt.form.home_page_feature_url'), $errors, $settings) }}
        <div class="media-picker-divider"></div>
    </div>
@endfor

