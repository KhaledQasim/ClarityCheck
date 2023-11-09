https://github.com/KhaledQasim/ClarityCheck

# ClarityCheck

PHP server that displays how weak code can be open to SQL injection, XSS and Stored XSS attacks.

Also shows how to fix the weak code and make it secure.

Explained in detail inside the report file at /report/ClarityCheck_CS3SP_Report.pdf


# Requirements

PHP 8.2
Apache2
MySQL DB

# Config

Please add connection settings to MySQL DB in config/connection.php


And Create a Database called 'claritycheck'


The tables will be automatically created upon loading of the index.php file


If not then check your settings inside the config/connection.php
