<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="format-detection" content="telephone=no">
        <!-- CSRF Token-->
        <meta name="csrf-token" content="{{ csrf_token() }}">    
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <header id="chat-header" class="sticky-top">
                <div class="row bg-topbar pt-2 pb-1">
                    <div class="col-12">
                        <div class="text-blue page-title" style="text-align: center;">新規登録</div>
                    </div>
                </div>
            </header>
            <div class="form-container">
                <a class="user-signup-btn" href="{{ route('user.entry') }}">個人のお客様は<br>こちら</a>
                <a class="painter-signup-btn" href="{{ route('painter.entry') }}">企業の方は<br/>こちら</a>
            </div>
           
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
