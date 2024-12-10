@include('media::admin.image_picker.single', [
    'title' => trans('fptservice::fpt_services.form.logo'),
    'inputName' => 'files[logo]',
    'file' => $fptService->logo,
])

<div class="media-picker-divider"></div>
