{{ Form::text('name', trans('fptservice::attributes.name'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
{{ Form::text('phone_number', trans('fptservice::attributes.phone_number'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
{{ Form::text('address', trans('fptservice::attributes.address'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
@if($fptServiceCustomer->property_type == \Modules\FptService\Entities\FptServiceCustomer::PROPERTY_TYPE_APARTMENT)
    {{ Form::text('apartment_name', trans('fptservice::attributes.apartment_name'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
    {{ Form::text('building_name', trans('fptservice::attributes.building_name'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
    {{ Form::text('floor_number', trans('fptservice::attributes.floor_number'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
    {{ Form::text('room_number', trans('fptservice::attributes.room_number'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
@endif
{{ Form::text('service', trans('fptservice::attributes.service'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
{{ Form::text('note', trans('fptservice::attributes.note'), $errors, $fptServiceCustomer, ['labelCol' => 2, 'required' => true]) }}
