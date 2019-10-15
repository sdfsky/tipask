<template>
    <div>
        <ol class="breadcrumb">
            <li><a href="/">首页</a></li>
            <li><router-link to="/list" class="pull-right">新闻</router-link></li>
            <li class="active">{{ detail.title }}</li>
        </ol>
        <h3><span class="label label-success" v-if="detail.is_recommend">推荐</span> {{ detail.title }}</h3>
        <p>创建时间ddd：{{ detail.created_at }}</p>
        <div>
            {{ detail.content }}
            <wv-button type="primary">页面主要操作 Normal</wv-button>
            <wv-button type="default">页面次要操作 Normal</wv-button>
            <wv-button type="warn">警告类操作 Normal</wv-button>
        </div>
    </div>
</template>
<style>
    .breadcrumb{
        padding: 8px 0;
    }
</style>
<script>
    import { mapState, mapActions } from 'vuex';
    export default({
        computed: mapState({
            detail: state => state.news.detail
        }),
        created() {
            // 获取路由参数id
            // js 中用 this.$route 获取当前路由，用 this.$router 获路由对象，全部路由信息
            // 在模板中用 $router  和 $router 直接调用
            var id = this.$route.params.id;
            this.getNewsDetail(id);
        },
        methods: {
            ...mapActions([
                'getNewsDetail'
            ])
        }
    });
</script>