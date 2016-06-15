<?php

//$class = new sumula_dados();

class sumula_dados {

    public $request;
    public $dados;
    public $escola1;
    public $escola2;
    public $lstTime1;
    public $lstTime2;
    public $sql;

    public function getDados($param) {
        $this->iniciar($param);
        $this->dados = $this->request;        
        if ($this->request['txtIdTabela'] > 0) {
            $param = array("txtIdTabela" => $this->request['txtIdTabela'], "txtRodada" => $this->request['txtRodada']);
            $param['txtPosicaoIn'] = $this->request['txtPosicao'] . "," . ($this->request['txtPosicao'] + 1);
            $this->lstTabela = $this->sql->lstTabela($param);
            $this->dados['SEXO'] = $this->lstTabela[0]['SEXO'];
            $this->dados['IDPROVA'] = $this->lstTabela[0]['IDPROVA'];
            $this->dados['IDTABELA'] = $this->lstTabela[0]['IDPROVA'];
            $this->dados['ARQUIVO_PRINT'] = $this->lstTabela[0]['ARQUIVO_PRINT'];
            $this->dados['DESCMODALIDADE'] = $this->lstTabela[0]['DESCMODALIDADE'];
            $this->dados['DESCCATEGORIA'] = $this->lstTabela[0]['DESCCATEGORIA'];
            $this->dados['SIGLA'] = $this->lstTabela[0]['SIGLA'];
            $this->dados['NJOGO'] = $this->request['txtNumJogo'];
            $this->dados['TIME1'] = $this->lstTabela[0]['ESCOLA'];
            $this->dados['TIME2'] = $this->lstTabela[1]['ESCOLA'];
        }
        
        // TIME ESCOLA 1
        $param=array("txtApelido"=>$this->request['txtTime1'],"txtIdProva"=>  $this->request['txtIdProva']);
        $this->lstTime1 = $this->sql->lstAlunoInscrito($param);
        
    // TIME ESCOLA 2
        $param=array("txtApelido"=>$this->request['txtTime2'],"txtIdProva"=>  $this->request['txtIdProva']);
        $this->lstTime2 = $this->sql->lstAlunoInscrito($param);
       // $this->lstTime2 = $this->request;
    }

    private function iniciar($param) {
        require_once '../php/sql.php';
        $this->sql = new sql();
        $this->sql->setTipoRetorno("php");
        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }
    }

}

// FIM DA CLASSE
?>

