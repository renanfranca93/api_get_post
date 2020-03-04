<?php

require "Estoque.php";

class Api{

    public static function open($requisição){

        try{
        $modulo = $requisição['modulo'];
        $acao = $requisição['acao'];
        
        if(isset($modulo)){


            if(isset($acao)){
                echo Estoque::mostrar($modulo,$acao);
            }else{
                    echo json_encode(array('status'=>'erro','dados'=>'Acao nao informada'));
                }
        }else{
            echo json_encode(array('status'=>'erro','dados'=>'Modulo nao informado'));
        }
        }catch(Exception $e){
            echo json_encode(array('status'=>'erro','dados'=>$e->getMessage()));
        }



    }

}

?>