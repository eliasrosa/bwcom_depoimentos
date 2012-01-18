<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(0);
echo bwButton::redirect('Criar novo depoimento', 'adm.php?com=depoimentos&view=cadastro');

function grid_col0($i)
{
    return $i->id;
}

function grid_col1($i)
{
    $src = $i->bwImagem->getUrlResize('width=100&height=100');
    return sprintf('<img src="%s" />', $src);
}

function grid_col2($i)
{
    return '<a href="' . bwRouter::_('adm.php?com=depoimentos&view=cadastro&id=' . $i->id) . '">'.$i->nome.'</a>';
}

function grid_col3($i)
{
    return bwUtil::truncate($i->resumo, 160);
}

function grid_col4($i)
{
    return bwAdm::getImgStatus($i->status);
}

$a = new bwGrid();
$a->setQuery(Doctrine_Query::create()->from('Depoimento'));
$a->addCol('ID', 'id', 'tac', 50);
$a->addCol('Imagem', NULL, 'tac', 100);
$a->addCol('Nome', 'nome', NULL, 350);
$a->addCol('Depoimento resumido', 'resumo');
$a->addCol('Status', 'status', 'tac', 25);
$a->show();
?>

