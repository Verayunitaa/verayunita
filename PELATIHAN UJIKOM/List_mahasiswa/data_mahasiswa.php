<?php
$servername = "localhost"; // Server database
$username = "root"; // Username MySQL (default XAMPP: root)
$password = ""; // Password MySQL (kosong untuk XAMPP)
$database = "mahasiswa_db"; // Nama database

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menampilkan data mahasiswa
function tampilkanData($conn) {
    $sql = "SELECT * FROM mahasiswa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Data Mahasiswa:\n";
        echo str_repeat("=", 50) . "\n";
        while ($row = $result->fetch_assoc()) {
            echo "{$row['id']}. {$row['nim']} | {$row['nama']} | {$row['gender']} | {$row['jurusan']} | {$row['alamat']}\n";
        }
    } else {
        echo "Tidak ada data mahasiswa.\n";
    }
}

// Fungsi untuk menambah data mahasiswa
function tambahData($conn) {
    echo "Masukkan NIM: ";
    $nim = trim(fgets(STDIN));

    echo "Masukkan Nama: ";
    $nama = trim(fgets(STDIN));

    echo "Pilih Gender (1 = Laki-Laki, 2 = Perempuan): ";
    $gender = trim(fgets(STDIN));
    $gender = ($gender == "1") ? "Laki-Laki" : "Perempuan";

    echo "Masukkan Jurusan: ";
    $jurusan = trim(fgets(STDIN));

    echo "Masukkan Alamat: ";
    $alamat = trim(fgets(STDIN));

    $sql = "INSERT INTO mahasiswa (nim, nama, gender, jurusan, alamat) VALUES ('$nim', '$nama', '$gender', '$jurusan', '$alamat')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan.\n";
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}

// Fungsi untuk menghapus data mahasiswa
function hapusData($conn) {
    echo "Masukkan ID mahasiswa yang ingin dihapus: ";
    $id = trim(fgets(STDIN));

    $sql = "DELETE FROM mahasiswa WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus.\n";
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}

// Menu CMD
while (true) {
    echo "\n=== Menu Mahasiswa ===\n";
    echo "1. Tampilkan Data\n";
    echo "2. Tambah Data\n";
    echo "3. Hapus Data\n";
    echo "4. Keluar\n";
    echo "Pilih opsi: ";
    $input = trim(fgets(STDIN));

    if ($input == "1") {
        tampilkanData($conn);
    } elseif ($input == "2") {
        tambahData($conn);
    } elseif ($input == "3") {
        hapusData($conn);
    } elseif ($input == "4") {
        echo "Keluar dari program.\n";
        break;
    } else {
        echo "Pilihan tidak valid.\n";
    }
}

// Tutup koneksi
$conn->close();
?>
