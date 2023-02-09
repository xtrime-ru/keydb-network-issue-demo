<?php

ini_set('memory_limit', '512M');

$shortopts = 's::';
$shortopts .= 'c::';
$shortopts .= 'y::';
$shortopts .= 'h';

$longopts = [
    "size::",
    "count::",
    "ttl::",
    "help",
];

$options = getopt($shortopts, $longopts);

if ($options['h'] ?? $options['help'] ?? false) {
    echo <<<HELP
        Demo for keydb network utilization
    
        usage: php index.php [--help] [-s|--size=10] [-c|--count=10] [-t|--ttl=10]
        
        Options:
                --help      Show this message
                
            -s  --size      Size of one key in megabytes (optional) (default: 10)
                            
            -c  --count     Number of uniq keys (optional) (default: 10)
            
            -t  --ttl       Time-to-live for keys in seconds (optional) (default: 1)

    HELP;
}

echo 'waiting keydb to start' . PHP_EOL;
sleep(3);

$redis = new Redis();
$redis->connect('keydb-1');

$keySizeMb = $options['s'] ?? $options['size'] ?? 10;
$keysCount = $options['c'] ?? $options['count'] ?? 10;
$ttl = $options['t'] ?? $options['ttl'] ?? 1;

foreach (range(1,$keysCount) as $i) {
	echo "Saving key $i" . PHP_EOL;

	$bigString = bin2hex(random_bytes($keySizeMb*(1024**2)));
	$redis->set('test_' . $i, $bigString, $ttl);
}

echo 'Done'  . PHP_EOL;