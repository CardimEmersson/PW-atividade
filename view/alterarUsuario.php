<?php
    $mensagem = $_REQUEST['mensagem'];
    $usuario = $_REQUEST['alterarusuario'];
?>
<div class="d-flex align-items-center flex-column">

    <div class="w-100 my-3 px-5 border-dark border-bottom d-flex justify-content-between align-items-center">
        <h3 class="">Alterar usuario</h3>
        <a href="?link=usuario&metodo=exibirPerfil" class="my-2 px-3 btn btn-primary btn-lg">Voltar</a>
    </div>

    <?php if (!empty($mensagem)) { ?>
        <div class="alert alert-info" role="alert">
            <?php echo $mensagem; ?>
        </div>
    <?php } ?>

    <form 
        action="?link=usuario&metodo=atualizarUsuario" 
        method="post" 
        enctype="multipart/form-data" 
        class="w-75 d-flex flex-column mb-5"
    >

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input class="form-control" type="text" name="nome" id="nome" placeholder="Digite seu nome" required value="<?php echo $usuario->Nome_usuario ?>">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="sobrenome">Sobrenome:</label>
                    <input class="form-control" type="text" name="sobrenome" id="sobrenome" placeholder="Digite seu Sobrenome" required value="<?php echo $usuario->Sobrenome_usuario ?>">

                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="form-group">

                    <label for="sexo">Sexo:</label>
                    <select name="sexo" class="form-control" id="sexo">
                        <option value="M" 
                            <?php 
                                echo $usuario->Sexo_usuario == "M" ? 'selected' : '';
                            ?>
                        >
                            Masculino
                        </option>
                        <option value="F" 
                            <?php 
                                echo $usuario->Sexo_usuario == "F" ? 'selected' : '';
                            ?>
                        >
                            Feminino
                        </option>
                        <option value="N" 
                            <?php 
                                echo $usuario->Sexo_usuario == "N" ? 'selected' : '';
                            ?>
                        >
                            Não Declarado
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-lg-7">
                <div class="form-group">
                    <label for="nascimento">Data de nascimento</label>
                    <input class="form-control" type="date" name="nascimento" id="nascimento" 
                    value="<?php echo $usuario->Nascimento_usuario; ?>" required maxlength="10" name="date" pattern="[0-9]{2}\/[0-9]{4}$" min="1920-01-01" max="2019-12-31">
                </div>

            </div>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Digite seu e-mail" required value="<?php echo $usuario->Email_usuario;?>">
        </div>

        <div class="form-group">
            <label for="celular">Celular/Whatsapp</label>
            <input class="form-control celular" type="tel" name="celular" id="celular" placeholder="Digite seu numero" required value="<?php echo $usuario->Celular_usuario;?>">
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input class="form-control" type="password" name="senha" id="senha" placeholder="Digite uma senha" minlength="8" required>
        </div>

        <div class="form-group">
            <label for="confsenha">Confirmar senha:</label>
            <input class="form-control" type="password" name="confsenha" id="confsenha" placeholder="Confirme sua senha" minlength="8" required>
        </div>
        <input type="hidden" name="Id" value="<?php echo $usuario->Id_usuario; ?>">

        <button type="submit" class="btn btn-success btn-lg py-2 mx-5" onclick="validarSenha()">Alterar</button>

    </form>

</div>