@extends('layouts.app')
@section('title','Cities')
@section('content')
@section('small_title','Cities')
@inject('model','App\Models\City')
<section class="content">
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cities</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">

            <!-- Start table   -->
            <button type="button" data-toggle="modal" data-target="#exampleModalCenter"  class="btn btn-primary" style="margin-bottom: 20px;">
                <i class="fa fa-plus"></i> Create New  </button>


            <!-- Button trigger modal -->

            @include('flash::message')



        <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::model($model, ['id' => 'AddCity']) !!}

                            @include('cities.form')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>



           <div class="table table-responsive">
               <table class="table">
                   <thead>
                       <th>#</th>
                       <th>Name</th>
                       <th>Governorate</th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </thead>
                   <tbody>

                   @if(count($records))

                       @foreach($records as $record)
                           <tr>
                               <td> {{ $loop->iteration }} </td>
                               <td> {{ $record->name }} </td>
                               <td><a href="{{ route('cities.edit',$record->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit </a> </td>
                               <td>


                                   {!! Form::open(['route' =>  ['cities.destroy' , $record->id], 'method' => 'DELETE']) !!}

                                   <div class="form-group">
                                       <button class="btn btn-danger btn-sm" type="submit"> <i class="fa fa-trash"></i> Delete</button>
                                   </div>

                                   {!! Form::close() !!}
                               </td>
                           </tr>
                       @endforeach

                       @else

                       <div class="alert alert-success">
                           <p> Not Data</p>
                       </div>

                       @endif
                   </tbody>

               </table>
           </div>

            <!-- End table   -->

            <div class="align-items-center">

                {{ $records->links() }}

            </div>


        </div>
    </div>

    <!-- /.card-body -->
</section>
@endsection

@push('scripts')

    <script type = "text/javascript">

        $(document).ready(function () {

            $.ajaxSetup({

                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
                }
            });
            $('#AddCity').on('submit', function (e) {
                e.preventDefault();
                console.log($('#AddCity input').val())

                $.ajax({

                    url : '{{ route('cities.store') }}',
                    type: 'post',
                    data : {
                        name : $('#cityName').val(),
                    },
                    success : function (data) {
                        window.location.reload(data);
                    }
                });
            })

        });


    </script>
@endpush


