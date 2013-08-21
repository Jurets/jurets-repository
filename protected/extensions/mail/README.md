yii-mail-extension
==================

One simple mail extension for Yii framework

It uses [PEAR Mail](http://pear.php.net/manual/en/package.mail.php) (not bundled) and for now only includes *Mailer* component that allows to send plain text and MIME mails. In near future this component could permit Cc, Bcc and Reply-to settings, file attachments and so on. Put messages on a queue for later delivery is also planned.

Installation
------------

* Install [PEAR Mail](http://pear.php.net/package/Mail/) and [PEAR Mail_Mime](http://pear.php.net/package/Mail_Mime/).

* Unpack mail extension under your extensions directory.

* Configure *Mailer* component (see PHPDoc):

```
	'mailer'=>array(
		'class'=>'ext.mail.Mailer',
		'backend'=>'...',
		'backendParams'=>array(
			...
		),
		'mimeParams'=>array(
			...
		),
	),
```

Usage
-----

* Send a plain text mail:

```
Yii::app()->mailer->send(
	'from@example.com',
	array(
		'to1@example.com',
		'to2@example.com',
	),
	'Subject',
	'This is the body'
);
```

* Send a MIME mail:

```
Yii::app()->mailer->sendMIME(
	'from@example.com',
	array(
		'to1@example.com',
		'to2@example.com',
	),
	'Subject',
	'This is the plain text body'
	'<html><body>This is the HTML body</body></html>'
);
```

