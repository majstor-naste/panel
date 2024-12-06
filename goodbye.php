<?php


ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);


echo '  <title>Flash Rebrading IBO V10</title>' . "\n";
echo '  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">' . "\n";
echo '  <link rel="icon" href="favicon.ico" type="image/x-icon">' . "\n";

function real_ip()
{
	$ip = 'undefined';

	if (isset($_SERVER)) {
		$ip = $_SERVER['REMOTE_ADDR'];

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	}
	else {
		$ip = getenv('REMOTE_ADDR');

		if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		else if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
	}

	$ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
	return $ip;
}

function get_os()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$os_platform = 'Unknown OS Platform';
	$os_array = ['/windows nt 10/i' => 'Windows 10', '/windows nt 6.3/i' => 'Windows 8.1', '/windows nt 6.2/i' => 'Windows 8', '/windows nt 6.1/i' => 'Windows 7', '/windows nt 6.0/i' => 'Windows Vista', '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', '/windows nt 5.1/i' => 'Windows XP', '/windows xp/i' => 'Windows XP', '/windows nt 5.0/i' => 'Windows 2000', '/windows me/i' => 'Windows ME', '/win98/i' => 'Windows 98', '/win95/i' => 'Windows 95', '/win16/i' => 'Windows 3.11', '/macintosh|mac os x/i' => 'Mac OS X', '/mac_powerpc/i' => 'Mac OS 9', '/linux/i' => 'Linux', '/ubuntu/i' => 'Ubuntu', '/iphone/i' => 'iPhone', '/ipod/i' => 'iPod', '/ipad/i' => 'iPad', '/android/i' => 'Android', '/blackberry/i' => 'BlackBerry', '/webos/i' => 'Mobile'];

	foreach ($os_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$os_platform = $value;
		}
	}

	return $os_platform;
}

function Browser_type()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$browser = 'Unknown Browser';
	$browser_array = ['/msie/i' => 'Internet Explorer', '/Trident/i' => 'Internet Explorer', '/firefox/i' => 'Firefox', '/safari/i' => 'Safari', '/chrome/i' => 'Chrome', '/edge/i' => 'Edge', '/opera/i' => 'Opera', '/netscape/i' => 'Netscape', '/maxthon/i' => 'Maxthon', '/konqueror/i' => 'Konqueror', '/ubrowser/i' => 'UC Browser', '/mobile/i' => 'Handheld Browser'];

	foreach ($browser_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$browser = $value;
		}
	}

	return $browser;
}

function get_device()
{
	$tablet_browser = 0;
	$mobile_browser = 0;

	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$tablet_browser++;
	}

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	if ((0 < strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml')) || (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']))) {
		$mobile_browser++;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = ['w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'];

	if (in_array($mobile_ua, $mobile_agents)) {
		$mobile_browser++;
	}

	if (0 < strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini')) {
		$mobile_browser++;
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));

		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
			$tablet_browser++;
		}
	}

	if (0 < $tablet_browser) {
		return 'Tablet';
	}
	else if (0 < $mobile_browser) {
		return 'Mobile';
	}
	else {
		return 'Computer';
	}
}

function IsTorExitPoint()
{
	if (gethostbyname(ReverseIPOctets($_SERVER['REMOTE_ADDR']) . '.' . $_SERVER['SERVER_PORT'] . '.' . ReverseIPOctets($_SERVER['SERVER_ADDR']) . '.ip-port.exitlist.torproject.org') == '127.0.0.2') {
		return 'True';
	}
	else {
		return 'False';
	}
}

function ReverseIPOctets($inputip)
{
	$ipoc = explode('.', $inputip);
	return $ipoc[3] . '.' . $ipoc[2] . '.' . $ipoc[1] . '.' . $ipoc[0];
}

$ipl = real_ip();
$details = json_decode(file_get_contents('https://ipinfo.io/' . $ipl . '/json'));
$country = $details->country;
$state = $details->region;
$city = $details->city;
$isp = $details->org;
$isp = preg_replace('/AS\\d{1,}\\s/', '', $isp);
$loc = $details->loc;
date_default_timezone_set('Europe/London');
$line = '---------------------------------------------' . "\n" . '[TOA] ' . date('Y-m-d H:i:s') . '  [IPV6] ' . real_ip() . "\n" . '[Country] ' . $country . ' [City] ' . $city . ' [State] ' . $state . ' [ISP] ' . $isp . "\n" . ' [Location] ' . $loc . "\n" . ('[UA] ' . $_SERVER['HTTP_USER_AGENT']) . ' [OS] ' . get_os() . "\n" . ' [Browser] ' . Browser_type() . "\n" . ' [Device] ' . get_device() . "\n" . '[Tor Browser] ' . IsTorExitPoint() . "\n";
$logname = date('d-m-Y H:i:s') . '.log';

if (file_exists('snoop/' . $logname)) {
	file_put_contents('snoop/' . $logname . '', $line . PHP_EOL, FILE_APPEND);
}
else {
	file_put_contents('snoop/' . $logname . '', $line . PHP_EOL, FILE_APPEND);
}

echo '<style>' . "\n";
echo '@import url("https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700");' . "\n";
echo "\n";
echo '* {' . "\n";
echo '    margin: 0;' . "\n";
echo '    padding: 0;' . "\n";
echo '    border: 0;' . "\n";
echo '    font-size: 100%;' . "\n";
echo '    font: inherit;' . "\n";
echo '    vertical-align: baseline;' . "\n";
echo '    box-sizing: border-box;' . "\n";
echo '    color: inherit;' . "\n";
echo '}' . "\n";
echo "\n";
echo 'body {' . "\n";
echo '    height: 100%;' . "\n";
echo '     background-image: url("img/goodbye.png");' . "\n";
echo "\t" . 'background-position: center;' . "\n";
echo '    background-repeat: no-repeat;' . "\n";
echo '    background-size: cover;' . "\n";
echo '}' . "\n";
echo "\n";
echo 'div {
    background: rgb(97 22 22 / 89%);
    width: 34vw;
    position: relative;
    border: double;
    top: 29%;
    left: -31%;
    color: #ff8f8f;
    transform: translateY(-50%);
    margin: 0 auto;
    padding: 30px 30px 10px;
    box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);
    z-index: 3;
}    ' . "\n";
echo "\n";
echo 'P {' . "\n";
echo '    font-family: "Share Tech Mono", monospace;' . "\n";
echo '    color: #f5f5f5;' . "\n";
echo '    margin: 0 0 20px;' . "\n";
echo '    font-size: 17px;' . "\n";
echo '    line-height: 1.2;' . "\n";
echo '}' . "\n";
echo "\n";
echo 'span {' . "\n";
echo '    color: #F0DA00;' . "\n";
echo '}' . "\n";
echo "\n";
echo 'i {' . "\n";
echo '    color: #36FE00;' . "\n";
echo '}' . "\n";
echo "\n";
echo 'div a {' . "\n";
echo '    text-decoration: none;' . "\n";
echo '}' . "\n";
echo "\n";
echo 'b {' . "\n";
echo '    color: #81a2be;' . "\n";
echo '}' . "\n";
echo "\n";
echo 'a {' . "\n";
echo '    color: #FF2D00;' . "\n";
echo '}' . "\n";
echo "\n";
echo '@keyframes slide {' . "\n";
echo '    from {' . "\n";
echo '        right: -100px;' . "\n";
echo '        transform: rotate(360deg);' . "\n";
echo '        opacity: 0;' . "\n";
echo '    }' . "\n";
echo '    to {' . "\n";
echo '        right: 15px;' . "\n";
echo '        transform: rotate(0deg);' . "\n";
echo '        opacity: 1;' . "\n";
echo '    }' . "\n";
echo '}' . "\n";
echo "\n";
echo '</style>' . "\n";
echo "\n";
echo '<div>' . "\n";
echo '<center>' . "\n";
echo '          <img class="img-profile rounded-circle" width="265px" src="https://i.imgur.com/rH1PVWv.png">' . "\n";
echo '<br><br>' . "\n";
echo '<p><span><a>𝑮𝒐𝒐𝒅𝒃𝒚𝒆!</a></span></p>' . "\n";
echo '<p> <span><a>𝑻𝒉𝒊𝒔 𝒑𝒂𝒏𝒆𝒍 is for restriction</a></span></p>' . "\n";
echo '<br>' . "\n";
echo '<br>' . "\n";
echo '<p> <span>𝑳𝒐𝒈𝒈𝒆𝒅 𝒐𝒖𝒕 𝒂𝒕</span>: <i>"';
echo date('d-m-Y H:i:s');
echo '<i>"</p>' . "\n";
echo '<br>' . "\n";
echo '<br>' . "\n";
echo '<p> <span><a>𝘾𝙡𝙞𝙘𝙠 𝙘𝙡𝙤𝙨𝙚 𝙩𝙤 𝙚𝙭𝙞𝙩 𝙩𝙝𝙞𝙨 𝙥𝙖𝙜𝙚!!</a></span></p>' . "\n";
echo '<br>' . "\n";
echo '<span><a button class="btn btn-warning btn-icon-split" id="button" href="./login.php">' . "\n";
echo '<span class="icon text-red"><i class="fa fa-cross"></i></span><span class="text">𝑪𝒍𝒐𝒔𝒆</span>' . "\n";
echo '</button></a></span>' . "\n";
echo "\t\t\n";
echo '<script>' . "\n";
echo 'var str = document.getElementsByTagName(\'div\')[0].innerHTML.toString();' . "\n";
echo 'var i = 0;' . "\n";
echo 'document.getElementsByTagName(\'div\')[0].innerHTML = "";' . "\n";
echo "\n";
echo 'setTimeout(function() {' . "\n";
echo '    var se = setInterval(function() {' . "\n";
echo '        i++;' . "\n";
echo '        document.getElementsByTagName(\'div\')[0].innerHTML = str.slice(0, i) + \'|\';' . "\n";
echo '        if (i == str.length) {' . "\n";
echo '            clearInterval(se);' . "\n";
echo '            document.getElementsByTagName(\'div\')[0].innerHTML = str;' . "\n";
echo '        }' . "\n";
echo '    }, 10);' . "\n";
echo '},0);' . "\n";
echo "\n";
echo '</script>';

?>

<style>

</style>
