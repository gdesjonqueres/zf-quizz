<?php

// spl_autoload_register(function ($class) {
// 	require_once str_replace('\\','/',$class) . '.php';
// }, true, true);

// spl_autoload_extensions('.php');
// spl_autoload_register();

require_once 'bootstrap.php';

// $dico = new Quizz\Dictionnary\File(
// 	'japaneseToFrench',
// 	new Quizz\Dictionnary\File\Adapter\Text(
// 		_FILES_PATH . '/[jlpt]_yonkyu_679_mots.txt'
// 	)
// );

$dico = Quizz\Dictionnary::factory(
        array('File' => 'Text'),
        'JapaneseToFrench',
        array(_FILES_PATH . '/[jlpt]_yonkyu_679_mots.txt')
);

$quizz = new Quizz\Quizz(Quizz\QuizzEntry::factoryMultiple($dico));

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  </head>
  <body>
<?php
foreach ($quizz as $quizzEntry) {
	print '<br />' . $quizzEntry->getDictionnaryEntry()->getWord();
	foreach ($quizzEntry->getPropositions() as $prop) {
		print '<br />' . '     ' . $prop;
	}
}
?>
  </body>
</html>