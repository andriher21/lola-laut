<?php

function detectCSVFileDelimiter($path)
{
    $handle = fopen($path, "r");
    $delimiters = array(',' => 0, ';' => 0, "\t" => 0, '|' => 0);
    $firstLine = '';
    if ($handle) {
        $firstLine = fgets($handle);
        fclose($handle);
    } else {
        fclose($handle);
    }
    if ($firstLine) {
        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($firstLine, $delimiter));
        }
        return array_search(max($delimiters), $delimiters);
    } else {
        return ',';
    }
}


function getActiveDate()
{  $db  = \Config\Database::connect();
    //  get_instance();
    $current = date('Y-m-d');

    $active_date = date('Y-m-d', strtotime($current));
    $yesterday_date = date('Y-m-d', strtotime($current . '- 1 DAY'));

    $active_date_day = date('w', strtotime($active_date));
    $yesterday_date_day = date('w', strtotime($yesterday_date));

    $builder = $db->table('dates');
    $builder->select('*');
    $builder->where('day', $yesterday_date_day);
    $builder->orWhere('day', $active_date_day);
    $builder->orderBy('day');
    $output = $builder->get();
    $setup = $output->getResultArray();

    $today_setup = array_values(array_filter($setup, function ($s) use ($active_date_day) {
        return $s['day'] == $active_date_day;
    }));

    if (!isset($today_setup[0])) {
        $setup = array_values(array_filter($setup, function ($s) use ($yesterday_date_day) {
            return $s['day'] == $yesterday_date_day;
        }));
        $active_date = $yesterday_date;
    }

    return $active_date;
}
