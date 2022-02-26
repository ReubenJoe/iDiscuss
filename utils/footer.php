<footer class="footer mt-5">
    <div class="container-footer">
        <div class="row_footer">
            <div class="footer-col">
                <h4>Category</h4>
                <ul>
                    <!-- <li><a href="#">Coding</a></li>
                    <li><a href="#">Python</a></li>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">PHP</a></li> -->
                    <?php 
                        $sql="SELECT `category_name` FROM `categories` LIMIT 4";
                        $result=mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '<li><a href="#">'.$row['category_name'].'</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">our services</a></li>
                    <li><a href="#">privacy policy</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
            </div>
            <!-- <div class="footer-col">
                    <h4>online shop</h4>
                    <ul>
                        <li><a href="#">watch</a></li>
                        <li><a href="#">bag</a></li>
                        <li><a href="#">shoes</a></li>
                        <li><a href="#">dress</a></li>
                    </ul>
                </div> -->
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>