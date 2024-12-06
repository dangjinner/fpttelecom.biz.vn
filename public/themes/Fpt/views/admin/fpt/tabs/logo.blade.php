@include('media::admin.image_picker.single', [
    'title' => trans('fpt::fpt.form.favicon'),
    'inputName' => 'fpt_favicon',
    'file' => $favicon,
])

<div class="media-picker-divider"></div>

@include('media::admin.image_picker.single', [
    'title' => trans('fpt::fpt.form.header_logo'),
    'inputName' => 'translatable[fpt_header_logo]',
    'file' => $headerLogo,
])

<div class="media-picker-divider"></div>

@include('media::admin.image_picker.single', [
    'title' => trans('fpt::fpt.form.footer_logo'),
    'inputName' => 'translatable[fpt_footer_logo]',
    'file' => $footerLogo,
])


