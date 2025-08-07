<?php

// 어디에서나 사용 할 수 있는 나만의 클래스들

define('DB_HOST',"test");  // DB 서버 주소
define('DB_PORT','3306'); // MySQL 기본 포트
define('DB_NAME',"test"); // 데이터베이스명
define('DB_USER',"test"); // DB 사용자명
define('DB_PASS',"test");  // DB 비밀번호 (XAMPP 기본값은 공백)
define('DB_CHARSET', 'utf8mb4'); // 이모지까지 포함한 완전한 UTF-8 지원
define('DB_COLLATION', 'utf8mb4_unicode_ci'); // utf8mb4_unicode_ci: 유니코드 정렬 규칙 (대소문자 구분 안함)


// * 데이터베이스 연결 및 쿼리 처리 클래스
class Database {
    private $connection; // PDO 연결 객체
    private $host;         // 데이터베이스 호스트
    private $dbname;       // 데이터베이스명
    private $username;     // 사용자명
    private $password;     // 비밀번호
    private $charset;      // 문자 인코딩
    private $options;      // PDO 옵션들

    public function __construct(){
        // 보통 config.php / db.config.php 에 할당된
        // DB연결 정보를 가져와서 연결 
        // 보통의 나는 config에서 상수로 선언하여 사용
        $this->host = DB_HOST;
        $this->dbname = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
        $this->charset = DB_CHARSET;

        // PDO 연결 옵션
        $this->options = [
                   // 에러 발생시 예외(Exception) 던지기
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            
            // 기본 fetch 모드를 연관배열로 설정 (컬럼명을 키로 사용)
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            
            // Prepared Statement를 데이터베이스에서 처리하도록 설정 (보안상 중요)
            PDO::ATTR_EMULATE_PREPARES => false,
            
            // 지속적 연결 사용 여부 (성능 향상)
            PDO::ATTR_PERSISTENT => false,
            
            // 연결 타임아웃 설정 (초 단위)
            PDO::ATTR_TIMEOUT => 30
        ];

    }
    /**
     * 데이터베이스 연결 함수
     * 
     * @return PDO PDO 연결 객체 반환
     * @throws Exception 연결 실패시 예외 발생
     */
    public function connect():PDO{
        // 이미 연결되어있으면 반환
        if($this->connection !== null) {
            return $this->connection;
        }
        try{
            // DSN(Data Source Name) 문자열 생성
            // 예: "mysql:host=localhost;dbname=crm_dev;charset=utf8mb4"
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            
            // PDO 객체 생성 및 데이터베이스 연결
            $this->connection = new PDO($dsn, $this->username, $this->password, $this->options);

            // 개발 환경에서 SQL 디버그가 활성화된 경우 연결 성공 로그
            if (defined('SQL_DEBUG')) {
                error_log("데이터베이스 연결 성공: {$this->host}/{$this->dbname}");
            }
            
            return $this->connection;
        }catch(PDOException $e){
            // 연결 실패시 에러 로그 기록
            $error_msg = "데이터베이스 연결 실패: " . $e->getMessage();
            error_log($error_msg);

            throw new Exception($error_msg);
        }
    }
    /**
    * SELECT 다중쿼리 실행 함수 ( 데이터 1열 이상 조회용 )
    * 
    * @param string $query SQL 쿼리문 (? 플레이스홀더 사용)
    * @param array $params 바인딩할 파라미터 배열
    * @return array 조회 결과 배열
    * 사용 예시:
    * $customers = $db->sql_query("SELECT * FROM customers WHERE grade = ? AND status = ?", ['VIP', 'active']);
    */
    public function sql_query(string $query,array $params=[]):array{
        try{
            $connection = $this->connection;

            $stmt = $connection->prepare($query);

            // 파라미터 바인딩 및 처리
            $stmt->execute($params);

            // 모든결과를 배열로 반환
            $result = $stmt->fetchAll();

            return $result;

        } catch (PDOException $e) {
            $error_msg = "Database 클래스 sql_query 함수 오류 " . $e->getMessage();
            throw new Exception($error_msg);
        }
    }
    /**
    * SELECT 단일쿼리 실행 함수 ( 데이터 단일 조회용 )
    * 
    * @param string $query SQL 쿼리문
    * @param array $params 바인딩할 파라미터 배열
    * @return array|null 단일 행 데이터 또는 null
    * 사용 예시:
    * $customer = $db->sql_fetch("SELECT * FROM customers WHERE id = ?", [123]);
    */
    public function sql_fetch(string $query,array $params=[]){
        $result = sql_query($query,[$params]);
        return !empty($result) ? $result[0] : null;
    }

    /**
     * UPDATE 쿼리 실행 함수 (데이터 수정)
     * 
     * @param string $query SQL UPDATE 쿼리문
     * @param array $params 바인딩할 파라미터 배열
     * @return int 영향받은 행의 수
     * 
     * 사용 예시:
     * $affected = $db->sql_update("UPDATE customers SET grade = ? WHERE id = ?", ['GOLD', 123]);
     */
    public function sql_update(string $query,array $params=[]):int{
        try{
            
            $connection = $this->connection;
            $stmt=$connection->prepare($query);
            $stmt->execute($params);

            $row_count = $stmt->rowCount();

            return $row_count;

        }catch(Exception $e){
            $error_msg = "Database 클래스 sql_update 함수 오류 " . $e->getMessage();
            throw new Exception($error_msg);
        }
    }
    /**
     * DELETE 쿼리 실행 함수 (데이터 수정)
     * 
     * @param string $query SQL DELEDE 쿼리문
     * @param array $params 바인딩할 파라미터 배열
     * @return int 영향받은 행의 수
     * 
     * 사용 예시:
     * $affected = $db->sql_delete("DELETE customers SET grade = ? WHERE id = ?", ['GOLD', 123]);
     */
    public function sql_delete(string $query,array $params=[]):int{
        try{
            
            $connection = $this->connection;
            $stmt=$connection->prepare($query);
            $stmt->execute($params);

            $row_count = $stmt->rowCount();

            return $row_count;

        }catch(Exception $e){
            $error_msg = "Database 클래스 sql_delete 함수 오류 " . $e->getMessage();
            throw new Exception($error_msg);
        }
    }

}


?>