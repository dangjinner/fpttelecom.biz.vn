@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('fptservice::fpt_services.fpt_services'))

    <li class="active">{{ trans('fptservice::fpt_services.fpt_services') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'fpt_services')
    @slot('name', trans('fptservice::fpt_services.fpt_service'))

    @component('admin::components.table')
        @slot('thead')
            <tr>
                @include('admin::partials.table.select_all')
                <th>{{ trans('fptservice::fpt_services.table.logo') }}</th>
                <th>{{ trans('fptservice::fpt_services.table.name') }}</th>
                <th>{{ trans('fptservice::fpt_services.table.price') }}</th>
                <th>{{ trans('fptservice::fpt_services.table.status') }}</th>
                <th>{{ trans('fptservice::fpt_services.table.created_at') }}</th>
            </tr>
        @endslot
    @endcomponent
@endcomponent

@push('scripts')
    <script>
        new DataTable('#fpt_services-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'logo' },
                { data: 'name', name: 'translations.name', orderable: true, searchable: true },
                { data: 'price', name: 'price', orderable: true, searchable: true },
                { data: 'status', name: 'is_active' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
