<?php
session_start();
class sql {
    private $cmdSQL;
    private $bd;
    private $request;
    private $response;

    public function __construct() {
        $this->iniciar();
        $this->response = $this->filtrar();
        // exibir em XML
        if ($this->bd['ret'] == "xml") {
            //echo "assacas";
            return;
        }
        if ($this->request['tipoRetorno'] == "json") {
            foreach ($this->response as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    if (is_string($v1)) {
                        $this->response[$k][$k1] = utf8_encode($v1);
                    }
                }
                if (is_string($v)) {
                    $this->response[$k] = utf8_encode($v);
                }
            }
            header("Content-Type: application/json; charset=UTF-8");
            //header('Content-Type: text/javascript; charset=utf8');
            //header('Content-Type: text/html; charset=UTF-8');
            echo json_encode($this->response);
        }
        //return $this->response;
    }

    public function iniciar() {
        $this->request = $_POST;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->request = $_GET;
        }
        //echo $_SESSION["varID"]."...";
        if ($_SESSION["varID"] > 0) {
            $this->request['txtID'] = $_SESSION["varID"];
            $_SESSION["varID"] = null;
        }        
        require_once($this->getUrlRaiz()."/../../lib/php/cmd_sql.php");
        $this->cmdSQL = new cmd_SQL();
        $this->bd['ret'] = "xml";

        if (!$this->request['tipoRetorno']) {
            $this->request['tipo_retorno'] = "xml";
            $this->bd["ret"] = "xml";
        } else if ($this->request['tipoRetorno'] == 'xml') {
            $this->bd["ret"] = "xml";
        } else {
            $this->bd["ret"] = "php";
        }
        if ($this->request["tipoRetorno"] == "json") {
            $this->bd['ret'] = "php";
        }        
    }

    private function filtrar() {
        switch ($this->request['filtro']) {            
            case 'lstModalidade': $this->response = $this->lstModalidade($this->request);
                break;
            case 'lstCategoria': $this->response = $this->lstCategoria($this->request);
                break;
            case 'lstAluno': $this->response = $this->lstAluno($this->request);
                break;
            case 'carregarSorteio': $this->response = $this->lstSorteio($this->request);
                break;       
            case 'consultarAlunoDuplicado': $this->response = $this->consultarAlunoDuplicado($this->request);
                break;            
            case 'carregarEscolasAtribuidasProfessor': $this->response = $this->carregarEscolasAtribuidasProfessor($this->request);
                break;
            case 'carregarTrava': $this->response = $this->lstTrava($this->request);
                break;
            case 'carregarProfessorEscola':$this->response = $this->lstProfessorEscola($this->request);
                break;
            case 'lstAcessoEscola':$this->response = $this->lstEscola($this->request);
                break;
            case 'lstEscola':$this->response = $this->lstEscola($this->request);
                break;
            case 'lstAcessoEscola':$this->response = $this->lstEscola($this->request);
                break;
            case 'lstLocal':$this->response = $this->lstLocal($this->request);
                break;
            case 'lstModalidade':$this->response = $this->lstModalidade($this->request);
                break;
            case 'lstProfessor':$this->response = $this->lstProfessor($this->request);
                break;
            case 'lstProva':$this->response = $this->lstProva($this->request);
                break;
            case 'lstTabela':$this->response = $this->lstTabela($this->request);
                break;                      
            case 'lstInscricaoAluno':$this->response = $this->lstAlunoInscrito($this->request);
                break;
            case 'lstAlunoInscrito':$this->response = $this->lstAlunoInscrito($this->request);
                break;
            case 'lstProvaMesmoTipo':$this->response = $this->lstProvaMesmoTipo($this->request);
                break;
            case 'lstInscreveEscola':$this->response = $this->lstEscolaInscrita($this->request);
                break;
            case 'lstSelecionaProva':$this->response = $this->lstSelecionaProva($this->request);
                break;
            case 'lstSumula':$this->lstSumula($this->request);
                break;
            case 'fichaIndividualAtletismoPista':$this->fichaIndividualAtletismoPista($this->request);
                break;
            case 'fichaIndividualNatacao':$this->response = $this->fichaIndividualNatacao($this->request);
                break;
            case 'validarLogin':$this->response = $this->validarLogin($this->request);
                break;            
            default:
                //return null;
                break;
        }
        if ($this->bd['ret'] == "xml") {
            return;
        }
        return $this->response;
    }

    public function validarLogin($param) {
        $campos="p.IDPROFESSOR,p.LOGIN,p.NOME,p.IDSTATUS,p.IDPERFIL,p.LOGIN";
        $this->bd['sql']  = "SELECT DISTINCT ".$campos." FROM OCG_USUARIO p WHERE p.login = '" . trim($_POST['txtNome']) . "'";
        $this->bd['sql'] .= " AND p.senha = '" . trim($_POST['txtSenha']) . "' AND p.IDSTATUS IN (1,3)";
        //echo $this->bd['sql'];
        $this->cmdSQL->pesquisar($this->bd);
        $this->bd['ret'] = "php";
        $rs = $this->cmdSQL->pesquisar($this->bd);        
        $_SESSION = $rs[0];
        //echo "<hr /><pre>".print_r($_SESSION)."</pre><hr />";exit;
        return $rs[0];
    }    
    
    public function lstEscola($param) {
        $campos = "e.IDESCOLA,e.NOME,e.APELIDO,e.ENDERECO,e.NUM_COMPL,e.TELEFONE1,e.TELEFONE2,e.EMAIL,e.BAIRRO,e.CEP,e.FAXESCOLA";
        $campos .= ",e.DIRETOR_NOME,e.DIRETOR_FONE,e.DIRETOR_RG,e.IDTIPOESCOLA,qtdprof.QTD_PROFESSOR,qtdInscr.QTD_INSCRICAO";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_ESCOLA e";
        $this->bd['sql'] .= " LEFT JOIN (SELECT COUNT(ep.IDPROFESSOR) QTD_PROFESSOR,ep.IDESCOLA FROM OCG_ESCOLAS_PROFESSOR ep GROUP BY ep.IDESCOLA) qtdprof ON e.IDESCOLA=qtdprof.IDESCOLA";
        $this->bd['sql'] .= " LEFT JOIN (SELECT COUNT(ie1.IDESCOLA) QTD_INSCRICAO,ie1.IDESCOLA FROM OCG_INSCRICAO_ESCOLA ie1 GROUP BY ie1.IDESCOLA) qtdInscr ON e.IDESCOLA=qtdInscr.IDESCOLA";
        $and = " WHERE";        
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " e.idEscola = " . $param['txtID'];
            $and = ' AND';
        }        
        //SAMUEL ... ADEQUAL O ´COD DE ORIGEM A ESTE, COMO txtID
        if ($param['cboEscola'] > 0) {
            $this->bd['sql'] .= $and . " e.idEscola = " . $param['cboEscola'];
            $and = ' AND';
        }
        
        if (!empty($param['txtNome'])) {
            $this->bd['sql'] .= $and . " e.NOME LIKE '%" . trim(strtoupper($param['txtNome'])) . "%'";
            $and = ' AND';
        }
        if (!empty($param['txtApelido'])) {
            $this->bd['sql'] .= $and . " e.apelido = '" . trim(strtoupper($param['txtApelido'])) . "'";
            $and = ' AND';
        }
        if (!empty($param['txtDiretor'])) {
            $this->bd['sql'] .= $and . " e.diretor_nome LIKE '%" . trim(strtoupper($param['txtDiretor'])) . "%'";
            $and = ' AND';
        }
        if ($param['constaProfessorInscrito'] == "sim") {
            $this->bd['sql'] .= $and . " qtdprof.QTD_PROFESSOR > 0";
            $and = ' AND';
        }

        if (!empty($param['txtIdProfessorIn'])) {
            $this->bd['sql'] .= $and . " e.IDESCOLA IN (SELECT DISTINCT ep1.IDESCOLA FROM OCG_ESCOLAS_PROFESSOR ep1 WHERE ep1.IDPROFESSOR= " . $param['txtIdProfessorIn'] . ")";
            $and = ' AND';
        }

        if (!empty($param['txtIdProfessorNotIn'])) {
            $this->bd['sql'] .= $and . " e.IDESCOLA NOT IN (SELECT DISTINCT ep1.IDESCOLA FROM OCG_ESCOLAS_PROFESSOR ep1 WHERE ep1.IDPROFESSOR= " . $param['txtIdProfessorNotIn'] . ")";
            $and = ' AND';
        }
        
        if (!empty($param['txtIdProva'])) {
            $this->bd['sql'] .= $and . " e.IDESCOLA IN (SELECT DISTINCT ie1.IDESCOLA FROM OCG_INSCRICAO_ESCOLA ie1 WHERE ie1.IDPROVA= " . $param['txtIdProva'] . ")";
            $and = ' AND';
        }
        if (!empty($param['txtIdEscolaIn'])) {
            $this->bd['sql'] .= $and . " e.IDESCOLA IN ( " . $param['txtIdEscolaIn'] . ")";
            $and = ' AND';
        }

        $this->bd['sql'] .= " ORDER BY e.nome";
      		//echo $this->bd['sql'];exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstEscolaInscrita($param) {
        $campos = "p.IDPROVA,p.SIGLA,p.DESCRICAO DESCPROVA,p.IDMODALIDADE,p.IDCATEGORIA,p.IDTIPODISPUTA";        
        $campos .= ",m.DESCRICAO DESCMODALIDADE,c.DESCRICAO DESCCATEGORIA, ie.IDESCOLA,pf.NOME RESPONSAVEL,pf.IDPROFESSOR";
        $campos .= ",case WHEN p.SEXO ='M' THEN 'Masculino' WHEN p.sexo ='F' THEN 'Feminino' END as SEXO";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_PROVA p";
        $this->bd['sql'] .= " INNER JOIN OCG_MODALIDADE m ON p.IDMODALIDADE= m.IDMODALIDADE";
        $this->bd['sql'] .= " INNER JOIN OCG_CATEGORIA c ON p.idCategoria = c.idCategoria";
        $escola = "";if ($param['txtIdEscola'] > 0) {$escola = " AND ie.idescola = " . $param['txtIdEscola'];}
        $this->bd['sql'] .= " LEFT JOIN OCG_INSCRICAO_ESCOLA ie ON (p.idProva = ie.idProva " . $escola . ")";
        $this->bd['sql'] .= " LEFT JOIN OCG_USUARIO pf  ON (ie.idProfessor=pf.idProfessor)";        
        $this->bd['sql'] .= " ORDER BY m.DESCRICAO,c.DESCRICAO,p.DESCRICAO";
       //echo "<br />".$this->bd['sql'];exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstCategoria($param) {
        $campos = "c.IDCATEGORIA,c.DESCRICAO,c.IDADE_MIN,c.IDADE_MAX,C.INDIVIDUAL_MAX,C.COLETIVA_MAX,qdtProva.QTD_PROVA";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_CATEGORIA c";
        $this->bd['sql'] .= " LEFT JOIN (SELECT COUNT(p1.IDPROVA) QTD_PROVA, p1.IDCATEGORIA FROM OCG_PROVA p1 GROUP BY p1.IDCATEGORIA) qdtProva ON c.IDCATEGORIA=qdtProva.IDCATEGORIA";
        $and = " WHERE";
        //print_r($param);
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " c.IDCATEGORIA = " . $param['txtID'];
            $and = ' AND';
        }
        if (!empty($param['txtCategoria'])) {
            $this->bd['sql'] .= $and . " c.DESCRICAO LIKE '%" . trim(strtoupper($param['txtCategoria'])) . "%'";
            $and = ' AND';
        }
        
        if (!empty($param['txtDtNasc'])) {
        	$this->bd['sql'] .= $and . "((TRUNC((months_between(sysdate,'".$param['txtDtNasc']."'))/12))) BETWEEN c.IDADE_MIN and c.IDADE_MAX+2 ";
        	$and = ' AND';
        }
        
     /*    if ($param['formatarIdadeDtNasc'] == 'sim') {
            
        	$this->bd['sql'] .= $and . " c.DESCRICAO LIKE '%" . trim(strtoupper($param['txtCategoria'])) . "%'";
            $and = ' AND';
	        } 
	        
        /* 
        if ($param['txtIdadeMax'] > 0) {
        	$this->bd['sql'] .= $where . " (TRUNC((months_between(sysdate,a.DTNASC))/12))<="  . $param['txtIdadeMax'] . "";
        	$where = " AND";
        }
         */
        
        $this->bd['sql'] .= " ORDER BY c.DESCRICAO, c.IDADE_MAX";
     	//echo $this->bd['sql'];exit;  
        return $this->cmdSQL->pesquisar($this->bd);
    }
    
    public function lstPerfilUsuario($param) {
    	$retorno ['0']['IDPERFIL'] = 1;
    	$retorno ['0']['NOME'] = "GESTOR";
    	$retorno ['1']['IDPERFIL'] = 2;
    	$retorno ['1']['NOME'] = "PROFESSOR";
    	return $retorno;
    }
    
    public function lstStatusUsuario($param) {
    	$retorno ['0']['IDSTATUS'] = 1;
    	$retorno ['0']['NOME'] = "ATIVO";
    	$retorno ['1']['IDSTATUS'] = 2;
    	$retorno ['1']['NOME'] = "INATIVO";
    	//$retorno ['2']['IDSTATUS'] = 3;
    	//$retorno ['2']['NOME'] = "TROCAR SENHA";
    	return $retorno;
    }
        
    public function lstProfessor($param) {
        $campos = "p.IDPROFESSOR,p.NOME,p.CREF,p.CPF,p.TEL,p.CEL,p.EMAIL,p.LOGIN,p.SENHA,p.IDSTATUS,p.IDPERFIL";
        $campos .= ",qtdEscola.QTDE_ESCOLA,TO_CHAR(p.DTNASC, 'DD/MM/YYYY') DTNASC";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_USUARIO p";
        $this->bd['sql'].= " LEFT JOIN (SELECT ep1.IDPROFESSOR,COUNT(ep1.IDESCOLA) QTDE_ESCOLA FROM OCG_ESCOLAS_PROFESSOR ep1 GROUP BY ep1.IDPROFESSOR) qtdEscola ON p.IDPROFESSOR=qtdEscola.IDPROFESSOR";
        $and = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " p.IDPROFESSOR = " . $param['txtID'];
            $and = ' AND';
        }
        if (!empty($param['txtNome'])) {
            $this->bd['sql'] .= $and . " p.NOME LIKE '%" . trim(strtoupper($param['txtNome'])) . "%'";
            $and = ' AND';
        }
        if (!empty($param['txtRG'])) {
            $this->bd['sql'] .= $and . " p.RG LIKE '%" . $param['txtRG'] . "%'";
            $and = ' AND';
        }
        if (!empty($param['txtCREF'])) {
            $this->bd['sql'] .= $and . " p.CREF LIKE '%" . $param['txtCREF'] . "%'";
            $and = ' AND';
        }
        if (!empty($param['txtCpf'])) {
            $this->bd['sql'] .= $and . " p.CPF ='" . $param['txtCpf'] . "'";
            $and = ' AND';
        }
        if ($param['txtIdStatus'] > 0) {
            $this->bd['sql'] .= $and . " p.IDSTATUS = " . $param['txtIdStatus'];
            $and = ' AND';
        }
        if ($param['txtIdPerfil'] > 0) {
            $this->bd['sql'] .= $and . " p.IDPERFIL = " . $param['txtIdPerfil'];
            $and = ' AND';
        }
        if ($param['txtIdEscola'] > 0) {
            $this->bd['sql'] .= $and . " p.IDPROFESSOR IN (SELECT DISTINCT ep1.IDPROFESSOR FROM OCG_ESCOLAS_PROFESSOR ep1 WHERE ep1.IDESCOLA=".$param['txtIdEscola'].")";
            $and = ' AND';
        }        
        $this->bd['sql'] .= " ORDER BY p.NOME";
        //echo $this->bd['sql'];exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }
    
    public function lstTabela($param) {
        //$this->bd['sql'] = "SELECT * FROM tabela where idProva = " . $this->request["idProva"] . " ORDER BY rodada, posicao";
        $campos = "t.IDPROVA IDTABELA,t.IDESCOLA,t.PLACAR,t.RODADA,t.POSICAO,e.NOME NOME_ESCOLA,t.ESCOLA";
        $campos.= ",p.IDPROVA,p.SIGLA,p.DESCRICAO DESCPROVA,m.DESCRICAO DESCMODALIDADE,m.ARQUIVO_PRINT,c.DESCRICAO DESCCATEGORIA,c.IDADE_MIN,c.IDADE_MAX";
        $campos.= ",case WHEN p.sexo='M' THEN 'MASCULINO' WHEN p.sexo='F' THEN 'Feminino' END as DESCSEXO";
        $campos.= ",qtdInscricao.qtde";
        
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM ocg_prova p";        
        $this->bd['sql'] .= " INNER JOIN ocg_modalidade m ON p.IDMODALIDADE= m.IDMODALIDADE";
        $this->bd['sql'] .= " INNER JOIN ocg_categoria c ON p.idCategoria = c.idCategoria";
        $joinTabela=" LEFT";
        if ($param['constaTabela']=="sim") {
            $joinTabela=" INNER";
        }        
        $this->bd['sql'] .= $joinTabela." JOIN ocg_tabela t ON p.idProva = t.idProva";        
        $this->bd['sql'] .= " LEFT JOIN ocg_escola e ON t.IDESCOLA= e.IDESCOLA";
        
        $this->bd['sql'] .= " LEFT JOIN (SELECT ie1.idProva, count(ie1.idEscola) as qtde FROM ocg_inscricao_escola ie1 group by ie1.idProva) qtdInscricao on p.idProva = qtdInscricao.idProva";
        $this->bd['sql'] .= " LEFT JOIN (SELECT distinct t1.idProva FROM ocg_tabela t1) tabela ON p.idProva = tabela.idProva";

        $and = " WHERE";
        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $and . " p.idProva = " . $param['txtIdProva'];
            $and = ' AND';
        }
        if ($param['txtIdTabela'] > 0) {
            $this->bd['sql'] .= $and . " t.IDPROVA = " . $param['txtIdTabela'];
            $and = ' AND';
        }
        
        if ($param['txtIdModalidade'] > 0) {
            $this->bd['sql'] .= $and . " m.IDMODALIDADE= " . $param['txtIdModalidade'];
            $and = ' AND';
        }
        if ($param['txtIdCategoria'] > 0) {
            $this->bd['sql'] .= $and . " c.idCategoria = " . $param['txtIdCategoria'];
            $and = ' AND';
        }        
        if ($param['txtRodada'] > 0) {
            $this->bd['sql'] .= $and . " t.RODADA= " . $param['txtRodada'];
            $and = ' AND';
        }        
        if ($param['txtIdTipoDisputa']>0) {
            $this->bd['sql'] .= $and . " p.IDTIPODISPUTA=" . $param['txtIdTipoDisputa'];
            $and = ' AND';
        }            
        if (!empty($param['txtPosicaoIn'])) {            
            $this->bd['sql'] .= $and . " t.POSICAO IN(" . $param['txtPosicaoIn'].")";
            $and = ' AND';
        }
        $this->bd['sql'] .= $and . " qtdInscricao.qtde>1";
            
        $this->bd['sql'] .= " ORDER BY t.IDPROVA, t.RODADA,t.POSICAO";
      	//echo ($this->bd['sql']);exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstTipoEscola($param) {
        $campos = "te.IDTIPOESCOLA,te.DESCRICAO";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM ocg_tipoescola te";
        $and = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " te.IDTIPOESCOLA = " . $param['txtID'];
            $and = ' AND';
        }
        if (!empty($param['txtNome'])) {
            $this->bd['sql'] .= $and . " te.DESCRICAO LIKE '%" . $param['txtNome'] . "%'";
            $and = ' AND';
        }
        $this->bd['sql'] .= " ORDER BY te.DESCRICAO";
        return $this->cmdSQL->pesquisar($this->bd);
    }

  public function lstAlunoInscrito($param) {
        $campos = "a.IDALUNO,a.NOME NOMEALUNO,a.RG,a.DTSISTEMA,a.NOME_MAE,a.IDESCOLA,a.IDCATEGORIA,a.IDPROFESSOR,ia.IDINSCRICAO";
        $campos .= ",case a.sexo WHEN 'M' THEN 'Masculino' WHEN 'F' THEN 'Feminino' END sexo";
        $campos .= ",ia.DTSISTEMA DTSISTEMA_INSCRICAO,ia.IDALUNO IDALUNO_INSCRITO,ia.IDPROVA IDPROVA_INSCRITO,ia.IDESCOLA IDESCOLA_ALUNO,p.idtipodisputa";
        $campos .= ",p.IDPROVA,p.descricao DESCPROVA,m.DESCRICAO DESCMODALIDADE,m.IDMODALIDADE,c.DESCRICAO DESCCATEGORIA,c.IDADE_MAX,c.IDADE_MIN";
        $campos .= ",TO_CHAR(a.DTNASC, 'DD/MM/YYYY') DTNASC,TO_CHAR(a.DTNASC, 'YYYY') DTIDADE,trunc((months_between(sysdate,a.DTNASC))/12) AS IDADE";
        //$campos .= ",pf.nome NOMEPROFESSOR, pf.tel TELEFONEPROFESSOR,pf.email EMAILPROFESSOR,pf.cpf CPFPROFESSOR";
        $campos .= ",e.nome NOMEESCOLA,td.DESCRICAO TIPODISPUTA";        
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_ALUNO a";
        $join = "LEFT";if ($param['somenteInscritos']) {$join = "INNER";}
        $txtProvaIn = "";if ($param['txtIdProvaInscricao'] > 0) {$txtProvaIn = " AND ia.IDPROVA = " . $param['txtIdProvaInscricao'];}
        $this->bd['sql'] .= " " . $join . " JOIN ocg_inscricao_aluno ia ON (a.IDALUNO= ia.IDALUNO " . $txtProvaIn . ")";
        $this->bd['sql'] .= " LEFT JOIN ocg_prova p ON ia.idProva = p.idProva";
        $this->bd['sql'] .= " LEFT JOIN OCG_MODALIDADE m ON  p.IDMODALIDADE= m.IDMODALIDADE";
        $this->bd['sql'] .= " LEFT JOIN OCG_CATEGORIA c ON  p.IDCATEGORIA= c.IDCATEGORIA";
        $this->bd['sql'] .= " LEFT JOIN OCG_TIPODISPUTA td ON  p.IDTIPODISPUTA= td.IDTIPODISPUTA";
        $this->bd['sql'] .= " LEFT JOIN OCG_ESCOLA e ON  a.IDESCOLA = e.IDESCOLA ";
        $subSql ="SELECT u1.*,ep1.IDESCOLA,ie1.idprova  from ocg_inscricao_escola ie1";
        $subSql.=" INNER JOIN OCG_ESCOLAS_PROFESSOR ep1 ON ie1.idescola= ep1.idescola";
        $subSql.=" INNER JOIN OCG_USUARIO u1 ON u1.idprofessor = ep1.idprofessor";
        $this->bd['sql'] .= " LEFT JOIN (".$subSql.") pf ON ia.IDESCOLA = pf.IDESCOLA AND p.idPROVA = pf.idprova ";
        $where = " WHERE";
        if ($param['txtIdAluno'] > 0) {
            $this->bd['sql'] .= $where . " ia.idAluno=" . $param['txtIdAluno'];
            $where = " AND";
        }
        if (!(empty($param['idsAluno']))) {
            $this->bd['sql'] .= $where . " ia.idAluno IN(" . $param['idsAluno'] . ")";
            $where = " AND";
        }

        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $where . " ia.idProva=" . $param['txtIdProva'] . "";
            $where = " AND";
        }        
        if ($param['txtIdCategoria'] > 0) {
            $this->bd['sql'] .= $where . " a.IDCATEGORIA=" . $param['txtIdCategoria'] . "";
            $where = " AND";
        }
        if ($param['txtIdEscola'] > 0) {
            $this->bd['sql'] .= $where . " e.idEscola=" . $param['txtIdEscola'] . "";
            $where = " AND";
        }
        if ($param['txtIdadeMax'] > 0) {
            $this->bd['sql'] .= $where . " (TRUNC((months_between(sysdate,a.DTNASC))/12))<="  . $param['txtIdadeMax'] . "";
            $where = " AND";
        }
        if ($param['txtIdadeMin'] > 0) {
            $this->bd['sql'] .= $where . " (TRUNC((months_between(sysdate,a.DTNASC))/12))>="  . $param['txtIdadeMin'] . "";
            $where = " AND";
        }
        
        if (!empty($param['txtApelido'])) {
        	$this->bd['sql'] .= $where . " e.APELIDO = '" . trim(strtoupper($param['txtApelido'])) . "'";
        	$where = ' AND';
        }

        $this->bd['sql'] .= " ORDER BY NOMEESCOLA,NOMEALUNO";
     //echo ($this->bd['sql']);exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }
    
    public function lstProva($param) {
        $campos = "p.IDPROVA,p.SIGLA,p.DESCRICAO,p.DESCRICAO DESCPROVA,p.SEXO,p.idtipodisputa,p.IDMODALIDADE,p.IDCATEGORIA";
        $campos .= ",m.DESCRICAO DESCMODALIDADE,m.QTDMAX QTDMAXPARTICIPANTE,m.QTDMIN QTDMINPARTICIPANTE,c.DESCRICAO DESCCATEGORIA,c.IDADE_MAX,c.IDADE_MIN";
        $campos .= ",case WHEN p.sexo='M' THEN 'MASCULINO' WHEN p.sexo='F' THEN 'FEMININO' END as DESCSEXO";
        $campos .= ",qtdEscola.QTDE_INSC_ESC";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM ocg_prova p";
        $this->bd['sql'] .= " INNER JOIN OCG_MODALIDADE m ON p.IDMODALIDADE= m.IDMODALIDADE";
        $this->bd['sql'] .= " INNER JOIN OCG_CATEGORIA c ON p.IDCATEGORIA= c.IDCATEGORIA";
        $this->bd['sql'] .= " LEFT JOIN (SELECT ie1.IDPROVA,COUNT(ie1.IDESCOLA) QTDE_INSC_ESC FROM OCG_INSCRICAO_ESCOLA ie1 GROUP BY ie1.IDPROVA) qtdEscola ON p.IDPROVA=qtdEscola.IDPROVA";
        $where = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $where . " p.IDPROVA=" . $param['txtID'];
            $where = " AND";
        }        
        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $where . " p.IDPROVA=" . $param['txtIdProva'];
            $where = " AND";
        }
        if ($param['txtIdCategoria'] > 0) {
            $this->bd['sql'] .= $where . " p.IDCATEGORIA=" . trim(strtoupper($param['txtIdCategoria']));
            $where = " AND";
        }
        if ($param['txtIdModalidade'] > 0) {
            $this->bd['sql'] .= $where . " p.IDMODALIDADE=" . trim(strtoupper($param['txtIdModalidade']));
            $where = " AND";
        }
        if (!(empty($param['txtSexo']))) {
            $this->bd['sql'] .= $where . " p.SEXO='" . $param['txtSexo']."'";
            $where = " AND";
        }
        if (!(empty($param['txtIdEscolaIn']))) {
            $this->bd['sql'] .= $where . " p.IDPROVA IN (SELECT DISTINCT ie1.IDPROVA FROM OCG_INSCRICAO_ESCOLA ie1 WHERE ie1.IDESCOLA IN(" . $param['txtIdEscolaIn']."))";
            $where = " AND";
        }
        $this->bd['sql'] .= " ORDER BY m.DESCRICAO,c.DESCRICAO,p.DESCRICAO";
     //echo $this->bd['sql'];exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstSelecionaProva($param) {
        $campos = "p.IDPROVA,ie.IDPROVA INSCRICAO,p.DESCRICAO DESCPROVA,IDTIPODISPUTA,m.DESCRICAO DESCMODALIDADE,c.DESCRICAO DESCCATEGORIA,c.IDADE_MAX MAX,c.IDADE_MIN MIN,e.NOME NOMEESCOLA";
        $campos .= ",case WHEN p.sexo='M' THEN 'MASCULINO' WHEN p.sexo='F' THEN 'MASCULINO' END as SEXO";
        $this->bd['sql'] = "SELECT " . $campos . " FROM ocg_prova p";
        $this->bd['sql'] .= " INNER JOIN OCG_MODALIDADE m ON (p.IDMODALIDADE= m.IDMODALIDADE)";
        $this->bd['sql'] .= " INNER JOIN OCG_CATEGORIA c ON (p.idCategoria = c.idCategoria)";
        $this->bd['sql'] .= " INNER JOIN OCG_INSCRICAO_ESCOLA ie on (p.idProva = ie.idProva)";
        $this->bd['sql'] .= " LEFT JOIN OCG_ESCOLA e on (ie.idescola = e.idescola)";
        $where = " WHERE";
        if ($param['txtIdEscola'] > 0) {
            $this->bd['sql'] .= $where . " ie.idEscola=" . $param['txtIdEscola'];
            $where = " AND";
        }
        $this->bd['sql'] .= " ORDER BY descmodalidade,c.IDADE_MIN,p.descricao";
    //  echo ($this->bd['sql']); exit;
        return $this->cmdSQL->pesquisar($this->bd);
    } 
    
    public function lstProvaEscola($param) {
        $campos = "p.IDPROVA,p.SIGLA,p.DESCRICAO DESCPROVA,p.idtipodisputa,td.descricao,p.IDMODALIDADE,p.IDCATEGORIA";
        $campos .= ",c.descricao DESCCATEGORIA,m.descricao DESCMODALIDADE,m.QTDMAX QTDMAXPARTICIPANTE,m.QTDMIN QTDMINPARTICIPANTE,e.NOME NOMEESCOLA,QTDE.QTD_INSCRITO";
        $campos .=",case WHEN p.sexo='M' THEN 'MASCULINO' WHEN p.sexo='F' THEN 'MASCULINO' END as SEXO";
        $campos .=",pf.nome NOME_PROFESSOR,pf.CPF CPF_PROFESSOR,pf.TEL TEL_PROFESSOR,pf.EMAIL EMAIL_PROFESSOR";        
        $campos .=",c.IDADE_MIN,c.IDADE_MAX,c.INDIVIDUAL_MAX,c.COLETIVA_MAX";        
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM ocg_prova p";
        $this->bd['sql'] .= " INNER JOIN OCG_CATEGORIA c ON   c.idCategoria = p.idCategoria";
        $this->bd['sql'] .= " INNER JOIN OCG_MODALIDADE m ON  m.IDMODALIDADE=p.IDMODALIDADE";
        $this->bd['sql'] .= " INNER JOIN OCG_TIPODISPUTA td ON  td.idtipodisputa=p.idtipodisputa";
        $this->bd['sql'] .= " LEFT JOIN OCG_INSCRICAO_ESCOLA ie ON  p.idProva=ie.idProva";
        $this->bd['sql'] .= " LEFT JOIN OCG_ESCOLA e ON ie.idEscola = e.idEscola";
        $this->bd['sql'] .= " LEFT JOIN OCG_ESCOLAS_PROFESSOR ep ON (e.IDESCOLA=ep.IDESCOLA AND ie.IDPROFESSOR=ep.IDPROFESSOR)";
        $this->bd['sql'] .= " LEFT JOIN OCG_USUARIO pf ON ep.IDPROFESSOR=pf.IDPROFESSOR";
        $this->bd['sql'] .= " LEFT JOIN (SELECT COUNT(ia1.IDALUNO) QTD_INSCRITO,ia1.IDPROVA,ia1.IDESCOLA FROM OCG_INSCRICAO_ALUNO ia1 GROUP BY ia1.IDPROVA,ia1.IDESCOLA) QTDE ON p.IDPROVA=QTDE.IDPROVA AND ie.IDESCOLA=qtde.IDESCOLA";
        $where = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $where . " p.IDPROVA=" . $param['txtID'];
            $where = " AND";
        }        
        if ($param['txtIdEscola'] > 0) {
            $this->bd['sql'] .= $where . " ie.idEscola=" . $param['txtIdEscola'];
            $where = " AND";
        }
        $this->bd['sql'] .= " ORDER BY m.descricao, p.descricao";
        //echo ($this->bd['sql']);exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstTipoDisputa($param) {
        $campos = "td.IDTIPODISPUTA,td.DESCRICAO";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_TIPODISPUTA td";
        $where = " WHERE";
        if (!(empty($param['txtTipoDisputa']))) {
            $this->bd['sql'] .= $where . " td.DESCRICAO ='" . $param['txtTipoDisputa'] . "'";
            $where = " AND";
        }
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $where . " td.IDTIPODISPUTA=" . $param['txtID'];
            $where = " AND";
        }
        $this->bd['sql'] .= " ORDER BY td.DESCRICAO";
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstSexo($param) {
        $retorno = array(0 => array("IDSEXO" => 0, "SIGLA" => "M", "DESCRICAO" => "MASCULINO"), 1 => array("IDSEXO" => 1, "SIGLA" => "F", "DESCRICAO" => "FEMININO"));
        if ($param['txtIdSexo'] > 0) {
            foreach ($retorno as $k => $v) {
                if ($param['txtIdSexo'] == $v['IDSEXO']) {
                    $retorno[$k]['selected'] = " selected";
                }
            }
        }
        return $retorno;
    }

    public function lstModeloSumula($param) {
        $retorno = array("FUTEBOL", "FUTSAL", "HANDEBOL", "VOLEIBOL");
        return $retorno;
    }

    public function lstSumula($param) {       
        $campos = "s.IDSUMULA,s.COMPETICAO,s.IDTIME1,s.IDTIME2,s.NJOGO,s.DATAJOGO,s.HORAJOGO,s.IDLOCAL,s.IDPROVA";
        $campos.= ",s.TIME1,s.TIME2,p.SIGLA, p.DESCRICAO DESCPROVA, m.DESCRICAO DESCMODALIDADE, m.ARQUIVO_PRINT";
        $campos.= ",c.DESCRICAO DESCCATEGORIA, c.IDADE_MIN, c.IDADE_MAX";
        $campos.= ", CASE WHEN p.sexo ='M' THEN 'Masculino' WHEN p.sexo ='F' THEN 'Feminino' END AS SEXO";        
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_SUMULA s";        
        $this->bd['sql'] .= " INNER JOIN ocg_prova p ON  s.IDPROVA=p.IDPROVA";
        $this->bd['sql'] .= " INNER JOIN ocg_modalidade m ON p.IDMODALIDADE= m.IDMODALIDADE";
        $this->bd['sql'] .= " INNER JOIN ocg_categoria c ON  p.idCategoria = c.idCategoria";
        $and = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " s.IDSUMULA = " . $param['txtID'];
            $and = ' AND';
        }
        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $and . " p.idProva = " . $param['txtIdProva'];
            $and = ' AND';
        }
        if ($param['txtIdTabela'] > 0) {
            $this->bd['sql'] .= $and . " t.IDPROVA = " . $param['txtIdTabela'];
            $and = ' AND';
        }
        
        if ($param['txtIdModalidade'] > 0) {
            $this->bd['sql'] .= $and . " m.IDMODALIDADE= " . $param['txtIdModalidade'];
            $and = ' AND';
        }
        if ($param['txtIdCategoria'] > 0) {
            $this->bd['sql'] .= $and . " c.idCategoria = " . $param['txtIdCategoria'];
            $and = ' AND';
        }                
        //$this->bd['sql'] .= " ORDER BY ";
      	//echo ($this->bd['sql']);exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function fichaIndividual($param) {
        $campos = "p.IDPROVA,a.NOME,M.DESCRICAO DESCMODALIDADE,p.DESCRICAO DESCPROVA,C.DESCRICAO DESCCATEGORIA,E.NOME ESCOLA";
        $campos.=",CASE WHEN p.SEXO ='M' THEN 'MASCULINO' WHEN p.SEXO ='F' THEN 'FEMININO' END AS SEXO";
        $campos.=",TO_CHAR(a.DTNASC, 'DD/MM/YYYY') DTNASC";
        $this->bd['sql'] .= "SELECT " . $campos . " FROM ocg_inscricao_aluno ia";
        $this->bd['sql'] .= " JOIN OCG_ALUNO a USING (idAluno)";
        $this->bd['sql'] .= " INNER JOIN ocg_prova p ON (p.idProva = ia.idprova)";
        $this->bd['sql'] .= " INNER JOIN OCG_MODALIDADE m ON  (m.IDMODALIDADE= p.IDMODALIDADE)";
        $this->bd['sql'] .= " INNER JOIN OCG_CATEGORIA c ON (c.idCategoria=p.idCategoria)";
        $this->bd['sql'] .= " INNER JOIN OCG_ESCOLA e on (e.idEscola=ia.idescola)";
        $where = " WHERE ";
        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $where . " p.idProva=" . $param['txtIdProva'];
            $where = " AND";
        }
        $this->bd['sql'] .= " ORDER BY e.nome,a.nome";
        // echo ($this->bd['sql']);
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function fichaIndividualAtletismoPista($param) {
        $campos = "ia.IDPROVA,a.NOME, M.DESCRICAO AS MODALIDADE,p.DESCRICAO AS PROVA,c.DESCRICAO AS CATEGORIA,e.NOME AS ESCOLA";
        $campos .= ", if(p.sexo='M','MASCULINO','FEMININO') as SEXO";
        $campos.=",TO_CHAR(a.DTNASC, 'DD/MM/YYYY') DTNASC";

        $this->bd['sql'] = "SELECT " . $campos . " FROM ocg_inscricao_aluno ia";
        $this->bd['sql'] .= " join OCG_ALUNO a using (idAluno)";
        $this->bd['sql'] .= " join OCG_ESCOLA e using (idEscola)";
        $this->bd['sql'] .= " join ocg_prova p using (idProva)";
        $this->bd['sql'] .= " join OCG_CATEGORIA c using (idCategoria)";
        $this->bd['sql'] .= " join OCG_MODALIDADE m using (idModalidade)";
        $where = " WHERE";
        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $where . " p.idProva=" . $param['txtIdProva'];
            $where = " AND";
        }
        $this->bd['sql'] .= " ORDER BY e.nome, a.nome";
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function fichaIndividualNatacao($param) {
        $campos = "ia.IDPROVA,a.NOME, M.DESCRICAO AS MODALIDADE,p.DESCRICAO AS PROVA,c.DESCRICAO AS CATEGORIA,e.NOME AS ESCOLA";
        $campos .= ", if(p.sexo='M','MASCULINO','FEMININO') as SEXO";
        $campos.=",TO_CHAR(a.DTNASC, 'DD/MM/YYYY') DTNASC";
        $this->bd['sql'] = "SELECT " . $campos . " FROM ocg_inscricao_aluno ia";
        $this->bd['sql'] .= " join OCG_ALUNO a using (idAluno)";
        $this->bd['sql'] .= " join OCG_ESCOLA e using (idEscola)";
        $this->bd['sql'] .= " join ocg_prova p using (idProva)";
        $this->bd['sql'] .= " join OCG_CATEGORIA c using (idCategoria)";
        $this->bd['sql'] .= " join OCG_MODALIDADE m using (idModalidade)";
        $where = " WHERE";
        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $where . " p.idProva=" . $param['txtIdProva'];
            $where = " AND";
        }
        $this->bd['sql'] .= " ORDER BY e.nome, a.nome";
        return $this->cmdSQL->pesquisar($this->bd);
    }

    function consultaConteudoRelProvaEscola($param) {
        // MESMA COISA DE lstInscricaoEscola
        $campos = "p.descricao DESCPROVA, p.idtipodisputa TIPO,e.idescola,";
        $campos.="CASE WHEN p.sexo ='M' THEN 'Masculino' WHEN p.sexo ='F' THEN 'Feminino' END as SEXO";
        $campos.=", c.descricao DESCCATEGORIA, m.descricao DESCMODALIDADE, pf.nome RESPONSAVEL, e.nome ESCOLA,E.TELEFONE1,E.TELEFONE2";
        $this->bd['sql'] = "SELECT " . $campos . " FROM OCG_INSCRICAO_ESCOLA i";
        $this->bd['sql'] .= " INNER JOIN OCG_ESCOLA e on i.idEscola = e.idEscola";
        $this->bd['sql'] .= " INNER JOIN ocg_prova p on i.idProva=p.idProva";
        $this->bd['sql'] .= " INNER JOIN OCG_CATEGORIA c on c.idCategoria = p.idCategoria";
        $this->bd['sql'] .= " INNER JOIN OCG_MODALIDADE m on m.IDMODALIDADE=p.IDMODALIDADE";
        $this->bd['sql'] .= " left join OCG_USUARIO pf on pf.idProfessor=i.idProfessor";
        $where = " WHERE";
        if ($param['txtIdEscola'] > 0) {
            $this->bd['sql'] .= $where . " i.idEscola=" . $param['txtIdEscola'];
            $where = " AND";
        }

        $this->bd['sql'] .= " ORDER BY ESCOLA,DESCMODALIDADE, DESCPROVA ";
       // echo $this->bd['sql'];exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstContatoEscola($param) {
        $campos = "p.IDPROFESSOR,p.NOME,p.TEL,p.CEL,p.EMAIL,e.NOME,e.TELEFONE1";
        $this->bd['sql'] = "SELECT " . $campos . " FROM OCG_ESCOLAS_PROFESSOR ep";
        $this->bd['sql'] .= " join OCG_USUARIO p using (idProfessor)";
        $this->bd['sql'] .= " join OCG_ESCOLA e using (idEscola)";
        $this->bd['sql'] .= " WHERE ep.idProfessor <> 89";
        $this->bd['sql'] .= " ORDER BY nome";
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstAluno($param) {
        //$campos = "a.NOME NOMEALUNO,a.IDALUNO,a.NOME,a.RG,a.RA,a.DTSISTEMA,a.SEXO,a.NOME_MAE,a.IDESCOLA,a.IDCATEGORIA,p.IDPROVA";
        $campos = "a.NOME NOMEALUNO,a.IDALUNO,a.NOME,a.RG,a.RA,a.DTSISTEMA,a.SEXO,a.NOME_MAE,a.IDESCOLA,a.IDCATEGORIA";
        $campos .= ",a.IDPROFESSOR,c.DESCRICAO DESCCATEGORIA,c.IDADE_MIN,c.IDADE_MAX,c.INDIVIDUAL_MAX,c.COLETIVA_MAX";
        $campos .= ",e.NOME NOMEESCOLA,qtdInscricao.QTDE_INSCRICAO,TO_CHAR(a.DTNASC, 'DD/MM/YYYY') DTNASC,TO_CHAR(a.DTNASC, 'YYYY') DTNASC2";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM OCG_ALUNO a";
        $this->bd['sql'] .= " INNER JOIN OCG_CATEGORIA c on a.idCategoria = c.idCategoria ";
        $this->bd['sql'] .= " INNER JOIN OCG_ESCOLA e on a.idEscola = e.idEscola";
      //  $this->bd['sql'] .= " INNER JOIN OCG_PROVA p on c.idCategoria = p.idCategoria";
        
        //$this->bd['sql'] .= " left join ocg_inscricao_aluno ia on ia.idprova = p.idprova ";        
        
        
        $this->bd['sql'] .= " LEFT JOIN (SELECT ia1.IDALUNO,COUNT(ia1.IDINSCRICAO) QTDE_INSCRICAO FROM OCG_INSCRICAO_ALUNO ia1 GROUP BY ia1.IDALUNO) qtdInscricao ON a.IDALUNO=qtdInscricao.IDALUNO";
        $and = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " a.idaluno = " . $param['txtID'];
            $and = ' AND';
        }
        if ($param['cboEscola'] > 0) {
            $this->bd['sql'] .= $and . " a.idescola = " . $param['cboEscola'];
            $and = ' AND';
        }
      /*  
        if ($param['txtIdProva'] > 0) {
            $this->bd['sql'] .= $and . " p.idProva = " . $param['txtIdProva'];
            $and = ' AND';
        }
        
        if ($param['txtIdProvaInscrito'] > 0) {
        	$this->bd['sql'] .= $and . " p.idProva IN(SELECT DISTINCT )= " . $param['txtIdProvaInscrito'];
        	$and = ' AND';
        } 
        
            if (!empty($param['txtApelido'])) {
            $this->bd['sql'] .= $and . " e.APELIDO LIKE '%" . trim(strtoupper($param['txtApelido'])) . "%'";
            $and = ' AND';
        }
        
        */
        
        if (!empty($param['txtRG'])) {
            $this->bd['sql'] .= $and . " a.RG = '" . trim($param['txtRG']) . "'";
            $and = ' AND';
        }
        if (!empty($param['txtRA'])) {
            $this->bd['sql'] .= $and . " a.RA = '" . trim($param['txtRA']) . "'";
            $and = ' AND';
        }
        if (!empty($param['txtNome'])) {
            $this->bd['sql'] .= $and . " a.NOME LIKE '%" . trim(strtoupper($param['txtNome'])) . "%'";
            $and = ' AND';
        }
        if (!empty($param['txtApelido'])) {
            $this->bd['sql'] .= $and . " e.APELIDO LIKE '%" . trim(strtoupper($param['txtApelido'])) . "%'";
            $and = ' AND';
        }
        if (!empty($param['txtDtNasc'])) {
            $this->bd['sql'] .= $and . " DTNASC LIKE '%" . $param['txtDtNasc'] . "%'";
            $and = ' AND';
        }
        $this->bd['sql'] .= " ORDER BY a.NOME";
   //   echo ($this->bd['sql']);exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstSorteio($param) {
        $this->bd['sql'] = "SELECT e.APELIDO FROM OCG_INSCRICAO_ESCOLA i INNER JOIN OCG_ESCOLA e ON i.idEscola = e.idEscola WHERE i.idProva = " . $this->request['txtIdProva'];
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function consultarAlunoDuplicado($param) {
        $this->bd['sql'] = "SELECT * FROM OCG_ALUNO WHERE nome = '" . $this->request['txtNome'] . "'  AND dtNasc = '" . $this->request["txtDtNasc"] . "'  AND idEscola = " . $this->request["escola"] . "";
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstLocal($param) {
        $campos = "l.IDLOCAL, l.LOCAL,QTDSUMULA.QTD_SUMULA";
        $this->bd['sql'] = "SELECT DISTINCT " . $campos . " FROM ocg_locais l";
        $this->bd['sql'] .= " LEFT JOIN (SELECT COUNT(l1.IDSUMULA) QTD_SUMULA, l1.IDLOCAL FROM OCG_SUMULA l1 GROUP BY l1.IDLOCAL) QTDSUMULA ON l.IDLOCAL=QTDSUMULA.IDLOCAL";
        $and = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " l.IDLOCAL = " . $param['txtID'];
            $and = ' AND';
        }
        if (!empty($param['txtLocal'])) {
            $this->bd['sql'] .= $and . " l.LOCAL LIKE '%" . trim(strtoupper($param['txtLocal'])) . "%'";
            $and = ' AND';
        }
        $this->bd['sql'] .= " ORDER BY l.LOCAL";
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstModalidade($param) {
        $this->bd['sql'] = "SELECT m.DESCRICAO,m.IDMODALIDADE,m.QTDMAX,m.QTDMIN,qdtProva.QTD_PROVA FROM OCG_MODALIDADE m";
        $this->bd['sql'] .= " LEFT JOIN (SELECT COUNT(p1.IDPROVA) QTD_PROVA, p1.IDMODALIDADE FROM OCG_PROVA p1 GROUP BY p1.IDMODALIDADE) qdtProva ON m.IDMODALIDADE=qdtProva.IDMODALIDADE";
        $and = " WHERE";
        if ($param['txtID'] > 0) {
            $this->bd['sql'] .= $and . " m.IDMODALIDADE = " . $param['txtID'];
            $and = ' AND';
        }
        if (!empty($param['txtDesc'])) {
            $this->bd['sql'] .= $and . " m.DESCRICAO LIKE '%" . trim(strtoupper($param['txtDesc'])) . "%'";
            $and = ' AND';
        }
        if ($param['constaInscrEscola'] == "sim") {
            $subSql = "SELECT DISTINCT p1.IDMODALIDADE FROM OCG_INSCRICAO_ESCOLA ie1 INNER JOIN OCG_PROVA p1 ON ie1.IDPROVA=p1.IDPROVA";
            $this->bd['sql'] .= $and . " m.IDMODALIDADE IN (" . $subSql . ")";
            $and = ' AND';
        }
        $this->bd['sql'] .= " ORDER BY m.DESCRICAO";
        //echo $this->bd['sql'];exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstTrava($param) {
        $this->bd['sql'] = "SELECT t.* FROM ocg_trava t";
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function lstProfessorEscola($param) {
        $this->bd['sql'] = "SELECT p.IDPROFESSOR, p.NOME FROM OCG_USUARIO p";
        $this->bd['sql'] .= " INNER JOIN OCG_ESCOLAS_PROFESSOR ep ON p.IDPROFESSOR = ep.IDPROFESSOR ";
        
        $and = " WHERE";
        if ($this->request['txtIdEscola'] > 0) {
            $this->bd['sql'] .= $and . " ep.IDESCOLA = " . $this->request['txtIdEscola'];
            $and = " AND";
        }
        if ($this->request['txtIdProfessor'] > 0) {
            $this->bd['sql'] .= $and . " p.IDPROFESSOR = " . $this->request['txtIdProfessor'];
            $and = " AND";
        }
        $this->bd['sql'] .= " ORDER BY p.nome ";
        //echo $this->bd['sql'];exit;
        return $this->cmdSQL->pesquisar($this->bd);
    }

    public function setTipoRetorno($param) {
        $this->bd['ret'] = $param;
        return $this->cmdSQL->pesquisar($this->bd);
    }    
    
    public function getUrlRaiz() {
        $distanciaRaiz = (substr_count($_SERVER['SCRIPT_NAME'], "/") - 2);
        $this->urlRaiz = "";
        for ($distanciaRaiz; $distanciaRaiz > 0; $distanciaRaiz--) {
            $this->urlRaiz .= "../";
        }
    }
}

$class = new sql();
?>