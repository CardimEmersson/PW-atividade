<?php
$produtos = $_REQUEST['produtos'];
$categorias = $_REQUEST['categorias'];
$mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">

    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Lista de Produtos</h3>
        <a href="?link=home" class="my-2 px-3 btn btn-primary btn-lg"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
    </div>

    <?php if (!empty($mensagem)) { ?>
        <div class="alert alert-info" role="alert">
            <?php echo $mensagem; ?>
        </div>
    <?php } ?>


    <form action="?link=produtos&metodo=filtroProduto" method="post" class="w-100 d-flex px-3 my-3">
        <div class="input-group px-2">
            <input type="text" class="form-control" placeholder="Nome" name="pesq_nome" value="<?php echo isset($_POST['pesq_nome']) ? $_POST['pesq_nome'] : ''; ?>">
        </div>

        <div class="input-group px-2">
            <input type="text" class="dinheiro form-control" placeholder="Preço" id="preco" name="pesq_preco" maxlength="10" value="<?php echo isset($_POST['pesq_preco']) ? $_POST['pesq_preco'] : ''; ?>">
            <div class="input-group-append">
                <span class="input-group-text">R$</span>
            </div>
        </div>

        <div class="input-group px-2">
            <input type="number" class="form-control" placeholder="Quantidade" name="pesq_quantidade"
            value="<?php echo isset($_POST['pesq_quantidade']) ? $_POST['pesq_quantidade'] : ''; ?>">
        </div>

        <button type="submit" class="btn btn-outline-primary" type="button"><i class="fas fa-search"></i></button>

    </form>


    <div class="w-100 table-responsive">

        <table class="table table-bordered table-striped">
            <thead class="">
                <tr class="text-center">
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Preco</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Imagem do produto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto) { ?>
                    <tr class="align-bottom">
                        <td class="text-center align-middle"><?php echo $produto->Id_produto; ?></td>
                        <td class="text-center align-middle"><?php echo $produto->Nome_produto; ?></td>
                        <td class="text-center align-middle">R$<?php echo $produto->Preco_produto; ?></td>
                        <td class="text-center align-middle">
                            <p><?php echo $produto->Descricao_produto; ?>
                        </td>
                        </p>
                        <td class="text-center align-middle"><?php echo $produto->Quantidade_produto; ?></td>
                        <td class="text-center align-middle">
                            <?php
                            foreach ($categorias as $categoria) {
                                if ($produto->Id_produto == $categoria->Id_produto) {
                                    echo $categoria->Nome_categoria;
                                    echo "<br>";
                                }
                            }
                            ?>
                        </td>
                        <td class="text-center align-middle">

                            <img height=80 width=100 src="public/imagens/<?php echo $produto->Url_imagem; ?>">
                        </td>
                        <td class="align-middle">
                            <a data-nome="<?php echo $produto->Nome_produto; ?>" data-id="<?php echo $produto->Id_produto; ?>" class="delete w-100 btn btn-danger my-1">
                                <i class="far fa-trash-alt"></i> Apagar
                            </a>

                            <a href="?link=produtos&metodo=alterarProduto&Id=<?php echo $produto->Id_produto; ?>" class="w-100 btn btn-info my-1"><i class="far fa-edit"></i> Alterar</a>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>
    <a href="?link=produtos&metodo=criarProduto" class="mb-5 py-3 btn btn-primary btn-block"><i class="fas fa-plus"></i> Novo produto</a>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    EXCLUIR PRODUTO <span class="nome"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir?
            </div>
            <div class="modal-footer">
                <a href="#" class="delete-button btn btn-block btn-danger"><i class="far fa-trash-alt"></i> Excluir</a>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete').on('click', function() {
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        $('span.nome').text(nome.toUpperCase()); // inserir na o nome na pergunta de confirmação dentro da modal
        $('a.delete-button').attr('href', '?link=produtos&metodo=deletarProduto&Id=' + id); // mudar dinamicamente o link, href do botão confirmar da modal
        $('#deleteModal').modal('show'); // modal aparece
    });
</script>
