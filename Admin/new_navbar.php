<?php
// include "header.php";
// include "../db=connection.php";
// session_start();

$query_menu = "SELECT * FROM Staff_role  where staff_id='" . $_SESSION['staff_id'] . "'";
$rs_menu = mysqli_query($con, $query_menu);
$row_menu = mysqli_fetch_array($rs_menu);

$menu_check = explode(",", $row_menu['menu']);
$role_check = explode(",", $row_menu['menu_sub']);
// var_dump($query_menu);
/// untuk mengetahui id menu buka di google drive : Master menu


function hide_menu($x, $y)
{
    $staff_menu = 0;
    $sub_menu = [];
    foreach ($x as $val) {
        $key_menu = array_search($val, $y);
        if ($key_menu !== false) {
            $staff_menu = 1;
            array_push($sub_menu, 1);
        } else {
            array_push($sub_menu, 0);
        }
    }
    return json_encode(array("menu" => $staff_menu, "sub_menu" => $sub_menu), true);
}
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" id="ppushmenu"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" onclick="logOut();"><i class="fa fa-sign-out">Log Out</i></a>
        </li>
    </ul>

</nav>
<!-- /.navbar -->


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="fa fa-eercast"><img src="../assets/i/performalogo.png" alt="Performa Logo"></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/IT_icon.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['staff'];  ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" onclick="hideShow(1,1,0)" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a onclick="reloadPage(-1,0,0)" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- menu lainnya dsini -->
                <?php
                $staff_it = [1, 2];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li4'>
                        <a href='#' onclick='hideShow(4,1,0)' class='nav-link' id='ali4'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                Staff IT
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            //  var_dump($rs_menu['sub_menu']);
                            if ($rs_menu['sub_menu'][0] == 1) {

                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="reloadPage(-4,0,0)" class="nav-link" id="a21">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Country</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][1] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="reloadPage(-5,0,0)" class="nav-link" id="a21">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>City</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                $staff_it = [3, 4, 5, 6];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li5'>
                        <a href='#' onclick='hideShow(5,1,0)' class='nav-link' id='ali5'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                Itinerary Drive
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                                <li class='nav-item'>
                                    <a href='#' onclick='reloadManual(9,0,0)' class='nav-link' id='a'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Paket Tour</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][1] == 1) {
                            ?>
                                <li class='nav-item'>
                                    <a href='#' onclick='reloadManual(10,0,0)' class='nav-link' id='a'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Cruise Tour</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][2] == 1) {
                            ?>
                                <li class='nav-item'>
                                    <a href='#' onclick='reloadManual(11,0,0)' class='nav-link' id='a'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Cruise Ship</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][3] == 1) {
                            ?>
                                <li class='nav-item'>
                                    <a href='#' onclick='reloadManual(12,0,0)' class='nav-link' id='a'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Cruise Order List</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                $staff_it = [7, 8];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li6'>
                        <a href='#' onclick='hideShow(5,1,0)' class='nav-link' id='ali6'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                Atraction
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                                <li class='nav-item'>
                                    <a href='#' onclick='reloadManual(13,0,0)' class='nav-link' id='a'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Order List</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][1] == 1) {
                            ?>
                                <li class='nav-item'>
                                    <a href='#' onclick='reloadManual(14,0,0)' class='nav-link' id='a'>
                                        <i class='far fa-circle nav-icon'></i>
                                        <p>Export Excel</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                // $staff_it = [9];
                // $get_menu = hide_menu($staff_it, $menu_check);
                // $rs_menu = json_decode($get_menu, true);

                if ($_SESSION['type'] == '1' or $_SESSION['type'] == '2') {
                    // if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li10'>
                        <a href='#' onclick='hideShow(8,1,0);' class='nav-link' id='ali10'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                OTORISASI
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            // if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                            <li class="nav-item">
                                <a href="#" onclick="OT_Package(0,0,0);" class="nav-link" id="a1">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>OTORISASI STAFF</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" onclick="OT_Package(1,0,0);" class="nav-link" id="a1">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>JOB LIST STAFF</p>
                                </a>
                            </li>
                            <?php
                            // }
                            ?>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                $staff_it = [10, 11, 12, 13];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li7'>
                        <a href='#' onclick='hideShow(6,1,0)' class='nav-link' id='ali7'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                LT ITINERARY
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_itinerary(0,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>MASTER ITINERARY</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][1] == 1) {
                            ?>
                                <!-- <li class="nav-item">
                                    <a href="#" onclick="LT_itinerary(3,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LIST PT(SUB)</p>
                                    </a>
                                </li> -->
                            <?php
                            }
                            if ($rs_menu['sub_menu'][2] == 1) {
                            ?>

                            <?php
                            }
                            if ($rs_menu['sub_menu'][3] == 1) {
                            ?>
                                <!-- <li class="nav-item">
                                    <a href="#" onclick="LT_itinerary(7,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LIST PT(CGK)</p>
                                    </a>
                                </li> -->
                            <?php
                            }
                            ?>
                            <li class="nav-item">
                                <a href="#" onclick="LT_itinerary(40,0,0);" class="nav-link" id="a1">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>LIST PAKET TOUR</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" onclick="Meal_Package(0,0,0);" class="nav-link" id="a1">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>MEAL</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                $staff_it = [14, 15, 16, 17, 18, 19, 20];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li8'>
                        <a href='#' onclick='hideShow(4,1,0)' class='nav-link' id='ali8'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                LT PACKAGE
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(0,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LIST TEMPAT</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][1] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(3,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LIST LAND TOUR</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][2] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(9,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LIST FLIGHT ROUNDTRIP</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][3] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(15,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LIST FLIGHT DETAIL</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][3] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(24,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LIST FLIGHT AGENT</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][4] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(13,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>HOTEL LANDTOUR</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][5] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(22,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LT WEBSITE</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" onclick="LT_Package(23,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>PT WEBSITE</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][6] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="Reloaditin(2,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>UPLOAD FILE EXCEL</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                $staff_it = [21, 22, 23, 24];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li7'>
                        <a href='#' onclick='hideShow(7,1,0);' class='nav-link' id='ali7'>
                            <i class='nav-icon fas fa-th'></i>
                            <p> DATA PROMO
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="DP_Package(0,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DP MASTER</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][1] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="DP_Package(5,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DP PT(SUB)</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][2] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="DP_Package(2,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DP PT(BTH)</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][3] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="DP_Package(4,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DP PT(CGK)</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                $staff_it = [25, 26, 27, 28];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li7'>
                        <a href='#' onclick='hideShow(8,1,0);' class='nav-link' id='ali7'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                PROFIT PACKAGE
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="PR_Package(0,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>FLIGHT</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][1] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="PR_Package(1,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>FLIGHT RANGE</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][2] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="PR_Package(3,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LANDTOUR RANGE</p>
                                    </a>
                                </li>
                            <?php
                            }
                            if ($rs_menu['sub_menu'][3] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="PR_Package(4,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LANDTOUR</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="nav-item">
                                <a href="#" onclick="PR_Package(8,0,0);" class="nav-link" id="a1">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>LANDTRANS RANGE</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                $staff_it = [30];
                $get_menu = hide_menu($staff_it, $menu_check);
                $rs_menu = json_decode($get_menu, true);
                if ($rs_menu['menu'] != 0) {
                ?>
                    <li class='nav-item has-treeview' id='li9'>
                        <a href='#' onclick='hideShow(8,1,0);' class='nav-link' id='ali9'>
                            <i class='nav-icon fas fa-th'></i>
                            <p>
                                ORDER LIST
                                <i class='right fas fa-angle-left'></i>
                            </p>
                        </a>
                        <ul class='nav nav-treeview'>
                            <?php
                            if ($rs_menu['sub_menu'][0] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" onclick="OR_Package(0,0,0);" class="nav-link" id="a1">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Landtour</p>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>

                        </ul>
                    </li>
                <?php
                }
                ?>
                <li class='nav-item has-treeview' id='li11'>
                    <a href='#' onclick='hideShow(8,1,0);' class='nav-link' id='ali9'>
                        <i class='nav-icon fas fa-th'></i>
                        <p>
                            TRANSPORT
                            <i class='right fas fa-angle-left'></i>
                        </p>
                    </a>
                    <ul class='nav nav-treeview'>
                        <li class="nav-item">
                            <a href="#" onclick="TRN_Package(0,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Agent Land Transport</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="TRN_Package(3,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Land Transport</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="TRN_Package(1,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Train</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="TRN_Package(2,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ferry</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class='nav-item has-treeview' id='li11'>
                    <a href='#' onclick='hideShow(8,1,0);' class='nav-link' id='ali9'>
                        <i class='nav-icon fas fa-th'></i>
                        <p>
                            MARKETPLACE
                            <i class='right fas fa-angle-left'></i>
                        </p>
                    </a>
                    <ul class='nav nav-treeview' style="font-size: 12pt;">
                        <li class="nav-item">
                            <a href="#" onclick="MP_Package(6,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>TOKOPEDIA LAND TOUR</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="MP_Package(0,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>TOKOPEDIA PAKET TOUR</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="MP_Package(1,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>TOKOPEDIA RENT TRANS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="MP_Package(3,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SHOPEE</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="MP_Package(1,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>BLIBLI</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class='nav-item has-treeview' id='li8'>
                    <a href='#' onclick='hideShow(8,1,0);' class='nav-link' id='ali8'>
                        <i class='nav-icon fas fa-th'></i>
                        <p>
                            KURS LIVE
                            <i class='right fas fa-angle-left'></i>
                        </p>
                    </a>
                    <ul class='nav nav-treeview'>
                        <li class="nav-item">
                            <a href="#" onclick="KL_Package(0,0,0);" class="nav-link" id="a1">
                                <i class="far fa-circle nav-icon"></i>
                                <p>BCA</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- end menu lainnya -->
            </ul>
        </nav>
    </div>

</aside>