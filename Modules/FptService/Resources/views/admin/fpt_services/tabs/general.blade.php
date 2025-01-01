{{ Form::text('name', trans('fptservice::attributes.name'), $errors, $fptService, ['labelCol' => 2, 'required' => true]) }}
{{ Form::wysiwyg('features', trans('fptservice::attributes.features'), $errors, $fptService, ['labelCol' => 2, 'required' => true]) }}
{{ Form::wysiwyg('description', trans('fptservice::attributes.description'), $errors, $fptService, ['labelCol' => 2, 'required' => false]) }}
{{ Form::select('fpt_categories', trans('fptservice::attributes.categories'), $errors, $fptCategories, $fptService, ['class' => 'selectize prevent-creation', 'multiple' => true, 'labelCol' => 2]) }}
{{ Form::text('speed', trans('fptservice::attributes.speed'), $errors, $fptService, ['labelCol' => 2, 'required' => false]) }}
{{ Form::text('promotion_details', trans('fptservice::attributes.promotion_details'), $errors, $fptService, ['labelCol' => 2, 'required' => false]) }}
{{ Form::checkbox('is_active', trans('fptservice::attributes.is_active'), trans('fptservice::fpt_services.form.enable_service'), $errors, $fptService, ['labelCol' => 2, 'required' => false]) }}

