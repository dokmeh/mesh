<?php
include_once "Mobile_Detect.php";

function get_device()
{
    $detect = new Mobile_Detect;
    return $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer';
}

function img_ext($image)
{
    $mime = $image->getMimeType();
    switch ($mime)
    {
        case "image/jpeg":
            $ext = "jpg";
            break;
        case "image/png":
            $ext = "png";
            break;
        case "image/bmp":
            $ext = "bmp";
            break;
        case "image/svg+xml":
            $ext = "svg";
            break;
        case "image/gif":
            $ext = "gif";
            break;
        default:
            $ext = false;
    }
    return $ext;
}
