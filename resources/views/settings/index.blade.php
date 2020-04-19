@extends('layouts.app')
@section('title','Settings')
@section('content')
@section('small_title','Settings')
<section class="content">
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Settings</h3>

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
                    <th>About App</th>
                    <th>commission</th>
                    <th>Edit</th>
                    </thead>
                    <tbody>

                    @if($records)


                            <tr>
                                <td> #</td>
                                <td> {{ $records->about_app }} </td>
                                <td> {{ $records->commission }} </td>
                                <td> <a href="{{ route('settings.edit',$records->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit </a> </td>
                            </tr>

                    @else

                        <div class="alert alert-success">
                            <p> Not Data</p>
                        </div>

                    @endif
                    </tbody>

                </table>
            </div>

            <!-- End table   -->

        </div>
    </div>

    <!-- /.card-body -->
</section>
@endsection


