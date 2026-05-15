<?php
session_start();
include '../includes/connect.php';
?>
<link rel="stylesheet" href="../assets/css/sidebar.css?v=9">
<link rel="stylesheet" href="../assets/css/userprofile.css?v=3">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=8">
<link rel="stylesheet" href="../assets/css/table.css?v=2">

<div class="layout">

    <?php include '../includes/sidebar.php'; ?>

    <div class="right">

        <?php include '../includes/dashboardheader.php'; ?>

        <main class="main-content">

            <div class="filter_container">
                <h2>USERS INFORMATION REPORT</h2>
                <?php
                    $type = $_GET['type'] ?? 'all';

                    $where = "";

                    if ($type != 'all') {
                        $where = "WHERE u.user_type = '$type'";
                    }
                ?>
                <div class="filter-box">
                    <a href="?type=all" class="filter-btn <?= $type=='all' ? 'active' : '' ?>">All</a>
                    <a href="?type=student" class="filter-btn <?= $type=='student' ? 'active' : '' ?>">Students</a>
                    <a href="?type=faculty" class="filter-btn <?= $type=='faculty' ? 'active' : '' ?>">Faculty</a>
                    <a href="?type=staff" class="filter-btn <?= $type=='staff' ? 'active' : '' ?>">Staff</a>
                </div>
            </div>
            <?php
            $query = "
                SELECT 
                    u.fullname,
                    u.email,
                    u.user_type,

                    s.course,
                    s.yearlevel,

                    f.rank,
                    st.office_department

                FROM user u

                LEFT JOIN tblstudent s 
                    ON s.user_id = u.id

                LEFT JOIN tblfaculty f 
                    ON f.user_id = u.id

                LEFT JOIN tblstaff st 
                    ON st.user_id = u.id

                $where

                ORDER BY u.user_type
            ";

            $result = mysqli_query($connection, $query);
            ?>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Role Info</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['fullname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['user_type']; ?></td>

                                <td>
                                    <?php
                                    if ($row['user_type'] == 'student') {
                                        echo '<span class="role-badge role-student">'
                                            . $row['course'] . ' - ' . $row['yearlevel'] .
                                        '</span>';
                                    }
                                    elseif ($row['user_type'] == 'faculty') {
                                        echo '<span class="role-badge role-faculty">'
                                            . $row['rank'] .
                                        '</span>';
                                    }
                                    elseif ($row['user_type'] == 'staff') {
                                        echo '<span class="role-badge role-staff">'
                                            . $row['office_department'] .
                                        '</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        </main>

    </div>
</div>
<script src="../assets/js/sidebar.js"></script>