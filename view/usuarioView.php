<?php
$usuario = $_REQUEST['perfil'];
$mensagem = $_REQUEST['mensagem'];
?>

<div class="d-flex align-items-center flex-column">

    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class=""><?php echo $usuario->Nome_usuario; ?> <?php echo $usuario->Sobrenome_usuario; ?></h3>
        <a href="?link=home" class="my-2 px-3 btn btn-primary btn-lg"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
    </div>

    <?php if (!empty($mensagem)) { ?>
        <div class="alert alert-info" role="alert">
            <?php echo $mensagem; ?>
        </div>
    <?php } ?>

    <div class="row w-100">
        <div class="col-6">
            <div class="mt-2">
                <h4 class="d-inline mr-2">Nome: </h4>
                <span class=" text-primary"><?php echo $usuario->Nome_usuario; ?></span>
            </div>

            <div class="mt-2">
                <h4 class="d-inline mr-2">Sobrenome: </h4>
                <span class=" text-primary"><?php echo $usuario->Sobrenome_usuario; ?></span>
            </div>

            <div class="mt-2">
                <h4 class="d-inline mr-2">Sexo: </h4>
                <span class=" text-primary">
                    <?php
                    if ($usuario->Sexo_usuario == 'M') {
                        echo 'Masculino';
                    } else if ($usuario->Sexo_usuario == 'F') {
                        echo 'Feminino';
                    } else {
                        echo 'Não Declarado';
                    }
                    ?>
                </span>
            </div>
        </div>
        <div class="col-6">
            <div class="mt-2">
                <h4 class="d-inline mr-2">Data de nascimento: </h4>
                <span class=" text-primary">
                    <?php
                    $data = date_create($usuario->Nascimento_usuario);
                    echo date_format($data, 'd/m/Y');
                    ?>
                </span>
            </div>

            <div class="mt-2">
                <h4 class="d-inline mr-2">Email: </h4>
                <span class=" text-primary"><?php echo $usuario->Email_usuario; ?></span>
            </div>

            <div class="mt-2">
                <h4 class="d-inline mr-2">Celular: </h4>
                <span class=" text-primary"><?php echo $usuario->Celular_usuario; ?></span>
            </div>
        </div>
    </div>

    <div class="row w-100 mt-5">
        <div class="col-4 ml-auto">
            <a href="?link=usuario&metodo=alterarUsuario&Id=<?php echo $usuario->Id_usuario; ?>" class="btn btn-primary btn-block"><i class="fas fa-user-edit"></i> Editar perfil</a>
        </div>
        <div class="col-4 mr-auto">
            <a
                data-nome="<?php echo $usuario->Nome_usuario; ?>"
                data-id="<?php echo $usuario->Id_usuario; ?>"
                href="#" class="delete btn btn-danger btn-block"><i class="far fa-trash-alt"></i> Excluir conta</a>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    EXCLUIR PERFIL <span class="nome"></span>
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
        $('a.delete-button').attr('href', '?link=usuario&metodo=deletarUsuario&Id=' + id); // mudar dinamicamente o link, href do botão confirmar da modal
        $('#deleteModal').modal('show'); // modal aparece
    });
</script>
