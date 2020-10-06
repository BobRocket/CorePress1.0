<h3>代码高亮模块</h3>
<div class="set-plane">
    <div class="set-title">
        功能开关
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.module.highlight"
                :active-value="1"
                :inactive-value="0"
        >
        </el-switch>
    </div>
</div>
<div class="set-plane">
    <div class="set-title">
        高亮风格
    </div>
    <div class="set-object">
        <el-switch
                v-model="set.module.highlighttheme"
                :active-value="1"
                :inactive-value="0"
                active-text="暗色风格"
                inactive-text="亮色风格"
        >
        </el-switch>
    </div>
</div>
