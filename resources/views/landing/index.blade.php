<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/logo-color.png">
</head>

<body class="font-sans">
    <header class="sticky top-0 w-full shadow-md">
        <nav class="mx-auto bg-opacity-10 backdrop-filter backdrop-blur-md border-gray-200 py-4 px-4 sm:px-8 lg:px-16">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto ">
                <a href="#" class="flex items-center">
                    <img src="assets/img/logo-color.png" class="h-8 mr-2 sm:h-10" alt="Logo" />
                    <span class="self-center text-2xl font-bold text-gray-800">Website Kantin</span>
                </a>
                <ul class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-8 font-medium">
                    <li><a href="#" class="block py-2 text-gray-700 hover:text-blue-500">Home</a></li>
                    <li><a href="#features" class="block py-2 text-gray-700 hover:text-blue-500">Fitur</a></li>
                    <li><a href="login"
                            class="block py-2 px-3 bg-blue-500 text-white rounded hover:bg-blue-700">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="px-3  sm:max-w-6xl mx-auto ">
        <section class="hero pb-12">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-x-10">
                <div class="flex flex-col flex-1 sm:gap-y-10">
                    <div class="h-[700px] flex flex-col justify-center">
                        <h1 class="text-6xl text-slate-800 font-bold mb-6 text-start">Selamat Datang di <br><span
                                class="bg-gradient-to-r from-blue-700 to-blue-500 text-transparent bg-clip-text">Website
                                Kantin</span></h1>
                        <div class="text-lg mb-6 max-w-6xl text-slate-600 text-justify">Kelola transaksi,
                            pengguna
                            kasir, produk, dan kategori dengan mudah dalam satu sistem. Sistem kami dirancang untuk
                            memudahkan
                            Anda dalam mengelola berbagai aspek operasional kantin dengan efisien. Dengan fitur-fitur
                            yang
                            lengkap dan user-friendly, Anda dapat meningkatkan produktivitas dan mengurangi kesalahan
                            dalam
                            pengelolaan data. Bergabunglah dengan kami dan rasakan kemudahan dalam mengelola kantin
                            Anda.
                        </div>
                        <div class="items-start">
                            <a href="#features"
                                class="inline-block bg-gradient-to-r from-blue-700 to-blue-500 text-white px-8 py-3 rounded-xl text-lg font-semibold shadow-lg">Jelajahi
                                Fitur</a>
                        </div>
                    </div>
                </div>
                <div class="flex-row item-center hidden sm:block">
                    <img src="assets/img/home.webp" alt="" class="w-[550px] h-max-[550px]">
                </div>
            </div>
        </section>
    </div>

    <section id="features" class="container mx-auto py-36 px-6 text-center">
        <h2 class="text-4xl font-bold mb-10 text-gray-800">Fitur Kami</h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="shadow-lg p-8 rounded-lg bg-white hover:scale-105 transition-transform">
                <img src="assets/img/orangorang.webp" class="mx-auto h-72" alt="Transaksi">
                <h4 class="text-xl font-bold mt-4">Kelola Transaksi</h4>
                <p class="mt-2 text-gray-600">Mudah dalam mencatat dan memproses transaksi penjualan.</p>
            </div>
            <div class="shadow-lg p-8 rounded-lg bg-white hover:scale-105 transition-transform">
                <img src="assets/img/layanan.webp" class="mx-auto h-72" alt="User">
                <h4 class="text-xl font-bold mt-4">Manajemen Kasir</h4>
                <p class="mt-2 text-gray-600">Tambah dan kelola data pengguna kasir dengan cepat.</p>
            </div>
            <div class="shadow-lg p-8 rounded-lg bg-white hover:scale-105 transition-transform">
                <img src="assets/img/warga.webp" class="mx-auto h-72" alt="Produk">
                <h4 class="text-xl font-bold mt-4">Kelola Produk</h4>
                <p class="mt-2 text-gray-600">Atur produk dan kategori dengan sistem yang terstruktur.</p>
            </div>
        </div>
    </section>

    <footer class="bg-white text-slate-800 text-center py-6 border-t border-gray-200">
        <p>&copy; 2025 Website Kantin. All Rights Reserved.</p>
    </footer>
</body>

</html>
