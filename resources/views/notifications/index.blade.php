<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #8DB4E2;
            color: #333;
            font-weight: 600;
            font-size: 16px;
        }

        td {
            background-color: #fff;
            color: #555;
            font-size: 14px;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        tr:hover td {
            background-color: #f1f1f1;
        }

        caption {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        @media screen and (max-width: 768px) {
            table {
                font-size: 12px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<table>
    <caption>Bildirişlər</caption>
    <thead>
    <tr>
        <th style="width: 220px;">Bildirişin adı</th>
        <th style="width: 160px;">Bildirişin məzmunu</th>
        <th style="width: 140px;">Yaranma tarixi</th>
    </tr>
    </thead>
    <tbody>
    @if($notifications->isEmpty())
        <tr>
            <td colspan="3">Heç bir bildiriş tapılmadı.</td>
        </tr>
    @else
        @foreach($notifications as $item)
            @php
                $data = json_decode($item->data, true);
                $data = (object)$data;
            @endphp
            <tr>
                <td>{{$data->title ?? "-"}}</td>
                <td>{{$data->text ?? "-"}}</td>
                <td>{{$item->created_at}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</body>
</html>
