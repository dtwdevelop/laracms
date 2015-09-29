@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') Dashboard :: @parent @stop

{{-- Content --}}
@section('main')

    <div class="page-header">
        <h3>
            Dashboard
        </h3>
    </div>

    <div class="row">

        <p>Welcome to Capsilite Admin panel</p>

        <?php

            if (isset($_GET['info'])) {
                phpinfo();
            }

        ?>

    </div>
@endsection
