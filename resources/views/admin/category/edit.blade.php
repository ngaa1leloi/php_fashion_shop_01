@extends('admin.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{!! __('text.category') !!}
                    <small>{!! __('text.edit') !!}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $message)
                    {{ $message }}<br>
                    @endforeach
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                 {{ session('success') }}
             </div>
             @endif
             {!! Form::open(['route' => ['edit_category', $category->id], 'method' => 'post' ]) !!}
             <div class="form-group">
                {!! Form::label(null, __('text.category_name')) !!}
                {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => __('text.enter_category_name')]) !!}
            </div>
            <div class="form-group">
                @foreach ($list_top_category as $cat)
                @if ($top_category_id == $cat->id)
                {!! Form::label(null, null, ['class' => 'radio-inline']) !!}
                {!! Form::radio('top_category', $cat->id, true) !!} {{ $cat->name }}
                @else
                {!! Form::label(null, null, ['class' => 'radio-inline']) !!}
                {!! Form::radio('top_category', $cat->id) !!} {{ $cat->name }}
                @endif
                @endforeach
            </div> 
            <div class="form-group">
                {!! Form::label(null, __('text.parent_category')) !!}
                {!! Form::select('parent_category', [''], $category->parent_id, ['class' => 'form-control', 'data-parentid' => $category->parent_id]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(null, __('text.priority')) !!}
                {!! Form::text('priority', $category->priority, ['class' => 'form-control', 'placeholder' => __('text.input_1,2')]) !!}
            </div>
            {!! Form::submit(__('text.edit_category'), ['class' => ['btn', 'btn-default']]) !!}
            {!! Form::reset(__('text.reset'), ['class' => ['btn', 'btn-default']]) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var top_category_id = $('input[name = "top_category"]:checked').val();
        var parent_id = $('select[name = "parent_category"]').data('parentid');
        $.get('admin/ajax/category/' + top_category_id, function(data) {
            $('select[name = parent_category]').html('');
            $.each(data, function() {
                $.each(this, function(index, val) {
                    if (index == parent_id) {
                        $('select[name = parent_category]').append("<option value='" + index + "'selected>" + val + "</option>");
                    } else {
                        $('select[name = parent_category]').append("<option value='" + index + "'>" + val + "</option>");
                    }
                });
            });
        });

        $('input[name = "top_category"]').change(function(event) {
            var selected_top_category_id = $(this).val();
            $.get('admin/ajax/category/' + selected_top_category_id, function(data) {
                $('select[name = parent_category]').html('');
                $.each(data, function() {
                    $.each(this, function(index, val) {
                        $('select[name = parent_category]').append("<option value='" + index + "'>" + val + "</option>");
                    });
                });
            });
        });
    });
</script>
@endsection
