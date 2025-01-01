@component('admin::components.table')
    @slot('thead')
        @include('product::admin.products.partials.thead')
    @endslot
@endcomponent

@push('scripts')
    <script>
        @php
            $sProducts = array_map('intval', $fptService->productList()->toArray());
        @endphp

        DataTable.setSelectedIds('#products .table', {!! old_json('fpt_service_products', $sProducts) !!});


        DataTable.setRoutes('#products .table', {
            index: 'admin.products.index',
            edit: 'admin.products.edit',
            destroy: 'admin.products.destroy',
        });

        new DataTable('#products .table', {
            pageLength: 10,
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'thumbnail', orderable: false, searchable: false, width: '10%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'price', searchable: false },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });

        $('#fpt-service-create-form, #fpt-service-edit-form').on('submit', function(e) {
            e.preventDefault();
            window.form.appendHiddenInputs('#fpt-service-create-form, #fpt-service-edit-form', 'fpt_service_products', DataTable.getSelectedIds('#products .table'));
            e.currentTarget.submit();
        })
    </script>
@endpush