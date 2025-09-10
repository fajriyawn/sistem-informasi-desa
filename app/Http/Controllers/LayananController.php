<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\TrainingRegistration;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

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
            'phone' => 'required|numeric|digits_between:10,15',
            'organization' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'proposal_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // maks 5MB
        ]);

        // Validasi Google reCAPTCHA v2
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaSecret = config('services.recaptcha.secret_key');
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);
        if (!($recaptcha->json('success') ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => ['Verifikasi reCAPTCHA gagal. Silakan coba lagi.']
            ]);
        }

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
            'phone' => 'required|numeric|digits_between:10,15',
            'organization_name' => 'required|string|max:255',
            'participant_count' => 'required|integer|min:1',
            'training_topic' => 'required|string|max:255',
            'proposed_date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        // Validasi Google reCAPTCHA v2
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaSecret = config('services.recaptcha.secret_key');
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip(),
        ]);
        if (!($recaptcha->json('success') ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => ['Verifikasi reCAPTCHA gagal. Silakan coba lagi.']
            ]);
        }

        TrainingRegistration::create($validated);

        return redirect()->route('layanan.index')
            ->with('success', 'Terima kasih! Pendaftaran pelatihan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
