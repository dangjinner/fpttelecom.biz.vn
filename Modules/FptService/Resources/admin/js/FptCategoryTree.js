export default class {

    constructor(fptCategoryForm, selector) {
        this.selector = selector;

        $.jstree.defaults.dnd.touch = true;
        $.jstree.defaults.dnd.copy = false;

        this.fetchFptCategoryTree();

        // On selecting a group.
        selector.on('select_node.jstree', (e, node) => fptCategoryForm.fetchFptCategory(node.selected[0]));

        // Expand fpt_categories when jstree is loaded.
        selector.on('loaded.jstree', () => selector.jstree('open_all'));

        // On updating group tree.
        this.selector.on('move_node.jstree', (e, data) => {
            this.updateFptCategoryTree(data);
        });
    }

    fetchFptCategoryTree() {
        this.selector.jstree({
            core: {
                data: { url: route('admin.fpt_categories.tree') },
                check_callback: true,
            },
            plugins: ['dnd'],
        });
    }

    updateFptCategoryTree(data) {
        this.loading(data.node, true);

        $.ajax({
            type: 'PUT',
            url: route('admin.fpt_categories.tree.update'),
            data: { group_tree: this.getFptCategoryTree() },
            success: (message) => {
                success(message);

                this.loading(data.node, false);
            },
            error: (xhr) => {
                error(xhr.responseJSON.message);

                this.loading(data.node, false);
            },
        });
    }

    getFptCategoryTree() {
        let fpt_categories = this.selector.jstree(true).get_json('#', { flat: true });

        return fpt_categories.reduce((formatted, group) => {
            return formatted.concat({
                id: group.id,
                parent_id: (group.parent === '#') ? null : group.parent,
                position: group.data.position,
            });
        }, []);
    }

    loading(node, state) {
        let nodeElement = this.selector.jstree().get_node(node, true);

        if (state) {
            $(nodeElement).addClass('jstree-loading');
        } else {
            $(nodeElement).removeClass('jstree-loading');
        }
    }

}