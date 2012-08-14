<?
defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(0);

$id = bwRequest::getInt('id');
$i = bwComponent::openById('Depoimento', $id);

$form = new bwForm($i, '/depoimentos/task');
$form->addH2('Dados do depoimento');
$form->addInputID();
$form->addInputDataHora('datahora');
$form->addInput('nome');
$form->addInput('cargo');
$form->addInput('empresa');
$form->addTextArea('resumo');
$form->addEditorHTML('depoimento');
$form->addStatus();
$form->addInputFileImg();

$form->addBottonSalvar('salvar');
$form->addBottonRemover('remover');
$form->show();
?>
