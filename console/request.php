<?php

error_reporting(1);
require_once __DIR__ . '/../vendor/autoload.php';

use AK\GithubAPI;

$config = parse_ini_file(__DIR__ . '/../config/config.ini', true);

$api = new GithubAPI($config['github']['api_url'], $config['github']['token']);

$info = $api->getPersonalInfo();
$issues = $api->getIssues(10);

echo "Info:\n";
var_dump($info);
echo "\n\n\nIssues:\n";
var_dump($issues);
