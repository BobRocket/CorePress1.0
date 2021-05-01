<?php


class CorePress_tag_cloud_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'corepress_tag_cloud_widget',
            'CorePress标签云',
            array(
                'description' => '标签云特效，一个页面只能有一个3D标签'
            )
        );
    }

    function form($instance)
    {
        $num = isset($instance['number']) ? absint($instance['number']) : 20;
        $title = isset($instance['title']) ? $instance['title'] : '标签云';
        $tagtitle = isset($instance['tagtitle']) ? $instance['tagtitle'] : 'tag1';

        $type = isset($instance['type']) ? $instance['type'] : '3d';

        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/></p>
        <p><label for="<?php echo $this->get_field_id('$tagtitle'); ?>">唯一标识</label>
            <input class="widefat" id="<?php echo $this->get_field_id('tagtitle'); ?>"
                   name="<?php echo $this->get_field_name('tagtitle'); ?>" type="text"
                   value="<?php echo esc_attr($tagtitle); ?>"/></p>
        <p>如果一个页面有多个标签云，请给唯一标识起不同的名字</p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>">标签数量</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>"
                   name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1"
                   value="<?php echo $num; ?>" size="3"/></p>

        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>">显示方式</label>
            <select name="<?php echo $this->get_field_name('type'); ?>">
                <option value="3d" <?php if ($type == '3d') echo 'selected' ?>>3d</option>
                <option value="default"<?php if ($type == 'default') echo 'selected' ?>>默认</option>
            </select>
        </p>
        <?php
    }

    public function widget_start($args, $instance)
    {
        echo $args['before_widget'];
        if ($title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
    }

    public function widget_end($args)
    {
        echo $args['after_widget'];
    }


    function update($new_instance, $old_instance)
    {
        return $new_instance;
    }

    function widget($args, $instance)
    {

        $this->widget_start($args, $instance);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        $type = (!empty($instance['type'])) ? $instance['type'] : '3d';
        $tagtitle = (!empty($instance['tagtitle'])) ? $instance['tagtitle'] : 'tag1';

        if ($type == '3d') {
            $tags = get_tags('number=' . $number);
            file_load_js('TagCloud.js');
            ?>
            <div class="corepress-tag-cloud">
                <div class="corepress-tag-container-<?php echo $tagtitle ?>">
                </div>
            </div>
            <?php
            ?>
            <style>
                .corepress-tagcloud a {
                    font-size: 12px;
                    color: #fff;
                    padding: 0 !important;
                }
                .corepress-tagcloud a:hover {
                    color: #fff !important;
                }
                .tagcloud--item {
                    color: #fff;
                    padding: 2px 4px;
                    border-radius: 3px;
                    cursor: pointer;
                }
                .tagcloud--item:hover {
                    opacity: 1 !important;
                    z-index: 100 !important;
                }
            </style>
            <script>
                <?php
                $arr = array();
                foreach ($tags as $item) {
                    $a['text'] = $item->name;
                    $a['href'] = home_url() . '/tag/' . $item->slug;
                    array_push($arr, $a);
                }
                ?>
                var tag = TagCloud('.corepress-tag-container-<?php echo $tagtitle?>', JSON.parse('<?php echo json_encode($arr)?>'), {}, ['#67C23A', '#E6A23C', '#F56C6C', '#909399', '#CC9966', '#FF6666', '#99CCFF', '#FF9999', '#CC6633']);
            </script>
            <?php
        } elseif ($type == 'default') {
            wp_tag_cloud('number=' . $number);
        }
        $this->widget_end($args, $instance);
    }
}

// register widget
function register_corepress_tag_cloud_widget()
{
    register_widget('CorePress_tag_cloud_widget');
}

add_action('widgets_init', 'register_corepress_tag_cloud_widget');