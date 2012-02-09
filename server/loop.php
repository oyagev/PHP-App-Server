<?php
# Create our worker object.
$worker= new GearmanWorker();
 
# Add default server (localhost).
$worker->addServer();
 
# Register function "reverse" with the server.
$worker->addFunction("reverse", "reverse_fn");
$worker->addFunction("fire", "fire_in_the_hole");
 
while (1)
{
  print "Waiting for job...\n";
 
  $ret= $worker->work();
  if ($worker->returnCode() != GEARMAN_SUCCESS)
    break;
}
 
# A much simple reverse function
function reverse_fn($job)
{
  $workload= $job->workload();
  echo "Received job: " . $job->handle() . "\n";
  echo "Workload: $workload\n"; 
  $result= strrev($workload);
  echo "Result: $result\n";
  return $result;
}


function fire_in_the_hole($job){
	$params = json_decode($job->workload());
	$_POST = $params->post;
	$_GET = $params->get;
	$_SERVER = $params->server;
	
	$app = __DIR__.'/../example-app/hello.php';
	ob_start();
	include $app;
	return ob_get_clean();
}