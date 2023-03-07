<?php
include_once 'header.php';

?>
        <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
            
            <!-- dot -->
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
            </div>
            
            <!-- slideshow -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../quanly/img/banner/1.png" class="d-block" style="width:100%;height:700px;">
            </div>
            <div class="carousel-item">
                <img src="../quanly/img/banner/2.png" class="d-block" style="width:100%;height:700px;">
            </div>
            <div class="carousel-item">
                <img src="../quanly/img/banner/3.png"  class="d-block" style="width:100%;height:700px;">
            </div>
            <div class="carousel-item">
                <img src="../quanly/img/banner/4.png" class="d-block" style="width:100%;height:700px;">
            </div>
            </div>
            
            <!-- button -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        <!-- Section-->
        <?php
            include 'connect.php';
            $sql="SELECT * FROM hanghoa_view ORDER BY MSHH DESC LIMIT 4";
            $query= mysqli_query($conn,$sql);
        ?>
        <section class="py-1">
             <div class="container px-4 px-lg-5 mt-5">
             <h2>Hàng mới về</h2>
             <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                include 'connect.php';
                while($row=mysqli_fetch_array($query)){
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- hinh anh san pham-->
                            <img class="card-img-top" src=<?php echo "../quanly/".$row['TenHinh'];?> alt="..." />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- ten san pham-->
                                    <h5 class="fw-bolder"><?php echo $row['TenHH'];?></h5>
                                    <!-- gia tien-->
                                    <?php echo $row['Gia'];?> VND
                                </div>
                            </div>
                            <!-- chi tiet -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
  
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" 
                                href="chi-tiet-hh.php?id=<?php echo $row['MSHH']; ?>">Xem chi tiết</a></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
             </div>
            </div>
        </section>
<?php 
include_once('footer.php')
?>
