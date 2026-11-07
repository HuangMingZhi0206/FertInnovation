<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🤖 AI ChatBot - Konsultasi Pertanian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Selamat Datang di ChatBot AI FertInnovation</h3>
                        <p class="text-gray-600">Tanyakan pertanyaan Anda seputar pertanian, harga pasar, manajemen air, pupuk, dan prediksi cuaca. AI kami siap membantu!</p>
                    </div>

                    <!-- Chat Container -->
                    <div id="chatContainer" class="bg-gray-50 rounded-lg p-4 h-96 overflow-y-auto mb-4 border border-gray-200">
                        <!-- Initial Message -->
                        <div class="mb-4">
                            <div class="bg-blue-100 rounded-lg p-3 max-w-xs">
                                <p class="text-sm text-blue-900">👋 Halo! Saya adalah AI Assistant FertInnovation. Saya dapat membantu Anda dengan:</p>
                            </div>
                            <div class="mt-2 text-xs text-gray-600">
                                <ul class="list-disc ml-4">
                                    <li>Konsultasi pertanian dan teknik tanam</li>
                                    <li>Analisis harga pasar produk pertanian</li>
                                    <li>Manajemen air dan pupuk yang efisien</li>
                                    <li>Prediksi cuaca dan dampaknya</li>
                                    <li>Optimasi hasil panen</li>
                                    <li>Saran bisnis agrikultur</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Questions -->
                    <div class="mb-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">💡 Pertanyaan yang Sering Diajukan:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <button onclick="sendMessage('Kapan waktu terbaik untuk menanam padi?')" class="bg-blue-50 hover:bg-blue-100 text-left p-2 rounded border border-blue-200 text-sm">
                                ❓ Kapan waktu terbaik untuk menanam padi?
                            </button>
                            <button onclick="sendMessage('Bagaimana cara menghemat penggunaan air?')" class="bg-blue-50 hover:bg-blue-100 text-left p-2 rounded border border-blue-200 text-sm">
                                ❓ Bagaimana cara menghemat penggunaan air?
                            </button>
                            <button onclick="sendMessage('Pupuk apa yang terbaik untuk tanah masam?')" class="bg-blue-50 hover:bg-blue-100 text-left p-2 rounded border border-blue-200 text-sm">
                                ❓ Pupuk apa yang terbaik untuk tanah masam?
                            </button>
                            <button onclick="sendMessage('Berapa harga pasar padi saat ini?')" class="bg-blue-50 hover:bg-blue-100 text-left p-2 rounded border border-blue-200 text-sm">
                                ❓ Berapa harga pasar padi saat ini?
                            </button>
                        </div>
                    </div>

                    <!-- Input Area -->
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            id="userInput" 
                            placeholder="Ketik pertanyaan Anda di sini..." 
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onkeypress="handleKeyPress(event)"
                        >
                        <button 
                            onclick="sendMessage(document.getElementById('userInput').value)"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold"
                        >
                            Kirim
                        </button>
                    </div>

                    <!-- Info -->
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg text-xs text-gray-600">
                        <p>💡 <strong>Tips:</strong> Semakin spesifik pertanyaan Anda, semakin akurat jawaban dari AI kami. Tuliskan kondisi lahan, jenis tanaman, dan masalah yang dihadapi untuk mendapatkan saran terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatContainer = document.getElementById('chatContainer');
        const userInput = document.getElementById('userInput');

        // AI Responses Database
        const aiResponses = {
            'padi': 'Untuk padi, waktu terbaik menanam adalah pada awal musim hujan. Gunakan benih berkualitas, lakukan penyiapan lahan dengan baik, dan jaga ketinggian air 5-10 cm. Hasil optimal: 8-12 ton/ha.',
            'air': 'Hemat air dengan: 1) Irigasi tetes/drip, 2) Mulsa untuk retensi air, 3) Panen air hujan, 4) Pemupukan terukur. Efisiensi irigasi modern: 80-90%.',
            'pupuk': 'Untuk tanah masam gunakan: 1) Dolomit untuk menetralkan, 2) NPK sesuai kebutuhan tanaman, 3) Pupuk organik. Konsultasikan dengan petani lokal untuk dosis tepat.',
            'harga': 'Harga padi berkisar Rp 5.000-8.000/kg tergantung kualitas dan lokasi pasar. Pantau harga real-time di fitur Market Prices untuk keputusan jual optimal.',
            'cuaca': 'Monitor cuaca penting untuk: 1) Penjadwalan tanam, 2) Irigasi, 3) Aplikasi pupuk/pestisida. Hindari aplikasi saat hujan deras.',
            'hasil': 'Optimalkan hasil dengan: 1) Varietas unggul, 2) Pengelolaan hama/penyakit, 3) Pupuk berimbang, 4) Irigasi teratur, 5) Pemanenan tepat waktu. Gunakan AI prediction kami!',
        };

        function sendMessage(message) {
            if (!message.trim()) return;

            // Add user message
            const userMsg = document.createElement('div');
            userMsg.className = 'mb-4 flex justify-end';
            userMsg.innerHTML = `<div class="bg-green-100 rounded-lg p-3 max-w-xs"><p class="text-sm text-green-900">${message}</p></div>`;
            chatContainer.appendChild(userMsg);

            userInput.value = '';

            // Simulate AI response
            setTimeout(() => {
                const lowerMsg = message.toLowerCase();
                let response = '';

                for (const [key, value] of Object.entries(aiResponses)) {
                    if (lowerMsg.includes(key)) {
                        response = value;
                        break;
                    }
                }

                if (!response) {
                    response = '🤔 Pertanyaan yang menarik! Berdasarkan data pertanian saat ini, saya rekomendasikan: 1) Konsultasi dengan ahli agronomi lokal, 2) Pantau dashboard monitoring kami untuk data real-time, 3) Gunakan fitur prediksi AI kami untuk perencanaan yang lebih baik. Ada lagi yang bisa saya bantu?';
                }

                const aiMsg = document.createElement('div');
                aiMsg.className = 'mb-4';
                aiMsg.innerHTML = `<div class="bg-blue-100 rounded-lg p-3 max-w-xs"><p class="text-sm text-blue-900">🤖 ${response}</p></div>`;
                chatContainer.appendChild(aiMsg);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 500);
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage(userInput.value);
            }
        }

        // Auto-scroll
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
</x-app-layout>
