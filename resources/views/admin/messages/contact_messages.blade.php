
@extends('admin.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ trans("admin/contact_messages.message") }}} :: @parent @stop

 
@section('content')
    <div class="page-header">
      <h3>  <a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >{{trans('admin/contact_messages.message')}}
        </h3>
        
    </div>


    <div class="row">
        <div class="col-md-12">
                 @if(Session::has('info'))
<p class="alert alert-success">{{Session::get('info') }}</p>
@endif
            <table class="table table-striped">
                <thead>
                    <tr>
                       
                       
                        <th class="text-left">Id</th>
                        <th class="text-left">Name</th>
                         <th class="text-left">Message</th>
                           <th class="text-left">Createad</th>
                           <th class="text-left"> </th>
                    </tr>
                </thead>

                <tbody>
               
                @foreach($messages as $message)
                <tr>
                       <td class="text-left">
                       {{$message->id}}
                    </td>
                    <td>{{$message->name}}</td>
                     
                  
                     <td class="text-left">
                       {{str_limit($message->message,70)}}
                    </td>
                    <td>
                        
                         {{ date('M d Y  h:m', strtotime($message->updated_at)) }}
                    </td>
                    <td>
                        <a class="btn btn-success btn-sm" onclick="" href="{{url('/admin/contact_messages/view',$message->id)}}">View</a>
                      @if($message->is_reviewed  > 0)  <button class="btn btn-default btn-sm">  <span class="glyphicon  glyphicon-ok "></span></button> @endif
                        @if($message->is_reviewed  < 1)  
                    <a class="btn btn-primary btn-sm" onclick="if(confirm('Reviewed? Are you sure?')) { return true } else {return false };" href="{{url('/admin/contact_messages/review',$message->id)}}">Reviewed</a>
                   
                   
                   @endif
                    </td>
                </tr>

                @endforeach

               
                </tbody>
            </table>

          <?= $messages->render(); ?>
        
        </div>
    </div>



@endsection


