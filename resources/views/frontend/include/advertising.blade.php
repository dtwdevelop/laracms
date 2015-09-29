<?php

$add = Session::get('reklama');
?>
<div class="addsave">


    <div class="modal addv fade bs-example-modal-lg " tabindex="-1000" role="dialog">
        <div class="modal-dialog modal-lg modadd">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                @if(isset($add))

                <img src="{{$add->getImageUrl()}}" alt="no load" />
                <p></p><a style="background: orange" class="btn s addbutton" href="/#products">Order now !</a></p>

                @endif
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery.cookie.js"></script>
<script type="text/javascript">
    jQuery(function () {

        $(window).load(function () {
            @if(isset($add))
          @if($add->is_active==1)
           //for delete $.removeCookie('name', { path: '/' });
           // $.cookie('reklama', 0,{ expires: 1,path: '/' });
            if (!$.cookie('reklama')) {


                jQuery('.addv').modal('show');
                $.cookie('reklama', 0,{ expires: 1,path: '/' });
            }
           else{
                if($.cookie('reklama')){
                    jQuery('.addv').modal('hide');
                   // $.removeCookie('reklama', { path: '/' });
                }

            }


            @endif

            @endif


        });
        $('.s').click(function () {
            jQuery('.addv').modal('hide');
          //  $.cookie('reklama', "no");
           // $.removeCookie('reklama', { path: '/' });

        });
    });


    $(window).bind("beforeunload", function () {




    });
</script>
