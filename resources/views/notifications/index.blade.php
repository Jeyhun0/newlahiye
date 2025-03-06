<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
<thead>
<tr style="display: flex; align-items: center">
    <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:220px; text-align:center; font-weight:600">Bildirişin adı</th>
    <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Bildirişin məzmunu</th>
    <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Yaranma tarixi</th>
</tr>
</thead>
<tbody>
@foreach($notifications as $item)
    @php
        $data = json_decode($item->data, true);
        $data=(object)$data;
    @endphp
    <tr>
        <td style="border:1px solid black; vertical-align:middle; text-align:center;">{{$data->title ?? "-"}}</td>
        <td style="border:1px solid black; vertical-align:middle; text-align:center;">{{$data->text ?? "-"}}</td>
        <td style="border:1px solid black; vertical-align:middle; text-align:center;">
            {{$item->created_at }}
        </td>


    </tr>
@endforeach
</tbody>
</table>
</body>
</html>

