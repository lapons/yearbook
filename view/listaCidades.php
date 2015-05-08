<?php

require_once '../dao/CidadesDAO.php';
require_once '../model/Cidades.php';

$cidadesDAO = new CidadesDAO();

$idEstado = $_GET['estado'];
$cidades = $cidadesDAO->getPorIdEstado($idEstado);

echo "<label class='label-cadastro'>Cidades</label><select name='cidade' required >";
echo "<option></option>";
foreach ($cidades as $cidade) {
    echo "<option value='".$cidade->getIdCidade()."'>".$cidade->getNomeCidade()."</option>";
}

echo "</select>";

?>