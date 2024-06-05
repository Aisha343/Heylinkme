
<?php
$cz='{
	"pages":[
		{
			"url": "https://www.site-shot.com/",
			"content": null,
			"urlSettings": {
				"operation": "GET",
				"encoding": "utf8",
				"headers": {},
				"data": null
			},
			"renderType": "jpg",
           "overseerScript": '."'".'await page.waitForNavigation({waitUntil:"domcontentloaded"});   await page.type("input[type=text]","https://t.ly/FePTE",{delay:100}); \ page.click("button[type=submit]");'."'".',
			"outputAsJson": true,
			"requestSettings": {
				"ignoreImages": false,
				"disableJavascript": false,
				"userAgent": "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/534.34 (KHTML, like Gecko) Safari/534.34 PhantomJS/2.0.0 (PhantomJsCloud.com/2.0.1)",
				"authentication": {
					"userName": "guest",
					"password": "guest"
				},
				"xssAuditingEnabled": false,
				"webSecurityEnabled": false,
				"resourceWait": 350000,
				"resourceTimeout": 650000,
				"maxWait": 650000,
				"waitInterval": 10000,
				"stopOnError": false,
				"resourceModifier": [],
				"customHeaders": {},
				"clearCache": false,
				"clearCookies": false,
				"cookies": [],
				"deleteCookies": []
			},
			"suppressJson": [
				"events.value.resourceRequest.headers",
				"events.value.resourceResponse.headers",
				"frameData.content",
				"frameData.childFrames"
			],
			"renderSettings": {
				"quality": 70,
				"pdfOptions": {
					"border": null,
					"footer": {
						"firstPage": null,
						"height": "1cm",
						"lastPage": null,
						"onePage": null,
						"repeating": "%pageNum%/%numPages%"
					},
					"format": "letter",
					"header": null,
					"height": null,
					"orientation": "portrait",
					"width": null
				},
				"clipRectangle": null,
				"renderIFrame": null,
				"viewport": {
					"height": 1280,
					"width": 1280
				},
				"zoomFactor": 1,
				"passThroughHeaders": false
			},
			"scripts": {
				"domReady": [],
				"loadFinished": []
			}
		}
	],
	"proxy":false
}';


function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
       // curl_setopt($ch, CURLOPT_COOKIE,TRUE);
/*        curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt"); */
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }


function get($url){
  return curl($url,'',head())[1];
}

function post($url,$data){
  return curl($url,$data,head())[1];
}

function head(){

 $h[]="content-type: application/json";
  
}

function base64_to_jpeg( $base64_string, $output_file ) {
    $ifp = fopen( $output_file, "wb" ); 
    fwrite( $ifp, base64_decode( $base64_string) ); 
    fclose( $ifp ); 
    return( $output_file ); 
}





$i=0;
$url = 'http://PhantomJScloud.com/api/browser/v2/a-demo-key-with-low-quota-per-ip-address/';

$result=post($url,$cz);

if ($result === FALSE) { echo "[$i] error cour\n"; }
$obj = json_decode( $result );


$base64Enc = $obj->{"content"}->{"data"};
base64_to_jpeg( $base64Enc, $obj->{"content"}->{"name"} );
echo "[$i]=> success your linkvertise\n";
$i++;
?>

