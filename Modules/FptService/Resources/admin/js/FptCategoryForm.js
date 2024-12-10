import FptCategoryTree from './FptCategoryTree';

export default class {

    constructor() {
        let tree = $('.fpt_category-tree');

        new FptCategoryTree(this, tree);

        this.collapseAll(tree);
        this.expandAll(tree);
        this.addRootFptCategory();
        this.addSubFptCategory();

        $('#fpt_category-form').on('submit', this.submit);

    }

    collapseAll(tree) {
        $('.collapse-all').on('click', (e) => {
            e.preventDefault();

            tree.jstree('close_all');
        });
    }

    expandAll(tree) {
        $('.expand-all').on('click', (e) => {
            e.preventDefault();

            tree.jstree('open_all');
        });
    }

    addRootFptCategory() {
        $('.add-root-fpt-category').on('click', () => {
            this.loading(true);

            $('.add-sub-fpt-category').addClass('disabled');

            $('.fpt_category-tree').jstree('deselect_all');

            this.clear();

            // Intentionally delay 150ms so that user feel new form is loaded.
            setTimeout(this.loading, 150, false);
        });
    }

    addSubFptCategory() {
        $('.add-sub-fpt-category').on('click', () => {
            let selectedId = $('.fpt_category-tree').jstree('get_selected')[0];

            if (selectedId === undefined) {
                return;
            }

            this.clear();
            this.loading(true);

            window.form.appendHiddenInput('#fpt_category-form', 'parent_id', selectedId);

            // Intentionally delay 150ms so that user feel new form is loaded.
            setTimeout(this.loading, 150, false);
        });
    }

    fetchFptCategory(id) {
        this.loading(true);

        $('.add-sub-fpt-category').removeClass('disabled');

        $.ajax({
            type: 'GET',
            url: route('admin.fpt_categories.show', id),
            success: (fpt_category) => {
                this.update(fpt_category);

                this.loading(false);
            },
            error: (xhr) => {
                error(xhr.responseJSON.message);

                this.loading(false);
            },
        });
    }

    update(fpt_category) {
        window.form.removeErrors();

        $('.btn-delete').removeClass('hide');
        $('.form-fpt_category .help-block').remove();

        $('#confirmation-form').attr('action', route('admin.fpt_categories.destroy', fpt_category.id));

        $('#id-field').removeClass('hide');

        $('#id').val(fpt_category.id);
        $('#name').val(fpt_category.name);

        $('#slug').val(fpt_category.slug);
        $('#slug-field').removeClass('hide');
        $('.fpt_category-details-tab .seo-tab').removeClass('hide');

        $('#is_searchable').prop('checked', fpt_category.is_searchable);
        $('#is_active').prop('checked', fpt_category.is_active);

        $('#fpt_category-form input[name="parent_id"]').remove();
    }

    clear() {
        $('#id-field').addClass('hide');

        $('#id').val('');
        $('#name').val('');

        $('#slug').val('');
        $('#slug-field').addClass('hide');
        $('.fpt_category-details-tab .seo-tab').addClass('hide');

        $('#is_searchable').prop('checked', false);
        $('#is_active').prop('checked', false);

        $('.btn-delete').addClass('hide');
        $('.form-fpt_category .help-block').remove();

        $('#fpt_category-form input[name="parent_id"]').remove();

        $('.general-information-tab a').click();
    }

    loading(state) {
        if (state === true) {
            $('.overlay.loader').removeClass('hide');
        } else {
            $('.overlay.loader').addClass('hide');
        }
    }

    submit(e) {
        let selectedId = $('.fpt_category-tree').jstree('get_selected')[0];

        if (! $('#slug-field').hasClass('hide')) {
            window.form.appendHiddenInput('#fpt_category-form', '_method', 'put');

            $('#fpt_category-form').attr('action', route('admin.fpt_categories.update', selectedId));
        }
        e.currentTarget.submit();
    }

}