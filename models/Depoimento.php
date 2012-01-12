<?php

class Depoimento extends bwRecord
{
    var $labels = array(
        'id' => 'ID',
        'datahora' => 'Data/Hora',
        'nome' => 'Nome',
        'cargo' => 'Cargo',
        'empresa' => 'Empresa',
        'resumo' => 'Depoimento resumido',
        'depoimento' => 'Depoimento',
        'status' => 'Status'
    );

    public function setTableDefinition()
    {
        $this->setTableName('bw_depoimentos');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => true,
            'autoincrement' => true,
        ));
        $this->hasColumn('datahora', 'timestamp', null, array(
            'type' => 'timestamp',
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'notblank' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('nome', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'notblank' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('cargo', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => false,
            'autoincrement' => false,
        ));
        $this->hasColumn('empresa', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => false,
            'autoincrement' => false,
        ));
        $this->hasColumn('resumo', 'string', null, array(
            'type' => 'string',
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => false,
            'autoincrement' => false,
        ));
        $this->hasColumn('depoimento', 'string', null, array(
            'type' => 'string',
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'notblank' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('status', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'autoincrement' => false,
        ));
    }

    public function setDatahora($v)
    {
        if (preg_match('#^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$#', $v))
            return $this->_set('datahora', bwUtil::data($v));
        return $v;
    }

    public function setUp()
    {
        parent::setUp();

        $this->setBwImagem('depoimentos', 'imagens');
    }

    public function preHydrate(Doctrine_Event $event)
    {
        parent::preHydrate($event);

        $dat = $event->data;
    
        @list($dat['_date'], $dat['_hora']) = explode(' ', $dat['datahora']);
        $dat['_date'] = bwUtil::data($dat['datahora'], false);
        $dat['_datahora'] = bwUtil::data($dat['datahora']);

        $event->data = $dat;
    }

    public function salvar($dados)
    {
        $db = bwComponent::save(__CLASS__, $dados);
        $r = bwComponent::retorno($db);

        return $r;
    }

    public function remover($dados)
    {
        $db = bwComponent::remover(__CLASS__, $dados);
        $r = bwComponent::retorno($db);

        return $r;
    }

    
    public function listar()
    {
    
        // Colunas para a ordenação
        $colunas = array('id', 'id', 'nome', 'resumo', 'status');

        // Total de colunas
        $totalColunas = count($colunas);

        // valor de busca
        $search = bwRequest::getVar('sSearch', '');
        $iDisplayLength = bwRequest::getVar('iDisplayLength');
        $iDisplayStart = bwRequest::getVar('iDisplayStart', 0);

        // SQL para a consulta
        $dqlPrincipal = Doctrine_Query::create()
                        ->from('Depoimento')
                        ->where('nome LIKE :search OR id LIKE :search OR datahora LIKE :search OR resumo LIKE :search OR empresa LIKE :search OR depoimento LIKE :search OR cargo LIKE :search', array(':search' => "%{$search}%"));

        // Consulta banco 1
        $dql = $dqlPrincipal
                        ->orderBy($colunas[bwRequest::getVar('iSortCol_0')] . ' ' . bwRequest::getVar('sSortDir_0', 'DESC'))
                        ->offset($iDisplayStart)
                        ->limit($iDisplayLength)
                        ->execute();

        // Consulta banco 2
        $totalRegistros = $dqlPrincipal
                        ->select('COUNT(' . $colunas[0] . ') AS total')
                        ->fetchOne();

        // Total de registros
        $iTotalRecords = $totalRegistros->total;

        // Total de registros exibidos
        $iTotalDisplayRecords = $iTotalRecords;

        // Dados das colunas
        $aaData = array();
        foreach ($dql as $i)
        {

            // nome
            $nome = ($i->nome == '') ? '[Sem nome]' : $i->nome;
            $nome = '<a href="' . bwRouter::_('adm.php?com=depoimentos&view=cadastro&id=' . $i->id) . '">' . $nome . '</a>';

            // imagem
            $src = $i->bwImagem->getUrlResize('width=100&height=100');
            $imagem = sprintf('<img src="%s" />', $src);

            // dados
            $aaData[] = array(
                $i->id,
                $imagem,
                $nome,
                bwUtil::truncate($i->resumo, 160),
                bwAdm::getImgStatus($i->status)
            );
        }

        // retorno ao DataTable
        $retorno = array(
            'sEcho' => bwRequest::getVar('sEcho'),
            'iTotalRecords' => $iTotalRecords,
            'iTotalDisplayRecords' => $iTotalDisplayRecords,
            'aaData' => $aaData
        );

        return $retorno;    
    
    }    
}
