<?

defined('BW') or die("Acesso negado!");

class bwDepoimentos extends bwComponent
{
    // variaveis obrigatórias
    var $id = 'depoimentos';
    var $nome = 'Depoimentos';
    var $adm_visivel = true;
    
    
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }
}
?>
