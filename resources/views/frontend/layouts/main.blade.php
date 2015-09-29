<?php

$site = App\SiteSetting::get()->first();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('subtitle'){{$site->title}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$site->description}}" />
    <meta name="keywords" content="{{$site->keywords}}" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="icon" href="{{$site->getFaviconUrl()}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{$site->getFaviconUrl()}}" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery-eu-cookie-law-popup.css"/>
    @yield('styles')
</head>

@yield('body')

@yield('scripts_bottom')

<script>
    function modal(text, title) {
        if (title !== undefined) {
            $('#modal-title').show().html(title);
        }
        $('#modal-text').html(text);
        $('#system-modal').modal('show');
    }

    function modal_from_ajax(text, title) {
        $.get('/api/get-modal-strings', function($data) {
            $data = JSON.parse($data);
            if (title !== undefined) {
                modal($data[text], modal[title]);
            }else {
                modal($data[text]);
            }
        });
    }

    @if (Session::has('modal'))
        @if (Session::has('modal-title'))
            modal("<?php echo Session::get('modal'); ?>", "<?php echo Session::get('modal-title'); ?>");
        @else
            modal("{{Session::get('modal')}}");
        @endif
    @endif
</script>

</html>
