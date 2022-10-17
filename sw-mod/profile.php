<?php
if ($mod == '') {
    header('location:../404');
    echo 'kosong';
} else {
    include_once 'sw-mod/sw-header.php';
    if (!isset($_COOKIE['COOKIES_MEMBER'])) {
        setcookie('COOKIES_MEMBER', '', 0, '/');
        setcookie('COOKIES_COOKIES', '', 0, '/');
        // Login tidak ditemukan
        setcookie("COOKIES_MEMBER", "", time() - $expired_cookie);
        setcookie("COOKIES_COOKIES", "", time() - $expired_cookie);
        session_destroy();
        header("location:./");
    } else {
        echo '<!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <div class="dropdown">
                <a href="#" id="dropdownMenu2" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">';
        if ($row_user['photo'] == '') {
            echo '<img src="' . $base_url . 'sw-content/avatar.jpg" alt="image" class="imaged w100 rounded">';
        } else {
            echo '
                    <img src="timthumb?src=' . $base_url . 'sw-content/karyawan/' . $row_user['photo'] . '&h=100&w=105" alt="avatar" class="rounded-circle" width="100px" height="100px">';
        }
        echo '
                    <span class="button">
                        <ion-icon name="camera-outline"></ion-icon>
                    </span>
                </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <label class="dropdown-item" type="button">
                            <input type="file" class="upload" name="file" id="avatar" accept=".jpg, .jpeg, ,gif, .png" capture="camera" hidden>
                        Upload Picture
                        </label>
                        <button class="dropdown-item" data-toggle="modal" data-target="#modalCamera" type="button">Take Picture</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="modalCamera" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-column">
                            <img id="output" class="mb-2 d-none">
                            <video autoplay="true" class="mb-2" id="avatarcamera"></video>
                            <canvas id="canvas" class="d-none"></canvas>
                            <button id="takeavatar" type="button" class="btn btn-secondary mb-1"><ion-icon name="camera-outline"></ion-icon></button>
                            <button  id="uploadavatar" type="button" class="btn btn-primary d-none" data-dismiss="modal">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section mt-2 mb-2">
            <div class="section-title">Profil</div>
            <div class="card">
                <div class="card-body">
                    <form id="update-profile">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">NIP/NRP</label>
                                <input type="number" name="employees_nip" class="form-control" value="' . $row_user['employees_nip'] . '" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Nama</label>
                                <input type="text" class="form-control" id="name" name="employees_name" value="' . $row_user['employees_name'] . '" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jabatan</label>
                                <select class="form-control custom-select" name="position_id">';
        $query = "SELECT * from position order by position_name ASC";
        $result = $connection->query($query);
        while ($rowa = $result->fetch_assoc()) {
            if ($rowa['position_id'] == $row_user['position_id']) {
                echo '<option value="' . $rowa['position_id'] . '" selected>' . $rowa['position_name'] . '</option>';
            } else {
                echo '<option value="' . $rowa['position_id'] . '">' . $rowa['position_name'] . '</option>';
            }
        }
        echo '
                                </select>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jam Kerja</label>
                                <select class="form-control custom-select" name="shift_id">';
        $query = "SELECT shift_id,shift_name from shift order by shift_name ASC";
        $result = $connection->query($query);
        while ($rowa = $result->fetch_assoc()) {
            if ($rowa['shift_id'] == $row_user['shift_id']) {
                echo '<option value="' . $rowa['shift_id'] . '" selected>' . $rowa['shift_name'] . '</option>';
            } else {
                echo '<option value="' . $rowa['shift_id'] . '">' . $rowa['shift_name'] . '</option>';
            }
        }
        echo '
                                </select>
                            </div>
                        </div>


                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="password4">Lokasi Penugasan</label>
                                <select class="form-control custom-select" name="building_id">';
        $query  = "SELECT building_id,name,address from building";
        $result = $connection->query($query);
        while ($row = $result->fetch_assoc()) {
            if ($row['building_id'] == $row_user['building_id']) {
                echo '<option value="' . $row['building_id'] . '" selected>' . $row['name'] . '</option>';
            } else {
                echo '<option value="' . $row['building_id'] . '">' . $row['name'] . '</option>';
            }
        }
        echo '
                                </select>
                            </div>
                        </div>

                        <hr>
                            <button type="submit" class="btn btn-success mr-1 btn-lg btn-block btn-profile">Simpan</button>
                        
                    </form>

                </div>
            </div>
        </div>

      
        <div class="section mt-2 mb-2">
            <div class="section-title">Ubah Password</div>
            <div class="card">
                <div class="card-body">
                    <form id="update-password">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Email</label>
                                <input type="email" class="form-control" name="employees_email" value="' . $row_user['employees_email'] . '" style="background:#eeeeee" readonly>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Password baru</label>
                                <input type="password" class="form-control" name="employees_password" id="employees_password" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success mr-1 btn-lg btn-block">Simpan</button>
                        <br>
                        <br>
                        <center>
                          <a href="logout" class="btn btn-danger" role="button">logout</a>
                        </center>
                    </form>
                    

                    

                </div>
            </div>
        </div>
        
    </div>
    <!-- * App Capsule -->
';
    }
    include_once 'sw-mod/sw-footer.php';
}
