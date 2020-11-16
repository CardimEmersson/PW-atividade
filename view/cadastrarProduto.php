<?php
$listaCategorias = $_REQUEST['listaCategorias'];
$mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">

    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
      <h3 class="">Cadastrar produto</h3>
      <a href="?link=produtos&metodo=exibirProdutos" class="my-2 px-3 btn btn-primary btn-lg"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
  </div>


    <?php if (!empty($mensagem)) { ?>
        <div class="alert alert-info" role="alert">
            <?php echo $mensagem; ?>
        </div>
    <?php } ?>

    <form action="?link=produtos&metodo=cadastrarProduto" method="post" enctype="multipart/form-data" class="w-75 d-flex flex-column mb-5">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" maxlength="100" required value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="arquivo">Imagem do produto</label>
                <input type="file" class="form-control-file" id="arquivo" name="arquivo" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="preco" class="">Preço</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="text" class="dinheiro form-control" id="preco" name="preco" maxlength="10" required value="<?php echo isset($_POST['preco']) ? $_POST['preco'] : ''; ?>">
                </div>
            </div>

            <div class="form-group col-md-5">
                <label for="categoria">Categoria</label>
                <select id="categoria" class="form-control mul-select" name="categoria[]" multiple="multiple" required>
                    <?php foreach ($listaCategorias as $categoria) { ?>
                        <option value="<?php echo $categoria->Id_categoria; ?>"
                        <?php echo isset($_POST['categoria']) == $categoria->Id_categoria ? 'selected' : '' ?>
                        >

                            <?php echo $categoria->Nome_categoria; ?>
                        </option>
                    <?php } ?>

                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="quantidade">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required value="<?php echo isset($_POST['quantidade']) ? $_POST['quantidade'] : ''; ?>" min="1">
            </div>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" maxlength="200" required><?php echo isset($_POST['descricao']) ? $_POST['descricao'] : ''; ?></textarea>
        </div>

        <button type="submit" class="btn btn-success btn-lg py-2 mx-5">Cadastrar</button>

    </form>

</div>
