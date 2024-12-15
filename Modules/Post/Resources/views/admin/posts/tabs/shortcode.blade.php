<div id="options-group" class="sortable">
    <div class="content-accordion panel-group options-group-wrapper" id="option-0">
        <div class="panel panel-default option">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#seo" aria-expanded="true" class="" style="position: relative;
                                        text-decoration: none;
                                        overflow: hidden;">

                        <span id="option-name" class="pull-left">Short Code</span>
                    </a>
                </h4>
            </div>

            <div id="seo" class="panel-collapse collapse in" aria-expanded="true" style="">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="meta-title" class="col-md-3 control-label text-left">
                            Choose shortcode
                        </label>
                        <div class="col-md-9">
                            <select name="shortcode" class="form-control form-select">
                                <option value="">Select</option>
                                <option value="fpt_category">FPT Category</option>
{{--                                <option value="fpt_service">FPT Service</option>--}}
                            </select>
                        </div>
                    </div>

                    <div id="additional-options-fpt_category" style="display: none">
                        {{ Form::select('fpt_category_id', trans('post::attributes.fpt_category_id'), $errors, $fptCategories, null, ['required' => true]) }}
                    </div>

                    {{--                    <div id="additional-options-single-product" style="display: none ">--}}
                    {{--                        <div >--}}
                    {{--                            {{ Form::text('shortcode_product_id', 'Product ID', $errors, null,[--}}
                    {{--                              'type' => 'number'--}}
                    {{--                          ]) }}--}}
                    {{--                        </div>--}}
                    {{--                        <div style="display:none;" id="shortcode-single-product-desc">--}}
                    {{--                            {{ Form::textarea('shortcode_single_product_desc', 'Description', $errors, null) }}--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div style="display: none" class="form-group" id="render_shortcode">
                        <label class="col-md-3 control-label text-left">
                            Render Shortcode
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="render_shortcode" class="form-control"
                                   value="" readonly>
                        </div>
                        <div class="col-md-3" style="margin-top: 1rem">
                            <button id="copyText" class="btn btn-primary">Copy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        let shortCode = '';
        let categoryIds = '';
        let limit = 10;
        let col = 5;
        let productId = null;
        let fptCategoryId = 0;

        $('select[name=shortcode]').change(function (e) {
            // Product list shortcode
            if ($(this).val() == 'fpt_category') {
                $('#additional-options-fpt_category').show();
            } else {
                $('#additional-options-fpt_category').hide();
            }

            // Single Product shortcode
            if ($(this).val() == 'fpt_service') {
                $('#additional-options-single-product').show()
            } else {
                $('#additional-options-single-product').hide()
            }
        });

        $("select[name='shortcode_category_id[]']").change(function (e) {
            $('#shortcode_product_limit_box').show('fast');
            categoryIds = $(this).val();
            $('input[name=render_shortcode]').val(`[product_list category_ids="${categoryIds}" limit="${limit}"][/product_list]`);
        });

        $('input[name=shortcode_product_col]').change(function (e) {
            col = $(this).val();
            $('#shortcode_product_col_box').show('fast');
            $('#render_shortcode').show('fast');
            $('input[name=render_shortcode]').val(`[product_list category_ids="${categoryIds}" limit="${limit}" col="${col}"][/product_list]`);
        });

        $('input[name=shortcode_product_limit]').change(function (e) {
            if (typeof parseInt($(this).val()) === 'number') {
                limit = $(this).val();
                $('input[name=render_shortcode]').val(`[product_list category_ids="${categoryIds}" limit="${limit}" col="${col}"][/product_list]`);
                $('#shortcode_product_col_box').show('fast');
            } else {
                $('#render_shortcode').hide('fast');
            }
        });

        // Single product shortcode
        $('input[name=shortcode_product_id]').change(function () {
            const productIdInput = $(this).val();
            if (typeof parseInt(productIdInput) == 'number') {
                productId = productIdInput;
                $('input[name=render_shortcode]').val(`[single_product id="${productIdInput}"][/single_product]`);
                $('#render_shortcode').show('fast');
                $('#shortcode-single-product-desc').show('fast');
            }
        })

        $('#shortcode_single_product_desc').change(function (e) {
            const descTxt = encodeURI($(this).val());
            $('input[name=render_shortcode]').val(`[single_product id="${productId}" desc="${descTxt}"][/single_product]`);
        })

        // Fpt Category shortcode
        $('#fpt_category_id').change(function () {
            fptCategoryId = $(this).val();
            renderShortcode(
                `[fpt_category id="${fptCategoryId}"][/fpt_category]`
            );
        })

        function renderShortcode(shortcode) {
            $('input[name=render_shortcode]').val(shortcode);
            $('#render_shortcode').show('fast');
        }

        $("#copyText").click(function (e) {
            e.preventDefault();
            let $temp = $("<input>");
            $("body").append($temp);
            $temp.val($("input[name=render_shortcode]").val()).select();
            document.execCommand("copy");
            $(this).html('Copied');
            $temp.remove();
        })
    </script>
@endpush