@extends('layouts.principal')
@section('content')
    @include('alerts.success')
    <div class="contact-content">
        <div class="top-header span_top">
            <div class="logo">
                <a href="index.html"><img src="images/logo.png" alt="" /></a>
                <p>Movie Theater</p>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="main-contact">
            <h3 class="head">CONTACT</h3>
            <p>WE'RE ALWAYS HERE TO HELP YOU</p>
            <div class="contact-form">
                {!!Form::open(['url' => '/password/reset'])!!}
                <div class="col-md-6 contact-left">

                    <div class="form-group">
                        {!!Form::hidden('token', $token, null)!!}
                        {!!Form::text('email', null, ['value'=>"{{old('email)}}"])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password:') !!}
                    </div>
                    <div class="form-group">
                        {!!Form::password('password')!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Password Confirmacion:') !!}
                    </div>

                    <div class="form-group">
                        {!!Form::password('password_confirmation')!!}
                    </div>

                </div>

                {!!Form::submit('Restablecer')!!}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
@endsection