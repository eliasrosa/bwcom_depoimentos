<?
defined('BW') or die("Acesso negado!");
$task = bwRequest::getVar('task');

// DEPOIMENTOS
/////////////////////////////////////////////////////////////
if ($task == 'salvar')
{
    $r = Depoimento::salvar(bwRequest::getVar('dados', array()));       
}

if ($task == 'remover')
{
    $r = Depoimento::remover(bwRequest::getVar('dados', array()));
    $r['redirect'] = bwRouter::_('/depoimentos/lista');
}

die(json_encode($r));
?>
