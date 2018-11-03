<?php

function themeoptions_page()
{
// 设置选项页面的主要功能
if ($_POST['update_themeoptions'] == 'true' ) {themeoptions_update(); }
下一步是增加一个更新函数。

?>
<div>
    <div id="icon-themes"><br /></div>
    <h2> <?php _e("Theme Setting","uglyboy") ?> </h2>
    <form method="POST" action="">
        <input type="hidden" name="update_themeoptions" value="true" />
        
        <h4><?php _e("Basic","uglyboy") ?></h4>
        <h4><input type="checkbox" name="local_jscss" id="local_jscss" <?php echo get_option('uglyboy_local_jscss'); ?> /> <?php _e("Use Local JS/CSS files","uglyboy") ?> </h4>
        
        <h4><?php _e("Color","uglyboy") ?></h4>
        <select name ="color">
            <?php $color = get_option('uglyboy_color'); ?>
            <option value="default" <?php if ($color=='gray') {echo 'selected';} ?> > <?php _e("Default","uglyboy") ?> </option>
        </select>
        
        <p><input type="submit" name="bcn_admin_options" value="<?php _e("Update","uglyboy") ?>"/></p>
    </form>
</div>
<?php
}

// 设置选项页
function themeoptions_admin_menu(){
    // 在控制面板的侧边栏添加设置选项页链接
    add_theme_page(__("Theme Setting","uglyboy"), __("setting","uglyboy"), 'edit_themes', basename(__FILE__), 'themeoptions_page');
}

add_action('admin_menu', 'themeoptions_admin_menu');

function themeoptions_update()
{
// 数据更新验证
update_option('uglyboy_color', $_POST['color']);
if ($_POST['local_jscss']=='on') {$display = 'checked';} else {$display =''; }
update_option('uglyboy_local_jscss', $display);
}
?>