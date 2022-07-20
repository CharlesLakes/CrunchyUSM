
$("#input-search").on("keypress",(e)=>{
    if(e.key == "Enter")
        window.location.href = "/buscador.php?q=" + $("#input-search").val();
});


$(".comentarios-anime .editar").click((e)=>{
    var id = $(e.target).data("id");
    $(`#comentario-${id} .acciones`).remove();

    var contenido = $(`#comentario-${id} .contenido p`).text();

    $(`#comentario-${id} .contenido`).html(`
    <form action="comentar.php" method="POST" style="width:100%;">
        <input type="hidden" name="accion" value="UPDATE">
        <input type="hidden" name="id_comentario" value="${id}">
        <textarea name="comentario" class="form form-control mb-2">${contenido}</textarea>
        <button class="btn btn-outline-light">Editar</button>
    </form>
    `);
});

