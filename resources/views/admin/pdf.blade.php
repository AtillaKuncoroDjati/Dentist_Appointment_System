<!-- resources/views/admin/appointments/pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Appointments Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Appointments Report</h1>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Name Doctor</th>
                <th>Service</th>
                <th>Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->name }}</td>
                    <td>{{ $appointment->email }}</td>
                    <td>{{ $appointment->phone }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->doctor }}</td>
                    <td>{{ $appointment->services }}</td>
                    <td>{{ $appointment->message }}</td>
                    <td>
                        @if ($appointment->status === 'Accepted')
                            Accepted
                        @elseif($appointment->status === 'Canceled')
                            Canceled
                        @else
                            Pending
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
