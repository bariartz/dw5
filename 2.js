const isiArray = (Baris,Kolom) => {
    let kalibaris = Math.ceil(Baris * Kolom) * Math.ceil(Baris - 1);
    let sumkolom = Math.ceil(Baris - 1) + Math.ceil(Kolom - 1);
    let nilaiBaris = new Array(Baris - 1);
    let hitungBaris = 30,
        sumBaris;
    for(let i = 0; i < Baris; i++){
        sumBaris = new Array(Baris).fill(Baris - 1);
        sumBaris[i] = hitungBaris++;
    }

    console.log(sumBaris);
}

/* let people = [["John", "Smith"], ["Jane", "Doe"], ["Emily", "Jones"]]
console.table(people); */

isiArray(3,5);