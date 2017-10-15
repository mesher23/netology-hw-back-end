<?php
$animal = [
    'Eurasia' => [
        'Lynx',
        'Snow leopard',
        'Elk',
        'Big panda',
        'Mooze',
        'Pheasant',
        'Mantis',
        'Brown bear',
        'Sable',
        'Wolf'
    ],
    'Africa' => [
        'African elephant',
        'Hippo',
        'Giraffe',
        'Lowland gorilla',
        'Spotted hyena',
        'Zebra',
        'Chimpanzee',
        'Cheetah',
        'Wild dog',
        'Furry lemur',
    ]
];

$one;
$two;
foreach($animal as $k=>$i){
    foreach($i as $ii){
        $calculated=str_word_count($ii);
        if($calculated===2){
            $word=str_word_count($ii, 1);
            $one[$k][]=$word[0];
            $two[]=$word[1];
        }
    }   
};

shuffle($two);

foreach($one as $k=>$i){foreach($i as $ii){
    $fantasy[$k][]=$ii.' '.array_shift($two);}
};

foreach($fantasy as $k=>$i){
    echo '<h1>'.$k.'</h1>';
    echo implode(', ', $i).'.';
};
?>
