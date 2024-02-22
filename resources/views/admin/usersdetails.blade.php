<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        th {
            background: #cecece;
            font-weight: bold;
        }

        td,
        th {
            padding: 6px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 14px;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .watermark {
            opacity: 0.5;
            position: absolute;
            right: 0%;
        }
    </style>

</head>

<body>

    <div style="width: 95%; margin: 0; padding: 0">
        <div style="width: 100%;text-align:center;">
            <img src="images/muitlogo.jpg" style="height: 85">
            <h3>MAHARISHI UNIVERSITY OF INFORMATION TECHNOLOGY,<br> NOIDA</h3>
            <h3>School of Engineering and Technology</h3>
            <div class="flex">
                <span style="margin-right: 30%">Test Name: {{ $tests->name ?? 'N/A' }}</span>
                <span>Date: {{ date('d-m-Y', strtotime($tests->date)) ?? 'N/A' }}</span>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Roll No.</th>
                <th>Name</th>
                <th>Total Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->roll_no }}</td>
                    <td>{{ strtoupper($item->name) }}</td>
                    <td>{{ $item->total_score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="watermark">Created by : HPS</div>

</body>

</html>
