<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $newsletter->media->titre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
        }
        .header-image {
            width: 100%;
            height: auto;
        }
        .title {
            font-size: 24px;
            margin-top: 20px;
            color: #333333;
        }
        .content {
            font-size: 16px;
            color: #555555;
            line-height: 1.6;
        }
        .cta-button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">

        @if ($newsletter->media && $newsletter->media->image)
            <img src="{{ asset('storage/' . $newsletter->media->image) }}" class="header-image">
        @endif

        <h1 class="title">{{ $newsletter->media->titre ?? 'Newsletter ORTN' }}</h1>

        <p class="content">
            {!! $newsletter->media->description ?? '' !!}
        </p>

        <div class="footer">
            © {{ now()->year }} ORTN. Tous droits réservés.
        </div>
    </div>
</body>
</html>