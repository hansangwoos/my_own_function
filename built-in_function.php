<?php


// ========================================//
// 배열 함수 (Array Functions)
// ========================================//
/**
 * 배열의 각 요소에 콜백 함수를 적용하여 새로운 배열 반환
 * @param callable $callback 적용할 콜백 함수
 * @param array $array 처리할 배열
 * @return array 변환된 새로운 배열
 */
$numbers = [1, 2, 3, 4];
$squared = array_map(fn($n) => $n * $n, $numbers); // [1, 4, 9, 16]

/**
 * 조건에 맞는 배열 요소만 필터링
 * @param array $array 필터링할 배열
 * @param callable|null $callback 필터 조건 함수
 * @param int $mode 필터링 모드
 * @return array 필터링된 배열
 */
$numbers = [1, 2, 3, 4, 5];
$even = array_filter($numbers, fn($n) => $n % 2 === 0); // [2, 4]

/**
 * 배열을 하나의 값으로 축약
 * @param array $array 처리할 배열
 * @param callable $callback 축약 함수
 * @param mixed $initial 초기값
 * @return mixed 축약된 결과값
 */
$numbers = [1, 2, 3, 4];
$sum = array_reduce($numbers, fn($carry, $item) => $carry + $item, 0); // 10

/**
 * 다차원 배열에서 특정 컬럼의 값들만 추출
 * @param array $array 다차원 배열
 * @param mixed $column_key 추출할 컬럼 키
 * @param mixed|null $index_key 인덱스로 사용할 키
 * @return array 추출된 값들의 배열
 */
$users = [
    ['id' => 1, 'name' => 'John'],
    ['id' => 2, 'name' => 'Jane']
];
$names = array_column($users, 'name'); // ['John', 'Jane']


/**
 * 하나 이상의 배열을 합침
 * @param array ...$arrays 합칠 배열들
 * @return array 합쳐진 새로운 배열
 */
$arr1 = [1, 2];
$arr2 = [3, 4];
$merged = array_merge($arr1, $arr2); // [1, 2, 3, 4]

/**
 * 배열에서 중복값 제거
 * @param array $array 중복을 제거할 배열
 * @param int $flags 비교 타입 플래그
 * @return array 중복이 제거된 배열
 */
$numbers = [1, 2, 2, 3, 3, 4];
$unique = array_unique($numbers); // [1, 2, 3, 4]

/**
 * 배열에서 값을 찾아 키 반환
 * @param mixed $needle 찾을 값
 * @param array $haystack 검색할 배열
 * @param bool $strict 엄격한 비교 여부
 * @return mixed 키 또는 false
 */
$fruits = ['apple', 'banana', 'orange'];
$key = array_search('banana', $fruits); // 1

/**
 * 배열의 모든 키를 반환
 * @param array $array 대상 배열
 * @param mixed $search_value 특정 값의 키만 찾기
 * @param bool $strict 엄격한 비교 여부
 * @return array 키들의 배열
 */
$data = ['name' => 'John', 'age' => 30, 'city' => 'Seoul'];
$keys = array_keys($data); // ['name', 'age', 'city']

/**
 * 배열의 모든 값을 반환 (키는 0부터 재정렬)
 * @param array $array 대상 배열
 * @return array 값들의 배열
 */
$data = ['name' => 'John', 'age' => 30];
$values = array_values($data); // ['John', 30]

/**
 * 배열의 키와 값을 뒤바꿈
 * @param array $array 대상 배열
 * @return array 키와 값이 바뀐 배열
 */
$original = ['a' => 1, 'b' => 2, 'c' => 3];
$flipped = array_flip($original); // [1 => 'a', 2 => 'b', 3 => 'c']

/**
 * 배열을 지정된 크기로 분할
 * @param array $array 분할할 배열
 * @param int $length 청크 크기
 * @param bool $preserve_keys 키 보존 여부
 * @return array 분할된 배열들의 배열
 */
$data = [1, 2, 3, 4, 5, 6, 7, 8];
$chunks = array_chunk($data, 3); // [[1,2,3], [4,5,6], [7,8]]

/**
 * 배열의 일부분을 추출
 * @param array $array 대상 배열
 * @param int $offset 시작 위치
 * @param int|null $length 길이
 * @param bool $preserve_keys 키 보존 여부
 * @return array 추출된 배열
 */
$data = [1, 2, 3, 4, 5];
$slice = array_slice($data, 1, 3); // [2, 3, 4]

/**
 * 배열의 일부를 제거하고 다른 요소로 대체
 * @param array &$input 대상 배열 (참조)
 * @param int $offset 시작 위치
 * @param int|null $length 제거할 길이
 * @param mixed $replacement 대체할 요소
 * @return array 제거된 요소들
 */
$arr = [1, 2, 3, 4, 5];
$removed = array_splice($arr, 2, 2, ['a', 'b']); // $arr은 [1,2,'a','b',5]가 됨


// ========================================//
// 문자열 함수 (String Functions)
// ========================================//
/**
 * 문자열에 특정 문자열이 포함되어 있는지 확인 (PHP 8.0+)
 * @param string $haystack 검색 대상 문자열
 * @param string $needle 찾을 문자열
 * @return bool 포함 여부
 */
$text = "Hello World";
$contains = str_contains($text, "World"); // true

/**
 * 문자열이 특정 문자열로 시작하는지 확인 (PHP 8.0+)
 * @param string $haystack 검사할 문자열
 * @param string $needle 시작 문자열
 * @return bool 시작 여부
 */
$email = "user@example.com";
$isValid = str_starts_with($email, "user"); // true

/**
 * 문자열이 특정 문자열로 끝나는지 확인 (PHP 8.0+)
 * @param string $haystack 검사할 문자열
 * @param string $needle 끝 문자열
 * @return bool 끝 여부
 */
$filename = "document.pdf";
$isPdf = str_ends_with($filename, ".pdf"); // true

/**
 * 문자열 양쪽 끝의 공백 제거
 * @param string $string 대상 문자열
 * @param string $characters 제거할 문자들
 * @return string 공백이 제거된 문자열
 */
$text = "  Hello World  ";
$trimmed = trim($text); // "Hello World"

/**
 * 문자열을 구분자로 나누어 배열로 변환
 * @param string $delimiter 구분자
 * @param string $string 나눌 문자열
 * @param int $limit 최대 분할 개수
 * @return array 분할된 문자열 배열
 */
$csv = "apple,banana,orange";
$fruits = explode(",", $csv); // ['apple', 'banana', 'orange']

/**
 * 배열을 구분자로 연결하여 문자열로 변환
 * @param string $separator 구분자
 * @param array $array 연결할 배열
 * @return string 연결된 문자열
 */
$fruits = ['apple', 'banana', 'orange'];
$csv = implode(",", $fruits); // "apple,banana,orange"

/**
 * HTML 특수문자를 엔티티로 변환 (XSS 방지)
 * @param string $string 변환할 문자열
 * @param int $flags 변환 플래그
 * @param string|null $encoding 문자 인코딩
 * @param bool $double_encode 이미 인코딩된 엔티티 재인코딩 여부
 * @return string 변환된 문자열
 */
$userInput = "<script>alert('XSS')</script>";
$safe = htmlspecialchars($userInput); // "&lt;script&gt;alert('XSS')&lt;/script&gt;"

/**
 * 문자열의 일부분 추출
 * @param string $string 대상 문자열
 * @param int $start 시작 위치
 * @param int|null $length 길이
 * @return string 추출된 문자열
 */
$text = "Hello World";
$part = substr($text, 0, 5); // "Hello"
$part = substr($text, 6);    // "World"

/**
 * 문자열의 길이 반환
 * @param string $string 대상 문자열
 * @return int 문자열 길이
 */
$length = strlen("Hello World"); // 11

/**
 * 문자열에서 특정 부분을 다른 문자열로 치환
 * @param array|string $search 찾을 문자열
 * @param array|string $replace 치환할 문자열
 * @param string|array $subject 대상 문자열
 * @param int &$count 치환된 횟수 (참조)
 * @return string|array 치환된 결과
 */
$text = "Hello World World";
$result = str_replace("World", "PHP", $text); // "Hello PHP PHP"

/**
 * 대소문자 구분 없이 문자열 치환
 * @param array|string $search 찾을 문자열
 * @param array|string $replace 치환할 문자열
 * @param string|array $subject 대상 문자열
 * @param int &$count 치환된 횟수
 * @return string|array 치환된 결과
 */
$result = str_ireplace("WORLD", "PHP", "Hello world"); // "Hello PHP"

/**
 * 문자열에서 특정 문자열의 첫 번째 위치 찾기
 * @param string $haystack 검색 대상
 * @param string $needle 찾을 문자열
 * @param int $offset 검색 시작 위치
 * @return int|false 위치 또는 false
 */
$pos = strpos("Hello World", "World"); // 6
$pos = strpos("Hello World", "PHP");   // false

/**
 * 문자열을 소문자로 변환
 * @param string $string 대상 문자열
 * @return string 소문자로 변환된 문자열
 */
$lower = strtolower("Hello World"); // "hello world"

/**
 * 문자열을 대문자로 변환
 * @param string $string 대상 문자열
 * @return string 대문자로 변환된 문자열
 */
$upper = strtoupper("Hello World"); // "HELLO WORLD"

/**
 * 첫 글자만 대문자로 변환
 * @param string $string 대상 문자열
 * @return string 첫 글자가 대문자인 문자열
 */
$result = ucfirst("hello world"); // "Hello world"

/**
 * 각 단어의 첫 글자를 대문자로 변환
 * @param string $string 대상 문자열
 * @param string $separators 단어 구분자
 * @return string 각 단어 첫 글자가 대문자인 문자열
 */
$result = ucwords("hello world"); // "Hello World"

// == 슈퍼글로벌함수== //

/**
 * 배열의 키-값을 변수로 추출
 * @param array $array 추출할 배열
 * @param int $flags 추출 플래그
 * @param string $prefix 변수명 접두사
 * @return int 추출된 변수 개수
 */
$data = ['name' => 'John', 'age' => 30];
extract($data); // $name = 'John', $age = 30 변수가 생성됨

/**
 * 변수들을 배열로 합침
 * @param array|string ...$var_names 변수명들
 * @return array 변수들로 구성된 배열
 */
$name = 'John';
$age = 30;
$data = compact('name', 'age'); // ['name' => 'John', 'age' => 30]

// ========================================//
// 수학/계산 관련 함수
// ========================================//

/**
 * 숫자를 반올림
 * @param int|float $num 반올림할 숫자
 * @param int $precision 소수점 자릿수
 * @param int $mode 반올림 모드
 * @return float 반올림된 숫자
 */
$result = round(3.14159, 2); // 3.14

/**
 * 숫자를 올림
 * @param int|float $num 올림할 숫자
 * @return float 올림된 숫자
 */
$result = ceil(3.2); // 4.0

/**
 * 숫자를 내림
 * @param int|float $num 내림할 숫자
 * @return float 내림된 숫자
 */
$result = floor(3.8); // 3.0

/**
 * 절댓값 반환
 * @param int|float $num 대상 숫자
 * @return int|float 절댓값
 */
$result = abs(-5); // 5

/**
 * 최댓값 반환
 * @param mixed ...$values 비교할 값들
 * @return mixed 최댓값
 */
$max = max(1, 5, 3, 9, 2); // 9
$max = max([1, 5, 3, 9, 2]); // 9

/**
 * 최솟값 반환
 * @param mixed ...$values 비교할 값들
 * @return mixed 최솟값
 */
$min = min(1, 5, 3, 9, 2); // 1

/**
 * 랜덤 정수 생성
 * @param int $min 최솟값
 * @param int $max 최댓값
 * @return int 랜덤 정수
 */
$random = rand(1, 100); // 1~100 사이의 랜덤한 정수



// ========================================//
// 보안 관련 함수
// ========================================//

/**
 * 비밀번호를 안전하게 해시화
 * @param string $password 해시할 비밀번호
 * @param string|int|null $algo 해시 알고리즘
 * @param array $options 해시 옵션
 * @return string 해시된 비밀번호
 */
$password = "user_password";
$hash = password_hash($password, PASSWORD_DEFAULT);

/**
 * 비밀번호와 해시값이 일치하는지 확인
 * @param string $password 확인할 비밀번호
 * @param string $hash 저장된 해시값
 * @return bool 일치 여부
 */
$isValid = password_verify($password, $hash);

/**
 * 문자열을 해시화
 * @param string $algo 해시 알고리즘
 * @param string $data 해시할 데이터
 * @param bool $binary 바이너리 출력 여부
 * @return string 해시값
 */
$hash = hash('sha256', 'Hello World');

// ========================================//
// 날짜/시간 함수
// ========================================//

/**
 * 날짜/시간을 포맷팅
 * @param string $format 날짜 포맷
 * @param int|null $timestamp 타임스탬프 (기본값: 현재시간)
 * @return string 포맷된 날짜 문자열
 */
$today = date('Y-m-d H:i:s'); // "2024-01-15 14:30:25"

/**
 * 문자열을 타임스탬프로 변환
 * @param string $datetime 날짜/시간 문자열
 * @param int|null $baseTimestamp 기준 타임스탬프
 * @return int|false 타임스탬프 또는 false
 */
$timestamp = strtotime('2024-01-15 14:30:25');
$nextWeek = strtotime('+1 week');

/**
 * 마이크로초 단위 현재 시간 반환
 * @param bool $as_float float로 반환할지 여부
 * @return string|float 마이크로타임
 */
$start = microtime(true);
// ... 코드 실행 ...
$end = microtime(true);
$executionTime = $end - $start;

// ========================================//
// 파일/디렉토리 함수
// ========================================//

/**
 * 파일의 내용을 문자열로 읽기
 * @param string $filename 파일명
 * @param bool $use_include_path include_path 사용 여부
 * @param resource|null $context 스트림 컨텍스트
 * @param int $offset 읽기 시작 위치
 * @param int|null $length 읽을 길이
 * @return string|false 파일 내용 또는 false
 */
$content = file_get_contents('config.json');


/**
 * 데이터를 파일에 쓰기
 * @param string $filename 파일명
 * @param mixed $data 쓸 데이터
 * @param int $flags 쓰기 플래그
 * @param resource|null $context 스트림 컨텍스트
 * @return int|false 쓴 바이트 수 또는 false
 */
$result = file_put_contents('log.txt', 'Error message', FILE_APPEND);

/**
 * 파일이나 디렉토리 존재 여부 확인
 * @param string $filename 파일명
 * @return bool 존재 여부
 */
$exists = file_exists('config.php');

/**
 * 디렉토리인지 확인
 * @param string $filename 경로명
 * @return bool 디렉토리 여부
 */
$isDirectory = is_dir('/path/to/directory');


/**
 * 디렉토리 생성
 * @param string $directory 생성할 디렉토리 경로
 * @param int $permissions 권한 (기본값: 0777)
 * @param bool $recursive 재귀적 생성 여부
 * @param resource|null $context 스트림 컨텍스트
 * @return bool 성공 여부
 */
$created = mkdir('/path/to/new/directory', 0755, true);


// ========================================//
// HTTP/URL 함수
// ========================================//

/**
 * 변수를 지정된 필터로 검증/정화
 * @param mixed $value 필터링할 값
 * @param int $filter 사용할 필터
 * @param int|array $options 필터 옵션
 * @return mixed 필터링된 값 또는 false
 */
$email = filter_var($input, FILTER_VALIDATE_EMAIL);
$url = filter_var($input, FILTER_VALIDATE_URL);
$int = filter_var($input, FILTER_VALIDATE_INT);

/**
 * URL을 구성요소로 분해
 * @param string $url 분해할 URL
 * @param int $component 반환할 특정 구성요소
 * @return array|string|int|null|false URL 구성요소
 */
$parts = parse_url('https://example.com/path?query=value');
// ['scheme' => 'https', 'host' => 'example.com', 'path' => '/path', 'query' => 'query=value']

/**
 * 배열을 URL 쿼리 문자열로 변환
 * @param array|object $data 쿼리 데이터
 * @param string $numeric_prefix 숫자 인덱스 접두사
 * @param string|null $arg_separator 인수 구분자
 * @param int $encoding_type 인코딩 타입
 * @return string 쿼리 문자열
 */
$params = ['name' => 'John', 'age' => 30];
$query = http_build_query($params); // "name=John&age=30"

/**
 * URL 인코딩
 * @param string $string 인코딩할 문자열
 * @return string 인코딩된 문자열
 */
$encoded = urlencode('Hello World!'); // "Hello%20World%21"


// ========================================//
// JSON 함수
// ========================================//

/**
 * PHP 변수를 JSON 문자열로 변환
 * @param mixed $value JSON으로 변환할 값
 * @param int $flags JSON 인코딩 플래그
 * @param int $depth 최대 깊이
 * @return string|false JSON 문자열 또는 false
 */
$data = ['name' => 'John', 'age' => 30];
$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

/**
 * JSON 문자열을 PHP 변수로 변환
 * @param string $json JSON 문자열
 * @param bool|null $associative 연관배열로 반환할지 여부
 * @param int $depth 최대 깊이
 * @param int $flags JSON 디코딩 플래그
 * @return mixed 변환된 값
 */
$json = '{"name":"John","age":30}';
$data = json_decode($json, true); // ['name' => 'John', 'age' => 30]

/**
 * 마지막 JSON 작업의 에러 코드 반환
 * @return int 에러 코드
 */
json_decode('{"invalid": json}');
$error = json_last_error(); // JSON_ERROR_SYNTAX


// ========================================//
// 기타 유틸리티 함수
// ========================================//

/**
 * 변수가 비어있는지 확인
 * @param mixed $var 확인할 변수
 * @return bool 비어있는지 여부
 */
$isEmpty = empty($variable); // "", 0, null, false, [] 등은 true

/**
 * 변수가 설정되어 있는지 확인
 * @param mixed $var 확인할 변수
 * @return bool 설정 여부
 */
$isSet = isset($variable); // null이 아니고 설정되어 있으면 true


/**
 * 변수의 정보를 덤프 (디버깅용)
 * @param mixed $value 덤프할 변수
 * @return void
 */
var_dump($variable); // 타입과 값을 자세히 출력

/**
 * 배열의 요소 개수(키 개수) 반환
 * @param array|Countable $value 카운트할 배열
 * @param int $mode 카운트 모드 (COUNT_NORMAL 또는 COUNT_RECURSIVE)
 * @return int 요소 개수
 */
$array = ['apple', 'banana', 'orange'];
$count = count($array); // 3

$assoc = ['name' => 'John', 'age' => 30, 'city' => 'Seoul'];
$count = count($assoc); // 3

/**
 * 배열에 특정 값이 있는지 확인
 * @param mixed $needle 찾을 값
 * @param array $haystack 검색할 배열
 * @param bool $strict 엄격한 비교 여부
 * @return bool 존재 여부
 */
$exists = in_array('apple', ['apple', 'banana', 'orange']); // true

/**
 * 배열에서 지정된 키가 존재하는지 확인
 * @param string|int $key 찾을 키
 * @param array $array 검색할 배열
 * @return bool 키 존재 여부
 */
$keyExists = array_key_exists('name', ['name' => 'John', 'age' => 30]); // true


/**
 * 범위의 배열 생성
 * @param mixed $start 시작값
 * @param mixed $end 끝값
 * @param int|float $step 증가폭
 * @return array 범위 배열
 */
$numbers = range(1, 10); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
$evens = range(2, 10, 2); // [2, 4, 6, 8, 10]

/**
 * 변수가 숫자인지 확인 (문자열 숫자도 포함)
 * @param mixed $value 검사할 값
 * @return bool 숫자 여부
 */
$isNum = is_numeric("123");    // true
$isNum = is_numeric("12.34");  // true
$isNum = is_numeric("abc");    // false

/**
 * 변수가 배열인지 확인
 * @param mixed $value 검사할 값
 * @return bool 배열 여부
 */
$isArr = is_array([1, 2, 3]); // true
$isArr = is_array("string");  // false

/**
 * 변수가 문자열인지 확인
 * @param mixed $value 검사할 값
 * @return bool 문자열 여부
 */
$isStr = is_string("hello");  // true
$isStr = is_string(123);      // false

/**
 * 변수가 null인지 확인
 * @param mixed $value 검사할 값
 * @return bool null 여부
 */
$isNull = is_null(null);    // true
$isNull = is_null("");      // false

/**
 * 외부 입력값을 필터링해서 가져오기
 * @param int $type 입력 타입 (INPUT_GET, INPUT_POST 등)
 * @param string $var_name 변수명
 * @param int $filter 필터 타입
 * @param int|array $options 옵션
 * @return mixed 필터링된 값 또는 false
 */
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);


/**
 * 출력 버퍼링 시작
 * @param callable|null $callback 버퍼 콜백 함수
 * @param int $chunk_size 청크 크기
 * @param int $flags 버퍼 플래그
 * @return bool 성공 여부
 */
ob_start(); // 출력 버퍼링 시작
echo "이 내용은 즉시 출력되지 않습니다";

/**
 * 출력 버퍼의 내용 가져오기
 * @return string|false 버퍼 내용 또는 false
 */
ob_start();
echo "Hello World";
$content = ob_get_contents(); // "Hello World"

/**
 * 출력 버퍼 내용 출력하고 버퍼 종료
 * @return bool 성공 여부
 */
ob_start();
echo "Hello World";
ob_end_flush(); // "Hello World" 출력 후 버퍼 종료

/**
 * 출력 버퍼 내용을 가져오고 버퍼 지우기
 * @return string|false 버퍼 내용 또는 false
 */
ob_start();
echo "Hello World";
$content = ob_get_clean(); // 내용을 변수에 저장하고 출력은 하지 않음






/**
 * 지정된 시간(마이크로초) 동안 실행 일시정지
 * @param int $microseconds 정지할 시간(마이크로초)
 * @return void
 */
usleep(500000); // 0.5초간 정지 (500,000 마이크로초)

/**
 * 지정된 시간(초) 동안 실행 일시정지
 * @param int $seconds 정지할 시간(초)
 * @return int 성공시 0, 신호로 중단시 남은 시간
 */
sleep(5); // 5초간 정지

/**
 * 스크립트 실행 종료 (exit의 별칭)
 * @param string|int $status 종료 메시지 또는 코드
 * @return void
 */
die("치명적 오류 발생"); // exit()와 동일

/**
 * 스크립트 실행 종료
 * @param string|int $status 종료 메시지 또는 코드
 * @return void
 */
exit("오류가 발생했습니다."); // 메시지 출력 후 종료
exit(1); // 오류 코드 1로 종료



?>