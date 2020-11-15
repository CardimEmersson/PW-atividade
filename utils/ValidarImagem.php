<?php

class ValidarImagem
{

    private $mensagem = '';

    public function getMensagem()
    {
        return $this->mensagem;
    }

    public function uploadImagem($imagem)
    {
        //Pasta onde o arquivo será salvo
        $_UP['pasta'] = "public/imagens/";

        //Tamanho máximo do arquivo em Bytes
        $_UP['tamanho'] = 1024 * 1024 * 100; //5mb
        //Array com a extensões permitidas
        $_UP['extensoes'] = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif');

        //Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

        //Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($imagem['error'] != 0) {
            $this->mensagem = ("Não foi possivel fazer o upload, erro: " . $_UP['erros'][$imagem['error']]);
            return false;
        }

        //Faz a verificação da extensao do arquivo
        $extensao = $imagem['type'];

        if (array_search($extensao, $_UP['extensoes']) === false) {

            $this->mensagem = "Extensão invalida";
            return false;
        } else if ($_UP['tamanho'] < $imagem['size']) {
            //Faz a verificação do tamanho do arquivo     
            $this->mensagem = "Arquivo muito grande, tamanho acima de 5 MB";
            return false;
        } else {
            //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta imagens

            //Verificar se é possivel mover o arquivo para a pasta escolhida
            $caminho = $_UP['pasta'] . $imagem['name'];

            if (move_uploaded_file($imagem['tmp_name'], $caminho)) {
                //OK	
                return $imagem['name'];
            } else {
                //Upload não efetuado com sucesso
                $this->mensagem = "A imagem não foi cadastrada";
                return false;
            }
        }
    }

    public function excluirImagem($nome)
    {
        $caminho = "public/imagens/" . $nome;

        if (is_file($caminho)) {

            unlink($caminho);
            return true;
        }

        return false;
    }
}
