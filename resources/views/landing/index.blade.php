<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Kasir Kantin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/logo-color.png">
</head>

<body class="font-sans">
    <header class="sticky top-0 w-full shadow-md">
        <nav class="mx-auto bg-opacity-10 backdrop-filter backdrop-blur-md border-gray-200 py-4">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-6 mx-auto">
                <a href="#" class="flex items-center">
                    <img src="assets/img/logo-color.png" class="h-8 mr-3 sm:h-10" alt="Logo" />
                    <span class="self-center text-2xl font-bold text-gray-800">Website Kantin</span>
                </a>
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li><a href="#" class="block py-2 text-gray-700 hover:text-purple-500">Home</a></li>
                    <li><a href="#features" class="block py-2 text-gray-700 hover:text-purple-500">Fitur</a></li>
                    <li><a href="#statistics" class="block py-2 text-gray-700 hover:text-purple-500">Statistik</a></li>
                    <li><a href="#contact" class="block py-2 text-gray-700 hover:text-purple-500">Kontak</a></li>
                    <li><a href="login" class="block py-2 px-3 bg-purple-500 text-white rounded hover:bg-purple-700">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class=" text-slate-800 h-[700px] flex flex-col justify-center items-center text-center">
        <h1 class="text-7xl font-bold mb-6">Selamat Datang di <span class="bg-gradient-to-r from-purple-700 to-purple-500 text-transparent bg-clip-text">Website Kantin</span></h1>
        <p class="text-lg mb-6 max-w-6xl text-slate-600 text-justify font-poppins">Kelola transaksi, pengguna kasir, produk, dan kategori dengan mudah dalam satu sistem. Sistem kami dirancang untuk memudahkan Anda dalam mengelola berbagai aspek operasional kantin dengan efisien. Dengan fitur-fitur yang lengkap dan user-friendly, Anda dapat meningkatkan produktivitas dan mengurangi kesalahan dalam pengelolaan data. Bergabunglah dengan kami dan rasakan kemudahan dalam mengelola kantin Anda.</p>
        <a href="#features" class="mt-6 inline-block bg-gradient-to-r from-purple-700 to-purple-500 text-white px-8 py-3 rounded-xl text-lg font-semibold shadow-lg">Jelajahi Fitur</a>
    </div>

    <section class="hero pb-12 pt-[100px] ">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-x-4 ">
            <div class="flex flex-col flex-1 gap-y-8 sm:gap-y-10">
                <div class="gap-y-2 sm:gap-y-6 flex flex-col">
                    <h1 class="text-gray-600 font-bold text-5xl sm:text-[70px] leading-none dark:text-white">
                        Tumbuh<br>
                        <span class="text-purple-500 dark:text-purple-400">Bersama RW 02.</span>
                    </h1>
                    <div class="text-sm sm:text-base leading-loose text-black3 dark:text-white">
                        Digitalisasi pencatatan dan pengelolaan data warga RW 02. 
                        mempercepat akses informasi, mendukung pembagian bansos tepat sasaran, kemudahan layanan sosial, pencarian
                        cepat, dan laporan statistik.
                    </div>
                </div>
                <div class="flex flex-row gap-x-4 items-center">
                    <a href=""
                        class="text-sm sm:text-base bg-purple-400 hover:bg-indigo-700 text-white py-4 px-5 sm:py-4 sm:px-10 rounded-full font-semibold dark:bg-purple-700 dark:hover:bg-white dark:hover:text-purple-700">Layanan Kami</a>
                </div>
            </div>
            <div class="flex-row item-center hidden sm:block">
                <img src="assets/img/layanan.webp" alt=""
                    class="w-[550px] h-max-[550px]">
            </div>
        </div>
    </section>

    <section id="features" class="container mx-auto py-20 px-6 text-center">
        <h2 class="text-4xl font-bold mb-10 text-gray-800">Fitur Kami</h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="shadow-lg p-8 rounded-lg bg-white hover:scale-105 transition-transform">
                <img src="assets/img/transaksi.png" class="mx-auto h-24" alt="Transaksi">
                <h4 class="text-xl font-bold mt-4">Kelola Transaksi</h4>
                <p class="mt-2 text-gray-600">Mudah dalam mencatat dan memproses transaksi penjualan.</p>
            </div>
            <div class="shadow-lg p-8 rounded-lg bg-white hover:scale-105 transition-transform">
                <img src="assets/img/user.png" class="mx-auto h-24" alt="User">
                <h4 class="text-xl font-bold mt-4">Manajemen Kasir</h4>
                <p class="mt-2 text-gray-600">Tambah dan kelola data pengguna kasir dengan cepat.</p>
            </div>
            <div class="shadow-lg p-8 rounded-lg bg-white hover:scale-105 transition-transform">
                <img src="assets/img/produk.png" class="mx-auto h-24" alt="Produk">
                <h4 class="text-xl font-bold mt-4">Kelola Produk</h4>
                <p class="mt-2 text-gray-600">Atur produk dan kategori dengan sistem yang terstruktur.</p>
            </div>
        </div>
    </section>

    <section id="statistics" class="bg-gray-100 py-20 text-center">
        <h2 class="text-4xl font-bold mb-10 text-gray-800">Statistik Kami</h2>
        <div class="grid md:grid-cols-4 gap-10">
            <div class="p-8 bg-white rounded-lg shadow-lg">
                <h3 class="text-6xl font-bold text-blue-500" id="jumlahProduk">0</h3>
                <p class="mt-2 text-gray-600">Jumlah Produk</p>
            </div>
            <div class="p-8 bg-white rounded-lg shadow-lg">
                <h3 class="text-6xl font-bold text-green-500" id="jumlahUser">0</h3>
                <p class="mt-2 text-gray-600">Jumlah Pengguna</p>
            </div>
            <div class="p-8 bg-white rounded-lg shadow-lg">
                <h3 class="text-6xl font-bold text-yellow-500" id="jumlahTransaksi">0</h3>
                <p class="mt-2 text-gray-600">Jumlah Transaksi</p>
            </div>
            <div class="p-8 bg-white rounded-lg shadow-lg">
                <h3 class="text-6xl font-bold text-red-500" id="jumlahPendapatan">Rp 0</h3>
                <p class="mt-2 text-gray-600">Jumlah Pendapatan</p>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white text-center py-6">
        <p>&copy; 2024 Kasir Kantin. All Rights Reserved.</p>
    </footer>

    <script>
        function countUp(elementId, endValue, isCurrency = false) {
            let startValue = 0;
            let increment = endValue / 100;
            let interval = setInterval(() => {
                startValue += increment;
                if (startValue >= endValue) {
                    startValue = endValue;
                    clearInterval(interval);
                }
                document.getElementById(elementId).textContent = isCurrency ? 'Rp ' + startValue.toLocaleString() : startValue;
            }, 10);
        }

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    countUp("jumlahProduk", 150);
                    countUp("jumlahUser", 500);
                    countUp("jumlahTransaksi", 1200);
                    countUp("jumlahPendapatan", 7500000, true);
                    observer.disconnect();
                }
            });
        });
        observer.observe(document.querySelector('#statistics'));
    </script>
</body>

</html>
