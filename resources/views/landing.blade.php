<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Nurul Jadid</title>

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
    <style>
        .hero-background {
            background-image: url('{{ asset('assets/images/masjid_nurul_jadid.webp') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        @media (max-width: 768px) {
            .hero-background {
                background-position: 65% center;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Main Container -->
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white backdrop-blur-sm shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="/" class="text-lg font-bold text-primary-700">
                                Yayasan Nurul Jadid
                            </a>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('login') }}"
                            class="inline-flex text-sm items-center px-6 py-2.5 bg-primary-700 text-white font-medium rounded-lg transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                            Login
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative hero-background">
            <div class="absolute inset-0 bg-black/75"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
                <div class="text-center text-white">
                    <!-- Logo/Icon -->
                    <div class="flex justify-center mb-8">
                        <div class="relative">
                            <div class="absolute inset-0 bg-primary-700 rounded-full blur-2xl opacity-40 animate-pulse"></div>
                            <div class="relative bg-primary-700 p-6 rounded-3xl">
                                <img src="{{asset('assets/icons/mosque.png')}}" alt="Icon Masjid" class="w-10 h-10">
                            </div>
                        </div>
                    </div>

                    <!-- Heading -->
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold mb-6">
                        Yayasan Nurul Jadid
                    </h1>
                    
                    <!-- Subheading -->
                    <p class="text-lg sm:text-xl text-primary-200 mb-8">
                        Berdakwah, Berpendidikan, Bermasyarakat
                    </p>

                    <!-- Description -->
                    <p class="mt-6 max-w-3xl mx-auto text-base sm:text-lg text-gray-100 leading-relaxed">
                        Sebuah yayasan yang berkomitmen untuk pengembangan masyarakat melalui pendidikan, dakwah, dan kegiatan sosial yang bermanfaat bagi umat.
                    </p>

                    <!-- CTA Button -->
                    <div class="mt-10">
                        <a href="#tentang"
                            class="inline-flex items-center px-8 py-4 text-base font-semibold text-white bg-primary-700 rounded-xl transform hover:scale-105 transition-all duration-200 shadow-xl hover:shadow-2xl hover:bg-primary-600">
                            Pelajari Lebih Lanjut
                            <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            
            <!-- Tentang Kami Section -->
            <section id="tentang" class="mb-24 scroll-mt-20">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
                        Tentang Yayasan Nurul Jadid
                    </h2>
                    <div class="w-24 h-1 bg-primary-600 mx-auto mb-6"></div>
                    <p class="text-base text-gray-600 max-w-3xl mx-auto">
                        Yayasan Nurul Jadid merupakan organisasi nirlaba yang berfokus pada pengembangan masyarakat melalui berbagai program pendidikan, keagamaan, dan sosial.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Visi & Misi</h3>
                        <p class="text-gray-600 mb-6">
                            Menjadi yayasan yang berkontribusi aktif dalam membangun masyarakat yang berakhlak mulia, berpendidikan, dan sejahtera melalui program-program yang berkelanjutan.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-primary-600 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700">Menyelenggarakan pendidikan formal dan non-formal</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-primary-600 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700">Mengembangkan kegiatan dakwah dan keagamaan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-primary-600 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700">Melaksanakan program pemberdayaan masyarakat</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-primary-600 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700">Menyediakan bantuan sosial untuk yang membutuhkan</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-primary-50 p-8 rounded-2xl border border-primary-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Lokasi Yayasan</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-primary-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Alamat</h4>
                                    <p class="text-gray-600">
                                        Jl. Patimura No.2, Dusun Sampangan, Kedungrejo,<br>
                                        Kec. Muncar, Kabupaten Banyuwangi,<br>
                                        Jawa Timur 68472
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Program & Kegiatan Section -->
            <section class="mb-24">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
                        Program & Kegiatan
                    </h2>
                    <div class="w-24 h-1 bg-primary-600 mx-auto mb-6"></div>
                    <p class="text-base text-gray-600 max-w-3xl mx-auto">
                        Berbagai program dan kegiatan yang diselenggarakan oleh Yayasan Nurul Jadid untuk masyarakat
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Program 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Pendidikan & Beasiswa</h3>
                        <p class="text-gray-600">Program pendidikan untuk anak-anak dan remaja, termasuk pemberian beasiswa bagi siswa berprestasi dari keluarga kurang mampu.</p>
                    </div>

                    <!-- Program 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Kegiatan Keagamaan</h3>
                        <p class="text-gray-600">Pengajian rutin, peringatan hari besar Islam, dan kegiatan keagamaan lainnya untuk memperkuat iman dan takwa masyarakat.</p>
                    </div>

                    <!-- Program 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Pemberdayaan Masyarakat</h3>
                        <p class="text-gray-600">Pelatihan keterampilan, usaha mikro, dan program pemberdayaan lainnya untuk meningkatkan kesejahteraan ekonomi masyarakat.</p>
                    </div>
                </div>
            </section>

            <!-- Kontak Section -->
            <section id="kontak" class="scroll-mt-20">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
                        Hubungi Kami
                    </h2>
                    <div class="w-24 h-1 bg-primary-600 mx-auto mb-6"></div>
                    <p class="text-base text-gray-600 max-w-3xl mx-auto">
                        Ingin berkontribusi, bertanya, atau berkolaborasi dengan Yayasan Nurul Jadid? Silakan hubungi kami
                    </p>
                </div>

                <div class="bg-primary-50 rounded-2xl p-8 md:p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="bg-white p-3 rounded-lg shadow-sm mr-4">
                                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Alamat</h4>
                                        <p class="text-gray-700">
                                            Jl. Patimura No.2, Dusun Sampangan,<br>
                                            Kedungrejo, Kec. Muncar,<br>
                                            Kabupaten Banyuwangi, Jawa Timur 68472
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-white p-3 rounded-lg shadow-sm mr-4">
                                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Telepon</h4>
                                        <p class="text-gray-700">(0333) 123456</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-white p-3 rounded-lg shadow-sm mr-4">
                                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                        <p class="text-gray-700">yayasan.nuruljadid@email.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Jam Operasional</h3>
                            <div class="bg-white rounded-xl p-6 shadow-sm">
                                <ul class="space-y-4">
                                    <li class="flex justify-between items-center pb-3 border-b border-gray-100">
                                        <span class="text-gray-700">Senin - Kamis</span>
                                        <span class="font-medium text-gray-900">08:00 - 16:00</span>
                                    </li>
                                    <li class="flex justify-between items-center pb-3 border-b border-gray-100">
                                        <span class="text-gray-700">Jumat</span>
                                        <span class="font-medium text-gray-900">08:00 - 11:30</span>
                                    </li>
                                    <li class="flex justify-between items-center pb-3 border-b border-gray-100">
                                        <span class="text-gray-700">Sabtu</span>
                                        <span class="font-medium text-gray-900">08:00 - 14:00</span>
                                    </li>
                                    <li class="flex justify-between items-center">
                                        <span class="text-gray-700">Minggu</span>
                                        <span class="font-medium text-gray-900">Libur</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">Yayasan Nurul Jadid</h3>
                        <p class="text-gray-400">
                            Berdakwah, Berpendidikan, Bermasyarakat untuk membangun umat yang lebih baik.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-2">
                            <li><a href="#tentang" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                            <li><a href="#kontak" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Program</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Lokasi</h4>
                        <p class="text-gray-400">
                            Jl. Patimura No.2, Dusun Sampangan,<br>
                            Kedungrejo, Kec. Muncar,<br>
                            Kabupaten Banyuwangi, Jawa Timur 68472
                        </p>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; <span id="currentYear"></span> Yayasan Nurul Jadid. <br> Website Developed by Centechno.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>