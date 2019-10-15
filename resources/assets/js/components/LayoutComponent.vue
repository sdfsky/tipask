<template>
    <div>
        <keep-alive>
            <router-view></router-view>
        </keep-alive>
        <wv-tabbar>
            <wv-tabbar-item to="/" is-on>
                <span slot="icon" style="display: inline-block; position: relative;">
                <img class="weui-tabbar__icon" src="icon.png" slot="icon">
                <wv-badge style="position: absolute;top: -2px;right: -13px;">8</wv-badge>
                </span> 首页
            </wv-tabbar-item>
            <wv-tabbar-item to="/tabbar">
                <img class="weui-tabbar__icon" src="icon.png" slot="icon"> 通讯录
            </wv-tabbar-item>
            <wv-tabbar-item to="/">
      <span slot="icon" style="display: inline-block; position: relative;">
        <img class="weui-tabbar__icon" src="icon.png" slot="icon">
        <wv-badge is-dot style="position: absolute;top: 0;right: -6px;">8</wv-badge>
      </span>
                发现
            </wv-tabbar-item>
            <wv-tabbar-item to="/profile">
                <img class="weui-tabbar__icon" src="icon.png" slot="icon"> 我
            </wv-tabbar-item>
        </wv-tabbar>
    </div>
</template>
<script>
    import {mapState, mapActions} from 'vuex';

    export default ({
        // 映射 vuex 上面的属性
        computed: mapState({
            recommend: state => state.news.recommend
        }),
        created() {
            // 获取推荐列表
            //this.getNewsRecommend();
        },
        methods: {
            // 映射 vuex 对象上的方法
            ...mapActions([
                'getNewsRecommend'
            ])
        }
    });
</script>