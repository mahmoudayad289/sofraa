@extends('layouts.app')
@section('title','Create Category')
@inject('model','App\Models\Category')
@section('content')
@section('title_page','Dashboard')
@section('small_title','Create Category')

<section class="content">
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">category Create</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">


            @include('includes.errors')



            {!! Form::model($model, [ 'route' => 'categories.store']) !!}

            @include('categories.form')

            {!! Form::close() !!}

        </div>
    </div>

    <!-- /.card-body -->
</section>
@endsection


@push('scripts')

    <script type = "text/javascript">

        $(document).ready(function () {
            $('#AddCat').click(function (e) {
                e.preventDefault();

                // console.log($('#CatName').val());

                $.ajax({

                    url : '{{ route('categories.store') }}',
                    type: 'post',
                    data : {
                        name : $('#CatName').val(),
                    },
                    success : function (data) {
                        window.location.reload(data);
                    }
                });
            })

        });


    </script>
@endpush
