function formatHarga(nilai){
    let formatHarga     =  nilai.toString(),
            digit       = formatHarga.length % 3,
            harga       = formatHarga.substr(0, digit),
            formatRibu  = formatHarga.substr(digit).match(/\d{3}/g);
        if(formatRibu){
            pisah = digit ? '.' : '';
            harga += pisah + formatRibu.join('.');
        }
    return harga;
}

const hitungGaji = (NamaKaryawan, Gaji, LamaKerja, Tunjangan) => {
    if(Tunjangan == true){
        var tunjangan = 500000;
        var outputTunjangan = formatHarga(tunjangan);
    } else {
        var tunjangan = 0;
        var outputTunjangan = "Tidak ada";
    }

    const Kondisi = {
        Tunjangan: tunjangan,
        BPJS: 3/100,
        Pajak: 5/100
    }

    let totalBPJS = Gaji * Kondisi.BPJS;
    let totalPajak = Gaji * Kondisi.Pajak;
    let gajiBersih = Gaji + Kondisi.Tunjangan - totalBPJS - totalPajak;

    console.log("===============================");
    console.log("Nama Karyawan:" + NamaKaryawan);
    console.log("Gaji Pokok:" + formatHarga(Gaji));
    console.log("Tunjangan:" + outputTunjangan);
    console.log("BPJS:" + formatHarga(totalBPJS));
    console.log("Pajak:" + formatHarga(totalPajak));
    console.log("===============================");
    console.log("Gaji bersih:" + formatHarga(gajiBersih) + "/bulan");
    console.log("===============================");
    console.log("Total Gaji: " + formatHarga(gajiBersih * LamaKerja));
}

hitungGaji("Andi", 1500000, 2, true);