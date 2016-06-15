<?php

session_start();
setlocale(LC_CTYPE, "pt_BR");

//echo phpinfo();exit;
//require_once("cmd_sql.php");
class Gravar {

    private $conn;
    private $db;
    private $response;
    private $request;

    public function __construct() {
        $this->iniciar($param);
        switch ($this->request["filtro"]) {
            case "alterarSenha":
                $this->alterarSenha();
                break;
            case "excluirLocal":
                $this->excluirLocal($this->request);
                break;
            case "excluirModalidade":
                $this->excluirModalidade($this->request);
                break;
            case "excluirTabela":
                $this->excluirTabela($this->request);
                break;
            case "excluirProva":
                $this->excluirProva($this->request);
                break;
            case "excluirAluno":
                $this->excluirAluno($this->request);
                break;
            case "excluirCategoria":
                $this->excluirCategoria($this->request);
                break;
            case "excluirProfessor":
                $this->excluirProfessor($this->request);
                break;
            case "excluirInscricaoEscola":
                $this->excluirInscricaoEscola($this->request);
                break;
            case "excluirEscolaProfessor":
                $this->excluirEscolaProfessor($this->request);
                break;
            case "gravarTrava":
                $this->gravarTrava($this->request);
                break;
            case "gravarInscricaoEscola":
                $this->gravarInscricaoEscola($this->request);
                break;
            case "gravarEscolaProfessor":
                $this->gravarEscolaProfessor($this->request);
                break;
            case "gravarTabela":
                $this->gravarTabela($this->request);
                break;
            default:
                break;
        }

        $this->cmdSql = null;
        $this->db = null;
        //exibir saida
        switch ($this->request["tipoRetorno"]) {
            case "xml":
                header("Content-type: application/xml;charset=UTF-8");
                $saida = "";
                foreach ($this->response as $k => $v) {
                    $saida.="<" . trim($k) . ">" . trim($v) . "</" . trim($k) . ">";
                }
                echo "<?xml version='1.0' encoding='utf-8' ?>" . "<reg>" . $saida . "</reg>";
                //exit;
                break;
            case "json":
                echo json_encode($this->response);
                break;
            case "texto":
                echo $this->response['mensagem'];
                break;
            default:
                break;
        }
    }

    public function excluirModalidade($param) {
        $sql = "DELETE FROM ocg_modalidade WHERE IDMODALIDADE = " . $this->request['txtID'];
        //echo "sql: ".$sql;exit;
        return $this->executarSql($sql);
    }

    public function excluirLocal($param) {
        $sql = "DELETE FROM ocg_locais WHERE IDLOCAL = " . $this->request['txtID'];
        //echo "sql: ".$sql;exit;
        return $this->executarSql($sql);
    }

    public function excluirCategoria($param) {
        $sql = "DELETE FROM ocg_categoria WHERE IDCATEGORIA = " . $this->request['txtID'];
        //echo "sql: ".$sql;exit;
        return $this->executarSql($sql);
    }

    public function excluirTabela($param) {
        $sql = "DELETE FROM ocg_tabela WHERE IDPROVA = " . $this->request['txtID'];
        return $this->executarSql($sql);
    }

    public function excluirProva($param) {
        $sql = "DELETE FROM ocg_prova WHERE IDPROVA = " . $this->request['txtID'];
        return $this->executarSql($sql);
    }

    public function excluirProfessor($param) {
        $sql = "DELETE FROM OCG_USUARIO WHERE IDPROFESSOR = " . $this->request['txtID'];
        return $this->executarSql($sql);
    }

    public function excluirAluno($param) {
        $sql = "DELETE FROM ocg_aluno WHERE IDALUNO= " . $this->request['txtID'];
        return $this->executarSql($sql);
    }

    public function excluirInscricaoEscola($param) {
        $sql = "DELETE FROM ocg_inscricao_escola WHERE IDESCOLA= " . $this->request['txtIdEscola'] . " AND IDPROVA=" . $this->request['txtIdProva'];
        $this->executarSql($sql);
        if ($this->response['codigo'] == 1) {
            echo 1;
            exit;
        } else {
            echo false;
        }
    }

    public function excluirEscolaProfessor($param) {
        $sql = "DELETE FROM ocg_escolas_Professor WHERE IDESCOLA= " . $this->request['txtIdEscola'] . " AND IDPROFESSOR=" . $this->request['txtIdProfessor'];
        $this->executarSql($sql);
        if ($this->response['codigo'] == 1) {
            echo 1;
            exit;
        } else {
            echo false;
        }
    }

    public function getMaxId($param) {
        $sql = "SELECT MAX(" . $param['campoId'] . ") ID FROM " . $param['tabela'];
        $rs = $this->executarSql($sql);
        return $rs[0]['ID'];
    }

    public function gravarInscricaoEscola($param) {
        $sql = "INSERT INTO ocg_inscricao_escola (idEscola,idProva,dtInscricao,idProfessor) VALUES ";
        $sql.="(" . $this->request['txtIdEscola'] . "," . $this->request['txtIdProva'] . ",SYSDATE," . ($this->request['txtIdProfessor']) . ")";
        $this->executarSql($sql);
        if ($this->response['codigo'] == 1) {
            echo true;
            exit;
        } else {
            echo false;
        }
    }

    public function gravarEscolaProfessor($param) {
        $sql = "INSERT INTO ocg_escolas_Professor (idProfessor,idEscola) VALUES ";
        $sql.="(" . $this->request['txtIdProfessor'] . "," . $this->request['txtIdEscola'] . ")";
        $this->executarSql($sql);
        if ($this->response['codigo'] == 1) {
            echo true;
            exit;
        } else {
            echo false;
        }
    }

    public function gravarProfessor($param) {
        /*
          echo "<pre>";
          print_r($this->request);
          echo "</pre>";
          exit;
         */
        $this->values['NOME'] = "txtNome";
        $this->values['CPF'] = "txtCpf";
        $this->values['CREF'] = "txtCREF";
        $this->values['TEL'] = "txtFone";
        $this->values['CEL'] = "txtCelular";
        $this->values['EMAIL'] = "txtEmail";
        $this->values['IDSTATUS'] = "cboStatus";
        $this->values['IDPERFIL'] = "cboPerfil";

        if ((!empty($_POST['txtLogin'])) && (!empty($_POST['txtSenha']))) {
            $this->values['SENHA'] = "txtSenha";
            $this->values['LOGIN'] = "txtLogin";
        }

        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("ocg_usuario");
            $sql .= " WHERE idProfessor = " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("ocg_usuario");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarModalidade($param) {
        $this->values['DESCRICAO'] = "txtModalidade";
        $this->values['QTDMAX'] = "txtQtdMax";
        $this->values['QTDMIN'] = "txtQtdMin";
        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("ocg_modalidade");
            $sql .= " WHERE IDMODALIDADE = " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("ocg_modalidade");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarCategoria($param) {
        $this->values['DESCRICAO'] = "txtDescricao";
        $this->values['IDADE_MIN'] = "txtIdadeMin";
        $this->values['IDADE_MAX'] = "txtIdadeMax";
        $this->values['INDIVIDUAL_MAX'] = "txtProvasIndividuais";
        $this->values['COLETIVA_MAX'] = "txtProvasColetivas";
        //$this->values['IDPROFESSOR = " . "" . $_SESSION['IDPROFESSOR";
        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("ocg_categoria");
            $sql .= " WHERE IDCATEGORIA = " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("ocg_categoria");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarLocal($param) {
        $this->values['LOCAL'] = "txtLocal";
        //$this->values['IDPROFESSOR = " . "" . $_SESSION['IDPROFESSOR";
        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("ocg_locais");
            $sql .= " WHERE IDLOCAL = " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("ocg_locais");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarAluno($param) {
        $this->values['IDCATEGORIA'] = "cboCategoria";
        $this->values['IDESCOLA'] = "cboEscola";
        $this->values['SEXO'] = "cboSexo";
        $this->values['NOME'] = "txtNome";
        $this->values['RG'] = "txtRG";
        $this->values['RA'] = "txtRA";
        $this->values['NOME_MAE'] = "txtNomeMae";
        $this->values['DTNASC'] = "txtDtNasc";
        $this->request['__DATA_SISTEMA'] = "DTSISTEMA";
        //$this->values['IDPROFESSOR = " . "" . $_SESSION['IDPROFESSOR";
        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("ocg_aluno");
            $sql .= " WHERE IDALUNO = " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("ocg_aluno");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarEscola($param) {
        $this->values['NOME'] = "txtNome";
        $this->values['APELIDO'] = "txtApelido";
        $this->values['EMAIL'] = "txtEmail";
        $this->values['ENDERECO'] = "txtEndereco";
        $this->values['NUM_COMPL'] = "txtNumeroComplemento";
        $this->values['BAIRRO'] = "txtBairro";
        $this->values['CEP'] = "txtCEP";
        $this->values['TELEFONE1'] = "txtTelefone1";
        $this->values['TELEFONE2'] = "txtTelefone2";
        $this->values['FAXESCOLA'] = "txtFax";
        $this->values['DIRETOR_NOME'] = "txtDiretorNome";
        $this->values['DIRETOR_FONE'] = "txtDiretorFone";
        $this->values['DIRETOR_RG'] = "txtDiretorRg";
        $this->values['IDTIPOESCOLA'] = "cboTipoEscola";
        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("ocg_escola");
            $sql .= " WHERE IDESCOLA = " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("ocg_escola");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarProva($param) {
        $this->values['IDMODALIDADE'] = "cboModalidade";
        $this->values['IDCATEGORIA'] = "cboCategoria";
        $this->values['IDTIPODISPUTA'] = "cboTipo";
        $this->values['SEXO'] = "cboSexo";
        $this->values['DESCRICAO'] = "txtDescricao";
        $this->values['SIGLA'] = "txtSigla";
        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("ocg_prova");
            $sql .= " WHERE IDPROVA= " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("ocg_prova");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarSumula($param) {
        $this->values['IDPROVA'] = "txtIdProva";
        $this->values['COMPETICAO'] = "txtCompeticao";
        $this->values['IDTIME1'] = "txtIdTime1";
        $this->values['IDTIME2'] = "txtIdTime2";
        $this->values['TIME1'] = "txtTime1"; //???
        $this->values['TIME2'] = "txtTime2"; //???
        $this->values['NJOGO'] = "txtNJogo"; //???
        $this->values['DATAJOGO'] = "txtDtJogo";
        $this->values['HORAJOGO'] = "cboHora";
        $this->values['IDLOCAL'] = "cboLocal";
        if ($this->request['txtID'] > 0) {
            $sql = $this->setCamposUpdate("OCG_SUMULA");
            $sql .= " WHERE IDSUMULA = " . $this->request['txtID'];
        } else {
            $sql = $this->setCamposInsert("OCG_SUMULA");
        }
        //echo $sql;exit;
        return $this->executarSql($sql);
    }

    public function gravarTabela($param) {
        $sql = "INSERT INTO ocg_tabela (idProva,escola,placar, rodada,posicao) VALUES (";
        $dados = trim($this->request['tabela']);
        $dados = substr($dados, 0, strlen($dados) - 1);
        $dados = explode("|", $dados);
        $virgula = "";
        foreach ($dados as $k => $v) {
            $sql .= $virgula . "'" . trim($v) . "'";
            $virgula = ",";
        }
        $sql .= ")";
        $this->executarSql($sql);
        if ($this->response['codigo'] == 1) {
            echo true;
            exit;
        } else {
            echo false;
        }
    }

    public function gravarTrava($param) {
        $sql = "UPDATE ocg_trava SET " . $this->request['campo'] . " = " . $this->request['valor'];
        $this->executarSql($sql);
        if ($this->response['codigo'] == 1) {
            echo true;
            exit;
        } else {
            echo false;
        }
    }

    public function alterarSenha() {
        try {
            $this->request["txtID"] = $_SESSION["varIDEscola"];
            if ($this->request["txtID"] > 0) {
                $sql = " SELECT idEscola, senha FROM escola WHERE senha = :senha AND idEscola = " . $this->request["txtID"];
                $stmt = $this->conn->prepare($sql, array());
                $stmt->bindParam(":senha", $this->request["senhaAtual"]);
                $stmt->execute();
                $res = $stmt->fetchAll();
                if (!($res[0]['idEscola'] > 0)) {
                    $this->response["mensagem"] = " Dados atuais nao conferem!";
                    $this->response["codigo"] = 0;
                    return;
                }
                $sql = " UPDATE escola SET senha = :senha";
                $sql .= " WHERE idEscola = " . $this->request["txtID"];
                $stmt = $this->conn->prepare(utf8_decode($sql));
                $stmt->bindParam(":senha", $this->request["novasenha"]);
                $exec_result = $stmt->execute();
                $this->response["mensagem"] = " Erro na altera&ccedil;&atilde;o!";
                if ($exec_result) {
                    $this->response["mensagem"] = " Registro alterado com sucesso!";
                    $this->response["codigo"] = 1;
                }
                //$this->response["mensagem"] .="<br />".$sql;
            } else {
                $this->response["mensagem"] .="Dados nao conferem";
            }
        } catch (PDOException $e) {
            $this->response["mensagem"] = "Erro! <br/>PDOException: " . $e->getMessage() . "<br />" . $sql;
        }
    }

    public function getLastId($param) {
        $sql = "SELECT MAX(" . $param['ID'] . ") ID FROM " . $param['tabela'] . "";
        $retorno = $this->executarSql($sql);
        return $retorno[0]['ID'];
    }

    public function executarSql($sql) {
        $conn = $this->getConexao();
        try {
            $sql = trim($sql);
            //echo $sql;exit;
            //$pdo = $this->conn->openConnection();
            //print_r($pdo);
            $stmt = $conn->prepare($sql);
            //echo $this->response['mensagem'];
            if (is_array($this->values)) {
                foreach ($this->values as $k => $v) {
                    $stmt->bindParam(":" . $k, trim(utf8_decode($this->request[$v])));
                    //echo "<hr />".$k." =: ".$this->request[$v];
                }
            }
            //exit;
            $this->values = null;
            $this->response['codigo'] = "0";
            $this->response['mensagem'] = "ATENCAO: procedimento nao executado";
            $stmt->execute();
            if (substr($sql, 0, 6) == "SELECT") {
                $this->response = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $this->response;
            }
            if ($stmt->rowCount() > 0) {
                $this->getProcedimentoSql($sql);
            }
        } catch (PDOException $e) {
            $this->response['mensagem'] = "Registro INALTERADO! " . $e->getMessage() . " ==> " . $sql;
            //$this->response['mensagem'] = "Registro INALTERADO! " . $e->getMessage();
            $this->response['codigo'] = 0;
        }
        return $this->response;
    }

    public function setCamposInsert($tabela) {
        $virgula = "";
        $campos = "";
        $values = "";
        foreach ($this->values as $k => $v) {
            $campos.=$virgula . $k;
            $values.=$virgula . ":" . $k;
            $virgula = ",";
        }
        if ($this->request['__DATA_SISTEMA']) {
            $campos.=$virgula . $this->request['__DATA_SISTEMA'];
            $values.=$virgula . "SYSDATE";
            unset($this->request['__DATA_SISTEMA']);
        }
        return "INSERT INTO " . $tabela . " (" . $campos . ") VALUES (" . $values . ")";
    }

    public function setCamposUpdate($tabela) {
        $virgula = "";
        $sql = "UPDATE " . $tabela . " SET ";
        foreach ($this->values as $k => $v) {
            $sql .=$virgula . $k . "=:" . $k;
            $virgula = ",";
        }
        if ($this->request['__DATA_SISTEMA']) {
            $sql .=$virgula . $this->request['__DATA_SISTEMA'] . "=SYSDATE";
            $this->request['__DATA_SISTEMA'] = null;
        }
        return $sql;
    }

    public function getProcedimentoSql($sql) {
        $this->response['codigo'] = "0";
        if (substr($sql, 0, 6) == "INSERT") {
            $this->response['mensagem'] = "Registro GRAVADO COM SUCESSO!";
            $this->response['codigo'] = "1";
        } elseif (substr($sql, 0, 6) == "UPDATE") {
            $this->response['mensagem'] = "Registro ALTERADO COM SUCESSO!";
            $this->response['codigo'] = "1";
        } elseif (substr($sql, 0, 6) == "SELECT") {
            $this->response['mensagem'] = null;
        } elseif (substr($sql, 0, 6) == "DELETE") {
            $this->response['codigo'] = "1";
            $this->response['mensagem'] = "Registro REMOVIDO COM SUCESSO!";
        } else {
            $this->response['mensagem'] = " Registro gravado com sucesso!";
        }
    }

    public function getUrlRaiz() {
        $distanciaRaiz = (substr_count($_SERVER['SCRIPT_NAME'], "/") - 2);
        $this->urlRaiz = "";
        for ($distanciaRaiz; $distanciaRaiz > 0; $distanciaRaiz--) {
            $this->urlRaiz .= "../";
        }
    }

    public function getConexao() {
        $this->getUrlRaiz();
        require_once($this->urlRaiz . "../lib/php/bd_pdo.php");
        $banco = new Banco();
        $this->conn = $banco->conectar($bd);
        return $this->conn;
        //echo "<hr />aATTR_CONNECTION_STATUS: ".$this->conn."<hr />";exit;
    }

    private function iniciar($param) {
        $this->request = $_POST;
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->request = $_GET;
        }
        $this->response['codigo'] = 0;
    }

}

$Gravar = new Gravar();
?>