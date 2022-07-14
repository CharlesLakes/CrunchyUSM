function procesamientoDeDiagonal() {
    var width = $(window).innerWidth();
    var height = $(window).innerHeight();
    var calculo = Math.atan(height / width);
    $("body").css({
        background: `linear-gradient(-${calculo}rad,var(--crunchy-color) 0%,var(--crunchy-color) 50%, white 50%,white 100%)`,
    });
}

procesamientoDeDiagonal();
window.addEventListener("resize", ()=>procesamientoDeDiagonal());
