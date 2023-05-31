<?php 

session_start();

class Dbh{

   /* private $servername = "localhost";
    private $username = "root";
    private $password ="";
    private $dbName = "industry_project";
    private $conn;
    protected function connect() {
        if(!$this->conn) {
            try {
                
                $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbName . "," . $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $ex) {
                echo "Connection failed: " .$ex->getMessage();
                die();
            }
        }
    } */
    protected function connect() {

        try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $conn = new PDO("mysql:host=$servername;dbname=industry_project", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch (PDOException $ex) {
            echo "Connection failed: " .$ex->getMessage();
            die();
        }
    } 
} 

class Register extends Dbh {

    private $firstname;
    private $lastname;
    private $email;
    private $pwd;
    private $repwd;
    private $roleid;
    public function __construct($firstname, $lastname, $email, $pwd, $repwd, $roleid)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->repwd = $repwd;
        $this->roleid = $roleid;
    }


   
    public function registerUser() {
        
        if($this->checkEmail() == false)
        {
            // email has already taken.
            header("location:../register.php?error=Email has already taken");
            exit();
        }
        
        if ($this->checkPwd() == false){

            header("location:../register.php?error=Password and Re-password doesn't match");
            exit();   
        }
        $this->setUser($this->firstname, $this->lastname, $this->email, $this->pwd, $this->roleid);
    }

    protected function setUser($firstname, $lastname, $email, $pwd, $roleid) {

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        $stmt = $this->connect()->prepare("INSERT INTO users(first_name, last_name, email, pwd, role_id) VALUES(:firstname, :lastname, :email, :pwd, :roleid);");

        $stmt->bindParam(':firstname',$firstname,PDO::PARAM_STR);
        $stmt->bindParam(':lastname',$lastname,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':pwd',$hashedPwd,PDO::PARAM_STR);
        $stmt->bindParam(':roleid',$roleid,PDO::PARAM_STR);
        $stmt->execute();
        $user_id = $this->connect()->lastInsertId();
        //$this->connect()->commit();

        // insert user_id and role_id in user_roles table.
        $stmt = $this->connect()->prepare("INSERT INTO user_roles(user_id, role_id) VALUES(:userid, :roleid);");

        $stmt->bindParam(':userid', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':roleid', $roleid, PDO::PARAM_STR);
        $stmt->execute();
    }
    
    private function checkPwd() {
        $result = null;
        if($this->pwd !== $this->repwd) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result; 
    }
    
    private function checkEmail() {

        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email=:email;');
        $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
        $stmt->execute();
        $result = null;
        if($stmt->rowCount() > 0) {
            // email has already taken.
            $result = false;
        }
        else {
            // available email.
            $result = true;
        }
        return $result;
    }
}

class Login extends Dbh {

    private $email;
    private $pwd;

    public function __construct($email, $pwd) {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser() {
        $this->getUser($this->email, $this->pwd);
    }

    protected function getUser($email, $pwd) {
        
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email=:email;');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pwdCheck = password_verify($pwd, $result[0]['pwd']);
        if($pwdCheck == false)
        {
            header("location:../login.php?error=Wrong Password");
            exit();
        } else {

            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['email'] = $result[0]['email'];
            $_SESSION['role_id'] = $result[0]['role_id'];
            header("location:../product.php?loginSuccessful");
            exit();        
        }
    }
}

class ProductView extends Dbh {

    public function getProduct() {
        $stmt = $this->connect()->prepare('SELECT * FROM products;');
        $stmt->execute();
        $count = 1;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>" . 
                "<td>" . $count++ . "</td>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>
                <a href='./productUpdate.php?id=" . $row['id'] . " ' class='btn btn-primary'>Update</a>
                <a href='includes/productDelete.inc.php?id=" . $row['id'] . " 'class='btn btn-danger'>Delete</a>
                </td>
            </tr>";
        }
    }
}

class Product extends Dbh {
    private $id;
    private $name;
    private $price;
    private $quantity;

    public function __construct($id, $name, $price, $quantity) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getParam() {
        $this->findById($this->id);
    }
    public function findById($id) {
        $stmt = $this->connect()->prepare('SELECT * FROM products WHERE id=:id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      /* foreach($result as $r) {
            $name = $r['name'];
            $price = $r['price'];
            $quantity = $r['quantity'];
        } */
        return $result;
    }
    
    public function updateProduct($id, $name, $price, $quantity) {

        $stmt = $this->connect()->prepare('UPDATE products SET name=:name, price=:price, quantity=:quantity WHERE id = :id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function addProduct() {
        $this->setProduct($this->name, $this->price, $this->quantity);
    }

    public function setProduct($name, $price, $quantity) {

        $stmt = $this->connect()->prepare('INSERT INTO products(name, price, quantity) VALUES(:name, :price, :quantity)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteProduct() {
        $this->removeProduct($this->id);
    }
    public function removeProduct($id) {

        $stmt = $this->connect()->prepare('DELETE FROM products WHERE id=:id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}