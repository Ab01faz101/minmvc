<?php


// app helper
function dd(...$data)
{

    foreach ($data as $item) {
        echo '<pre style="
    background-color: rgba(45,45,45,0.94);
    padding: 15px;
    color: #f8f8f2;
    font-family: Consolas, monaco, monospace;
    font-size: 14px;
    border-radius: 5px;
    overflow-x: auto;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
    border: 1px solid #333;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(50px);
    margin-bottom: 10px;;
    ">';
        var_dump($item);
        echo '</pre>';

    }
    exit;
}

function toJson($array){
    header('Content-Type: application/json');
    echo json_encode($array);
    exit;
}

// url helper

function url($url)
{
    return trim(BASE_URL , '/') . '/' . trim($url , '/');
}








// file path helper

function path($path)
{
    return BASE_PATH . DIRECTORY_SEPARATOR . str_replace("/", DIRECTORY_SEPARATOR, $path);
}

function myCompact(...$vars)
{
    $data = [];
    foreach ($vars as $var) {
        if (isset($$var)) {
            $data[$var] = $$var;
        }
    }
    return $data;
}


function includePath($path, $data = [])
{
    extract($data);
    require_once path($path);
}

function viewPath($path)
{
    return BASE_PATH . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $path) . ".php";
}

function view($path, $data = [])
{
    extract($data);
    require_once viewPath($path);
}



