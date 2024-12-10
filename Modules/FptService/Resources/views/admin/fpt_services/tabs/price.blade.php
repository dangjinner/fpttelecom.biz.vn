{{ Form::text('price', trans('fptservice::attributes.price'), $errors, $fptService, ['labelCol' => 2, 'required' => true]) }}
{{ Form::text('billing_cycle', trans('fptservice::attributes.billing_cycle'), $errors, $fptService, ['labelCol' => 2, 'required' => true]) }}

