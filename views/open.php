<?

defined('BW') or die("Acesso negado!");

$id = bwRequest::getInt('id', 0);

$t = Doctrine_Query::create()
                ->from('Depoimento')
                ->where('id = ? AND status = 1', $id)
                ->fetchOne();

if ($t)
{

    bwHtml::setTitle($t->nome . ' - Depoimentos');
    bwHtml::setDescription($t->resumo);

    echo '<h1>Depoimentos</h1>';
    echo '<h2>' . $t->nome . '</h2>';
    echo '<p class="cargo">Cargo: ' . $t->cargo . '</p>';
    echo '<p class="empresa">Empresa: ' . $t->empresa . '</p>';
    echo '<p class="data">' . $t->_datahora . '</p>';

    if (!$t->bwImagem->isError404())
    {
        echo '<div class="imagem">';
        echo "<img src=\"{$t->bwImagem->getUrl()}\" width=\"250\" height=\"250\" />";
        echo '<a rel="lightbox" width="650" height="450" href="' . $t->bwImagem->getUrl() . '"><span>Ampliar imagem</span></a></div>';
    }

    echo '<div class="depoimento">'.$t->depoimento.'</div>';

}
else
{
    bwError::header404();
    echo '<h1>Depoimentos</h1>';
    echo '<p>Nenhum depoimento foi encontrado!</p>';
}
?>
