<?php
/*
 * Taken from: https://stackoverflow.com/a/2690541
 */
function time2str($ts)
{
    if(!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if($diff == 0)
        return 'now';
    elseif($diff > 0)
    {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 60) return 'Ahora mismo';
            if($diff < 120) return 'Hace 1 minuto';
            if($diff < 3600) return 'Hace ' .floor($diff / 60) . ' minutos';
            if($diff < 7200) return 'Hace 1 hora';
            if($diff < 86400) return 'Hace ' . floor($diff / 3600) . ' horas';
        }
        if($day_diff == 1) return 'Ayer';
        if($day_diff < 7) return 'Hace ' . $day_diff . ' días';
        if($day_diff < 31) return 'Hace ' . ceil($day_diff / 7) . ' semanas';
        if($day_diff < 60) return 'Mes pasado';
        return date('F Y', $ts);
    }
    else
    {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 120) return 'En un minuto';
            if($diff < 3600) return 'En ' . floor($diff / 60) . ' minutos';
            if($diff < 7200) return 'En una hora';
            if($diff < 86400) return 'En ' . floor($diff / 3600) . ' horas';
        }
        if($day_diff == 1) return 'Mañana';
        if($day_diff < 4) return date('l', $ts);
        if($day_diff < 7 + (7 - date('w'))) return 'Próxima semana';
        if(ceil($day_diff / 7) < 4) return 'En ' . ceil($day_diff / 7) . ' semanas';
        if(date('n', $ts) == date('n') + 1) return 'Siguiente mes';
        return date('F Y', $ts);
    }
}