<?php
    require_once 'config/database.php';

    class EmployeeModel{
        private $employeeMa;
        private $employeeTen;
        private $employeeCV;
        private $employeePB;
        private $employeeLuong;
        private $employeeDate;

        public function getAllEmployees(){
            
            $conn = $this->connectDb();
            $sql = "SELECT * FROM nhanvien";
            $result = mysqli_query($conn,$sql);

            $arr_employees = [];
            if(mysqli_num_rows($result) > 0){
                $arr_employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }

            return $arr_employees;
        }
    
        public function getEmployee($employeeMa) {
            
            $connection = $this->connectDb();
            $querySelect = "SELECT * FROM nhanvien WHERE maNV=$employeeMa";
            $result = mysqli_query($connection, $querySelect);
            $arr_employee = [];
            if(mysqli_num_rows($result) > 0) {
                $arr_employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                $arr_employee = $arr_employees[0];
            }
           
            $this->closeDb($connection);
            return $arr_employee;
        }

        public function delete($employeeMa) {
            $connection = $this->connectDb();
    
            $queryDelete = "DELETE FROM nhanvien WHERE maNV=$employeeMa";
            $isDelete = mysqli_query($connection, $queryDelete);
           
            $this->closeDb($connection);
    
            return $isDelete;
        }
        public function insert($param = []) {
            $connection = $this->connectDb();
            $queryInsert = "INSERT INTO nhanvien(hovaten,chucvu,phongban,luong,ngayvaolam) 
            VALUES('{$param['name']}','{$param['job']}','{$param['department']}','{$param['salary']}','{$param['date']}')";
           
            $isInsert = mysqli_query($connection, $queryInsert);
            $this->closeDb($connection);
    
            return $isInsert;
        }
        public function update($employee = []) {
            $connection = $this->connectDb();
            $queryUpdate = "UPDATE nhanvien
        SET hovaten = '{$employee['name']}',
            chucvu = '{$employee['job']}',
            phongban = '{$employee['department']}',
            luong = '{$employee['salary']}',
            ngayvaolam = '{$employee['date']}',
            
         WHERE maNV = {$employee['id']}";
         
            $isUpdate = mysqli_query($connection, $queryUpdate);
            $this->closeDb($connection);
            return $isUpdate;
        }
        
        public function connectDb() {
            $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if (!$connection) {
                die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
            }
    
            return $connection;
        }
    
        public function closeDb($connection = null) {
            mysqli_close($connection);
        }
    }


?>