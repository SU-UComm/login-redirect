# Login Redirect

Some plugins set login redirects to `$_SERVER['SERVER_NAME']`,
which fails on Pantheon servers. This plugin intercepts
`login-redirect` and replaces the hostname with
`$_SERVER['HTTP_HOST']`.