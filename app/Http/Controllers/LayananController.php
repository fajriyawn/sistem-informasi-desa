<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\TrainingRegistration;

class LayananController extends Controller
{
    // Menampilkan halaman utama Layanan
    public function index()
    {
        return view('layanan.index');
    }

    // Menampilkan form pengajuan rehabilitasi
    public function showProposalForm()
    {
        return view('layanan.proposal-form');
    }

    // Menyimpan data dari form
    public function storeProposal(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'organization' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'proposal_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // maks 5MB
        ]);

        $filePath = null;
        if ($request->hasFile('proposal_file')) {
            $filePath = $request->file('proposal_file')->store('proposals', 'public');
        }

        Proposal::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'organization' => $validated['organization'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('layanan.index')
            ->with('success', 'Terima kasih! Pengajuan Anda telah berhasil dikirim dan akan segera kami review.');
    }

    public function showTrainingForm()
    {
        return view('layanan.training-form');
    }

    // Menyimpan data dari form pelatihan
    public function storeTraining(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'organization_name' => 'required|string|max:255',
            'participant_count' => 'required|integer|min:1',
            'training_topic' => 'required|string|max:255',
            'proposed_date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        TrainingRegistration::create($validated);

        return redirect()->route('layanan.index')
            ->with('success', 'Terima kasih! Pendaftaran pelatihan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
