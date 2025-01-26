<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the profile of a specific user.
     */
    public function show($id)
    {
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::with('classs', 'attendance', 'payment', 'trainsession')->findOrFail($id);

        return view('profile', [
            'pagetitle' => $user->username . ' Detail',
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'image_profile' => 'nullable|image|max:1024',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password);
            }
        }

        if ($request->hasFile('image_profile')) {
            if ($user->image_profile && file_exists(storage_path('app/public/' . $user->image_profile))) {
                unlink(storage_path('app/public/' . $user->image_profile));
            }

            $path = $request->file('image_profile')->store('profile_images', 'public');
            $user->image_profile = $path;
        }

        $user->update([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'birth_date' => $request->input('birth_date'),
        ]);

        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully');
    }

    public function destroy(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        if ($user->image_profile && file_exists(storage_path('app/public/' . $user->image_profile))) {
            unlink(storage_path('app/public/' . $user->image_profile));
        }

        $user->delete();

        return redirect('/');
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        $birthDate = $request->input('birth_date');
        $classId = $this->assignClassBasedOnAge($birthDate);

        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'birth_date' => $birthDate,
            'class_id' => $classId,
        ]);

        Auth::login($user);

        return redirect()->route('profile', $user->id)->with('success', 'Registration successful.');
    }

    /**
     * Assign class based on age.
     */
    private function assignClassBasedOnAge(string $birthDate): ?int
    {
        $classes = Classs::all(); // Ambil semua kelas
        $birthDate = strtotime($birthDate); // Konversi tanggal lahir ke timestamp
        $currentDate = time(); // Tanggal sekarang

        // Hitung usia berdasarkan tahun, bulan, dan hari
        $age = date('Y', $currentDate) - date('Y', $birthDate);

        // Jika belum ulang tahun tahun ini, kurangi satu tahun
        if (date('m', $currentDate) < date('m', $birthDate) || 
            (date('m', $currentDate) == date('m', $birthDate) && date('d', $currentDate) < date('d', $birthDate))) {
            $age--;
        }

        return match (true) {
            $age >= 10 && $age <= 12 => $classes->where('class_name', 'KU 12')->first()?->id, // Untuk umur 10-12
            $age >= 12 && $age <= 14 => $classes->where('class_name', 'KU 14')->first()?->id, // Untuk umur 12-14
            $age >= 14 && $age <= 16 => $classes->where('class_name', 'KU 16')->first()?->id, // Untuk umur 14-16
            $age >= 16 && $age <= 18 => $classes->where('class_name', 'KU 18')->first()?->id, // Untuk umur 16-18
            $age > 18 => $classes->where('class_name', 'Adult')->first()?->id, // Untuk umur lebih dari 18
            default => null, // Jika tidak sesuai kategori
        };
    }
}
