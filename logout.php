<?

session_start();

session_destroy();

echo "Logged out";

header('Refresh: 4;URL=login.html');

?>