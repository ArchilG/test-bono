<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Письмо {{$message->name}}</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
<p>
    <a href="{{route('mails.list')}}">
        To list
    </a>&nbsp;&nbsp;&nbsp;
    <a href="{{route('mails.main')}}">
        To form
    </a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="{{route('mails.export')}}">
        Export
    </a>
</p>
<p><b>Filds:</b>
    <label><input data-url="{{request()->fullUrlWithoutQuery('fields')}}" type="checkbox" name="fields[]"
                               value="name" {{in_array('name',request()->get('fields',[])) ? 'checked' : ''}}/>
        Name</label>&nbsp;&nbsp;&nbsp;
    <label><input data-url="{{request()->fullUrlWithoutQuery('fields')}}" type="checkbox" name="fields[]"
                                                    value="email" {{in_array('email',request()->get('fields',[])) ? 'checked' : ''}} />
        Email</label></p>
<h1>{{$message->name}}</h1>
<div>
    <div>{{$message->created_at}}</div>
    <div>{{$message->email}}</div>
    <p>{{$message->text}}</p>
</div>
<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
