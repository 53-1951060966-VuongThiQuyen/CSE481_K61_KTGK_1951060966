<?php
    require_once 'model/EmployeeModel.php';
    class EmployeeController{
        
        function index(){
            
            $employeeModel = new EmployeeModel();
            $employees = $employeeModel->getAllEmployees();
            require_once 'view/employee/index.php';
        }

       
        function add(){
                $error = '';
                if (isset($_POST['submit'])) {

                    $employeeTen = $_POST['name'];
                    $employeeCV = $_POST['job'];
                    $employeePB = $_POST['department'];
                    $employeeLuong = $_POST['salary'];
                    $employeeDate = $_POST['date'];
                    if (empty($employeeTen)) {
                        $error = "Tên không được để trống";
                    }
                    else {
                        $employeeModel = new EmployeeModel();
                        $employeeArr = [
                            'name' => $employeeTen,
                            'job' => $employeeCV,
                            'department' => $employeePB,
                            'salary' =>$employeeLuong,
                            'salary' => $employeeLuong,
                            'date' =>$employeeDate
                        ];
                       
                        $isInsert = $employeeModel->insert($employeeArr);
                        
                        if ($isInsert) {
                            $_SESSION['success'] = "Thêm mới thành công";
                        }
                        else {
                            $_SESSION['error'] = "Thêm mới thất bại";
                        }
                       
                        header("Location: index.php?controller=employee&action=index");
                        exit();
                    }
                }
            }

         function showAdd(){
            require_once 'view/employee/add.php';
        }
        function edit(){
            
            $error = '';
               
                    $employeeMa = $_GET['id'];
                    $employeeTen = $_POST['name'];
                    $employeeCV = $_POST['job'];
                    $employeePB = $_POST['department'];
                    $employeeLuong = $_POST['salary'];
                    $employeeDate = $_POST['date'];
                    
                    $employeeModel = new EmployeeModel();
                
                        $employeeArr = [
                            'id' => $employeeMa,
                            'name' => $employeeTen,
                            'job' => $employeeCV,
                            'department' => $employeePB,
                            'salary' =>$employeeLuong,
                            'salary' => $employeeLuong,
                            'date' =>$employeeDate
                        ];
                        
                        $isUpdate = $employeeModel->update($employeeArr);
                        if ($isUpdate) {
                            $_SESSION['success'] = "Thêm mới thành công";
                        }
                        else {
                            $_SESSION['error'] = "Thêm mới thất bại";
                        }
                       
                        header("Location: index.php?controller=employee&action=index");
                        exit();

       
    }
        function showEdit(){
            $employeeMa = $_GET['id'];
            $employeeModel = new EmployeeModel();
            $employee = $employeeModel->getEmployee($employeeMa);
            
            require_once 'view/employee/edit.php';
        }
        function delete(){
            $employeeMa = $_GET['id'];
                if (!is_numeric($employeeMa)) {
                    header("Location: index.php?controller=employee&action=index");
                    exit();
                }
        
                $employeeModel = new EmployeeModel();
                $isDelete = $employeeModel->delete($employeeMa);
        
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa bản ghi #$employeeMa thành công";
                }
                else {
                    $_SESSION['error'] = "Xóa bản ghi #$employeeMa thất bại";
                }
        
                header("Location: index.php?controller=employee&action=index");
                exit();
            }
        
    }
?>