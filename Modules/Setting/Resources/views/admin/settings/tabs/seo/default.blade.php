{{ Form::text('fpt_home_meta_title', trans('setting::attributes.meta_title'), $errors, $settings, ['required' => false]) }}
{{ Form::textarea('fpt_home_meta_description', trans('setting::attributes.meta_description'), $errors, $settings, ['required' => false]) }}
{{ Form::text('fpt_home_meta_keyword', trans('setting::attributes.meta_keyword'), $errors, $settings, ['required' => false]) }}
