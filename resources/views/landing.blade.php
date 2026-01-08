<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AkuntanMasjid - Centechno</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased">
    <!-- Main Container -->
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-sm shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-base font-bold text-primary-700">
                                AkuntanMasjid
                            </h1>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('login') }}"
                            class="inline-flex text-sm items-center px-6 py-2.5 bg-primary-700 text-white font-medium rounded-lg transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                            Login Masjid
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto px-8 py-16 sm:py-24">
            <div class="text-center">
                <!-- Icon/Logo -->
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary-700 rounded-full blur-2xl opacity-20 animate-pulse"></div>
                        <div class="relative bg-primary-700 p-6 rounded-3xl">
                            <img src="{{asset('assets/icons/mosque.png')}}" alt="Icon Masjid" class="w-10 h-10">
                        </div>
                    </div>
                </div>

                <!-- Heading -->
                <h2 class="text-2xl sm:text-5xl font-bold text-gray-900 mb-6">
                    Kelola Keuangan Masjid
                    <span class="block mt-2 text-primary-600">
                        Dengan Mudah
                    </span>
                </h2>

                <!-- Description -->
                <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-600 leading-relaxed">
                    AkuntanMasjid adalah aplikasi akuntansi sederhana yang membantu Anda mengelola pembukuan,
                    mencatat transaksi, dan membuat laporan keuangan dengan cepat dan efisien.
                </p>

                <!-- CTA Button -->
                <div class="mt-10">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-primary-700 rounded-xl transform hover:scale-105 transition-all duration-200 shadow-xl hover:shadow-2xl">
                        Mulai Sekarang
                        <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pencatatan Transaksi</h3>
                    <p class="text-gray-600">Catat semua transaksi keuangan bisnis Anda dengan mudah dan terorganisir.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Laporan Keuangan</h3>
                    <p class="text-gray-600">Buat laporan keuangan lengkap untuk memantau kesehatan bisnis Anda.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Data keuangan Anda tersimpan dengan aman dan dapat diakses kapan saja.</p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <p class="text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Centechno. <br> Aplikasi Akuntansi Masjid Sederhana.
                </p>
            </div>
        </footer>
    </div>
</body>

</html>