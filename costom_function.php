<?php 

/**
 * 변수 또는 배열의 이름과 값을 바로 출력. print_r() 함수의 변형
 * @param array $array 표현할 배열
 * @return void
 */
function print_r2(array $var){
    ob_start();
    print_r($var);
    $str = ob_get_contents();
    ob_end_clean();
    $str = str_replace(" ","&nbsp;",$str);
    $result = nl2br("<span style='font-family:Tahoma, 굴림; font-size:9pt;'>$str</span>");
    echo $result;
}

/**
 * 안전한 URL 리다이렉트 (header/JavaScript/meta태그 폴백 지원)
 * @param string $url 이동할 URL
 * @param int $delay 지연시간(초, meta태그용)
 * @return void
 */
function goto_url($url,$delay=0){
    //url 정리
    $url = str_replace("&amp;","&",$url);
    $url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); // XSS 방지

    if(!headers_sent()){
        header("Location:".$url);
    }else {
        $result = '<script>';
        $result .= 'location.replace("'.$url.'")';
        $result .= '</script>';
        $result .= '<noscript>';
        $result .= '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        $result .=  '</noscript>';

        // 사용자에게 메시지 표시
        if($delay > 0) {
            echo "<p>잠시 후 페이지가 이동됩니다.</p>";
        }
        echo $result;
    }
    exit;
}

/**
 * JavaScript alert/confirm 창으로 메시지 표시
 * @param string $msg 표시할 메시지
 * @param string $url 이동할 URL
 * @param bool $error 에러 여부
 * @param bool $post POST 방식 여부
 * @param bool $confirm confirm 사용 여부
 * @return void
 */
function alert($msg='', $url='', $error=true, $post=false, $confirm=false)
{
    global $mm, $config, $member;
    global $is_admin;
    
    $msg = $msg ? strip_tags($msg, '<br>') : '올바른 방법으로 이용해 주십시오.';
    $msg = str_replace('<br>', '\n', $msg);
    $msg = addslashes($msg);
    
    echo '<script>';
    
    if($confirm && $url) {
        // confirm 사용시
        echo 'if(confirm("' . $msg . '")) {';
        $url = str_replace("&amp;", "&", $url);
        $url = addslashes($url);
        echo 'location.href="' . $url . '";';
        echo '} else {';
        echo 'history.back();';
        echo '}';
    } else {
        // 일반 alert
        echo 'alert("' . $msg . '");';
        
        if($url) {
            $url = str_replace("&amp;", "&", $url);
            $url = addslashes($url);
            echo 'location.href="' . $url . '";';
        } else {
            echo 'history.back();';
        }
    }
    
    echo '</script>';
    exit;
}


?>