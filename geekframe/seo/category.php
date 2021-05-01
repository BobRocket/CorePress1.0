<?php

function corepress_category_seo_field()
{

    $value = get_option('corepress_cat_set_' . $_GET['tag_ID']);
    $title = 'cat_title';
    $keywords = 'cat_keywords';
    $description = 'cat_description';
    ?>
    <table class="form-table"></table>
    <h2>CorePress自定义目录SEO</h2>
    <table class="form-table">
        <tbody>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo $title ?>">标题</label></th>
            <td><input name="<?php echo $title ?>" id="<?php echo $title ?>" type="text"
                       value="<?php echo esc_attr(stripslashes($value['title']));
                       ?>">
                <p class="description">默认调用分类名称作为Head中Title信息。</p>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo $keywords; ?>">关键词</label></th>
            <td><input name="<?php echo $keywords; ?>" id="<?php echo $keywords; ?>" type="text"
                       value="<?php echo $value['keywords'];
                       ?>">
                <p class="description">多个关键词用小写逗号“,”分隔开。</p>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="<?php echo $description; ?>">描述</label></th>
            <td><textarea name="<?php echo $description; ?>" id="<?php echo $description;
                ?>" rows="3" cols="30"><?php echo stripslashes($value['description']); ?></textarea>
                <p class="description">若未设置，将不显示Description信息。</p>
            </td>
        </tr>
        </tbody>
    </table>

    <?php
}

function corepress_save_category_seo()
{
    update_option('corepress_cat_set_' . $_POST['tag_ID'], array('title' => $_POST['cat_title'],
        'description' => $_POST['cat_description'],
        'keywords' => $_POST['cat_keywords'],
    ));
}

global $set;
if ($set['seo']['catseo'] == 1) {
    add_action('category_edit_form_fields', 'corepress_category_seo_field');
    add_action('edited_category', 'corepress_save_category_seo', 10, 2);
}
?>