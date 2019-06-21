<?php
namespace Mapc\Library;

function security_arguments($arr) {
	foreach($arr as $key => $str) {
		{ // BLOCK:SQL_Inject:20180918:SQL인젝션방어
			$str = @trim($str);
			if(get_magic_quotes_gpc()) {
				$str = stripslashes($str);
			}
			$str = str_replace("'","&#39;",$str);
			//$str = preg_replace("(select|union|insert|update|delete|and|or|drop|\"|\'|#|\/\*|\*\/|\\\|\;)", "", $str); 
			$str = preg_replace("(select|union|insert|update|delete|drop|\"|\'|#|\/\*|\*\/|\\\|\;)", "", $str); 
		} // BLOCK

		{ // BLOCK:Xss_block:20180918:XSS 방어
			$str = str_replace("&","&amp;",$str);
			$str = str_replace("<","&lt;",$str);
			$str = str_replace(">","&gt;",$str);
			//$str = str_replace("""","&quot;",$str);
			$str = str_replace("'","&#39;",$str);


			$str = preg_replace("#\/\*.*\*\/#", "", $str);

			$str = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $str);
			$str = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $str);
			$str = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $str);
			$str = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $str);
			//$str = preg_replace("/\<(\w|\s|\?)*(xml)/i", "", $str);
			$str = preg_replace("/\<(\w|\s|\?)*(xml)/i", "_$1$2_", $str);

			// 플래시의 액션스크립트와 자바스크립트의 연동을 차단하여 악의적인 사이트로의 이동을 막는다.
			$str = preg_replace("/((?<=\<param|\<embed)[^>]+)(\s*=\s*[\'\"]?)always([\'\"]?)([^>]+(?=\>))/i", "$1$2never$3$4", $str);

			// 이미지 태그의 src 속성에 삭제등의 링크가 있는 경우 게시물을 확인하는 것만으로도 데이터의 위변조가 가능하므로 이것을 막음
			$str = preg_replace("/<(img[^>]+delete\.php[^>]+bo_table[^>]+)/i", "*** CSRF 감지 : &lt;$1", $str);
			$str = preg_replace("/<(img[^>]+delete_comment\.php[^>]+bo_table[^>]+)/i", "*** CSRF 감지 : &lt;$1", $str);
			$str = preg_replace("/<(img[^>]+logout\.php[^>]+)/i", "*** CSRF 감지 : &lt;$1", $str);
			$str = preg_replace("/<(img[^>]+download\.php[^>]+bo_table[^>]+)/i", "*** CSRF 감지 : &lt;$1", $str);
		} // BLOCK

		$arr_result[$key] = $str;

	} // foreach

	return $arr_result;
}

// this is it
