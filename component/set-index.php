<h3>幻灯片设置</h3>

<div class="swiper-plane">
    <div class="swiper-control">
        <el-button type="primary" @click="addSwiper" size="mini">添加幻灯片</el-button>
    </div>
    <el-collapse>
        <div v-for="(item,index) in set.index.swiperlist">
            <el-collapse-item>
                <template slot="title">
                    <div>
                        <span class="index-card-plane-thumbnail"><img :src="item.imgurl"></span>
                        <span class="swiper-title">{{item.imgurl}}</span>
                        <span class="swiper-colbtn" @click.stop="delSwiper(index)"><i class="el-icon-close"></i></span>
                        <span class="swiper-colbtn" @click.stop="moveSwiper(index,1)"
                              v-if="index<(set.index.swiperlist.length-1)"><i class="el-icon-bottom"></i></span>
                        <span class="swiper-colbtn" @click.stop="moveSwiper(index,-1)" v-if="index>0"><i
                                    class="el-icon-top"></i></span>
                    </div>
                </template>
                <div class="set-plane">
                    <div class="set-title">
                        图片地址
                    </div>
                    <div class="set-object">
                        <el-input placeholder="" v-model="item.imgurl" size="small">
                            <el-button size="mini" slot="append" icon="el-icon-picture"
                                       @click="selectImg('swiperlist',index)">上传
                            </el-button>
                        </el-input>
                    </div>
                </div>
                <div class="set-plane">
                    <div class="set-title">
                        指向链接
                    </div>
                    <div class="set-object">
                        <el-input placeholder="" v-model="item.url" size="small">
                        </el-input>
                    </div>
                </div>
                <div class="set-plane">
                    <div class="set-title">
                        标题内容
                    </div>
                    <div class="set-object">
                        <el-input placeholder="" v-model="item.title" size="small">
                        </el-input>
                    </div>
                </div>
            </el-collapse-item>
        </div>
    </el-collapse>
</div>
<h3>首页推荐卡片</h3>
<div class="set-plane">
</div>
<div class="set-plane">
    <div class="set-title">
        每行显示个数
    </div>
    <div class="set-object">
        <el-input placeholder="" v-model="set.index.postcardlinenumber" size="small">
        </el-input>
    </div>
</div>
<div class="index-card-plane">
    <div class="swiper-control">
        <el-button type="primary" @click="addPostCard" size="mini">添加首页卡片</el-button>
    </div>
    <el-collapse>
        <div v-for="(item,index) in set.index.postcard">
            <el-collapse-item>
                <template slot="title">
                    <div>
                        <span class="index-card-plane-thumbnail"><img :src="item.imgurl"></span>
                        <span class="swiper-title">{{item.title}}</span>
                        <span class="swiper-colbtn" @click.stop="delPostCard(index)"><i
                                    class="el-icon-close"></i></span>
                        <span class="swiper-colbtn" @click.stop="movePostCard(index,1)"
                              v-if="index<(set.index.postcard.length-1)"><i class="el-icon-bottom"></i></span>
                        <span class="swiper-colbtn" @click.stop="movePostCard(index,-1)" v-if="index>0"><i
                                    class="el-icon-top"></i></span>
                    </div>
                </template>
                <div class="set-plane">
                    <div class="set-title">
                        图片地址
                    </div>
                    <div class="set-object">
                        <el-input placeholder="" v-model="item.imgurl" size="small">
                            <el-button size="mini" slot="append" icon="el-icon-picture"
                                       @click="selectImg('postcard',index)">上传
                            </el-button>
                        </el-input>
                    </div>
                </div>
                <div class="set-plane">
                    <div class="set-title">
                        指向链接
                    </div>
                    <div class="set-object">
                        <el-input placeholder="" v-model="item.url" size="small">
                        </el-input>
                    </div>
                </div>
                <div class="set-plane">
                    <div class="set-title">
                        标题内容
                    </div>
                    <div class="set-object">
                        <el-input placeholder="" v-model="item.title" size="small">
                        </el-input>
                    </div>
                </div>
            </el-collapse-item>
        </div>
    </el-collapse>
</div>
<h3>首页文章列表选项卡</h3>

<div class="set-plane">
    <div class="set-title">
        分类ID
    </div>
    <div class="set-object">
        <el-input placeholder="" v-model="set.index.tab_ids" size="small">
        </el-input>
    </div>
</div>

<div class="set-plane">
    <div class="set-title">

    </div>
    <div class="set-object">
        首页最新文章旁边支持选项卡切换，填写分类文章ID，多个ID使用英文逗号隔开，推荐不超过4个,点击下方的分类标签，可以快速加入ID
        <br>首页文章分页加载方式必须开启无限滚动才能使用 开启方式->外观设置->首页文章分页加载方式 <br>
        <p><a href="https://www.yuque.com/applek/corepress/indextabs" target="_blank">配置教程</a></p>
        <div style="margin-top: 10px">
            <?php
            $cats = get_categories(array('orderby' => 'name'));
            foreach ($cats as $item) {
                echo '<el-tag @click="add_index_tab_id(\'' . $item->cat_ID . '\')" class="tabs-cat-item" size="mini"   effect="plain">' . $item->cat_name.'('.$item->count.')' . '</el-tag>';
            }
            ?>
        </div>
    </div>
</div>
<h3>友情链接</h3>
<div class="set-plane">
    <div class="set-title">
        显示友情链接模块
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.index.links"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
        申请友链描述
    </div>
    <div class="set-object">
        <el-input placeholder="" v-model="set.index.linksdescribe" size="small">
        </el-input>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
    </div>
    <div class="set-object">
        友情链接标题旁边描述内容
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
        申请友链地址
    </div>
    <div class="set-object">
        <el-input placeholder="" v-model="set.index.applylink" size="small">
        </el-input>
    </div>
</div>
