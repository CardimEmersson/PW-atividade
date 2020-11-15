<?php
$categorias = $_REQUEST['categorias'];
$mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">
    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Lista de Categorias</h3>
        <a href="?link=home" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
    </div>
    <?php if (!empty($mensagem)) { ?>
        <div class="alert alert-info" role="alert">
            <?php echo $mensagem; ?>
        </div>
    <?php } ?>
    <div class="table-responsive-md w-50">

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria) { ?>
                    <tr class="align-bottom">
                        <td class="text-center align-middle"><?php echo $categoria->Id_categoria; ?></td>
                        <td class="text-center align-middle"><?php echo $categoria->Nome_categoria; ?></td>
                        <td class="d-flex justify-content-between">
                            <a 
                                data-nome="<?php echo $categoria->Nome_categoria; ?>" 
                                data-id="<?php echo $categoria->Id_categoria; ?>" 
                                class="delete w-100 btn btn-danger my-1"
                            >
                                Apagar
                            </a>

                            <a href="?link=categorias&metodo=alterarCategoria&Id=<?php echo $categoria->Id_categoria; ?>" class="w-50 btn btn-info my-1 mx-1">Alterar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <a href="?link=categorias&metodo=criarCategoria" class="w-50 mb-5 py-3 btn btn-primary btn-lg">Nova categoria</a>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    EXCLUIR CATEGORIA <span class="nome"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir?
            </div>
            <div class="modal-footer">
                <a href="#" class="delete-button btn btn-block btn-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('.delete').on('click', function() {
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        $('span.nome').text(nome.toUpperCase()); // inserir na o nome na pergunta de confirmação dentro da modal
        $('a.delete-button').attr('href', '?link=categorias&metodo=deletarCategoria&Id=' + id); // mudar dinamicamente o link, href do botão confirmar da modal
        $('#deleteModal').modal('show'); // modal aparece
    });
</script>