<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../config/dbConnection.php');
require_once(__DIR__ . '/../header.php');
include('../functions.php');

if (isset($_GET['page'])) {
    $pn = $_GET['page'];
} else {
    $pn = 1;
}


$limit = 4;
$start_from = ($pn - 1) * $limit;
$query = "SELECT * FROM `course` WHERE course.status = 'active'";

$value = 0;

switch($_POST['sort_week']) {
 case 1:
    $value = 2;
    $query .= "ORDER BY `course`.`id` DESC LIMIT $start_from, $limit";
  break;
 case 0:
  $value = 1;
    $query .= "ORDER BY `course`.`id` ASC LIMIT $start_from, $limit";
  break;
}

$result = selectData($query);

// $limit = 4;
// $start_from = ($pn - 1) * $limit;
// $sql = "SELECT * from students WHERE students.status = 'active' LIMIT $start_from, $limit";

// $result = selectData($sql);
?>

<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Kurslar</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../index.php">Bosh sahifa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Kurslar
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <div class="text-end upgrade-btn">
                    <a href="create.php" class="btn btn-success d-none d-md-inline-block text-white">Kurs Qo'shish</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->

    <div class="container-fluid">
        <!-- Table -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex">
                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">
                               Kurslar Jadvali
                            </h4>
                            
                        </div>
                        <div class="table-responsive mt-5">
                            <table class="table stylish-table no-wrap">
                                <thead>
                                    <tr>
                                        <form name="Table Properties" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <th class="border-top-0" colspan="2">Kurs nomi
                                                <button type="submit" name="sort_week" value="<?php echo $value; ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-sort-alphabetical"></i></button>
                                            </th>
                                        </form>
                                        <!-- <th class="border-top-0">Ism Familiya</th> -->
                                        <th class="border-top-0">Kurs haqida</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php

                                        foreach ($result as $value) {
                                            echo "<tr>
                                                    <td style='width: 50px'>
                                                        <span class='" . randomColor() . "'>" . getImage('', $value['name'])."</span>
                                                    </td>
                                                    <td class='align-middle'>
                                                        <h6>" . $value['name'] . "</h6>
                                                        <small class='text-muted'>" . $value['name'] . "</small>
                                                    </td>
                                                    <td class='align-middle'>" . $value['description'] . "</td>
                                                    <td class='align-middle'>
                                                        <!-- <a href='./settings/studentsview.php'><i class='mdi mdi-eye'></i></a> -->
                                                        <a href='edit.php?id=" . $value['id'] . "'><i class='mdi mdi-account-edit'></i></a>
                                                        <a href='delete.php?id=" . $value['id'] . "'><i class='mdi mdi-delete'></i></a>

                                                    </td>
                                                </tr>";
                                        }
                                        ?>

                                        <!-- <td style="width: 50px">
                                                    <span class="round">S</span>
                                                </td>
                                                <td class="align-middle">
                                                    <h6>Sunil Joshi</h6>
                                                    <small class="text-muted">Web Designer</small>
                                                </td>
                                                <td class="align-middle">Elite Admin</td>
                                                <td class="align-middle">$3.9K</td>
                                            </tr>
                                            <tr class="active">
                                                <td>
                                                    <span class="round"><img src="./assets/images/users/2.jpg" alt="user" width="50" /></span>
                                                </td>
                                                <td class="align-middle">
                                                    <h6>Andrew</h6>
                                                    <small class="text-muted">Project Manager</small>
                                                </td>
                                                <td class="align-middle">Real Homes</td>
                                                <td class="align-middle">$23.9K</td>
                                            </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php
                                $total_pages = getPagination('course');
                                $pagLink =  "<li class='page-item disabled'>
                                            <a class='page-link' href='#' tabindex='-1'> 1 - $total_pages </a>
                                        </li>";

                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $pn) {
                                        $pagLink .= "<li class='page-item'><a class='page-link active' href='index.php?page=$i'>$i</a></li>";
                                    } else {
                                        $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
                                    }
                                }
                                echo $pagLink;
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<?php require(__DIR__ . '/../footer.php');  ?>