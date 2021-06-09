<?php
include_once "./graph-raw.php";

$graphData = json_decode($graphRaw, true);

function taka() {
  $acc = '';
  foreach ($graphData as $key => $value) {
    $acc += $value['name'];
  }

  return $acc;
}