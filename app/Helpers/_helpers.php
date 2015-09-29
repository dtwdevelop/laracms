<?php

use App\Helpers\BladeParser;

/**
 * Send email to client. Subject is taken from config mail.subject_<tpl_name>
 *
 * Sends from mail.username and name is set to mail.name
 *
 * If environment is not production then will be sent back to mail.username
 *
 * @param string $email email
 * @param string $tpl   blade template name in mails folder
 * @param array  $data  (Optional) data passed to blade template
 *
 * @throws Exception
 *
 * @return bool
 */
function send_mail($email, $tpl, $data = array())
{
    if (env('APP_ENV') !== 'production') {
        $data['_original_sendmail_to'] = $email;
        $email = env('TEST_EMAIL', config('mail.username'));
    }

    $parser = new BladeParser();
    $subject = config('mail.subject_' . $tpl);
    if ($subject === null) {
        throw new Exception('config for subject not found: mail.subject_' . $tpl);
    }
    $subject = $parser->parse($subject, $data);

    $sent = Mail::send(
        'emails.' . $tpl,
        $data,
        function ($message) use ($email, $subject) {
            $message->from(config('mail.username'), config('mail.name'));
            $message->to($email);
            $message->subject($subject);
        }
    );

    return $sent;
}

/**
 * Send system emails to us. Emails are taken from config mail.info_mail.
 * info_mail might be a string of emails separated by comma without spaces.
 * In that case email is send to multiple recipients.
 * System email subject is taken from config mail.subject_<tpl>
 *
 * Sends from mail.username and name is set to mail.name
 *
 * If environment is not production then will be sent back to mail.username
 *
 * @param string $tpl  blade template
 * @param array  $data (Optional) data passed to blade template
 *
 * @throws Exception
 *
 * @return bool
 */
function send_info_mails($tpl, $data = array())
{
    // get system emails from mail.info_emails
    $info_emails = config('mail.info_emails');
    if (strpos($info_emails, ',') !== false) {
        $info_emails = explode(',', $info_emails);
    }

    if (env('APP_ENV') !== 'production') {
        $data['_original_sendmail_to'] = $info_emails;
        $info_emails = array(
            env('TEST_INFO_EMAIL_1', config('mail.username')),
            env('TEST_INFO_EMAIL_2', config('mail.username')),
        );
    }

    $parser = new BladeParser();
    $subject = config('mail.subject_' . $tpl);
    if ($subject === null) {
        throw new Exception('config for subject not found: mail.subject_' . $tpl);
    }
    $subject = $parser->parse($subject, $data);

    $sent = Mail::send(
        'emails.' . $tpl,
        $data,
        function ($message) use ($info_emails, $subject) {
            $message->from(config('mail.username'), config('mail.name'));
            $message->to($info_emails);
            $message->subject($subject);
        }
    );

    return $sent;
}

// Returns a file size limit in bytes based on the PHP upload_max_filesize
// and post_max_size
function file_upload_max_size()
{
    static $max_size = -1;

    if ($max_size < 0) {
        // Start with post_max_size.
        $max_size = parse_size(ini_get('post_max_size'));

        // If upload_max_size is less, then reduce. Except if upload_max_size is
        // zero, which indicates no limit.
        $upload_max = parse_size(ini_get('upload_max_filesize'));
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }
    }

    return $max_size;
}

function parse_size($size)
{
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    } else {
        return round($size);
    }
}

//This function transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in this case)
function convert_size($sSize)
{
    if ( is_numeric( $sSize) ) {
        return $sSize;
    }
    $sSuffix = substr($sSize, -1);
    $iValue = substr($sSize, 0, -1);
    switch(strtoupper($sSuffix)){
        case 'P':
            $iValue *= 1024;
        case 'T':
            $iValue *= 1024;
        case 'G':
            $iValue *= 1024;
        case 'M':
            $iValue *= 1024;
        case 'K':
            $iValue *= 1024;
            break;
    }
    return $iValue;
}

function get_max_upload_file_size()
{
    return min(convert_size(ini_get('post_max_size')), convert_size(ini_get('upload_max_filesize')));
}

function format_bytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'k', 'M', 'G', 'T');

    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}
