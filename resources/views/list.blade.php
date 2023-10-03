<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Письма</title>
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    </head>
    <body>
    <p>
        <a href="{{route('mails.list')}}">
            To list
        </a>&nbsp;&nbsp;&nbsp;
        <a href="{{route('mails.main')}}">
            To form
        </a>&nbsp;&nbsp;&nbsp;
        <a href="{{route('mails.export')}}">
            Export
        </a>
    </p>
    <p>
        <a href="{{request()->fullUrlWithQuery(['order' => $order == 'desc' ? 'asc' : 'desc'])}}">
            Sort by create date {{$order == 'desc' ? 'asc' : 'desc'}}
        </a>
    </p>
    <div>
        @foreach($items as $item)
            <div>
                <a href="/mail/{{$item->id}}">
                    <b>{{$item->name}} ({{$item->email}})</b>
                </a>
                <hr>
            </div>
        @endforeach
    </div>
    {{$items->links()}}

    </body>
</html>
