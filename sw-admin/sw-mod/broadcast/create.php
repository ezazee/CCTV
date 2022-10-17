<section class="content">
  <form method="POST" enctype="multipart/form-data" id="uploadFile">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-solid">
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <span>Kirim Ke :</span>
                <label class="checkbox-inline">
                  <input type="checkbox" id="keseluruhan-anggota-checkbox" name="checkbox" value="1"> Keseluruhan Anggota
                  <!-- <input type="text" name="keseluruhan-anggota-checkbox-value" id="keseluruhan-anggota-checkbox-value" value="" /> -->
                </label>
              </div>
              <div class="col-md-5">
                <div class="form-inline">
                  <div class="form-group">
                    <label class="checkbox-inline">
                      <input type="checkbox" id="penempatan-anggota-checkbox" name="checkbox" value="2">Penempatan
                      <!-- <input type="text" name="penempatan-anggota-checkbox-value" id="penempatan-anggota-checkbox-value" value="" /> -->
                    </label>
                    <select id="penempatan-anggota-button" name="state" disabled>

                      <?php
                      $query = "SELECT * FROM `building`";
                      $result = $connection->query($query);
                      if ($result->num_rows > 0) :
                        $no = 0;
                        while ($row = $result->fetch_assoc()) :
                          $no++;
                      ?>
                          <option value="<?= $row['building_id']; ?>"><?= $row['name']; ?></option>
                      <?php
                        endwhile;
                      endif;
                      ?>
                    </select>
                  </div>
                </div>

              </div>
              <div class="col-md-4">
                <div class="form-inline">
                  <div class="form-group">
                    <label class="checkbox-inline">
                      <input type="checkbox" id="salah-satu-anggota-checkbox" name="checkbox" value="3"> Salah Satu Anggota
                      <!-- <input type="text" name="salah-satu-anggota-checkbox-value" id="salah-satu-anggota-checkbox-value" value="" /> -->
                    </label>
                    <select id="salah-satu-anggota-button" name="anggota" disabled>
                      <?php
                      $query = "SELECT * FROM `employees`";
                      $result = $connection->query($query);
                      if ($result->num_rows > 0) :
                        $no = 0;
                        while ($row = $result->fetch_assoc()) :
                          $no++;
                      ?>
                          <option value="<?= $row['id']; ?>"><?= $row['employees_name']; ?></option>
                      <?php
                        endwhile;
                      endif;
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-solid">
          <div class="box-body">
            <div class="form-group">
              <label for="pesan">Pesan:</label>
              <textarea cols="30" rows="10" class="form-control" id="isi-pesan" name="isi-pesan"></textarea>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-inline">
                  <div class="form-group">
                    <label for="file">Lampirkan File</label>
                    <input id="file" type="file" class="form-control" name="file" accept=".pdf">
                  </div>
                  <div class="form-group" style="margin: 0 10px 0 10px;">
                    <label for="link-zoom-meeting">Link Zoom Meeting</label>
                    <input type="text" class="form-control" id="link-zoom-meeting" name="link-zoom" placeholder="Masukan Link Zoom Meeting">
                  </div>
                  <input type="submit" class="btn btn-success" id="kirim-broadcast" value="Kirim Broadcast">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>