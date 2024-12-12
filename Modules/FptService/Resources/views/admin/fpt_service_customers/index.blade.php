@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('fptservice::fpt_service_customers.fpt_service_customers'))

    <li class="active">{{ trans('fptservice::fpt_service_customers.fpt_service_customers') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'fpt_service_customers')
    @slot('name', trans('fptservice::fpt_service_customers.fpt_service_customer'))

    @component('admin::components.table')
        @slot('thead')
            <tr>
                @include('admin::partials.table.select_all')
                <th>{{ trans('fptservice::fpt_service_customers.table.name') }}</th>
                <th>{{ trans('fptservice::fpt_service_customers.table.phone_number') }}</th>
                <th>{{ trans('fptservice::fpt_service_customers.table.service') }}</th>
                <th>{{ trans('fptservice::fpt_service_customers.table.created_at') }}</th>
            </tr>
        @endslot
    @endcomponent
@endcomponent

@push('scripts')
    <script>
        new DataTable('#fpt_service_customers-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'name', name: 'name', orderable: true, searchable: true },
                { data: 'phone_number', name: 'phone_number', orderable: true, searchable: true },
                { data: 'service', orderable: true, searchable: true },
                { data: 'created', name: 'created_at', orderable: true, searchable: true },
            ],
        });
    </script>
@endpush
