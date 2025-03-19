<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rujukan;
use App\Models\User;

class RujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rujukan = Rujukan::latest()->get();
        return view('admin.index', compact('rujukan'));
    }


    /**
     * Display a User Rujukan.
     */
    public function indexUser()
    {
        $userId = auth()->id(); // Get the logged-in user's ID
    
        // Filter rujukan where the logged-in user is in the visible_to column
        $rujukan = Rujukan::whereRaw("FIND_IN_SET(?, rujuk_pasien)", [$userId])->latest()->get();
    
        return view('user.index', compact('rujukan', 'userId'));
    }


    public function approve($id)
    {
        $userId = auth()->id(); // Get the logged-in user's ID
    
        // Find the rujukan
        $rujukan = Rujukan::findOrFail($id);
    
        // Get the current approved_by list
        $approvedBy = $rujukan->approved_by_array;
    
        // Add the current user ID if not already approved
        if (!in_array($userId, $approvedBy)) {
            $approvedBy[] = $userId;
            $rujukan->approved_by = implode(',', $approvedBy); // Convert back to a comma-separated string
            $rujukan->save();
        }
    
        return redirect()->route('rujukan.indexUser')->with('success', 'Rujukan approved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type', 0)->get();
        return view('admin.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{

    // dd($request->all());
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nama_pasien' => 'required|string|max:255',
        'rujuk_pasien' => 'required|array',
        'rujuk_pasien.*' => 'string|max:255',
        'keterangan' => 'required|string|max:255',
        // 'status' => 'required|in:pending,approved',
    ]);

    // Convert the rujuk_pasien array to a comma-separated string
    $validatedData['rujuk_pasien'] = implode(',', $validatedData['rujuk_pasien']);


    // Create a new Rujukan instance and fill it with validated data
    $rujukan = new Rujukan($validatedData);

    // Save the new Rujukan instance to the database
    $rujukan->save();

    // Redirect to a specific route with a success message
    return redirect()->route('rujukan.index')->with('success', 'Rujukan created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rujukan = Rujukan::findOrFail($id);
        $users = User::where('type', 0)->get();
        return view('admin.edit', compact('rujukan', 'users'));
   
    }

    /**
     * Show the form for editing user.
     */
    // public function editUser($id)
    // {   
    //     $rujukan = Rujukan::findOrFail($id);
    //     $users = User::where('type', 0)->get();
    //     return view('user.edit', compact('rujukan', 'users'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'rujuk_pasien' => 'required|array',
            'rujuk_pasien.*' => 'string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Convert the rujuk_pasien array to a comma-separated string
        $validatedData['rujuk_pasien'] = implode(',', $validatedData['rujuk_pasien']);

        // Find the existing Rujukan instance by ID
        $rujukan = Rujukan::findOrFail($id);

        // Update the Rujukan instance with validated data
        $rujukan->update($validatedData);

        // Redirect to a specific route with a success message
        return redirect()->route('rujukan.index')->with('success', 'Rujukan updated successfully.');

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request, $id)
    {
        // dd($request->all());
        // Validate the incoming request data
        // $validatedData = $request->validate([
        //     'nama_pasien' => 'required|string|max:255',
        //     'rujuk_pasien' => 'required|array',
        //     'rujuk_pasien.*' => 'string|max:255',
        //     'keterangan' => 'required|string|max:255',
        //     'status' => 'required|in:pending,approved',
        // ]);

        // Convert the rujuk_pasien array to a comma-separated string
        // $validatedData['rujuk_pasien'] = implode(',', $validatedData['rujuk_pasien']);

        // Find the existing Rujukan instance by ID
        $rujukan = Rujukan::findOrFail($id);

        // Update the Rujukan instance with validated data
        $rujukan->update($request->all());

        // Redirect to a specific route with a success message
        return redirect()->route('rujukan.indexUser')->with('success', 'Rujukan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
