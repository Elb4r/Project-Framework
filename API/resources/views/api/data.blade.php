<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr {
            transition: background-color 0.3s;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        table {
            animation: fadeIn 1s ease-in-out;
        }
    </style>
</head>

<body>
    <h1>Data dari API</h1>
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>alpha_two_code</th>
                <th>country</th>
                <th>state-province</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item['name']}}</td>
                <td>{{$item['alpha_two_code']}}</td>
                <td>{{$item['country']}}</td>
                <td>{{$item['state-province']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>