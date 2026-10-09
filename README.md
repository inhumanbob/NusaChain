# NusaChain

NusaChain adalah sebuah Supply Chain Enterprise Application berbasis web yang berfungsi sebagai platform konsolidasi logistik B2B. 

Platform ini dirancang untuk memecahkan masalah mahalnya ongkos kirim eceran *Less than Container Load* (LCL) dan ketidakmampuan UMKM untuk memenuhi *Minimum Order Quantity* (MOQ) yang diminta oleh pembeli global . NusaChain bekerja dengan cara menggabungkan kapasitas produksi dari beberapa UMKM menjadi satu "Konsorsium Digital", sehingga barang dapat dikirim secara *Full Container Load* (FCL) yang jauh lebih murah dan terstandarisasi.

## Tim Pengembang
Proyek ini dikembangkan oleh **Kelompok 6 (Kelas 4E)** yang terdiri dari:
* Bagas Darma Saputra (2313020225) 
* Dyah Avri Kartika Hapsari (2313020239) 
* Ilham Dimas Ramadhan (2313020238) 

## Fokus Fitur Utama
Sistem ini dibangun dengan tiga modul utama:

* **Modul 1: Smart Clustering (Fokus: Logistics)** 
  Menggunakan algoritma *filtering* yang mencocokkan UMKM berdasarkan kesamaan kategori produk, kesesuaian HS Code (agar lolos Bea Cukai), dan kuota volume barang untuk memenuhi 1 kontainer penuh.
* **Modul 2: B2B Matchmaking & Planning (Fokus: Supply Chain Planning)** 
  Sistem yang dirancang untuk mempertemukan pesanan MOQ dari *Buyer* dengan kapasitas gabungan dari "Konsorsium UMKM" yang sudah terbentuk, serta menampilkan informasi jadwal keberangkatan logistik.
* **Modul 3: Role-based Dashboard (Fokus: Supply Chain Enterprise Applications)** 
  Sebuah dasbor interaktif sederhana yang disesuaikan untuk 2 aktor utama: UMKM (untuk melihat status konsorsium dan kuota yang masih kurang) serta Buyer (untuk melihat daftar konsorsium yang sudah siap di-order).

## Gambaran Sistem & Alur Kerja

* **Aktor Sistem:** Interaksi di dalam sistem melibatkan tiga aktor utama, yaitu UMKM, Buyer, dan Sistem (Engine).
* **Alur Gabung Konsorsium:** 
  * Proses dimulai ketika UMKM melakukan input data barang. 
  * Sistem kemudian akan mengecek database untuk melihat apakah kapasitas barang sudah memenuhi MOQ atau belum.
  * Jika kapasitas sudah memenuhi batas (>= MOQ), UMKM akan langsung diarahkan untuk mengakses Dasbor Mandiri.
  * Jika kapasitas belum memenuhi batas, sistem akan mencari konsorsium aktif yang memiliki kecocokan.
  * Sistem akan menggabungkan UMKM tersebut ke dalam grup konsorsium yang sudah ada (eksisting) atau membuat grup konsorsium baru jika tidak ada yang cocok.
  * Setelah itu, UMKM akan diarahkan untuk mengakses Dasbor Konsorsium.
* **Arsitektur Teknis:** Komunikasi data diproses melalui lapisan *Frontend*, *Backend*, dan *Database*. Data aplikasi menstrukturkan beberapa entitas utama seperti `Users`, `Produk`, `Konsorsium`, `Anggota_Konsorsium`, `Pesanan_Ekspor`, dan `Sistem_Engine`.
