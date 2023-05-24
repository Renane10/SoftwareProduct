<?php
function formataTelefone($number){
    $number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
    // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
    return $number;
}

function extract_numbers_tel($string){
    $return = str_replace("(","",$string);
    $return = str_replace(")","",$return);
    $return = str_replace("-","",$return);
    $return = str_replace(" ","",$return);
    return $return;
}

function print_rr($arg = '') {
    if (is_array($arg)) {
        array_walk_recursive($arg, function (&$item, $key) {
            $item = gettype($item) == 'string' ? strip_tags($item) : $item;
        });
    }
    echo '<pre>';
    print_r($arg);
    echo '</pre>';
}

function converterDataHoraBd($dataHoraAmericano) {
    // Converte a data e hora para formato americano
    $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $dataHoraAmericano);
    $dataHoraAmericano = $dateTime->format('Y-m-d H:i:s');

    return $dataHoraAmericano;
}
function converterDataHoraDisplay($dataHoraAmericano) {
    // Converte a data e hora para formato brasileiro
    $dataHoraBrasileiro = DateTime::createFromFormat('Y-m-d H:i:s', $dataHoraAmericano)->format('d/m/Y H:i:s');

    return $dataHoraBrasileiro;
}