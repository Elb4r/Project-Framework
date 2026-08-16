<!-- resources/views/bankmini/transaksi.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Mini Transactions</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f1f3f5;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            width: 100%;
        }

        .container h1 {
            color: #333333;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }

        .btn {
            margin: 15px 5px;
            padding: 10px 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .table {
            margin-top: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        /* Customizing the search bar */
        .search-bar input {
            width: 300px;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bank Mini Transaksi</h1>
        <p class="lead">Transaksi Dari Siswa</p>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('bankmini.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        <!-- Search Bar -->
        <div class="search-bar text-center">
            <input type="text" id="searchTransaction" class="form-control" placeholder="Cari transaksi..." onkeyup="searchTransactions()">
        </div>

        <!-- Transaction Table -->
        <table class="table" id="transactionTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Jumlah</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->sender ? $transaction->sender->name : 'N/A' }}</td> <!-- Nama Pengirim -->
                        <td>{{ $transaction->recipient ? $transaction->recipient->name : 'N/A' }}</td> <!-- Nama Penerima -->
                        <td>${{ number_format($transaction->amount, 2) }}</td> <!-- Jumlah transaksi dengan format uang -->
                        <td>
                            <span class="badge {{ $transaction->type == 'Credit' ? 'badge-success' : 'badge-info' }}">
                                {{ $transaction->type }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $transaction->status == 'Completed' ? 'badge-success' : 'badge-danger' }}">
                                {{ $transaction->status }}
                            </span>
                        </td>
                        <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td> <!-- Tanggal dan waktu transaksi -->
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for search -->
    <script>
        function searchTransactions() {
            const filter = document.getElementById("searchTransaction").value.toLowerCase();
            const table = document.getElementById("transactionTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const columns = rows[i].getElementsByTagName("td");
                if (columns.length > 0) {
                    let match = false;
                    for (let j = 0; j < columns.length; j++) {
                        if (columns[j].textContent.toLowerCase().includes(filter)) {
                            match = true;
                            break;
                        }
                    }
                    rows[i].style.display = match ? "" : "none";
                }
            }
        }
    </script>
</body>
</html>
