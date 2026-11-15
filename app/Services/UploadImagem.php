
<?php

class UploadImagem {

    public static function salvar($arquivo) {

        if (
            !isset($arquivo["error"]) ||
            $arquivo["error"] !== UPLOAD_ERR_OK
        ) {
            throw new RuntimeException(
                "Erro ao receber a imagem."
            );
        }

        // Limite de 5 MB
        $tamanhoMaximo = 5 * 1024 * 1024;

        if (
            !isset($arquivo["size"]) ||
            $arquivo["size"] <= 0 ||
            $arquivo["size"] > $tamanhoMaximo
        ) {
            throw new RuntimeException(
                "A imagem deve ter no máximo 5 MB."
            );
        }

        // Confirma se o arquivo veio de um upload HTTP
        if (
            !isset($arquivo["tmp_name"]) ||
            !is_uploaded_file($arquivo["tmp_name"])
        ) {
            throw new RuntimeException(
                "Arquivo de upload inválido."
            );
        }

        // Verifica o tipo real do arquivo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipo = $finfo->file($arquivo["tmp_name"]);

        $formatos = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/webp" => "webp"
        ];

        if (!isset($formatos[$tipo])) {
            throw new RuntimeException(
                "Formato não permitido. Use JPG, PNG ou WebP."
            );
        }

        // Confirma que o arquivo é uma imagem reconhecível
        if (getimagesize($arquivo["tmp_name"]) === false) {
            throw new RuntimeException(
                "O arquivo não contém uma imagem válida."
            );
        }

        // Cria um nome aleatório
        $nome = bin2hex(random_bytes(16));
        $extensao = $formatos[$tipo];

        $nomeArquivo = $nome . "." . $extensao;

        // Define a pasta de destino
        $diretorio = __DIR__ .
            "/../../public/uploads/produtos/";

        if (!is_dir($diretorio)) {
            throw new RuntimeException(
                "A pasta de imagens não existe."
            );
        }

        $destino = $diretorio . $nomeArquivo;

        // Move o arquivo para a pasta
        if (!move_uploaded_file(
            $arquivo["tmp_name"],
            $destino
        )) {
            throw new RuntimeException(
                "Não foi possível salvar a imagem."
            );
        }

        return "uploads/produtos/" . $nomeArquivo;
    }
}
?>