<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Component Preview - Microsite Component Library</title>
    <style>
        /* Reset default styles */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <style>
        {!! $component->scss !!}
    </style>

    <div class="preview-container">
        {!! $component->html !!}
    </div>

    @if ($component->js)
        <script>
            {!! $component->js !!}
        </script>
    @endif
</body>

</html>
