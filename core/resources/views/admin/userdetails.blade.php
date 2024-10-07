@extends('admin.layouts.app')

@section('panel')

    <style>
        .hgghhgt th {
            background-color: #071251;
            color: #fff;
            
            padding: 8px;
            text-align: left;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .download-date {
            float: right;
            font-size: 12px;
        }
        .watermark {
            position: absolute;
            top: 40%;
            left: 30%;
            font-size: 50px;
            color: rgba(0, 0, 0, 0.1);
            transform: rotate(-45deg);
            z-index: -1;
        }
        body {
            background-color: #f0f0f0;
            padding: 20px;
        }
       
       
    </style>

    <div class="row mb-none-30">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                       
                        <div class="download-date">
                            Downloaded on: {{ now()->format('Y-m-d H:i:s') }}
                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="printTable()">Print Table</button>

                    <div class="table-responsive">
                        <table id="userTable" class="table table-bordered">
                            <thead class="hgghhgt">
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>City</th>
                                    <th>Mobile</th>
                                    <th>Profile Status</th>
                                    <th>Last Balance</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->profile_complete ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ number_format($user->balance, 2) }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function printTable() {
            var table = document.getElementById('userTable');
            if (table) {
                var win = window.open('', '', 'width=800,height=600');
                win.document.write('<html><head><title>User Details</title>');
                win.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #000; padding: 8px; text-align: left; }</style>');
                win.document.write('<style>.hgghhgt th { background-color: #071251; color: #fff; border: 1px solid #000; padding: 8px; text-align: left; }</style>');
                win.document.write('<style>body { background-color: #f0f0f0; padding: 20px; }</style>');
                win.document.write('<style>.watermark { position: absolute; top: 40%; left: 30%; font-size: 50px; color: rgba(0, 0, 0, 0.1); transform: rotate(-45deg); z-index: -1; }</style>');
                win.document.write('</head><body>');
                win.document.write('<div class="header">');
                win.document.write('<img src="{{ asset('https://my11clubs.com/assets/images/logo_icon/logo.png') }}" alt="Logo" class="logo">');
                win.document.write('<div class="download-date">Downloaded on: ' + new Date().toLocaleDateString() + '</div>');
                win.document.write('<div class="watermark">Confidential</div>');
                win.document.write('</div>');
                win.document.write('<h1 style="text-align: center;">User Details</h1>');
                win.document.write(table.outerHTML);
                win.document.write('</body></html>');
                win.document.close();
                win.print();
            }
        }
    </script>

@endsection
