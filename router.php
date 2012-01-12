<?
defined('BW') or die("Acesso negado!");

function depoimentosBuildRoute( &$query )
{
    $segments = array();    

    if(preg_match('#open#', $query['view']))
    {
        
        if(!isset($query['id']) || !isset($query['alias']))
        {
            $t = Doctrine_Query::create()
                ->from('Depoimento')
                ->where('status = 1')
                ->orderBy("datahora DESC, nome ASC")
                ->fetchOne();
                
            if($t)
            {
                $segments[] = $t->id;
                $segments[] = bwUtil::alias($t->nome);        
            }
        }
        else
        {
            $segments[] = $query['id'];
            $segments[] = bwUtil::alias($query['alias']);
            unset($query['id'], $query['alias']);
        }
    }

    return $segments;
}

function depoimentosParseRoute( $segments )
{
    $vars = array();
    
    if(count($segments))
    {
        $vars['id'] = $segments[0];     
        $vars['alias'] = $segments[1];      
    }
    
    return $vars;   
}
?>