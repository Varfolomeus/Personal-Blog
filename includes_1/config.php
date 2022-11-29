<?PHP
$config = array(
'title' => 'Блог IT-Капиталиста '.date("d.m.Y"),
'sn_ssylka' => 'https://www.facebook.com/oleg.chernyavskyy.1',
'db' => array(
'server' => 'localhost',
'username' => 'root',
'password' => '',
'name' => 'test'
)
);

$connection = mysqli_connect(
$config['db']['server'],
$config['db']['username'],
$config['db']['password'],
$config['db']['name']
);

IF($connection==false)
{
echo 'не удалось подключиться к базе <br>';
echo mysqli_connect_error();
exit();
}
mysqli_set_charset($connection, "utf8");
$perpage = 4;
$uploaddir = '../media/images/';
?>