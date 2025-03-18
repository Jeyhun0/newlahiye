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
            <th style="background-color: #8DB4E2; border:1px solid black; text-align:center; font-weight:600">Inspection Form 2</th>
            <th style="background-color: #8DB4E2; border:1px solid black; text-align:center; font-weight:600">EMI Form 2</th>
            <th style="background-color: #8DB4E2; color:black; border:1px solid black; vertical-align:middle; width:110px; text-align:center; font-weight:600">Qeyd</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $data)
        <tr>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">{{$data->id}}</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">{{$data->name}}</td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->supplier ? $data->supplier->name : "-"}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->created_at->format('d-m-Y') ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->quantity ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->quantity_alert ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->selling_price ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->buying_price ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->remaining_amount ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->accredited_balance ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->advance_debt ?? '-'}}
            </td>

            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->project_completion_estimate ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->estimated_funds_2025 ?? '-'}}
            </td>

            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->unit ? $data->unit->name : '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->category ? $data->category->name : '-'}}
            </td>
            <td style="border:1px solid black; text-align:center;">
                {{$data->inspection_form_2 ?? '-'}}
            </td>
            <td style="border:1px solid black; text-align:center;">
                {{$data->emi_form_2 ?? '-'}}
            </td>
            <td style="border:1px solid black; vertical-align:middle; text-align:center;">
                {{$data->notes ?? '-'}}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

