<?php


/**
 * @param string|null $param
 * 
 * @return string
 */
function site(string $param = null): string
{
    if ($param and !empty(SITE[$param])) {
        return SITE[$param];
    }
    return SITE['root'];
}
/**
 * @param string $imageUrl
 * 
 * @return string
 */
function routeImage(string $imageUrl): string
{
    return "http://via.placeholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";
}

/**
 * @param string $path
 * @param bool $time
 * 
 * @return string
 */
function asset(string $path, $time = true): string
{
    $file = SITE['root'] . "/views/assets/{$path}";
    $fileOnDir = dirname(__DIR__, 1) . "/views/assets/{$path}";

    if ($time && file_exists($fileOnDir)) {
        $file .= "?v=" . filemtime($fileOnDir);
    }
    return $file;
}

/**
 * @param string|null $type
 * @param string|null $message
 * 
 * @return string|null
 */
function flash(string $type = null, string $message = null): ?string
{
    if ($type and $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];
        return null;
    }

    if (!empty($_SESSION["flash"]) and $flash =   $_SESSION["flash"]) {
        unset($_SESSION["flash"]);
        return "<div class=\"message {$flash["type"]}\">{$flash["message"]}</div>";
    }
    return null;
}
function fm_get_file_icon_class($path)
{
    // get extension
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    switch ($ext) {
        case 'ico':
        case 'gif':
        case 'jpg':
        case 'jpeg':
        case 'jpc':
        case 'jp2':
        case 'jpx':
        case 'xbm':
        case 'wbmp':
        case 'png':
        case 'bmp':
        case 'tif':
        case 'tiff':
        case 'svg':
            $img = 'fas fa-image';
            break;
        case 'passwd':
        case 'ftpquota':
        case 'sql':
        case 'js':
        case 'json':
        case 'sh':
        case 'config':
        case 'twig':
        case 'tpl':
        case 'md':
        case 'gitignore':
        case 'c':
        case 'cpp':
        case 'cs':
        case 'py':
        case 'map':
        case 'lock':
        case 'dtd':
            $img = 'fas fa-file-code';
            break;
        case 'txt':
        case 'ini':
        case 'conf':
        case 'log':
        case 'htaccess':
            $img = 'fas fa-file-alt';
            break;
        case 'css':
        case 'less':
        case 'sass':
        case 'scss':
            $img = 'fab fa-css3-alt';
            break;
        case 'zip':
        case 'rar':
        case 'gz':
        case 'tar':
        case '7z':
            $img = 'fas fa-file-archive';
            break;
        case 'php':
        case 'php4':
        case 'php5':
        case 'phps':
        case 'phtml':
            $img = 'fab fa-php';
            break;
        case 'htm':
        case 'html':
        case 'shtml':
        case 'xhtml':
            $img = 'fab fa-html5';
            break;
        case 'xml':
        case 'xsl':
            $img = 'fas fa-file-excel';
            break;
        case 'wav':
        case 'mp3':
        case 'mp2':
        case 'm4a':
        case 'aac':
        case 'ogg':
        case 'oga':
        case 'wma':
        case 'mka':
        case 'flac':
        case 'ac3':
        case 'tds':
            $img = 'fas fa-music';
            break;
        case 'm3u':
        case 'm3u8':
        case 'pls':
        case 'cue':
            $img = 'fas fa-headphones';
            break;
        case 'avi':
        case 'mpg':
        case 'mpeg':
        case 'mp4':
        case 'm4v':
        case 'flv':
        case 'f4v':
        case 'ogm':
        case 'ogv':
        case 'mov':
        case 'mkv':
        case '3gp':
        case 'asf':
        case 'wmv':
            $img = 'fas fa-file-video';
            break;
        case 'eml':
        case 'msg':
            $img = 'fas fa-envelope';
            break;
        case 'xls':
        case 'xlsx':
        case 'ods':
            $img = 'far fa-file-excel';
            break;
        case 'csv':
            $img = 'fas fa-file-csv';
            break;
        case 'bak':
            $img = 'fas fa-clipboard';
            break;
        case 'doc':
        case 'docx':
        case 'odt':
            $img = 'fas fa-file-word';
            break;
        case 'ppt':
        case 'pptx':
            $img = 'fas fa-file-powerpoint';
            break;
        case 'ttf':
        case 'ttc':
        case 'otf':
        case 'woff':
        case 'woff2':
        case 'eot':
        case 'fon':
            $img = 'fas fa-font';
            break;
        case 'pdf':
            $img = 'fas fa-file-pdf';
            break;
        case 'psd':
        case 'ai':
        case 'eps':
        case 'fla':
        case 'swf':
            $img = 'fas fa-file-images';
            break;
        case 'exe':
        case 'msi':
            $img = 'fas fa-file';
            break;
        case 'bat':
            $img = 'fas fa-terminal';
            break;
        default:
            $img = 'fa fa-info-circle';
    }

    return $img;
}



function fm_get_filesize($size)
{
    $size = (float) $size;
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return sprintf('%s %s', round($size / pow(1024, $power), 2), $units[$power]);
}