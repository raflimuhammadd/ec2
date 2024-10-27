<?php include "header.php" ?>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">


        <!-- Begin Page Content -->
        <div class="container">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">
            DataTables is a third party plugin that is used to generate the
            demo table below. For more information about DataTables, please
            visit the
            <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
          </p>

          <!-- DataTales Example -->

          <?php
          $list = [
            [
              "judul" => "Marmut Merah Jambu",
              "pengarang" => "Raditya DIka",
              "penerbit" => "Elex Media",
              "tahun" => "2010",
              "kategori" => "Komedi",
              "detail" => "view",
              "img" => "./img/marmut merah jambu.jpeg",
            ],
            [
              "judul" => "Sistem Operasi",
              "pengarang" => "Lutpan",
              "penerbit" => "Lab",
              "tahun" => "2023",
              "kategori" => "Pendidikan",
              "detail" => "view",
              "img" => "./img/so.jpeg",
            ],
            [
              "judul" => "Tuhan dalam Secangkir Kopi",
              "pengarang" => "Denny Siregar",
              "penerbit" => "Noura Books",
              "tahun" => "1999",
              "kategori" => "Filosofi",
              "detail" => "view",
              "img" => "./img/marmut merah jambu.jpeg",
            ],
            [
              "judul" => " Sherlock Holmes",
              "pengarang" => "Sir Conanedoil",
              "penerbit" => "PT Gramedia",
              "tahun" => "1989",
              "kategori" => "Detektif",
              "detail" => "view",
              "img" => "./img/sherlock holmes.jpeg",
            ],
            [
              "judul" => "Omnicient Reader's Viewpoint",
              "pengarang" => "SING, Eob",
              "penerbit" => "Naver Webtoon",
              "tahun" => "2018",
              "kategori" => "Fantasy",
              "detail" => "view",
              "img" => "./img/omnicient.jpeg",
            ],
            [
              "judul" => "Go Kitchen",
              "pengarang" => "Restu Utami",
              "penerbit" => "Kawan Pustaka",
              "tahun" => " 2018",
              "kategori" => "Memasak",
              "detail" => "view",
              "img" => "./img/go kitchen.jpeg",
            ],
            [
              "judul" => "Siksa Kubur",
              "pengarang" => " ",
              "penerbit" => " ",
              "tahun" => "2000",
              "kategori" => "Religi",
              "detail" => "view",
              "img" => "./img/siksa kubur.jpeg",
            ],
            [
              "judul" => "Sewindu Dekat Bung Karno",
              "pengarang" => "Bambang Wijarnako",
              "penerbit" => "PT Gramedia",
              "tahun" => "1988",
              "kategori" => "Biografi",
              "detail" => "view",
              "img" => "./img/sewindu dekat bung karno.jpeg",
            ],
            [
              "judul" => "Reborn Rich",
              "pengarang" => "Dojun ",
              "penerbit" => "Shinigami",
              "tahun" => "2020",
              "kategori" => "Fantasi",
              "detail" => "view",
              "img" => "./img/reborn rich.jpeg",
            ],
            [
              "judul" => "The Novel Extra ",
              "pengarang" => "Kim Hajin",
              "penerbit" => "Shinigami ",
              "tahun" => "2020",
              "kategori" => "Fantasi",
              "detail" => "view",
              "img" => "./img/the novel extra.jpeg",
            ],
            [
              "judul" => "Negeri 5 Menara",
              "pengarang" => "Ahmad",
              "penerbit" => "ISBN ",
              "tahun" => "2009",
              "kategori" => "Religi",
              "detail" => "view",
              "img" => "./img/negeri 5 menara.jpeg",
            ],
            [
              "judul" => "Sing Song",
              "pengarang" => "Christina Georgina",
              "penerbit" => " ",
              "tahun" => "1872",
              "kategori" => "Musik",
              "detail" => "view",
              "img" => "./img/sing song.jpeg",

            ],
            [
              "judul" => "Naruto",
              "pengarang" => "Masashi Kishimoto",
              "penerbit" => "Shonen Jump",
              "tahun" => "2000",
              "kategori" => "Fantasi",
              "detail" => "view",
              "img" => "./img/naruto shippuden.jpeg",
            ],
            [
              "judul" => "Dracula",
              "pengarang" => "Bram Stoker",
              "penerbit" => " ",
              "tahun" => "1897",
              "kategori" => "Horor",
              "detail" => "view",
              "img" => "./img/dracula.jpeg",
            ],
          ] ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                DataTables Example
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Judul Buku</th>
                      <th>Pengarang</th>
                      <th>Penerbit</th>
                      <th>Tahun terbit</th>
                      <th>Kategori</th>
                      <th>Detail Buku</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($list as $i => $buku) : ?>
                      <tr>
                        <td><?php echo $buku['judul'] ?></td>
                        <td><?php echo $buku['pengarang'] ?></td>
                        <td><?php echo $buku['penerbit'] ?></td>
                        <td><?php echo $buku['tahun'] ?></td>
                        <td><?php echo $buku['kategori'] ?></td>
                        <td>
                          <!-- <a type="button"  data-target="#exampleModalCenter">
                          Launch demo modal
                        </a> -->
                          <a data-toggle="modal" data-target="#view<?php echo $i ?>" href="">view</a>
                          <div class="modal fade" id="view<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Detail Buku</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <!-- <span aria-hidden="true">&times;</span> -->
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <img class="col-5" src="<?php echo $buku['img'] ?>">
                                    <div class="col-7">
                                      <h4><b><?php echo $buku['judul'] ?></b></h4>
                                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate voluptatum dicta placeat voluptatem, voluptatibus mollitia reiciendis temporibus, tempore ipsa soluta debitis molestiae officiis laudantium excepturi, culpa quaerat dolores dignissimos ad!</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</body>

</html>
<?php include "footer.php" ?>