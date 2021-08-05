<?php

$TITLE   = 'Git Deployment Bot';
$VERSION = '1.0';

echo <<<EOT
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>$TITLE</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>



  _____ _ _     _____             _                                  _     ____        _   
 / ____(_) |   |  __ \           | |                                | |   |  _ \      | |  
| |  __ _| |_  | |  | | ___ _ __ | | ___  _   _ _ __ ___   ___ _ __ | |_  | |_) | ___ | |_ 
| | |_ | | __| | |  | |/ _ \ '_ \| |/ _ \| | | | '_ ` _ \ / _ \ '_ \| __| |  _ < / _ \| __|
| |__| | | |_  | |__| |  __/ |_) | | (_) | |_| | | | | | |  __/ | | | |_  | |_) | (_) | |_ 
 \_____|_|\__| |_____/ \___| .__/|_|\___/ \__, |_| |_| |_|\___|_| |_|\__| |____/ \___/ \__|
                           | |             __/ |                                           
                           |_|            |___/                                            



EOT;



flush();

// Actually run the bot

$commands = array(
	'echo $PWD',
	'whoami',
	'git pull',
	'git status',
	'git submodule sync',
	'git submodule update',
	'git submodule status',
    'test -e /usr/share/update-notifier/notify-reboot-required && echo "system restart required"',
);

$output = "\n";

$log = "####### ".date('Y-m-d H:i:s'). " #######\n";

foreach($commands AS $command){
    // Run it
    $tmp = shell_exec("$command 2>&1");
    // Output
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";

    $log  .= "\$ $command\n".trim($tmp)."\n";
}

$log .= "\n";

file_put_contents ('deploy-log.txt',$log,FILE_APPEND);

echo $output; 

?>
</pre>
</body>
</html>
