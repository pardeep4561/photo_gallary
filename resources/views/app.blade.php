<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="asset" content="{{ asset('') }}"/>
    <meta name="keywords" content="{{ $metakeyword ?? "" }}">
    <meta name="description" content="{{ $metadescription ?? "" }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  </head>
  <body>
    @inertia
    @routes
    <script src="{{ mix('/js/app.js') }}" defer></script>
  </body>
</html>