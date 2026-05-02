function jawab(el, idx, benar){
    if(el.classList.contains('flip')) return;

    el.classList.add('flip');

    if(benar){
        el.innerHTML="BENAR";
        document.getElementById("benar").play();
    } else {
        el.innerHTML="SALAH";
        document.getElementById("salah").play();
    }

    setTimeout(()=>{
        document.getElementById("jawaban").value = idx;
        document.getElementById("form").submit();
    },1000);
}