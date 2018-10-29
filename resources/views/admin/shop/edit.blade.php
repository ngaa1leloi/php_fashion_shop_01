@extends('admin.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ __('text.shop') }}
                    <small>{{ $shop->name }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
                @if (count($errors)>0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                    {{ $err }}<br>
                    @endforeach
                </div>
                @endif

                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                {!! Form::open(['url' => 'admin/shop/edit/' . $shop->id]) !!}
                <div class="form-group">
                    {!! Form::label('name', __('text.name')) !!}
                    {!! Form::text('name', $shop->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('province', __('text.province')) !!}
                    {!! Form::select('province', $branch->pluck('name', 'id'), $shop->branch_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', __('text.address')) !!}
                    {!! Form::text('address', $shop->address, ['class' => 'form-control']) !!} 
                </div>
                <div class="form-group">
                    {!! Form::label('phone', __('text.phone')) !!}
                    {!! Form::text('phone', $shop->phone, ['class' => 'form-control']) !!} 
                </div> 
                {!! Form::submit(__('text.edit'), ['class' => 'btn btn-default']) !!}
                {!! Form::reset(__('text.reset'), ['class' => 'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
