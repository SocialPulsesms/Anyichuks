<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Sign In - Ifeanyi Chukwuma Odii</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpg') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Animations */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

    </style>
</head>

<body class="antialiased text-white min-h-screen relative flex flex-col justify-between"
    style="background-image: url('{{ asset('images/landing-profile.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <!-- Dark Overlay to ensure high-end feel -->
    <div class="absolute inset-0 bg-black/75 backdrop-blur-md z-0"></div>

    <!-- Main Content Panel (Centered Card) -->
    <main class="relative z-10 flex-grow w-full max-w-7xl mx-auto px-4 py-8 flex items-center justify-center">
        
        <div class="w-full max-w-md bg-black/40 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl flex flex-col items-center justify-center animate-fade-in">
            
            <!-- Logo Section -->
            <a href="/" class="text-xl md:text-2xl font-bold tracking-wider text-white uppercase select-none mb-2">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>
            <span class="text-[10px] text-amber-400/80 font-semibold tracking-widest uppercase mb-8 border-b border-white/5 pb-2 w-full text-center">
                Executive Portal Sign In
            </span>

            <!-- Sign In Heading -->
            <div class="w-full text-left mb-6">
                <h2 class="text-lg font-bold text-white tracking-wide">Enter Passcode</h2>
                <p class="text-xs text-gray-400 mt-1 leading-relaxed">
                    Provide the unique administrator security password to open the contact inquiries dashboard.
                </p>
            </div>

            <!-- Login Form -->
            <form id="login-form" class="w-full space-y-5">
                <!-- Password Field -->
                <div class="flex flex-col gap-1.5 relative">
                    <label for="password" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Administrative Password</label>
                    <div class="relative w-full">
                        <input type="password" id="password" required placeholder="••••••••••••••"
                            class="bg-white/5 border border-white/10 rounded-xl pl-4 pr-11 py-3 text-sm placeholder-gray-600 focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30">
                        
                        <!-- Toggle Password Visibility (Eye Icon) -->
                        <button type="button" id="password-toggle-btn" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors focus:outline-none select-none">
                            <svg id="eye-open-icon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye-closed-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Glowing Error Message Panel (Hidden by default) -->
                <div id="error-panel" class="hidden w-full bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-2xl text-xs font-semibold text-left flex items-start gap-2 shadow-inner">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span id="error-message">Error message details here.</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-btn"
                    class="w-full py-4 bg-amber-400 hover:bg-amber-300 text-black font-bold tracking-wider uppercase rounded-xl text-xs shadow-2xl hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                    <span id="submit-text">Access Dashboard</span>
                    <svg id="submit-spinner" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

        </div>

    </main>

    <!-- Footer Area -->
    <footer class="relative z-10 w-full text-center py-6 border-t border-white/10 bg-black/40 text-xs text-gray-400 shrink-0">
        <p>© 2026 Dr. Ifeanyi Chukwuma Odii. Admin Console.</p>
    </footer>

    <!-- Interactive Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const loginForm = document.getElementById('login-form');
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.getElementById('password-toggle-btn');
            const eyeOpen = document.getElementById('eye-open-icon');
            const eyeClosed = document.getElementById('eye-closed-icon');
            const errorPanel = document.getElementById('error-panel');
            const errorMessage = document.getElementById('error-message');
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitSpinner = document.getElementById('submit-spinner');

            // Toggle Password Visibility
            toggleBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeOpen.classList.add('hidden');
                    eyeClosed.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeOpen.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                }
            });

            // Handle AJAX login submit
            loginForm.addEventListener('submit', async function (e) {
                e.preventDefault();
                
                // Hide previous errors & show spinner
                errorPanel.classList.add('hidden');
                submitSpinner.classList.remove('hidden');
                submitText.textContent = 'Validating...';
                submitBtn.disabled = true;

                try {
                    const response = await fetch('/contacts-login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            password: passwordInput.value
                        })
                    });

                    // Add a tiny delay for premium visual loader
                    await new Promise(resolve => setTimeout(resolve, 600));

                    if (response.ok) {
                        // Redirect to the protected dashboard on success
                        window.location.href = '/contacts-dashboard';
                    } else {
                        const data = await response.json();
                        
                        // Show error feedback
                        errorMessage.textContent = data.error || 'Authentication failed. Please verify credentials.';
                        errorPanel.classList.remove('hidden');
                        
                        // Reset submit button state
                        submitSpinner.classList.add('hidden');
                        submitText.textContent = 'Access Dashboard';
                        submitBtn.disabled = false;
                        passwordInput.value = '';
                        passwordInput.focus();
                    }

                } catch (error) {
                    errorMessage.textContent = 'Connection error. Please check your network and try again.';
                    errorPanel.classList.remove('hidden');
                    submitSpinner.classList.add('hidden');
                    submitText.textContent = 'Access Dashboard';
                    submitBtn.disabled = false;
                }
            });

        });
    </script>
</body>

</html>
