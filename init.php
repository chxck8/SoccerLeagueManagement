<?php

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$es = ClientBuilder::create()->build();
