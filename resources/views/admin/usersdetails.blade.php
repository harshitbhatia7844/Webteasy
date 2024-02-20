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
    </style>

</head>

<body>

    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 100%;float: left;text-align:center;">
            <h3>MAHARISHI UNIVERSITY OF INFORMATION TECHNOLOGY, NOIDA</h3>
            <h4>School of Engineering and Technology</h4>
            <div style="display:flex; justify-content:space-between;">
            <h5>Test Name: {{ $tests->name ?? 'N/A' }}</h5>
            <h5>Test Date: {{ $tests->date ?? 'N/A' }}</h5>
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
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->total_score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
