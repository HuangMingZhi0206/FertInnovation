<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    private $aiResponses = [
        'cuaca' => 'Untuk mengatasi cuaca ekstrem, saya rekomendasikan: 1) Monitor cuaca real-time, 2) Gunakan sistem irigasi adaptif, 3) Tanam varietas yang tahan cuaca ekstrem, 4) Lindungi tanaman dengan mulsa organik.',
        'pupuk' => 'Panduan efisiensi pupuk: 1) Gunakan pupuk organik untuk meningkatkan kualitas tanah, 2) Aplikasikan pupuk berdasarkan hasil tes tanah, 3) Gunakan pupuk bersamaan dengan irigasi, 4) Hindari pemborosan dengan dosis tepat.',
        'air' => 'Tips efisiensi air: 1) Gunakan sistem irigasi tetes untuk menghemat 40-50% air, 2) Airi pada pagi/sore hari, 3) Monitor kelembaban tanah, 4) Gunakan mulsa untuk mengurangi evaporasi.',
        'panen' => 'Optimalisasi hasil panen: 1) Pilih waktu panen yang tepat, 2) Gunakan peralatan panen modern, 3) Kurangi kehilangan pasca panen dengan penanganan hati-hati, 4) Pastikan penyimpanan yang proper.',
        'harga' => 'Strategi pemasaran: 1) Pantau harga pasar real-time, 2) Manfaatkan tren permintaan tinggi, 3) Jual langsung ke pembeli atau koperasi, 4) Kolaborasi dengan petani lain untuk volume besar.',
        'default' => 'Saya adalah AI Chatbot untuk Agrikultur Supply Chain. Tanyakan tentang: cuaca, pupuk, air, panen, harga pasar, atau manajemen lahan. Bagaimana saya bisa membantu Anda?',
    ];

    public function index()
    {
        return view('chatbot.index');
    }

    public function sendMessage(Request $request)
    {
        $message = strtolower($request->input('message', ''));
        
        $response = $this->aiResponses['default'];
        foreach ($this->aiResponses as $keyword => $aiResponse) {
            if ($keyword !== 'default' && strpos($message, $keyword) !== false) {
                $response = $aiResponse;
                break;
            }
        }

        return response()->json([
            'response' => $response,
            'timestamp' => now()->format('H:i'),
        ]);
    }
}
