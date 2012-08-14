<?

defined('BW') or die("Acesso negado!");

//
bwRouter::addUrl('/depoimentos');
bwRouter::addUrl('/depoimentos/detalhes/:alias/:id', array('fields' => array('nome', 'id')));
bwRouter::addUrl('/depoimentos/task', array('type' => 'task'));
bwRouter::addUrl('/depoimentos/lista');
bwRouter::addUrl('/depoimentos/cadastro/:id', array('fields' => array('id')));
