<?php
/**
 * MANUAL AUTOLOAD PROTOCOL
 * Use this only if Composer is unavailable.
 */

// Define the path to your PHPMailer source files
// This assumes you downloaded PHPMailer and put it in a folder named 'PHPMailer'
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Now your script can use the namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;