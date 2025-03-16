Python 3.12.6 (tags/v3.12.6:a4a2d2b, Sep  6 2024, 20:11:23) [MSC v.1940 64 bit (AMD64)] on win32
Type "help", "copyright", "credits" or "license()" for more information.
>>> import csv
... 
... class Koperasi:
...     def __init__(self, file='koperasi.csv'):
...         self.file = file
...         self.load_data()
... 
...     def load_data(self):
...         try:
...             with open(self.file, mode='r', newline='') as f:
...                 reader = csv.DictReader(f)
...                 self.anggota = list(reader)
...         except FileNotFoundError:
...             self.anggota = []
... 
...     def simpan_data(self):
...         with open(self.file, mode='w', newline='') as f:
...             fieldnames = ['ID', 'Nama', 'Saldo', 'Pinjaman']
...             writer = csv.DictWriter(f, fieldnames=fieldnames)
...             writer.writeheader()
...             writer.writerows(self.anggota)
... 
...     def daftar_anggota(self, nama):
...         id_baru = len(self.anggota) + 1
...         self.anggota.append({'ID': str(id_baru), 'Nama': nama, 'Saldo': '0', 'Pinjaman': '0'})
...         self.simpan_data()
...         print(f"Anggota {nama} telah terdaftar dengan ID {id_baru}")
... 
...     def setor_simpanan(self, id_anggota, jumlah):
...         for anggota in self.anggota:
...             if anggota['ID'] == str(id_anggota):
...                 anggota['Saldo'] = str(int(anggota['Saldo']) + jumlah)
...                 self.simpan_data()
...                 print(f"{jumlah} telah disetor ke akun {anggota['Nama']}")
...                 return
...         print("Anggota tidak ditemukan")

    def pinjam_dana(self, id_anggota, jumlah):
        for anggota in self.anggota:
            if anggota['ID'] == str(id_anggota):
                anggota['Pinjaman'] = str(int(anggota['Pinjaman']) + jumlah)
                self.simpan_data()
                print(f"{jumlah} telah dipinjam oleh {anggota['Nama']}")
                return
        print("Anggota tidak ditemukan")

    def bayar_pinjaman(self, id_anggota, jumlah):
        for anggota in self.anggota:
            if anggota['ID'] == str(id_anggota):
                sisa_pinjaman = int(anggota['Pinjaman']) - jumlah
                if sisa_pinjaman < 0:
                    print("Jumlah pembayaran melebihi pinjaman")
                else:
                    anggota['Pinjaman'] = str(sisa_pinjaman)
                    self.simpan_data()
                    print(f"{jumlah} telah dibayarkan, sisa pinjaman: {sisa_pinjaman}")
                return
        print("Anggota tidak ditemukan")

koperasi = Koperasi()

while True:
    print("\nMenu Koperasi Pegawai:")
    print("1. Daftar Anggota")
    print("2. Setor Simpanan")
    print("3. Pinjam Dana")
    print("4. Bayar Pinjaman")
    print("5. Keluar")
    pilihan = input("Pilih menu: ")

    if pilihan == '1':
        nama = input("Masukkan nama anggota: ")
        koperasi.daftar_anggota(nama)
    elif pilihan == '2':
        id_anggota = input("Masukkan ID anggota: ")
        jumlah = int(input("Masukkan jumlah simpanan: "))
        koperasi.setor_simpanan(id_anggota, jumlah)
    elif pilihan == '3':
        id_anggota = input("Masukkan ID anggota: ")
        jumlah = int(input("Masukkan jumlah pinjaman: "))
        koperasi.pinjam_dana(id_anggota, jumlah)
    elif pilihan == '4':
        id_anggota = input("Masukkan ID anggota: ")
        jumlah = int(input("Masukkan jumlah pembayaran: "))
        koperasi.bayar_pinjaman(id_anggota, jumlah)
    elif pilihan == '5':
        print("Terima kasih!")
        break
    else:
        print("Pilihan tidak valid!")
