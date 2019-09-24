<?php

namespace AdiechaHK\HerokuHelper\Client;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


/**
 * Heroku Client
 */
class Heroku
{
  public static function apps()
  {

    $op = static::executeCommand("heroku apps");
    $lines = static::lines($op);

    $apps = [];

    foreach ($lines as $line)
    {
      $app = trim(preg_replace('/\s[\s*\S*]*/', "", $line));
      array_push($apps, $app);
    }

    return $apps;
  }

  public static function setConfig($app, $conf)
  {
    $indvars = [];
    foreach ($conf as $key => $value) {
      array_push($indvars, $key . "=" . $value);
    }
    $vars = implode(" ", $indvars);
    $op = static::executeCommand("heroku config:set $vars --app $app");
    return trim($op);
  }

  public static function unsetConfig($app, $name)
  {
    if(strlen(trim($name)) == 0) return "";
    $op = static::executeCommand("heroku config:unset $name --app $app");
    return trim($op);
  }

  public static function resetConfig($app)
  {
    $conf = static::getAllConfigs($app);
    return static::unsetConfig($app, implode(" ", array_keys($conf)));
  }

  public static function getConfig($app, $name)
  {
    $op = static::executeCommand("heroku config:get $name --app $app");
    return trim($op);
  }

  public static function getAllConfigs($app)
  {
    $op = static::executeCommand("heroku config --app $app");
    $lines = static::lines($op);
    $config = [];
    foreach ($lines as $line) {
      $split = explode(":", $line);
      $key = array_shift($split);
      $val = implode(":", $split);
      $config[$key] = trim($val);
    }
    return $config;
  }

  private static function lines($op)
  {
    $lines = [];
    foreach (explode("\n", $op) as $line)
    {
      $line = trim($line);
      if (strlen($line) > 0 and strpos($line, "=== ") !== 0)
      {
        array_push($lines, $line);
      }      
    }
    return $lines;
  }

  private static function executeCommand($cmd)
  {
    echo "executing command '$cmd'\n";
    $process = new Process(explode(" ", $cmd));
    $process->run();

    // executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    return $process->getOutput();
  }
}