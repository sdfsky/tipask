<template>
    <div class="panel panel-default">
        <div class="panel-heading">新闻列表</div>
        <ul class="list-group">
            <li class="list-group-item"
                v-for="row in lists">
                <router-link :to="{path:'/detail/' + row.id}">
                    <span class="label label-success" v-if="row.is_recommend">推荐</span>
                    {{ row.title }}
                </router-link>
                <span class="pull-right">{{ row.created }}</span>
            </li>
        </ul>
    </div>
</template>
<script>
    import { mapState, mapActions } from 'vuex';
    export default({
        computed: mapState({
            lists: state => state.news.lists
        }),
        created() {
            this.getNewsLists();
        },
        methods: {
            ...mapActions([
                'getNewsLists'
            ])
        }
    });
</script>