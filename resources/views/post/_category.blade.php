<ul style="overflow-y:scroll; height:200px; list-style: none; border: 1px solid #bfcbd9; padding: 11px;">
  @php
    function category_loop ($categories) {
      foreach($categories as $category) {
        echo '<li>';
        echo '<el-checkbox :label="'.$category->id.'">'.$category->name .'</el-checkbox>';
        if (count($category->children) > 0) {
          echo '<ul>';
          echo category_loop($category->children);
          echo '</ul>';
        }
        echo '</li>';
      }
    };

    echo '<el-checkbox-group v-model="form.categories">';
    category_loop($categories);
    echo '</el-checkbox-group>';
  @endphp
</ul>
