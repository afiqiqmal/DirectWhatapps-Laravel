<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Direct Whatsapp</title>

        @section('css')
            {{ Html::style('css/app.css') }}
            {{ Html::style('css/material-dashboard.css') }}
            {{ Html::style('css/demo.css') }}
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

            <style type="text/css">
                .sub-header{
                    text-align: center !important;
                }
            </style>
        @show
    </head>
    <body>
        <div class="col-md-12 container">
            <h4>Easy way to send Whatapps directly from the browsers without save receipent phone number</h4>
            <div class="sub-header">
                <strong >Can be use with Desktop and Mobile</strong><br>
                <small class="hidden-sm"><strong>https://directwhatsapp.herokuapp.com/{phonenumber}/{text}</strong></small>
            </div>
            <div class="card">
                {{ Form::open(['route' => 'whatapps', 'method' => 'post'])}}
                    <div class="card-header card-header-icon" data-background-color="green">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Whatsapp Form</h3>
                            <div class="form-group">
                                <select class="selectpicker" data-style="btn {{ $errors->has('countrycode') ? 'btn-rose' : 'btn-success' }} btn-square" name="countrycode" required="true"> 
                                    <option disabled selected>Country Code</option>
                                    @foreach($countrycode as $code)
                                        <option value="{{$code->dial_code}}">{{$code->name}} ({{$code->dial_code}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('phonenumber') ? ' has-error' : '' }} label-floating">
                                <label class="control-label">
                                    Phone Number
                                    <small>*</small>
                                </label>
                                <input class="form-control" name="phonenumber" type="text" value="{{old('phonenumber')}}" />
                            </div>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Message
                            </label>
                            <textarea class="form-control" name="message" rows="5">{{old('message')}}</textarea>
                        </div>
                        <div class="category form-category">
                            <small>*</small> Required fields</div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-success btn-fill">
                                <i class="material-icons">done</i> Send
                            </button>
                            <button type="reset" class="btn btn-rose btn-fill">
                                <i class="material-icons">autorenew</i> Reset
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>

        <footer class="footer">
                <div class="container-fluid">
                    <div class="col-md-6 col-sm-12">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="https://github.com/afiqiqmal" target="_blank">
                                    Github
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/muhammad-hafiq-iqmal-bin-mohd-noh-5a2a65109/" target="_blank">
                                    LinkedIn
                                </a>
                            </li>
                            
                        </ul>
                    </nav>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="copyright pull-right">
                            ©
                            <script></script><script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="https://github.com/afiqiqmal" target="_blank">Hafiq Iqmal</a>,    Whatsapp via Broswer
                        </p>
                    </div>
                </div>
            </footer>

        @section('script')
            {{ Html::script('js/jquery-3.1.1.min.js')}}
            {{ Html::script('js/app.js') }}
            {{ Html::script('js/material.min.js') }}
            {{ Html::script('js/jquery.select-bootstrap.js') }}
            {{ Html::script('js/material-dashboard.js') }}
            {{ Html::script('js/bootstrap-notify.js') }}
            {{ Html::script('js/jquery.tagsinput.js') }}
            {{ Html::script('js/demo.js') }}
        @show


        @if($errors->has('countrycode'))
            <script>
                $(document).ready(function(){
                    demo.showNotification('top','center','{{$errors->first('countrycode')}}');
                });
            </script>
        @endif

        @if($errors->has('phonenumber'))
            <script>
                $(document).ready(function(){
                    demo.showNotification('top','center','{{$errors->first('phonenumber')}}');
                });
            </script>
        @endif
    </body>
</html>
