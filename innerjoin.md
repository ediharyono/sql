CREATE TABLE mahasiswa
(
    nim INT(10),
    nama VARCHAR(100),
    alamat VARCHAR(100),
    PRIMARY KEY(nim)
);

CREATE TABLE transaksi
(
    id_transaksi INT(10),
    nim INT(10),
    buku VARCHAR(100),
    PRIMARY KEY(id_transaksi)
);



INSERT INTO mahasiswa 
VALUES 
(21400200,"faqih","bandung"),
(21400201,"ina","jakarta"),
(21400202,"anto","semarang"),
(21400203,"dani","padang"),
(21400204,"jaka","bandung"),
(21400205,"nara","bandung"),
(21400206,"senta","semarang");

INSERT INTO transaksi 
VALUES 
(1,21400200,"Buku Informatika"),
(2,21400202,"Buku Teknik Elektro"),
(3,21400203,"Buku Matematika"),
(4,21400206,"Buku Fisika"),
(5,21400207,"Buku Bahasa Indonesia"),
(6,21400210,"Buku Bahasa Daerah"),
(7,21400211,"Buku Kimia");



> SELECT * FROM mahasiswa;
+----------+-------+----------+
| nim      | nama  | alamat   |
+----------+-------+----------+
| 21400200 | faqih | bandung  |
| 21400201 | ina   | jakarta  |
| 21400202 | anto  | semarang |
| 21400203 | dani  | padang   |
| 21400204 | jaka  | bandung  |
| 21400205 | nara  | bandung  |
| 21400206 | senta | semarang |
+----------+-------+----------+
7 rows in set (0.00 sec)

> SELECT * FROM transaksi;
+--------------+----------+-----------------------+
| id_transaksi | nim      | buku                  |
+--------------+----------+-----------------------+
|            1 | 21400200 | Buku Informatika      |
|            2 | 21400202 | Buku Teknik Elektro   |
|            3 | 21400203 | Buku Matematika       |
|            4 | 21400206 | Buku Fisika           |
|            5 | 21400207 | Buku Bahasa Indonesia |
|            6 | 21400210 | Buku Bahasa Daerah    |
|            7 | 21400211 | Buku Kimia            |
+--------------+----------+-----------------------+
7 rows in set (0.00 sec)


SELECT *
FROM table1
INNER JOIN table2
ON table1.field = table2.field;

SELECT *
FROM mahasiswa
INNER JOIN transaksi
ON mahasiswa.nim = transaksi.nim;
+----------+-------+----------+--------------+----------+---------------------+
| nim      | nama  | alamat   | id_transaksi | nim      | buku                |
+----------+-------+----------+--------------+----------+---------------------+
| 21400200 | faqih | bandung  |            1 | 21400200 | Buku Informatika    |
| 21400202 | anto  | semarang |            2 | 21400202 | Buku Teknik Elektro |
| 21400203 | dani  | padang   |            3 | 21400203 | Buku Matematika     |
| 21400206 | senta | semarang |            4 | 21400206 | Buku Fisika         |
+----------+-------+----------+--------------+----------+---------------------+
4 rows in set (0.00 sec)

SELECT *
FROM table1
LEFT JOIN table2
ON table1.field = table2.field;

SELECT *
FROM mahasiswa
LEFT JOIN transaksi
ON mahasiswa.nim = transaksi.nim;
+----------+-------+----------+--------------+----------+---------------------+
| nim      | nama  | alamat   | id_transaksi | nim      | buku                |
+----------+-------+----------+--------------+----------+---------------------+
| 21400200 | faqih | bandung  |            1 | 21400200 | Buku Informatika    |
| 21400202 | anto  | semarang |            2 | 21400202 | Buku Teknik Elektro |
| 21400203 | dani  | padang   |            3 | 21400203 | Buku Matematika     |
| 21400206 | senta | semarang |            4 | 21400206 | Buku Fisika         |
| 21400201 | ina   | jakarta  |         NULL |     NULL | NULL                |
| 21400204 | jaka  | bandung  |         NULL |     NULL | NULL                |
| 21400205 | nara  | bandung  |         NULL |     NULL | NULL                |
+----------+-------+----------+--------------+----------+---------------------+
7 rows in set (0.00 sec)

SELECT *
FROM table1
RIGHT JOIN table2
ON table1.field = table2.field;

SELECT *
FROM mahasiswa
RIGHT JOIN transaksi
ON mahasiswa.nim = transaksi.nim;
+----------+-------+----------+--------------+----------+-----------------------+
| nim      | nama  | alamat   | id_transaksi | nim      | buku                  |
+----------+-------+----------+--------------+----------+-----------------------+
| 21400200 | faqih | bandung  |            1 | 21400200 | Buku Informatika      |
| 21400202 | anto  | semarang |            2 | 21400202 | Buku Teknik Elektro   |
| 21400203 | dani  | padang   |            3 | 21400203 | Buku Matematika       |
| 21400206 | senta | semarang |            4 | 21400206 | Buku Fisika           |
|     NULL | NULL  | NULL     |            5 | 21400207 | Buku Bahasa Indonesia |
|     NULL | NULL  | NULL     |            6 | 21400210 | Buku Bahasa Daerah    |
|     NULL | NULL  | NULL     |            7 | 21400211 | Buku Kimia            |
+----------+-------+----------+--------------+----------+-----------------------+
7 rows in set (0.00 sec)
