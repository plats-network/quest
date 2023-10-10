
<div class="row mb-3">
    <div class="col-12 col-sm-8">
        <div class="row mb-3">
            <div class="col-12 col-sm-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Quest</label>
                    <input type="email" readonly class="form-control " id="exampleFormControlInput1" placeholder="Quest" value="{{$data->post? $data->post->name : ''}}">
                    {{--Hidden input $post_id--}}
                    <input type="hidden" name="post_id" value="{{$post_id}}">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-sm-12">
                <div class="form-group">
                    <?php
                    $field_name = 'name';
                    $field_lable = label_case($field_name);
                    $field_placeholder = $field_lable;
                    $required = "required";
                    ?>
                    {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                </div>
            </div>
            @if(false)
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                            <?php
                            $field_name = 'slug';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                        {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                            <?php
                            $field_name = 'group_name';
                            $field_lable = label_case($field_name);
                            $field_placeholder = $field_lable;
                            $required = "";
                            ?>
                        {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                    </div>
                </div>
            @endif
        </div>
        <div class="row mb-3">
            <div class="col-12  col-sm-12">
                <div class="form-group">
                    <?php
                    $field_name = 'description';
                    $field_lable = label_case($field_name);
                    $field_placeholder = $field_lable;
                    $required = "required";
                    ?>
                    {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                    {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->rows(5) }}
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <?php
                    $field_name = 'entry_type';
                    $field_lable = label_case('Task Type');
                    $field_placeholder = "-- Select an option --";
                    $required = "required";
                    $select_options = $all_task_type;
                    ?>
                    {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                    {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-select')->attributes(["$required"]) }}
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <?php
                    $field_name = 'value';
                    $field_lable = 'Action Url';
                    $field_placeholder = $field_lable;
                    $required = "required";
                    ?>
                    {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                </div>
            </div>
        </div>

        <hr>

        <div class="row mb-3" id="taskBlockChain" style="display:  block">
            <div class="col-6 col-sm-6">
                <div class="form-group">
                    <?php
                    $field_name = 'block_chain_network';
                    $field_lable = 'Blockchain Network';
                    $field_placeholder = "-- Select an option --";
                    $required = "";
                    $select_options = [
                        1 => 'Phala',
                        2 => 'Aleph Zero',
                    ];
                    ?>
                    {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                    {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-select')->attributes(["$required"]) }}
                </div>
            </div>

            <div class="col-6 col-sm-6 mt-3">
                <div class="form-group">
                    <?php
                    $field_name = 'total_token';
                    $field_lable = 'Total Token';
                    $field_placeholder = $field_lable;
                    $required = "";
                    ?>
                    {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                    {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                </div>
            </div>
        </div>

    </div>
    <div class="col-12 col-sm-4">
        <div class="row mb-3">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <?php
                    $field_name = 'status';
                    $field_lable = label_case($field_name);
                    $field_placeholder = "-- Select an option --";
                    $required = "required";
                    $select_options = [
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                        'Draft' => 'Draft'
                    ];
                    ?>
                    {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                    {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-select')->attributes(["$required"]) }}
                </div>
            </div>
        </div>
    </div>
</div>


@push ('after-scripts')


    <script type="module">
        $(document).ready(function() {
            //taskBlockChain
            var taskBlockChain = $('#taskBlockChain');
            //taskBlockChain.hide();
            var arrTypeToken = [10,11];
            //Select entry_type on change
            $('#entry_type').on('change', function() {
                var entry_type = $(this).val();
                if (arrTypeToken.includes(parseInt(entry_type))) {
                    $('#taskBlockChain').show();
                } else {
                    $('#taskBlockChain').hide();
                }
            });
        });
    </script>
@endpush
