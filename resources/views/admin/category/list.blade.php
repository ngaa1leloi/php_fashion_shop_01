@extends('admin.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ __('text.category') }} 
                    <small>{{ __('text.list') }}</small>
                </h1>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>{{ __('text.id') }}</th>
                        <th>{{ __('text.name') }}</th>
                        <th>{{ __('text.slug') }}</th>
                        <th>{{ __('text.delete') }}</th>
                        <th>{{ __('text.edit') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $ca) 
                    <tr class="odd gradeX" align="center">
                        <td>{{ $ca->id }}</td>
                        <td>{{ $ca->name }}</td>
                        <td>{{ $ca->slug }}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('delete_category', ['id' => $ca->id]) }}">{{ __('text.delete') }}</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('edit_category', ['id' => $ca->id]) }}">{{ __('text.edit') }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
