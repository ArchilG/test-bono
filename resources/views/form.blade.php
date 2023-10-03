<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Форма</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
<p>
    <a href="{{route('mails.list')}}">
        To list
    </a>&nbsp;&nbsp;&nbsp;
    <a href="{{route('mails.main')}}">
        To form
    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="{{route('mails.export')}}">
        Export
    </a>
</p>
<div class="form">
    <form action="/send" class="ajax-form">
       <div>
           <label>Name</label><br>
           <input type="text" name="name" required />
       </div>
        <div>
            <label>Email</label><br>
            <input type="text" name="email" required />
        </div>
        <div>
            <label>Text</label><br>
            <textarea name="text" required></textarea>
        </div>
        <div>
          <input type="submit" value="Send">
        </div>
    </form>
</div>
<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
