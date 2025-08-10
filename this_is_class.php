<?php 

//  클래스란 객체를 만들기위한 설계도. 
//  데이터(속성), 기능(메서드)을 하나로 묶어서 관리 할 수 있다

/**
 * 기본 클래스 구조
 */
class User 
{
    // 1. 속성(Properties) - 데이터 저장
    public $name;
    public $email;
    private $password;
    
    // 2. 생성자(Constructor) - 객체 초기화
    public function __construct($name, $email) 
    {
        $this->name = $name;
        $this->email = $email;
    }
    
    // 3. 메서드(Methods) - 기능 구현
    public function getName() 
    {
        return $this->name;
    }
    
    public function setPassword($password) 
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}

// 4. 객체 생성 및 사용
$user = new User("홍길동", "hong@example.com");
echo $user->getName(); // "홍길동"
$user->setPassword("mypassword");

// 접근제한자 public
/**
 * 어디서든 접근 가능
 * 클래스 내부, 외부, 상속받은 클래스 모두 접근 가능
 */
class User2 
{
    public $name;  // 외부에서 직접 접근 가능
    
    public function getName() 
    {
        return $this->name;
    }
}

$user = new User2();
$user->name = "홍길동";        // ✅ 가능
echo $user->getName();        // ✅ 가능




?>