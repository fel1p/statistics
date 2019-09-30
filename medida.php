<?php

header('Content-Type: text/html; charset=utf-8');
/*
Aplicabilidade das medidas:
  - Tendência Central:
    - Média
    - Moda
    - Mediana
  - Dispersão
    - Desvio Médio
    - Variância
    - Desvio Padrão
*/

// BASE DE DADOS
$json = file_get_contents("exemplo.json");
$dados = json_decode($json, true);

// VARIAVEIS
$indice = $_GET["indice"];
foreach ( $dados as $e )
{ $vetor[] = $e[$indice]; }

// FUNÇÕES
function media($vetor) {
   return (count( array_filter( $vetor ))!=0) ? number_format(array_sum($vetor) / count(array_filter($vetor)), 2, '.', '') : false;
}

function moda($vetor){
    $cuenta = array_count_values($vetor);
    arsort($cuenta);
    return key($cuenta);
}

function mediana($vetor){
  $cantidad = count($vetor);
  $posMediana = ($cantidad + 1) / 2;
  return $cantidad % 2 != 0 ? $vetor[$posMediana - 1] : ($vetor[$posMediana - 1] + $vetor[$posMediana]) / 2;
}

function variancia($vetor){
    $vet_size = count($vetor);
    $mu = array_sum($vetor)/$vet_size;
    $ans=0;
    foreach($vetor as $elem)
    { $ans+=pow(($elem-$mu),2); }
    return number_format($ans/$vet_size, 2, '.', '');
}

# stats_absolute_deviation
function desvio_medio($vetor){
    return false;
}

# stats_standard_deviation
function desvio_padrao($vetor){
    $vet_size = count($vetor);
    $mu = array_sum($vetor)/$vet_size;
    $ans=0;
    foreach($vetor as $elem)
    { $ans+=pow(($elem-$mu),2); }
    return number_format(sqrt($ans/$vet_size), 2, '.', '');
}

// OUTPUT
?>
<table border="1">
  <thead>
    	<tr><th colspan="3">Medidas de Tendência Central</th></tr>
      <tr>
          <th>Média</th>
          <th>Moda</th>
          <th>Mediana</th>
      </tr>
  </thead>
  <tbody>
    <?php
        echo '<tr>';
          echo '<td>' . media($vetor) . '</td>';
          echo '<td>' . moda($vetor) . '</td>';
          echo '<td>' . mediana($vetor) . '</td>';
        echo '</tr>';
    ?>
  </tbody>
</table>
<br>
<table border="1">
  <thead>
    	<tr><th colspan="3">Medidas de Dispersão</th></tr>
      <tr>
          <th>Desvio Médio</th>
          <th>Variância</th>
          <th>Desvio Padrão</th>
      </tr>
  </thead>
  <tbody>
    <?php
        echo '<tr>';
          echo '<td>' . desvio_medio($vetor) . '</td>';
          echo '<td>' . variancia($vetor) . '</td>';
          echo '<td>' . desvio_padrao($vetor) . '</td>';
        echo '</tr>';
    ?>
  </tbody>
</table>
