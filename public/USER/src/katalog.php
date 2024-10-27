<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>bookjed-katalog</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<?php include "header.php" ?>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <div class="container">

                    <div class="row katalog">
                        <!-- ajax here -->
                    </div>
                    <a class="readmore d-flex align-self-center" href="2">
                        <button type="button">Readmore &rarr;</button>
                    </a>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Bookjedd 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '.readmore', function(e) {
                e.preventDefault();
                const page = $(this).attr('href');
                const nextpage = parseInt(page) + 1;
                $(this).attr('href', nextpage);
                ajaxLoad(nextpage);
            })

            ajaxLoad();

            function ajaxLoad(page = 1) {
                $.ajax({
                    url: "https://api.itbook.store/1.0/search/sea/" + page,
                    cache: false,
                    method: "GET",
                    success: function(result) {
                        console.log(result);
                        for (var i = 0; i < 9; i++) {
                            $('.katalog').append(`<div class="col-4">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="${result.books[i].image}" class="card-img" alt="..." syle="width:auto height:auto">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title line-clamp">${result.books[i].title}</h5>
                                                <p class="card-text line-clamp">${result.books[i].subtitle}</p>
                                                <p class="card-text"></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>`)
                        }
                    },
                    error: function() {
                        console.log('error');
                        showToastError('There was a problem submitting your request. Please try again.');
                    }
                });
            }

        })
    </script>
</body>

</html>
<?php include "footer.php" ?>