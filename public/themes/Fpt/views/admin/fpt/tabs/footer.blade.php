<h5 style="margin-bottom: 10px; color: #0a53be; font-weight: bold">Right section</h5>
{{ Form::wysiwyg('fpt_footer_right', null, $errors, $settings, ['placeholder' => trans('fpt::fpt.form.fpt_footer_right'), 'labelCol' => 0]) }}
<div class="media-picker-divider"></div>

@include('media::admin.image_picker.single', [
           'title' => trans('fpt::fpt.form.fpt_footer_noticed_gov_image'),
           'inputName' => "fpt_footer_noticed_gov_image",
           'file' => $noticedGovImage,
       ])

{{ Form::text("fpt_footer_noticed_gov_url", trans('fpt::fpt.form.fpt_footer_noticed_gov_url'), $errors, $settings) }}
<div class="media-picker-divider"></div>
