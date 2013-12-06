SendGrid Sample App - PHP
======================

This git repository helps you to send emails quickly and easily through SendGrid using PHP.

Create an SendGrid account at http://sendgrid.com/pricing.html

Clone SendGrid application on your local machine
<pre>
    git clone https://github.com/sendgrid/sendgrid-php-sample-app
</pre>

###Configuration###

Configure `index.php` file with your information:

Update the *&lt;sendgrid_username&gt;* and *&lt;sendgrid_password&gt;* with your SendGrid credentials.
```php
    $sendgrid_username = '<sendgrid_username>';
    $sendgrid_password = '<sendgrid_password>';
```
Update the *&lt;from_address&gt;* with your email address
```php
    $from_email = "<from_address>";
```

Upload your application to your server




