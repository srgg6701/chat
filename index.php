<?php
/**
 * @file        index.php
 * @description
 *
 * PHP Version  5.4.4
 *
 * @package     newrobocall
 * @category
 * @plugin URI
 * @copyright   2015, Vadim Pshentsov. All Rights Reserved.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
 * @author      Vadim Pshentsov <pshentsoff@gmail.com> 
 * @link        http://pshentsoff.ru Author's homepage
 * @link        http://blog.pshentsoff.ru Author's blog
 *
 * @created     03.08.15
 */

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('debug'=>true, 'mode' => 'development'));
require_once 'includes/frontend/config.php';

ob_start();
$app->get('/', function ()use($menu_array){
	require_once "includes/frontend/contents/default.php";
});
$app->get('/solutions', function (){
	require_once "includes/frontend/contents/solutions.php";
});
//----------------------------------------
$app->get('/hello/:name', function ($name){
	$header=$name;
	require_once "includes/frontend/contents/hello.php";
});
$app->get('/:name', function ($name){
	$header=$name;
	require_once "includes/frontend/contents/dude.php";
});
$app->run();
require_once "includes/frontend/index.php";
