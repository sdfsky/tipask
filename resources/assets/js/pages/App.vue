<template>
    <div>
        <wv-search-bar
                :autofocus="false"
                v-model="value"
                :result="filterResult"
        />
        <wv-swipe :height="130" :autoplay="4000">
            <wv-swipe-item style="background-color: #f44336">1</wv-swipe-item>
            <wv-swipe-item style="background-color: #ffc107">2</wv-swipe-item>
            <wv-swipe-item style="background-color: #03a9f4">3</wv-swipe-item>
        </wv-swipe>
        <wv-grid>
            <wv-grid-item to="/">
                <img :src="thumbSmall" slot="icon">
                <span slot="label">问答</span>
            </wv-grid-item>
            <wv-grid-item url="/">
                <img :src="thumbSmall" slot="icon">
                <span slot="label">文章</span>
            </wv-grid-item>
            <wv-grid-item>
                <img :src="thumbSmall" slot="icon">
                <span slot="label">课程</span>
            </wv-grid-item>
        </wv-grid>
        <wv-panel title="推荐问题">
            <wv-media-box :thumb="thumb" title="首页最佳推荐轮播图，右边的推荐文章列表，是在哪边添加的呢" :description="description" to="/"
                          type="text">
                <ul class="weui-media-box__info" slot="box_ft">
                    <li class="weui-media-box__info__meta">时间</li>
                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">其它信息</li>
                </ul>
            </wv-media-box>
            <wv-media-box :thumb="thumb" title="首页最佳推荐轮播图，右边的推荐文章列表，是在哪边添加的呢" :description="description" to="/"
                          type="text">
                <ul class="weui-media-box__info" slot="box_ft">
                    <li class="weui-media-box__info__meta">时间</li>
                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">其它信息</li>
                </ul>
            </wv-media-box>
        </wv-panel>
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