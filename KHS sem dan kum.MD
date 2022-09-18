MENAMPILKAN IPSEMESTER MAHASISWA SELECT P.nim,m.nama,k.semester,k.thnakademik,SUM((69-ASCII(UPPER(p.nilai)))*Mk.sks)/SUM(Mk.sks) AS IP_SemesterFROMKuliah k,peserta p,matakuliah mk,mahasiswa mWHERE p.nim = m.nimAND   K.kodemk = MK.kodemkAND K.kodekuliah = p.kodekuliahGROUP BY P.nim,m.nama,k.semester,k.thnakademik

MENAMPILKAN MAHASISWA BESERTA IPK DENGAN ASUMSI MK YANG DIULANG DIAMBIL NILAI TERBAIK

SELECT P.nim,m.nama,SUM((69-ASCII(UPPER(p.nilai)))*Mk.sks)/SUM(Mk.sks) AS IP_SemesterFROM(SELECT p.nim,k.kodemk,MIN(p.nilai) AS Nilai_TerbaikFROM kuliah k,peserta pWHERE k.kodekuliah = p.kodekuliahGROUP BY p.nim,k.kodemk) AS T,Kuliah k,peserta p,matakuliah mk,mahasiswa mWHEREp.nilai = T.Nilai_TerbaikAND           p.nim = T.nimAND           m.nim = T.nimAND        K.kodemk = T.kodemkAND       Mk.kodemk = T.kodemkAND    K.kodekuliah = p.kodekuliahGROUP BY P.nim,m.nama


https://docplayer.info/30663024-Beberapa-query-yang-dapat-digunakan-dalam-memperoleh-informasi.html
