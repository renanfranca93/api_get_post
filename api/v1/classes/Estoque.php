<?php

class Estoque{
    

 

    //funcao de busca
    public static function mostrar($modulo,$acao){



        //verificar parametros da busca
        if(isset($_REQUEST['categoria']))
        {
            $categoria = "categoria = '".$_REQUEST['categoria']."'";
        }else $categoria ="";
        
        if(isset($_REQUEST['precomin']))
        {
            $precomin = "preco > ".$_REQUEST['precomin'];
        }else $precomin ="";

        if(isset($_REQUEST['precomax']))
        {
            $precomax = "preco < ".$_REQUEST['precomax'];
        }else $precomax ="";

        $condicao = "";

        $parametros = array($categoria,$precomin,$precomax);
        $filtrado = array_values((array_filter($parametros)));

        if(count(array_filter($filtrado))==1){
            $condicao = "WHERE ".$filtrado[0];
        }else if(count(array_filter($filtrado))==2){
            $condicao = "WHERE ".$filtrado[0]." AND ".$filtrado[1];
        }else if(count(array_filter($parametros))==3){
            $condicao = "WHERE ".$filtrado[0]." AND ".$filtrado[1]." AND ".$filtrado[2];
        }

        $conexao = new PDO('mysql:host=127.0.0.1;dbname=filial','root','');
        $sql = "SELECT id, nome, categoria, preco FROM produtos ".$condicao." ORDER BY nome ASC";
        $sql = $conexao->prepare($sql);
        $sql->execute();

        $resultados = array();

        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
            $resultados[] = $row;
        }
        if(!$resultados){
            throw new Exception("Nenhum pruduto no estoque!");
        }

        return json_encode(array('status' => 'sucesso', 'dados' => $resultados));
    }
}

?>
