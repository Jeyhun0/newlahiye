<table>
    <thead>
        <tr>
           <th colspan="16" style="color:black; border:1px solid black; vertical-align:middle; width:50px;  text-align:center; text-align: center; font-weight:600">Podratçı təşkilatlar ilə bağlanmış müqavilələrin icrası barədə məlumat</th>
        </tr>
        <tr>
           <th colspan="16" style="color:black; border:1px solid black; vertical-align:middle; width:50px;  text-align:center; text-align: center; font-weight:600">CƏDVƏLİ</th>
        </tr>
        <tr style="display: flex; align-items: center">
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:40px;  text-align:center; font-weight:600; white-space: normal;">Sıra №-si</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:220px; text-align:center; font-weight:600">Obyektin adı</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Podratçı təşkilatın adı</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Müqavilənin bağlanma tarixi və nömrəsi</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Layihənin ehtimal olunan ümumi dəyəri</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Müqavilənin dəyəri</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Ayrılmış vəsait</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Ödənilmiş vəsait</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Qalıq vəsait</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Akkreditivin qalığı</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Avans borcu</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Layihənin bitməsi üçün  tələb olunan ehtimal vəsait</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">2025-ci ilə tələb olunan vəsait</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">İşin növü</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Vəsaitin mənbəyi</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Qeyd</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $data)
        <tr>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">{{$data->id}}</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;"> {{$data->name}} </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;"> {{$data->customer ? $data->customer->name : "-"}}</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">2</td>
        </tr>
        @endforeach
    </tbody>
</table>

