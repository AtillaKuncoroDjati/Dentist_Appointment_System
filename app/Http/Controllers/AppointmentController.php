<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date_format:Y-m-d H:i', // Ensure date format includes time
            'doctor' => 'required|string|max:255',
            'services' => 'required|string|max:255',
            'message' => 'nullable|string',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Mark proof as required
        ]);

        try {
            // Check if the appointment date and time are available
            $date = $validatedData['date'];
            $doctor = $validatedData['doctor'];

            $appointmentExists = Appointment::where('appointment_date', $date)
                ->where('doctor', $doctor)
                ->exists();

            if ($appointmentExists || (new \DateTime($date))->format('H:i') == '18:00') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The selected time is not available. Please choose another time.'
                ], 422);
            }

            // Create a new appointment record
            $appointment = new Appointment();
            $appointment->name = $validatedData['name'];
            $appointment->email = $validatedData['email'];
            $appointment->phone = $validatedData['phone'];
            $appointment->appointment_date = $date;
            $appointment->doctor = $doctor;
            $appointment->services = $validatedData['services'];
            $appointment->message = $validatedData['message'] ?? null;
            $appointment->status = 'pending'; // Set default status

            // Handle proof upload
            $file = $request->file('proof');
            $proofPath = $file->store('proofs', 'public');
            $appointment->proof = $proofPath;

            $appointment->save();

            // Return success response
            return response()->json(['status' => 'success', 'message' => 'Appointment booked successfully.']);
        } catch (\Exception $e) {
            Log::error('Error saving appointment: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save appointment. Please try again later.'
            ], 500);
        }
    }


    public function viewAppointment() {
        return view('templates.appointment_template');
    }

    public function updateStatus(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->status = $request->status;
        $appointment->save();

        return response()->json(['success' => true]);
    }

    public function checkAvailability(Request $request)
    {
        $date = $request->date;
        $doctor = $request->doctor;

        $appointments = Appointment::whereDate('appointment_date', $date)
                                ->where('doctor', $doctor)
                                ->pluck('appointment_date');

        $bookedHours = $appointments->map(function ($appointment) {
            return date('H:i', strtotime($appointment));
        })->toArray();

        $availableHours = [];
        for ($hour = 10; $hour < 18; $hour++) {
            $time = sprintf('%02d:00', $hour);
            if (!in_array($time, $bookedHours)) {
                $availableHours[] = $time;
            }
        }

        return response()->json(['booked' => $bookedHours, 'available' => $availableHours]);
    }

    public function viewReport()
    {
        // Fetch appointments for the last 30 days
        $appointments = Appointment::where('appointment_date', '>=', Carbon::now()->subDays(30))
                                    ->get();

        // Group appointments by the actual appointment date and status
        $appointmentsByDateAndStatus = $appointments->groupBy(function($appointment) {
            return Carbon::parse($appointment->appointment_date)->format('Y-m-d'); // Group by date only
        });

        // Prepare data for the chart
        $labels = [];
        $pendingCounts = [];
        $acceptedCounts = [];
        $canceledCounts = [];

        // Iterate through each date
        foreach ($appointmentsByDateAndStatus as $date => $appointmentsOnDate) {
            $labels[] = $date; // Use the formatted date

            // Count the number of appointments per status for this date
            $pendingCounts[] = $appointmentsOnDate->where('status', 'pending')->count();
            $acceptedCounts[] = $appointmentsOnDate->where('status', 'Accepted')->count();
            $canceledCounts[] = $appointmentsOnDate->where('status', 'Canceled')->count();
        }

        // Create the bar chart with the data
        $chart = LarapexChart::barChart()
            ->addData('Pending', $pendingCounts)
            ->addData('Accepted', $acceptedCounts)
            ->addData('Canceled', $canceledCounts)
            ->setLabels($labels) // Set labels for the X-axis
            ->setColors(['#FFB300', '#4CAF50', '#F44336'])
            ->setXAxis($labels); // Explicitly set X-axis labels (dates)

        // Return the view with the chart data
        return view('admin.report', compact('chart'));
    }

    public function exportPDF()
    {
        // Fetch appointments data
        $appointments = Appointment::all(); // You can modify this query if needed, e.g., to filter by doctor or status

        // Load the view and pass the appointments data
        $pdf = PDF::loadView('admin.pdf', compact('appointments'));

        // Return the PDF as a download
        return $pdf->download('appointments.pdf');
    }
}
