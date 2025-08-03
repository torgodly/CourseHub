<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'admin-blue': '#3B82F6',
                        'trainer-green': '#10B981',
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center p-4 relative overflow-hidden">
<!-- Colorful Background Elements -->
<div class="absolute inset-0 overflow-hidden">
    <div class="absolute top-20 left-20 w-72 h-72 bg-gradient-to-r from-blue-200 to-cyan-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
    <div class="absolute top-40 right-20 w-72 h-72 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-2000"></div>
    <div class="absolute -bottom-20 left-1/2 w-72 h-72 bg-gradient-to-r from-emerald-200 to-teal-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-4000"></div>
</div>

<div class="w-full max-w-4xl mx-auto relative z-10">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-4">Welcome Back</h1>
        <p class="text-xl text-gray-700 font-medium">Choose your role to access your dashboard</p>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 mx-auto mt-4 rounded-full"></div>
    </div>

    <!-- Cards Container -->
    <div class="grid md:grid-cols-2 gap-8 max-w-2xl mx-auto">
        <!-- Admin Card -->
        <div class="group cursor-pointer" onclick="redirectToLogin('admin')">
            <div class="bg-gradient-to-br from-white to-blue-50 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 hover:scale-105 p-8 border-2 border-blue-100 hover:border-blue-300 backdrop-blur-sm relative overflow-hidden">
                <!-- Card Background Pattern -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100 to-transparent rounded-full -translate-y-16 translate-x-16 opacity-50"></div>

                <div class="text-center relative z-10">
                    <!-- Admin Icon -->
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-blue-500/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors duration-300">Administrator</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed font-medium">Manage users, system settings, and access comprehensive analytics dashboard with full control.</p>

                    <!-- Button -->
                    <div class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl font-bold group-hover:from-blue-600 group-hover:to-indigo-700 transition-all duration-300 shadow-lg shadow-blue-500/40 group-hover:shadow-blue-500/60 group-hover:shadow-xl">
                        <span>Access Admin Panel</span>
                        <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trainer Card -->
        <div class="group cursor-pointer" onclick="redirectToLogin('trainer')">
            <div class="bg-gradient-to-br from-white to-emerald-50 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 hover:scale-105 p-8 border-2 border-emerald-100 hover:border-emerald-300 backdrop-blur-sm relative overflow-hidden">
                <!-- Card Background Pattern -->
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-100 to-transparent rounded-full -translate-y-16 translate-x-16 opacity-50"></div>

                <div class="text-center relative z-10">
                    <!-- Trainer Icon -->
                    <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-emerald-500/30">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-800 mb-4 group-hover:text-emerald-600 transition-colors duration-300">Trainer</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed font-medium">Manage courses, track student progress, and access comprehensive training resources.</p>

                    <!-- Button -->
                    <div class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-2xl font-bold group-hover:from-emerald-600 group-hover:to-teal-700 transition-all duration-300 shadow-lg shadow-emerald-500/40 group-hover:shadow-emerald-500/60 group-hover:shadow-xl">
                        <span>Access Training Hub</span>
                        <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-16">
        <p class="text-gray-600 text-sm font-medium">Need assistance? <a href="#" class="text-blue-600 hover:text-blue-700 font-bold transition-colors duration-300 underline decoration-blue-400/50 hover:decoration-blue-600">Contact Support</a></p>
    </div>
</div>

<script>
    function redirectToLogin(role) {
        if (role === 'admin') {
            // Redirect to admin login page
            window.location.href = '/admin/login';
        } else if (role === 'trainer') {
            // Redirect to trainer login page
            window.location.href = '/trainer/login';
        }
    }

    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === '1') {
            redirectToLogin('admin');
        } else if (e.key === '2') {
            redirectToLogin('trainer');
        }
    });

    // Add interactive tilt effect
    document.addEventListener('mousemove', function(e) {
        const cards = document.querySelectorAll('.group');
        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            if (x >= 0 && x <= rect.width && y >= 0 && y <= rect.height) {
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-16px) scale(1.05)`;
            } else {
                card.style.transform = '';
            }
        });
    });
</script>

<style>
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }

    @keyframes bounce-gentle {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .group:hover {
        animation: bounce-gentle 2s ease-in-out infinite;
    }

    /* Add some sparkle effect */
    .group::before {
        content: '';
        position: absolute;
        top: 20px;
        right: 20px;
        width: 6px;
        height: 6px;
        background: linear-gradient(45deg, #3B82F6, #8B5CF6);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .group:hover::before {
        opacity: 1;
        animation: sparkle 1.5s ease-in-out infinite;
    }

    @keyframes sparkle {
        0%, 100% { transform: scale(0) rotate(0deg); opacity: 0; }
        50% { transform: scale(1) rotate(180deg); opacity: 1; }
    }
</style>
</body>
</html>
