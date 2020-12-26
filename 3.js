const cetakPola = (angka) => {
    angka = Math.ceil(angka * 2) - 1;
    let angka2 = angka%2 == 0 ? angka : angka+1;
    let bintang = new Array(angka2-1).fill('* ');
    let kosong = [''];
    let baris = angka/2;
    
   for (let i=0; i < baris;i++){
       console.log(kosong.concat(bintang).join(''));
       kosong.unshift();
       kosong.push(" ");
       bintang.shift();
       bintang.pop();
   }
    
}

cetakPola(7);