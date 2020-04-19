@extends('layouts.app')
@section('title','orders')
@section('content')
@section('small_title','orders')
<section class="content">
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">orders</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">

            <!-- Start table   -->
            <a href="{{ route('orders.create') }}" class="btn btn-primary" style="margin-bottom: 20px;"> <i class="fa fa-plus"></i> Create New  </a>

            @include('flash::message')


           <div class="table table-responsive">
               <table class="table">
                   <thead>
                       <th>#</th>
                       <th>Restaurant</th>
                       <th>Client</th>
                       <th>Amount</th>
                       <th>Address</th>
                       <th>Notes</th>
                       <th>spacial order </th>
                       <th>payment method </th>
                       <th>State </th>
                       <th>Cost </th>
                       <th>Delivery cost </th>
                       <th>Total </th>
                       <th>commission </th>
                       <th>rest </th>
                       <th>Edit</th>
                       <th>Delete</th>
                   </thead>
                   <tbody>

                   @if(count($records))

                       @foreach($records as $record)
                           <tr>
                               <td> {{ $loop->iteration }} </td>
                               <td> {{ $record->restaurant->name }} </td>
                               <td> {{ $record->client->name }} </td>
                               <td> {{ $record->amount }} </td>
                               <td> {{ $record->address }} </td>
                               <td> {{ $record->notes }} </td>
                               <td> {{ $record->spacial_order }} </td>
                               <td> {{ $record->payment_method }} </td>
                               <td> {{ $record->statue }} </td>
                               <td> {{ $record->cost }} </td>
                               <td> {{ $record->delivery_cost }} </td>
                               <td> {{ $record->total }} </td>
                               <td> {{ $record->commission }} </td>
                               <td> {{ $record->rest }} </td>
                               <td><a href="{{ route('orders.edit',$record->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit </a> </td>
                               <td>


                                   {!! Form::open(['route' =>  ['orders.destroy' , $record->id], 'method' => 'DELETE']) !!}

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


