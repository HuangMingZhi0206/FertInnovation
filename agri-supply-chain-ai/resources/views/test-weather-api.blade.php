<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Weather API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        button {
            background: #10b981;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
        }
        button:hover {
            background: #059669;
        }
        button:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background: #f9fafb;
            border-left: 4px solid #3b82f6;
        }
        .error {
            border-left-color: #ef4444;
            background: #fef2f2;
        }
        .success {
            border-left-color: #10b981;
            background: #f0fdf4;
        }
        pre {
            background: #1f2937;
            color: #f3f4f6;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .info {
            background: #dbeafe;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Weather API Test</h1>
        
        <div class="info">
            <strong>Testing Route:</strong> <code>{{ route('api.weather.location') }}</code>
        </div>

        <h3>Test 1: Manual Test (Jakarta)</h3>
        <button onclick="testJakarta()" id="testBtn1">Test Jakarta Coordinates</button>

        <h3>Test 2: Current Location</h3>
        <button onclick="testCurrentLocation()" id="testBtn2">Test My Location</button>

        <h3>Test 3: Invalid Coordinates</h3>
        <button onclick="testInvalid()" id="testBtn3">Test Invalid Location</button>

        <div id="result"></div>
    </div>

    <script>
        function showResult(title, data, isError = false) {
            const resultDiv = document.getElementById('result');
            const className = isError ? 'result error' : 'result success';
            resultDiv.innerHTML = `
                <div class="${className}">
                    <h4>${title}</h4>
                    <pre>${JSON.stringify(data, null, 2)}</pre>
                </div>
            `;
        }

        async function testJakarta() {
            const btn = document.getElementById('testBtn1');
            btn.disabled = true;
            btn.textContent = 'Testing...';

            try {
                const url = '{{ route("api.weather.location") }}?lat=-6.1753&lon=106.8271';
                console.log('Testing URL:', url);

                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                });

                console.log('Response status:', response.status);
                
                const data = await response.json();
                console.log('Response data:', data);
                
                showResult('✅ Test Jakarta Success', data, false);
            } catch (error) {
                console.error('Error:', error);
                showResult('❌ Test Failed', {
                    error: error.message,
                    stack: error.stack
                }, true);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Test Jakarta Coordinates';
            }
        }

        async function testCurrentLocation() {
            const btn = document.getElementById('testBtn2');
            btn.disabled = true;
            btn.textContent = 'Getting location...';

            if (!navigator.geolocation) {
                showResult('❌ Geolocation Not Supported', {
                    error: 'Your browser does not support geolocation'
                }, true);
                btn.disabled = false;
                btn.textContent = 'Test My Location';
                return;
            }

            navigator.geolocation.getCurrentPosition(
                async function(position) {
                    try {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
                        
                        const url = `{{ route("api.weather.location") }}?lat=${lat}&lon=${lon}`;
                        console.log('Testing URL:', url);

                        const response = await fetch(url, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            credentials: 'same-origin'
                        });

                        const data = await response.json();
                        showResult(`✅ Current Location (${lat.toFixed(4)}, ${lon.toFixed(4)})`, data, false);
                    } catch (error) {
                        showResult('❌ Test Failed', { error: error.message }, true);
                    } finally {
                        btn.disabled = false;
                        btn.textContent = 'Test My Location';
                    }
                },
                function(error) {
                    showResult('❌ Location Error', {
                        code: error.code,
                        message: error.message
                    }, true);
                    btn.disabled = false;
                    btn.textContent = 'Test My Location';
                }
            );
        }

        async function testInvalid() {
            const btn = document.getElementById('testBtn3');
            btn.disabled = true;
            btn.textContent = 'Testing...';

            try {
                const url = '{{ route("api.weather.location") }}?lat=50&lon=50'; // Outside Indonesia
                console.log('Testing URL:', url);

                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                });

                const data = await response.json();
                showResult('⚠️ Invalid Location Response', data, response.status !== 200);
            } catch (error) {
                showResult('❌ Test Failed', { error: error.message }, true);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Test Invalid Location';
            }
        }
    </script>
</body>
</html>
