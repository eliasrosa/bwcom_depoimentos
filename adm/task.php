<?
defined('BW') or die("Acesso negado!");

// DEPOIMENTOS
/////////////////////////////////////////////////////////////
if ($task == 'salvarDepoimento')
{
    $r = Depoimento::salvar(bwRequest::getVar('dados', array()));       
}

if ($task == 'removerDepoimento')
{
    $r = Depoimento::remover(bwRequest::getVar('dados', array()));
    $r['redirect'] = bwRouter::_("adm.php?com=depoimentos&view=lista");
}

die(json_encode($r));
?>
