<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class KamarController extends Controller
{
    public function index()
    {
        // Retrieve a list of kamars with their associated reservasis
        $kamars = Kamar::with(['reservasis' => function ($query) {
            $query->where('status', 'Uncompleted');
        }, 'reservasis.customer'])->get();
        
        return view('daftarkamar', compact('kamars'));
    }
    public function dashboard()
{
    // Retrieve a list of all kamars
    $allKamars = Kamar::all();

    // Retrieve the room numbers of available rooms
    $availableRooms = Kamar::where('status', 'Available')->pluck('no_kamar');

    // Calculate the number of occupied and vacant rooms
    $occupiedRooms = Reservasi::where('status', 'Uncompleted')->count();
    $vacantRooms = count($allKamars) - $occupiedRooms;
    $checkout = Reservasi::whereDate('check_out_date', now())
        ->where('status', 'Uncompleted')
        ->count();

    $checkOutOverdue = Reservasi::where('status', 'Uncompleted')
        ->where('check_out_date', '<', Carbon::now())
        ->count();

    return view('dashboard', compact('occupiedRooms', 'vacantRooms', 'availableRooms','checkout','checkOutOverdue'));
}



public function latecheckoutRooms()
{
    // Retrieve a list of vacant room numbers
    $checkOutOverdue = Reservasi::where('status', 'Uncompleted')
        ->where('check_out_date', '<', Carbon::now())
        ->get();

    return view('latecheckout-rooms', compact('checkOutOverdue'));
}
public function checkoutRooms()
{
    // Retrieve a list of vacant room numbers
    $checkoutNow = Reservasi::whereDate('check_out_date', now())
        ->where('status', 'Uncompleted')
        ->get();

    return view('checkout-rooms', compact('checkoutNow'));
}
public function availableRooms()
{
    // Retrieve a list of vacant room numbers
    $vacantRoomNumbers = Kamar::whereDoesntHave('reservasis', function ($query) {
        $query->where('check_out_date', '>=', now());
    })->pluck('no_kamar');

    return view('available-rooms', compact('vacantRoomNumbers'));
}


    public function viewDetail($id)
    {
        // Fetch details for the room with the provided ID that has uncompleted reservations
        $kamarr = Kamar::with(['reservasis' => function ($query) {
            $query->where('status', 'Uncompleted');
        }, 'reservasis.customer'])
            ->where('id', $id)
            ->first();

        // dd($kamarr);

        return view('room.detail', compact('kamarr'));
    }


    public function addTenant($id)
    {
        $kamar = Kamar::findOrFail($id);

        return view('room.add-tenant', compact('kamar'));
    }

    public function storeTenant(Request $request, $id)
{
    $request->validate([
        'ktp' => 'required|numeric|min:1000000000000000',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'gender' => 'required',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
    ], [
        'ktp.min' => 'The NIK field must be at least 16 digits.',
    ]);

    // Ambil tanggal dan waktu yang dipilih oleh pengguna
    $checkInDateTime = Carbon::parse($request->input('check_in'));
    $checkOutDateTime = Carbon::parse($request->input('check_out'));

    // Periksa apakah tanggal check_in lebih kecil dari tanggal saat ini
    // Di dalam metode storeTenant
if ($checkInDateTime->isPast()) {
    return redirect()->back()->withErrors(['check_in' => 'Tanggal check-in tidak boleh lebih kecil dari tanggal saat ini.']);
}


    // Create a new customer
    $customer = Customer::create([
        'ktp' => $request->input('ktp'),
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'gender' => $request->input('gender'),
    ]);

    // Create a new reservation
    $reservasi = Reservasi::create([
        'customer_id' => $customer->id,
        'kamar_id' => $id,
        'check_in_date' => $checkInDateTime,
        'check_out_date' => $checkOutDateTime,
        'status' => 'Uncompleted',
    ]);

    // Update the room status to "Occupied"
    $kamar = Kamar::findOrFail($id);
    $kamar->status = 'Occupied';
    $kamar->save();
    
    return redirect()->route('room.detail', ['id' => $kamar->id])->with('success', 'Tenant added successfully');
}


public function checkout($id, $reservation_id)
{
    $kamar = Kamar::findOrFail($id);
    $reservation = Reservasi::findOrFail($reservation_id);

    // Set status kamar menjadi "Available"
    $kamar->status = 'Available';
    $kamar->save();

    // Update checkout_date to the current date
    $reservation->check_out_date = now(); // This sets checkout_date to the current date and time

    // Hitung total masa sewa
    $checkInDate = Carbon::parse($reservation->check_in_date);
    $checkOutDate = Carbon::parse($reservation->check_out_date);
    $totalRentalPeriod = $checkInDate->diff($checkOutDate);

    // Ubah status reservasi menjadi "Checked Out" atau sesuai kebutuhan
    // Misalnya, jika Anda memiliki kolom 'status' pada tabel 'reservasis'

    $reservation->status = 'Completed';
    $reservation->save();

    return redirect()->route('kamars.index')->with('success', 'Checkout successful')->with('totalRentalPeriod', $totalRentalPeriod);
}



public function bookingStatus()
{
    $currentDateTime = now(); // Get the current date and time

    // Bookings that are already completed (check_out_date and time is in the past)
    $completedBookings = Reservasi::where('check_out_date', '<', $currentDateTime)->paginate(10);
    $currentPage = $completedBookings->currentPage();
    $itemsPerPage = $completedBookings->perPage();
    return view('booking.status', compact('completedBookings', 'currentPage', 'itemsPerPage'));
}


    public function create()
    {
        $kamars = Kamar::where('status', 'Available')->get();
        return view('booking.create', compact('kamars'));
    }

    
    public function daftarpenghuni()
    {
        // Ambil daftar kamars beserta reservasis dan informasi penghuninya
        $kamars = Reservasi::with('customer','kamar')
            ->where(function ($query) {
                $query->where('status', 'Completed');
            })
            ->paginate(10);
        $kamarss = Reservasi::with('customer','kamar')
            ->where(function ($query) {
                $query->where('status', 'Uncompleted');
            })
            ->paginate(10);
            // dd($kamarss);

        return view('daftarpenghuni', compact('kamars','kamarss'));
    }

    public function createroom()
    {
        return view('room.tambah');
    }

    public function storeroom(Request $request)
{
    // Validasi data yang diterima dari formulir
    $validatedData = $request->validate([
        'no_kamar' => 'required|unique:kamars',
        'status' => 'required',
    ], [
        'no_kamar.unique' => 'Nomor kamar sudah ada di database.',
    ]);

    // Simpan data kamar baru ke dalam database
    $kamar = new Kamar;
    $kamar->no_kamar = $request->input('no_kamar');
    $kamar->status = $request->input('status');
    
    try {
        $kamar->save();
        // Redirect ke halaman daftar kamar dengan pesan sukses
        return redirect()->route('kamars.index')->with('success', 'Kamar baru telah berhasil ditambahkan.');
    } catch (\Illuminate\Database\QueryException $exception) {
        // If a database error occurs (e.g., unique constraint violation), handle it
        return redirect()->back()->with('error', 'Gagal menambahkan kamar. Nomor kamar sudah ada.');
    }
}

public function deleteRoom($id)
    {
        // Find the room by ID
        $room = Kamar::findOrFail($id);

        // Perform any additional validation or checks if needed
        // For example, you can check if the room has no active reservations before deleting.

        // Delete the room
        $room->delete();

        // Redirect back to the room listing page with a success message
        return redirect()->route('kamars.index')->with('success', 'Room deleted successfully');
    }

    public function filterBookings(Request $request)
{
    $checkinDate = $request->input('checkin_date');
    $customerName = $request->input('customer_name');

    // Query untuk mengambil data berdasarkan filter dan pencarian
    $completedBookings = Reservasi::when($checkinDate, function ($query) use ($checkinDate) {
        return $query->where('check_in_date', '>=', $checkinDate);
    })
    ->when($customerName, function ($query) use ($customerName) {
        return $query->whereHas('customer', function ($customerQuery) use ($customerName) {
            $customerQuery->where('first_name', 'like', '%' . $customerName . '%');
        });
    })
    ->paginate(10);

    $currentPage = $completedBookings->currentPage();
    $itemsPerPage = $completedBookings->perPage();
    


    return view('booking.status', compact('completedBookings', 'currentPage', 'itemsPerPage'));
}

    public function searchPenghuni(Request $request)
    {
        $searchTerm = $request->input('search');

$kamarss = Reservasi::with('customer', 'kamar')
    ->where(function ($query) {
        $query->where('status', 'Uncompleted');
    })
    ->where(function ($query) use ($searchTerm) {
        $query->whereHas('customer', function ($customerQuery) use ($searchTerm) {
            $customerQuery->where('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('ktp', 'like', '%' . $searchTerm . '%');
        });
    })
    ->paginate(10);


        return view('daftarpenghuni', compact('kamarss'));
    }

    public function detailPenghuni($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return abort(404); // You can customize the error handling as needed
        }

        return view('booking.detail', compact('customer'));
    }


}

