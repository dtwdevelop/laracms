@extends('admin.layouts.default')
@section('title') {{{ trans("admin/setting.title") }}} :: @parent @stop
@section('content')
    <div class="page-header">
  <h3><a href="{{URL::to('admin/')}}">{{trans('admin/admin.admin_panel')}}</a> >{{trans('admin/setting.title')}}

       </h3>
    </div>

@include("admin.pages.err")
    <div class="row">
        <div class="col-md-12">
     @if(Session::has('info'))
<p class="alert alert-success">{{Session::get('info') }}</p>
@endif
          
            <form action="{{ url('/admin/site_settings/update/') }}" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" value="{{$settings->id}}">
                 
                <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" class="form-control" value="{{$settings->name}}"/>
                </div>
                 
                   <div class="form-group">
                     <label for="title">Ttitle</label>
                     <input type="text" name="title" class="form-control" value="{{$settings->title}}"/>
                </div>
                 
                 
                <div class="form-group">
                     <label for="meta_description">Meta description</label>
                     <input type="text" name="meta_description" class="form-control" value="{{$settings->meta_description}}"/>
                </div>
                 
                  <div class="form-group">
                     <label for="meta_keywords">Meta keywords</label>
                     <input type="text" name="meta_keywords" class="form-control" value="{{$settings->meta_keywords}}"/>
                </div>
                
                
               
        
                <div class="form-group">
      <?= HTML::image( $site->getLogoUrl(),"", array('class' => 'thumb',"width"=>80,'id='>'iconview4'))  ?>

                     <label for="logo">Logo</label>
                       <img id="logoview" src="" width="100" alt="" />
                     <input id="logo" type="file" name="logo" value="{{$site->getLogoUrl()}}" />
                     
                </div>
                 
                 <div class="form-group">
             <?= HTML::image( $site->getFaviconUrl(),"", array('class' => 'thumb',"width"=>80,'id='>'iconview3'))  ?>
                      <label for="favicon">Favicon</label>
                      <img id="faviconview" src="" width="100" alt="" />
                    
                     <input id="favicon" type="file" name="favicon" value="{{$site->getFaviconUrl()}}" />
                     
                </div>
        
              
                               

                 <input type="submit" class="btn btn-primary" value="Update">
           
                 
            </form>

<h3>Social</h3>

            <form class="form-inline" action="{{ url('/admin/site_settings/createsocial/') }}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    @if($socials->count() > 0)
               
                    <button class="btn btn-info " type="submit" >Update</button>
                    <br>
                 
                @endif
               </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 @foreach($socials as $social )
              
               <input class="hid" type="hidden" name="id[]" value="{{$social->id}}">
            <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name[]" class="form-control" value="{{$social->name}}"/>
                </div>
                 
                  <div class="form-group">
                     <label for="icon">Icon</label>
                     <?= HTML::image( App\SiteSocial::getImageUrlIcon($social->id,$social->icon),"", array('class' => 'thumb',"width"=>80,'id='>'iconview2'))  ?>

                      
  
<!--                       <img id="icon" src="" width="100" alt="" />-->
                     <input id="icons" type="file" name="icon[]" value="{{$social->favicon}}" />
                     
                </div>
                
                <div class="form-group">
                     <label for="link">Link</label>
                     <input type="text" name="link[]" class="form-control" value="{{$social->link}}"/>
                </div>
                
                 <div class="form-group">
                     <label for=" order">Order</label>
                     <input type="text" name="order[]" class="form-control" value="{{$social->order}}"/>
                    
                </div>
               
                  <div class="form-group">
                      <a id="del" class="btn btn-warning" href="{{ url('/admin/site_settings/delete', $social->id) }}"   style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                   <i class="fa fa-minus-square"></i>
                    </a>
                </div>
                <br/>
               @endforeach
                
            </form>

       
        
         <div>
             <hr>
    <form id="add" class="form-inline" action="{{ url('/admin/site_settings/add/') }}" method="POST" enctype="multipart/form-data">
                 
             
            <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input class="newhid" type="hidden" name="id[]" value="">
                     <label for="name">Name</label>
                     <input type="text" name="name[]" class="form-control" value=""/>
                </div>
                 
                  <div class="form-group">
                     <label for="icon">Icon</label>
                       <img id="iconview" src="" width="100" alt="" />
                     <input id="icon" type="file" name="icon[]" value="" />
                     
                </div>
                
                <div class="form-group">
                     <label for="link">Link</label>
                     <input type="text" name="link[]" placeholder="http://sample.com/" class="form-control" value=""/>
                </div>
                
                 <div class="form-group">
                     <label for="order">Order</label>
                     <input type="text" name="order[]" class="form-control" placeholder="1" value=""/>
                     <input class="btn add btn-success" type="submit" value="+" >
                </div>
               
           
            </form>
         </div>
        </div>
                
        </div>
    
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    function readURL(input,el) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(el).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logo").change(function () {
        readURL(this,'#logoview');
    });
     $("#favicon").change(function () {
        readURL(this,'#faviconview');
    });
     $("#icon").change(function () {
        readURL(this,'#iconview');
    });
//    $('.add').on('click',function(){
//
//    });
</script>
@endsection



