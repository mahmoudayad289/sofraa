@extends('layouts.app')
@section('title','Contacts')
@section('content')
@section('small_title','Contacts')
<section class="content">
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contacts</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">


            <div class="table table-responsive">
                <table class="table">
                    <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>phone</th>
                    <th>Message</th>
                    <th>Delete</th>
                    </thead>
                    <tbody>

                    @if(count($records))

                        @foreach($records as $record)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $record->name }} </td>
                                <td> {{ $record->email }} </td>
                                <td> {{ $record->subject }} </td>
                                <td> {{ $record->phone }} </td>
                                <td> {{ $record->message }} </td>
                                <td>
                                    {!! Form::open(['route' =>  ['contacts.destroy' , $record->id], 'method' => 'DELETE']) !!}

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


