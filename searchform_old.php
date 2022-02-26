<form action="category.php" method="post">
    <?php
                    $sql = "SELECT category_name, category_id FROM `categories`";
                    $result = mysqli_query($conn, $sql); 
                  ?>
    <div class="form-group">
        <div class="search-dropdown">
            <div class="default-option" disabled>Category</div>
            <input type="hidden" name="categories" value="categories" id="name_cat" />
            <div class="search-dropdown-list">
                <ul>
                    <?php
                      while($rows = $result->fetch_assoc())
                      {
                        $cat_name = $rows['category_name'];
                        echo "<li value='$cat_name' name='$cat_name'>$cat_name</li>";
                      }
                    ?>
                </ul>
            </div>
        </div>
        <div class="search">
            <input type="text" id="searchText" name="question" class="search-input" placeholder="Ask Anything....">
        </div>
        <button type="submit" name="ask-btn" class="search-button"><i class="fas fa-search"></i></button>
    </div>

</form>