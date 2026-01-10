# Library System – Software Evolution Mini Project

Mini project ini mendemonstrasikan **evolusi sistem perangkat lunak** dari arsitektur **Monolith (v1)** ke **Microservices (v2)** menggunakan **Laravel**.  
Fokus utama project ini adalah menunjukkan bagaimana sistem berevolusi seiring bertambahnya kebutuhan, tanpa merusak versi sebelumnya.

---

## Informasi Umum
- **Framework**: Laravel
- **Bahasa**: PHP
- **Arsitektur**:
  - v1: Monolith
  - v2: Microservices
- **Data**: Dummy data (array/dictionary, simulasi API)

---

## Versi 1 (v1.0.0) – Monolith

### Deskripsi
Versi awal sistem dibangun menggunakan **arsitektur monolith**, di mana seluruh fitur berada dalam **satu aplikasi Laravel**.

Versi ini hanya memiliki **fitur dasar**, sesuai kebutuhan awal sistem.

### Fitur v1
1. Pencarian buku sederhana berdasarkan **judul / penulis**
2. Peminjaman buku online
3. Pengembalian buku online

> Data buku dan peminjaman disimpan sebagai **dummy data (dictionary/array)** di dalam konfigurasi aplikasi.

---

### 🔌 Endpoint API v1
| Method | Endpoint | Deskripsi |
|------|--------|----------|
| GET | `/api/books?q=` | Pencarian buku |
| GET | `/api/loans` | Daftar peminjaman |
| POST | `/api/borrow` | Peminjaman buku |
| POST | `/api/return` | Pengembalian buku |

---

### Unit Testing v1
Versi v1 dilengkapi dengan **Feature Test Laravel** untuk memastikan:
- Status code sesuai
- Struktur response API benar
- Error handling berjalan dengan baik

Menjalankan unit test:
```bash
php artisan test
Menjalankan v1
Checkout ke versi v1:

bash
Copy code
git checkout v1.0.0
Install dependency dan jalankan aplikasi:

bash
Copy code
composer install
php artisan serve
Versi 2 (v2.0.0) – Microservices
Deskripsi
Pada versi kedua, sistem dievolusikan menjadi arsitektur microservices untuk meningkatkan:

Modularitas

Skalabilitas

Ketahanan terhadap kegagalan (fault isolation)

Versi v1 tetap dipertahankan dan tidak diubah.

Struktur Microservices
bash
Copy code
microservices/
├── catalog-service        # Pencarian & data buku
├── circulation-service    # Peminjaman & pengembalian
└── recommendation-service # Rekomendasi buku
Setiap service merupakan aplikasi Laravel terpisah dan berjalan di port berbeda.

🔌 Endpoint API v2
Catalog Service (port 8001)
GET /api/books?q=

Circulation Service (port 8002)
GET /api/loans

POST /api/borrow

POST /api/return

Recommendation Service (port 8003)
GET /api/recommendations?q=

Menjalankan v2
Checkout ke versi terbaru:

bash
Copy code
git checkout main
Jalankan masing-masing service:

Catalog Service:

bash
Copy code
cd microservices/catalog-service
php artisan serve --port=8001
Circulation Service:

bash
Copy code
cd microservices/circulation-service
php artisan serve --port=8002
Recommendation Service:

bash
Copy code
cd microservices/recommendation-service
php artisan serve --port=8003
Demo Konsep Microservices
Modularisasi
Setiap service berjalan di port berbeda dan memiliki tanggung jawab masing-masing.

Fault Isolation (Tidak Mengganggu Sistem Lain)
Jika recommendation-service dimatikan:

Catalog service tetap berjalan

Circulation service tetap berjalan

Ini membuktikan bahwa kegagalan pada satu service tidak menjatuhkan seluruh sistem.

Scalability
Catalog service dapat dijalankan lebih dari satu instance:

bash
Copy code
php artisan serve --port=8001
php artisan serve --port=8004
Hal ini menunjukkan konsep horizontal scaling tanpa memengaruhi service lain.

Versioning
v1.0.0 → Versi awal (Monolith)

v2.0.0 → Versi evolusi (Microservices)

Versi awal dapat diakses kapan saja menggunakan Git Tag.

Kesimpulan
v1 cocok untuk sistem kecil dan pengembangan cepat

v2 lebih modular, scalable, dan tahan terhadap perubahan

Evolusi sistem dilakukan tanpa merusak versi sebelumnya

Project ini menunjukkan penerapan konsep Software Evolution, Refactoring Arsitektur, dan Best Practice Version Control.
