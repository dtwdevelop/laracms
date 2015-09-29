<?php
$socials = App\SiteSocial::SocialIcons();
?>
<footer class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="adress">
                        Natural Options Nutrition Ltd.<br>
                        Unit 1 - 6 Maritime Street<br>
                        Copse Road<br>
                        Fleetwood<br>
                        Lancs FY7 7PB<br>
                    </div>
                    <div class="e-mail"><a href="mailto:info@capsilite.com">info@capsilite.com</a></div>
                    <div class="copyrights">Copyrights &copy; 2015<br>
                    <a href="/terms">Terms & Conditions</a></div>
                </div>
                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-2 col-xs-12">
                    <div class="social-media">
                        <div class="row">
                                    @foreach($socials as $key=>$soc)
                            @if($key == 0)
                            <div class="twitter col-md-2 col-sm-2 col-xs-3">
                               @endif 
                               @if($key == 1)
                            <div class="facebook col-md-2 col-sm-2 col-xs-3">
                               @endif 
                                   @if($key == 2)
                            <div class="youtube col-md-2 col-sm-2 col-xs-3">
                               @endif 
                                <a href="{{$soc->link}}" target="_blank">
                                      
                 <?= HTML::image( App\SiteSocial::getImageUrlIcon($soc->id,$soc->icon),"")  ?></a>
                                     
             
                            </div>
                          @endforeach
                       
                    </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </footer>
{{--<div class="container-fluid cookies-container-fluid-pop">--}}
    {{--<div id="cookies-block" class="row close-cookies">--}}
        {{--<div class="col-lg-11 cookies-text">--}}
            {{--We use cookies to give you a fabulous customer experience and enable you to checkout on our website.--}}
            {{--By continuing to shop we will assume you are happy to receive all cookies, otherwise you can review more information on cookies--}}
            {{--<a class="more-cookies" href="/cookies">here</a>--}}
            {{--<!--<div id="allow-cokies" href="#" class="btn-group btn-group-sm" role="button">Allow</div>-->--}}
        {{--</div>--}}
        {{--<div class="col-lg-1">--}}
            {{--<a id="close-cookies" href="#">--}}
                {{--<i class="fa fa-times"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}



<!-- MODAL -->
<div id="system-modal" class="modal fade bs-example-modal-lg11" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modal-title" style="display: none"></h4>
            </div>
            <div class="modal-body">
                <p id="modal-text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->

{{--<script type="text/javascript">--}}
    {{--close = document.getElementById("close-cookies");--}}
    {{--close.addEventListener('click', function() {--}}
        {{--note = document.getElementById("cookies-block");--}}
        {{--note.style.display = 'none';--}}
    {{--}, false);--}}
{{--</script>--}}
