<?php

if (php_sapi_name() != "cli") {
    die("Only console execution allowed\n");
}

if (@$argv[1] == 'allow') {
	print 'set wide permissions' . "\n";
	$commands = array(
		'find . -type d -exec chmod 755 {} \;', 
		'find . -type f -exec chmod 644 {} \;',
	);
	executeCommands($commands);
} else if (@$argv[1] == 'restrict') {
	print 'set strict permissions' . "\n";
	$commands = array(
		'find . -type f -exec chmod 444 {} \;',
		'find . -type d -exec chmod 555 {} \;',
		'find var/ -type f -exec chmod 644 {} \;',
		'find media/ -type f -exec chmod 644 {} \;',
		'find var/ -type d -exec chmod 755 {} \;',
		'find media/ -type d -exec chmod 755 {} \;',
	);
	executeCommands($commands);
} else {
	print "==================================
php {$argv[0]} allow
php {$argv[0]} restict

";
}

function executeCommands($cmds)
{
	foreach ($cmds as $cmd) {
		print "Executing: {$cmd}...";
		$a = `$cmd`;
		if ($a) {
			var_dump($a);
			print "\n";
		} else {
			print " OK\n";
		}
	}
}