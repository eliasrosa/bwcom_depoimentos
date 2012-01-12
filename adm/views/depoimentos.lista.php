<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(0);

?>

<?= bwButton::redirect('Criar novo depoimento', 'adm.php?com=depoimentos&view=cadastro'); ?>

<table id="dataTable01">
    <thead>
        <tr>
            <th class="tac" style="width: 50px;">ID</th>
            <th class="tac" style="width: 100px;">Imagem</th>
            <th style="width: 400px;">Nome</th>
            <th>Depoimento resumido</th>
            <th class="tac" style="width: 25px;">Status</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {

        oTable = $('#dataTable01').dataTable($.extend($.dataTableSettings, {
            
        // Fixbug
        aoColumnDefs: [{
            sClass: "tac", aTargets: [0, 1, 4] 
        }],
            sAjaxSource: "<?= bwRouter::_('adm.php?com=depoimentos&task=listarDepoimentos&' .bwRequest::getToken(). '=1') ?>"
        }));
        
    });
</script>
