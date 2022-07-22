# sql

Sistem informasi akademik tidak lepas dengan pencatatan nilai semua mahasiswanya. Dalam pencatatan nilai ini, terkadang ada banyak mahasiswa yang mengambil sebuah matakuliah lebih dari sekali. Yah… itu wajar mengingat tidak semua matakuliah itu mudah, sehingga butuh beberapa kali pengambilan matakuliah yang sama sampai mencapai nilai yang baik.

Sebagai contoh misalkan ada mahasiswa A dia mengambil matakuliah X pada semester 1. Karena si A ini anaknya malas belajar, maka nilai matakuliah X nya jelek sekali yaitu 1.0 (D). Nah… semester 3, si A ini kembali lagi mengambil matakuliah X. Namun dengan usahanya kali ini dia hanya mendapatkan nilai 2.0 (C). Karena matakuliah itu sebenarnya menyenangkan, maka si A ingin mengambil lagi matakuliah X di semester 5. Nah.. karena usahanya dalam belajar tinggi, maka akhirnya ia mendapat nilai 4.0 (A).

Nah… dalam sistem informasi akademik harus dapat mencatat semua track record mahasiswa A di atas dalam pengambilan matakuliah X nya, mulai dari semester 1, 3, dan 5.

Selanjutnya ketika si A akan lulus kuliah, maka sistem informasi akademik akan mencetak semua hasil studinya (transkrip nilai). Untuk kasus di atas (pengambilan matakuliah X), harusnya sistem informasi akademik hanya akan menampilkan hasil yang terbaik, yaitu nilai 4.0 (A) pada matakuliah X nya.

Yang menjadi pertanyaan adalah, ‘Bagaimana membuat query SQL untuk menampilkan daftar matakuliah yang telah diikuti mahasiswa beserta hasilnya, dengan ketentuan jika ada sebuah matakuliah yang diikuti beberapa kali maka hanya akan ditampilkan sekali yaitu yang memiliki nilai terbaik saja”. Pertanyaan inilah yang akan dibahas pada artikel kali ini.

OK.. untuk membahasnya, ada baiknya kita sajikan terlebih dahulu data-datanya. Dalam kasus ini misalkan terdapat 3 buah tabel yaitu ‘mhs’, ‘mk’ dan ‘ambilmk’. Tabel ‘mhs’ digunakan untuk menyimpan data mahasiswa, ‘mk’ untuk menyimpan data matakuliah-matakuliah, dan ‘ambilmk’ untuk menyimpan data pengambilan matakuliah oleh mahasiswa beserta nilainya.

CREATE TABLE mhs (
  nim varchar(10),
  namamhs varchar(30),
  alamat text,
  sex varchar(10),
  PRIMARY KEY  (nim)
);

INSERT INTO mhs VALUES ('M0197001', 'ROSIHAN ARI YUANA', 'COLOMADU', 'L');
INSERT INTO mhs VALUES ('M0197002', 'DWI AMALIA FITRIANI', 'KUDUS', 'P');
INSERT INTO mhs VALUES ('M0197003', 'FAZA FAUZAN KH.', 'COLOMADU', 'L');
INSERT INTO mhs VALUES ('M0197004', 'NADA HASANAH', 'COLOMADU', 'P');
INSERT INTO mhs VALUES ('M0197005', 'MUH. AHSANI TAQWIM', 'COLOMADU', 'L');

CREATE TABLE mk (
  kodemk varchar(5),
  namamk varchar(20),
  sks int(11),
  smt int(11),
  PRIMARY KEY  (kodemk)
) ;

INSERT INTO mk VALUES ('K001', 'KALKULUS I', 3, 1);
INSERT INTO mk VALUES ('K002', 'KALKULUS II', 3, 2);
INSERT INTO mk VALUES ('K003', 'GEOMETRI', 2, 1);
INSERT INTO mk VALUES ('K004', 'NUMERIK', 3, 2);

CREATE TABLE ambilmk (
  nim varchar(10),
  kodemk varchar(5),
  smt varchar(6),
  thajaran varchar(9),
  nilai float,
  PRIMARY KEY (nim, kodemk, smt, thajaran)
);

INSERT INTO ambilmk VALUES ('M0197001', 'K001', 'GANJIL', '2007/2008', 1);
INSERT INTO ambilmk VALUES ('M0197001', 'K002', 'GANJIL', '2007/2008', 2);
INSERT INTO ambilmk VALUES ('M0197001', 'K003', 'GANJIL', '2007/2008', 3);
INSERT INTO ambilmk VALUES ('M0197002', 'K001', 'GANJIL', '2007/2008', 2);
INSERT INTO ambilmk VALUES ('M0197002', 'K002', 'GANJIL', '2007/2008', 3);
INSERT INTO ambilmk VALUES ('M0197001', 'K001', 'GANJIL', '2008/2009', 2);
INSERT INTO ambilmk VALUES ('M0197001', 'K001', 'GANJIL', '2009/2010', 4);

Dari data pengambilan matakuliah di atas tampak bahwa mahasiswa bernim ‘M0197001’ mengambil matakuliah berkode ‘K001’ beberapa kali, tepatnya 3 kali. Pengambilan pertama dia mendapat 1.0, kedua 2.0 dan ketiga mendapat 4.0.

Sekarang bagaimana cara menulis query SQL untuk menampilkan semua matakuliah yang telah diikuti mahasiswa bernim ‘M0197001’ ini?

OK… misalkan kita gunakan query seperti berikut ini

SELECT nim, kodemk, nilai 
FROM ambilmk 
WHERE nim = 'M0197001';

Hasil query di atas adalah


Photobucket

Jika Anda gunakan query di atas maka akan tampak semua matakuliah yang telah diikuti mahasiswa tersebut. Dalam hasil yang diperoleh akan tampak bahwa matakuliah ‘K001’ muncul sebanyak 3 kali dengan nilainya masing-masing. Sehingga penggunaan query di atas belum menampilkan hasil pengambilan matakuliah ‘K001’ secara tunggal dengan nilai tertinggi.

Hmm… yang nilainya tertinggi yah… OK.. berarti kita harus gunakan function MAX(nilai). Tapi eit… tunggu dulu! Nilai tertinggi di sini bukan nilai nilai tertinggi secara umum dari semua matakuliah yang diambil tapi nilai tertinggi dari matakuliah yang sama yang pernah diambilnya. Oleh karena itu dalam query SQL yang kita buat ini nanti harus ada ‘GROUP BY kodemk’

SELECT nim, kodemk, max(nilai) 
FROM ambilmk 
WHERE nim = 'M0197001' 
GROUP BY kodemk;

Hasil query di atas adalah


Photobucket

Yes…. sudah lebih baik sekarang. Dari hasil di atas tampak bahwa untuk nilai ‘K001’ sudah muncul hanya sebuah dengan nilai yang tertinggi.

OK.. next… bagaimana jika kita ingin menampilkan nama masing-masing matakuliahnya dan juga SKS nya? Hmm.. ya berarti kita harus relasikan tabel ‘ambilmk’ dengan ‘mk’.

SELECT ambilmk.nim, ambilmk.kodemk, mk.namamk, mk.sks, MAX(ambilmk.nilai)
FROM ambilmk, mk
WHERE ambilmk.kodemk = mk.kodemk AND ambilmk.nim = 'M0197001'
GROUP BY ambilmk.kodemk;

Hasil query di atas adalah


Photobucket

He..3x mudah bukan membuat query SQL nya. Nah… mudah-mudahan artikel ini bisa membantu Anda yang sedang membuat sistem informasi akademik.
