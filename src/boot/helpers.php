<?php
/**
 * @var string $uri
 * @return string
 */
function clear_uri(string $uri): string
{
    $uri = str_replace(['//', '///', '////', '/////'], '/', $uri);
    $uri = (substr($uri, -1) === '/' ? substr($uri, 0, -1) : $uri);
    $uri = (substr($uri, -1) === '/' ? substr($uri, 0, -1) : $uri);
    return $uri;
}

/**
 * @var string $uri
 * @return string
 */
function extract_params(string $uri): string
{
    if (strpos($uri, '{') !== false) {
        $result = clear_uri(strstr($uri, '{', true));
        return ($result === '' ? '/' : $result);
    }
    return $uri;
}

/**
 * @var string $uri
 * @return string
 */
function uri_params(string $uri): string
{
    return clear_uri(strstr($uri, '{'));
}

/**
 * @var string $route
 * @var string $uri
 * @return string
 */
function uri_params_array(string $route, string $uri): array
{
    $uri = clear_uri($uri);
    $uri = (!empty($uri) && $uri[0] === '/' ? substr($uri, 1) : $uri);
    $len = strlen(extract_params($route));
    $uriParams = explode('/', substr($uri, $len -1));
    $uriParams = array_filter($uriParams, fn($e) => $e !== '');
    $params = [];
    foreach ($uriParams as  $value) {
        $params[] = $value;
    }
    $uriParams = $params;
    $routeParams = explode('/', str_replace(['{', '}'], '', uri_params($route)));
    if (count($uriParams) === count($routeParams)) {
        $data = [];
        for ($i=0; $i < count($uriParams); $i++) { 
            $data[$routeParams[$i]] = $uriParams[$i];
        }
        return $data;
    }
    return [];
}
