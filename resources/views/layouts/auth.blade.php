<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - TokoOnlineSMK</title>
    @vite('resources/css/app.css')
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }
        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-glow {
            animation: glow 3s ease-in-out infinite;
        }
        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-10 -left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute top-1/4 -right-10 w-16 h-16 bg-white/10 rounded-full animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-1/3 left-1/4 w-12 h-12 bg-white/10 rounded-full animate-float" style="animation-delay: -4s;"></div>
        <div class="absolute bottom-20 right-1/4 w-24 h-24 bg-white/10 rounded-full animate-float" style="animation-delay: -1s;"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-md">
        @yield('content')
    </div>

    <script>
        // Input focus effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.add('input-focus');
                });
                input.addEventListener('blur', function() {
                    this.classList.remove('input-focus');
                });
            });

            // Form submission loading state
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const button = this.querySelector('button[type="submit"]');
                    if (button) {
                        button.innerHTML = `
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memproses...
                        `;
                        button.disabled = true;
                    }
                });
            });
        });
    </script>
</body>
</html>
