<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Ifeanyi Chukwuma Odii</title>
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

        /* Custom Scrollbar for premium feel */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(251, 191, 36, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(251, 191, 36, 0.5);
        }

        /* Bouncing Dots Animation for AI Typing */
        .dot-bounce {
            animation: dotBounce 1.4s infinite ease-in-out both;
        }
        .dot-bounce:nth-child(1) { animation-delay: -0.32s; }
        .dot-bounce:nth-child(2) { animation-delay: -0.16s; }

        @keyframes dotBounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1.0); }
        }

    </style>
</head>

<body class="antialiased text-white min-h-screen relative flex flex-col justify-between"
    style="background-image: url('{{ asset('images/landing-profile.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <!-- Dark Overlay to ensure readability and high-end feel -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm z-0"></div>

    <!-- Navigation Header -->
    <header class="relative z-10 w-full bg-black/40 border-b border-white/10 px-6 lg:px-12 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Back Button -->
            <a href="/" class="flex items-center gap-2 group text-gray-300 hover:text-amber-400 font-semibold text-sm transition-all duration-200">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Home
            </a>

            <!-- Logo -->
            <a href="/" class="text-lg md:text-xl font-bold tracking-wider text-white uppercase select-none hidden sm:inline-block">
                ANYI GA EMEYA <span class="text-amber-400">2027</span>
            </a>

            <!-- Admin Panel Button -->
            <a href="/contacts-login" class="flex items-center gap-1.5 px-4.5 py-2 rounded-xl bg-white/5 border border-white/10 hover:border-amber-400/40 hover:bg-amber-400/10 text-gray-300 hover:text-amber-400 font-semibold text-xs transition-all duration-300 active:scale-95">
                <svg class="w-3.5 h-3.5 text-amber-400/90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Admin Console
            </a>
        </div>
    </header>

    <!-- Main Content Grid -->
    <main class="relative z-10 flex-grow w-full max-w-7xl mx-auto px-4 md:px-8 lg:px-12 py-8 lg:py-16 flex items-center">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 w-full items-stretch">
            
            <!-- Left Side: Interactive AI Assistant Console (lg:col-span-7) -->
            <div class="lg:col-span-7 flex flex-col bg-black/40 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl transition-all hover:border-white/15 h-[580px] lg:h-[640px]">
                <!-- AI Console Header -->
                <div class="bg-white/5 border-b border-white/10 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative w-10 h-10 rounded-full bg-amber-400/10 flex items-center justify-center border border-amber-400/30 overflow-hidden shrink-0">
                            <span class="text-amber-400 font-black text-sm">AI</span>
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-black animate-ping"></span>
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-black"></span>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-sm font-bold tracking-wider text-white uppercase">Anyichuks AI Representative</h2>
                            <span class="text-[10px] text-amber-400/80 font-semibold tracking-widest uppercase">Verified Executive Agent</span>
                        </div>
                    </div>
                    <span class="text-[11px] bg-white/5 px-2.5 py-1 rounded-full text-gray-300 font-medium">Online</span>
                </div>

                <!-- Chat Messages Area -->
                <div id="ai-chat-messages" class="flex-grow overflow-y-auto p-6 space-y-4 flex flex-col">
                    <!-- Initial AI Welcome Bubble -->
                    <div class="flex flex-col items-start max-w-[85%] self-start animate-fade-in">
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1 ml-2">Anyichuks AI</span>
                        <div class="bg-white/5 text-gray-200 px-4 py-3 rounded-2xl rounded-tl-none border border-white/5 shadow-md leading-relaxed text-sm">
                            Welcome! I am the Executive AI Representative for Dr. Ifeanyi Chukwuma Odii. Ask me about his business ventures, extensive philanthropy (Ebele and Anyichuks Foundation), political reforms, or how to reach out to him directly.
                        </div>
                    </div>
                </div>

                <!-- AI Quick-Start Prompts Container -->
                <div class="px-6 py-3 bg-black/25 border-t border-white/5 flex flex-wrap gap-2 overflow-x-auto shrink-0 select-none">
                    <button class="quick-prompt-btn text-xs bg-white/5 hover:bg-amber-400 hover:text-black border border-white/10 rounded-full px-3.5 py-1.5 transition-all active:scale-95 duration-200">
                        What are Dr. Odii's key businesses?
                    </button>
                    <button class="quick-prompt-btn text-xs bg-white/5 hover:bg-amber-400 hover:text-black border border-white/10 rounded-full px-3.5 py-1.5 transition-all active:scale-95 duration-200">
                        Tell me about his philanthropic achievements.
                    </button>
                    <button class="quick-prompt-btn text-xs bg-white/5 hover:bg-amber-400 hover:text-black border border-white/10 rounded-full px-3.5 py-1.5 transition-all active:scale-95 duration-200">
                        What is his political background in Ebonyi?
                    </button>
                </div>

                <!-- Message Input Area -->
                <form id="ai-chat-form" class="bg-black/35 border-t border-white/10 px-6 py-4 flex gap-3 shrink-0">
                    <input type="text" id="ai-chat-input" placeholder="Type your inquiry about Dr. Ifeanyi Chukwuma Odii..."
                        class="flex-grow bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-amber-400/50 transition-colors focus:ring-1 focus:ring-amber-400/30"
                        autocomplete="off" required>
                    <button type="submit"
                        class="px-5 py-3 bg-amber-400 hover:bg-amber-300 text-black font-semibold rounded-xl text-sm transition-all active:scale-95 flex items-center gap-1.5 shrink-0">
                        <span>Ask AI</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Right Side: Contact Form Card (lg:col-span-5) -->
            <div class="lg:col-span-5 flex flex-col bg-black/45 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl p-6 md:p-8 justify-between min-h-[580px] lg:min-h-[640px] relative">
                
                <!-- Standard Form Content -->
                <div id="contact-form-container" class="flex flex-col h-full justify-between">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold tracking-wide text-white">Contact Us</h2>
                        <p class="text-xs text-gray-400 mt-1.5 leading-relaxed">
                            Submit your inquiry directly to Dr. Ifeanyi Chukwuma Odii's executive team. We review all formal inquiries within 48 business hours.
                        </p>

                        <!-- Form Fields -->
                        <form id="contact-form" class="mt-6 space-y-4">
                            <!-- Full Name -->
                            <div class="flex flex-col gap-1">
                                <label for="name" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Full Name</label>
                                <input type="text" id="name" required placeholder="e.g. Chief John Doe"
                                    class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm placeholder-gray-500 focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30">
                            </div>

                            <!-- Email & Phone Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex flex-col gap-1">
                                    <label for="email" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Email Address</label>
                                    <input type="email" id="email" required placeholder="e.g. john@example.com"
                                        class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm placeholder-gray-500 focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="phone" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Phone Number</label>
                                    <input type="tel" id="phone" required placeholder="e.g. +234 803..."
                                        class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm placeholder-gray-500 focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30">
                                </div>
                            </div>

                            <!-- Location & Purpose Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex flex-col gap-1">
                                    <label for="location" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Location</label>
                                    <input type="text" id="location" required placeholder="e.g. Abakaliki, Lagos, New York"
                                        class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm placeholder-gray-500 focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="reason" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Purpose</label>
                                    <select id="reason" required
                                        class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30 text-gray-300">
                                        <option value="" disabled selected class="bg-neutral-900 text-gray-500">Select inquiry reason</option>
                                        <option value="Business Partnership" class="bg-neutral-900 text-white">Business Partnership</option>
                                        <option value="Philanthropy / Sponsorship" class="bg-neutral-900 text-white">Philanthropy / Sponsorship</option>
                                        <option value="Political Engagement" class="bg-neutral-900 text-white">Political Engagement</option>
                                        <option value="Media & Press Inquiry" class="bg-neutral-900 text-white">Media & Press Inquiry</option>
                                        <option value="Other Inquiries" class="bg-neutral-900 text-white">Other Inquiries</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Reason / Message Description -->
                            <div class="flex flex-col gap-1">
                                <label for="message" class="text-[11px] font-bold tracking-wider text-amber-400 uppercase">Inquiry Overview</label>
                                <textarea id="message" required rows="3" placeholder="Provide a brief overview of your proposal, partnership opportunity, or inquiry details..."
                                    class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm placeholder-gray-500 focus:outline-none focus:border-amber-400/50 transition-colors w-full focus:ring-1 focus:ring-amber-400/30 resize-none"></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Submit Area -->
                    <div class="mt-6 pt-4 border-t border-white/5">
                        <button type="button" id="submit-contact-btn"
                            class="w-full py-4 bg-amber-400 hover:bg-amber-300 text-black font-bold tracking-wider uppercase rounded-xl text-xs shadow-2xl hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                            <span>Submit Inquiry</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Sending Loading State (Hidden by default) -->
                <div id="contact-sending-container" class="hidden absolute inset-0 bg-black/85 flex flex-col items-center justify-center p-8 text-center rounded-3xl animate-fade-in z-20">
                    <div class="w-16 h-16 rounded-full border-4 border-amber-400/20 border-t-amber-400 animate-spin mb-4"></div>
                    <h3 class="text-lg font-bold tracking-wider text-white">SENDING INQUIRY...</h3>
                    <p class="text-xs text-gray-400 mt-2 max-w-xs leading-relaxed">
                        Establishing a secure connection to Dr. Ifeanyi Chukwuma Odii's executive office. Please wait.
                    </p>
                </div>

                <!-- Success Confirmation Receipt Panel (Hidden by default) -->
                <div id="contact-success-container" class="hidden absolute inset-0 bg-black/90 flex flex-col items-center justify-between p-8 text-center rounded-3xl animate-fade-in z-20">
                    <div class="flex flex-col items-center justify-center flex-grow">
                        <!-- Animated Checkmark -->
                        <div class="w-16 h-16 rounded-full bg-emerald-500/10 border-2 border-emerald-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-emerald-400 animate-bounce" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold tracking-wide text-white uppercase">Message Sent!</h3>
                        <p class="text-xs text-gray-300 mt-2 leading-relaxed max-w-sm">
                            Thank you, <span id="success-client-name" class="font-bold text-amber-400">---</span>. Your contact inquiry has been successfully submitted and queued for executive review.
                        </p>

                        <!-- Brief Receipt Summary -->
                        <div class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 mt-6 text-left space-y-2">
                            <div class="flex justify-between text-[11px] border-b border-white/5 pb-1">
                                <span class="text-gray-400 uppercase tracking-wider">Reference ID:</span>
                                <span id="success-ref-id" class="font-mono text-amber-400 font-bold">ANYI-93829-26</span>
                            </div>
                            <div class="flex justify-between text-[11px] border-b border-white/5 pb-1">
                                <span class="text-gray-400 uppercase tracking-wider">Purpose:</span>
                                <span id="success-purpose" class="text-gray-200">---</span>
                            </div>
                            <div class="flex justify-between text-[11px] border-b border-white/5 pb-1">
                                <span class="text-gray-400 uppercase tracking-wider">Email Queue:</span>
                                <span id="success-email" class="text-gray-200 font-medium">---</span>
                            </div>
                            <div class="flex justify-between text-[11px]">
                                <span class="text-gray-400 uppercase tracking-wider">Priority:</span>
                                <span class="text-emerald-400 font-bold uppercase tracking-wider">Standard Review</span>
                            </div>
                        </div>
                    </div>

                    <!-- Return Button -->
                    <div class="w-full border-t border-white/5 pt-4">
                        <a href="/"
                            class="block w-full py-3.5 bg-white/10 hover:bg-white/15 text-white font-bold tracking-wider uppercase rounded-xl text-xs transition-colors">
                            Return to Home Page
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- Footer Area -->
    <footer class="relative z-10 w-full text-center py-6 border-t border-white/10 bg-black/40 text-xs text-gray-400 shrink-0">
        <p>© 2026 Dr. Ifeanyi Chukwuma Odii. All rights reserved.</p>
    </footer>

    <!-- AI Agent & Form Interactive Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // --- AI AGENT INTERACTIVE CONSOLE LOGIC ---
            const chatMessagesContainer = document.getElementById('ai-chat-messages');
            const chatForm = document.getElementById('ai-chat-form');
            const chatInput = document.getElementById('ai-chat-input');
            const quickPromptBtns = document.querySelectorAll('.quick-prompt-btn');

            // Helper: Scroll Chat to Bottom
            function scrollChatToBottom() {
                chatMessagesContainer.scrollTo({
                    top: chatMessagesContainer.scrollHeight,
                    behavior: 'smooth'
                });
            }

            // Append Message Bubble to Chat
            function appendMessage(senderName, text, isUser = false) {
                const messageBubble = document.createElement('div');
                messageBubble.className = `flex flex-col max-w-[85%] ${isUser ? 'self-end items-end' : 'self-start items-start'} animate-fade-in`;
                
                const label = document.createElement('span');
                label.className = `text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1 ${isUser ? 'mr-2' : 'ml-2'}`;
                label.textContent = senderName;
                
                const textBubble = document.createElement('div');
                textBubble.className = isUser 
                    ? `bg-amber-400 text-black px-4 py-3 rounded-2xl rounded-tr-none font-medium shadow-md leading-relaxed text-sm`
                    : `bg-white/5 text-gray-200 px-4 py-3 rounded-2xl rounded-tl-none border border-white/5 shadow-md leading-relaxed text-sm whitespace-pre-line`;
                
                textBubble.textContent = text;
                
                messageBubble.appendChild(label);
                messageBubble.appendChild(textBubble);
                chatMessagesContainer.appendChild(messageBubble);
                scrollChatToBottom();
            }

            // Add Typing Indicator
            function showTypingIndicator() {
                const indicator = document.createElement('div');
                indicator.id = 'ai-typing-indicator';
                indicator.className = 'flex flex-col max-w-[85%] self-start items-start animate-fade-in';
                
                const label = document.createElement('span');
                label.className = 'text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1 ml-2';
                label.textContent = 'Anyichuks AI';

                const textBubble = document.createElement('div');
                textBubble.className = 'bg-white/5 px-4 py-3.5 rounded-2xl rounded-tl-none border border-white/5 shadow-md flex items-center gap-1';
                textBubble.innerHTML = `
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full dot-bounce"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full dot-bounce"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full dot-bounce"></span>
                `;

                indicator.appendChild(label);
                indicator.appendChild(textBubble);
                chatMessagesContainer.appendChild(indicator);
                scrollChatToBottom();
            }

            // Remove Typing Indicator
            function removeTypingIndicator() {
                const indicator = document.getElementById('ai-typing-indicator');
                if (indicator) {
                    indicator.remove();
                }
            }

            // Handle Submitting Inquiries to the AI Assistant via real Backend AI Endpoint
            async function handleUserMessageSubmit(messageText) {
                if (!messageText.trim()) return;

                // 1. Append User Message
                appendMessage('You', messageText, true);

                // 2. Show Typing Indicator
                showTypingIndicator();

                try {
                    // 3. Fetch reply from the secure backend proxy
                    const response = await fetch('/api/ai-chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: messageText })
                    });

                    // Log developer debug warnings directly to console instead of showing them to visitors
                    const debugNotice = response.headers.get('X-AI-Debug');
                    if (debugNotice) {
                        console.warn(`[Anyichuks AI Representative]: ${debugNotice}`);
                    }

                    removeTypingIndicator();

                    if (response.ok) {
                        const data = await response.json();
                        appendMessage('Anyichuks AI', data.reply, false);
                    } else {
                        const errorData = await response.json().catch(() => ({}));
                        appendMessage('Anyichuks AI', errorData.reply || 'I am having trouble connecting to my cognitive networks. Please try again shortly.', false);
                    }

                } catch (error) {
                    removeTypingIndicator();
                    appendMessage('Anyichuks AI', 'A connection error occurred. Please ensure your internet is active and try again.', false);
                }
            }

            // Bind Form Submit
            chatForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const text = chatInput.value;
                chatInput.value = '';
                handleUserMessageSubmit(text);
            });

            // Bind Quick Prompt Buttons
            quickPromptBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const text = this.textContent.trim();
                    handleUserMessageSubmit(text);
                });
            });


            // --- CONTACT FORM SUBMISSION FLOW ---
            const contactForm = document.getElementById('contact-form');
            const submitContactBtn = document.getElementById('submit-contact-btn');
            const formContainer = document.getElementById('contact-form-container');
            const sendingContainer = document.getElementById('contact-sending-container');
            const successContainer = document.getElementById('contact-success-container');

            submitContactBtn.addEventListener('click', async function () {
                // Check browser validity
                if (!contactForm.reportValidity()) {
                    return;
                }

                const clientName = document.getElementById('name').value;
                const clientEmail = document.getElementById('email').value;
                const clientPhone = document.getElementById('phone').value;
                const clientLocation = document.getElementById('location').value;
                const clientPurpose = document.getElementById('reason').value;
                const clientMessage = document.getElementById('message').value;

                // 1. Show Sending overlay
                sendingContainer.classList.remove('hidden');

                try {
                    // 2. Perform actual server submission
                    const response = await fetch('/api/contacts', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            name: clientName,
                            email: clientEmail,
                            phone: clientPhone,
                            location: clientLocation,
                            reason: clientPurpose,
                            message: clientMessage
                        })
                    });

                    // A brief slight delay to ensure a premium loader experience
                    await new Promise(resolve => setTimeout(resolve, 800));

                    sendingContainer.classList.add('hidden');

                    if (response.ok) {
                        const data = await response.json();

                        // Hide the standard form container
                        formContainer.classList.add('hidden');

                        // Populate success panel details with verified database response
                        document.getElementById('success-client-name').textContent = data.name;
                        document.getElementById('success-purpose').textContent = data.reason;
                        document.getElementById('success-email').textContent = data.email;
                        document.getElementById('success-ref-id').textContent = data.ref_id;

                        // Show success container
                        successContainer.classList.remove('hidden');
                    } else {
                        alert('Unable to process inquiry. Please ensure all fields are correctly formatted and try again.');
                    }

                } catch (error) {
                    sendingContainer.classList.add('hidden');
                    alert('A connection error occurred. Please ensure your internet is active and try again.');
                }
            });

        });
    </script>
</body>

</html>
