# nginx configuration
charset utf-8;
error_page 404 /index.php;
location /No-CMS/ {
    if (!-e $request_filename){
        rewrite ^/No-CMS/site-([a-zA-Z0-9]*)$ /No-CMS/index.php/?__cms_subsite=$1 break;
    }
    if (!-e $request_filename){
        rewrite ^/No-CMS/(.*)$ /No-CMS/index.php/$1 break;
    }
    if ($http_host ~* "^www\.(.+)$"){
        rewrite ^/No-CMS/(.*)$ http://%1$request_uri redirect;
    }
    if ($script_filename ~ "-d"){
        return 403;
    }
    if ($script_filename ~ "-f"){
        return 403;
    }
}
location /No-CMS/site {
    rewrite ^/No-CMS/site-([a-zA-Z0-9]*)/(.*)$ /No-CMS/index.php/$2?__cms_subsite=$1 break;
}
