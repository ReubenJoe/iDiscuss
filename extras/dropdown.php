                    <!-- <select name="multi_search_filter" id="multi_search_filter">
                    <?php while($row = mysqli_fetch_array($result)): ?>
                        <?php $tags=$row['tags']; 
                            $str_arr = explode (",", $tags);?>
                            <option value="filter">filter</option>
                        <?php foreach($str_arr as $value):?>
                        <option value="<?php echo $value;?>"><?php echo $value;?></option>
                    <?php endforeach ?>
                    <?php endwhile ?>
                    </select>
                    <input type="hidden" name="hidden_country" id="hidden_country" /> -->