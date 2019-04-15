<?php
print('<h1>DB Connect check</h1>');
try {
  $db = get_db();
  $stt = $db->query("SELECT * FROM `users` ");
  echo '<pre>';
  print_r($stt->fetchAll(PDO::FETCH_ASSOC));
  echo '</pre>';
} catch (PDOException $e) {
  print_r($e->getMessage());
}

function get_db() {
  $db_host = getenv('DB_HOST');
  $db_port = getenv('DB_PORT');
  $db_name = getenv('DB_NAME');
  $user = getenv('DB_USER');
  $password = getenv('DB_PASS');

  $dsn = "mysql:host={$db_host};"
        ."port={$db_port};"
        ."dbname={$db_name};"
        ."charset=utf8";

  return new PDO($dsn, $user, $password);
}
