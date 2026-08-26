<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer List</title>
    <style>
        @page {
            margin: 80px 35px 60px 35px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        header {
            position: fixed;
            top: -50px;
            left: 0px;
            right: 0px;
            height: 40px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        header h2 {
            margin: 0;
            color: #7539FF;
            font-size: 18px;
            font-weight: 600;
        }
        footer {
            position: fixed; 
            bottom: -40px; 
            left: 0px; 
            right: 0px;
            height: 30px; 
            font-size: 9px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
        .footer-left {
            float: left;
        }
        .footer-right {
            float: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #eee;
            padding: 8px 10px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #F8F9FA;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {
            background-color: #FCFCFD;
        }
    </style>
</head>
<body>
    <header>
        <h2>Customer List</h2>
    </header>

    <footer>
        <div class="footer-left">Generated on: {{ now()->format('Y-m-d H:i:s') }}</div>
        <div class="footer-right">Page <span class="pagenum"></span></div>
    </footer>

    <main>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 25%;">Name</th>
                    <th style="width: 20%;">Phone</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 15%;">City</th>
                    <th style="width: 10%;">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $index => $customer)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="font-weight: bold; color: #111;">{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email ?? '-' }}</td>
                        <td>{{ $customer->city ?? '-' }}</td>
                        <td>{{ $customer->created_at ? $customer->created_at->format('Y-m-d') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
