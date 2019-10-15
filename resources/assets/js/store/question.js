import api from '../api/article';
export default{
    state: {
        recommendedList: [], // 推荐
        searchList: [],  // 列表
        detail: {}  // 详情
    },
    mutations: {
        // 注意，这里可以设置 state 属性，但是不能异步调用，异步操作写到 actions 中
        SETRECOMMENDEDLIST(state, recommendedList) {
            state.recommendedList = recommendedList;
        },
        SETSEARCHLIST(state, searchList) {
            state.searchList = searchList;
        },
        SETDETAIL(state, detail) {
            state.detail = detail;
        }
    },
    actions: {
        getDetail({commit}, id) {
            // 获取详情，并调用 mutations 设置 detail
            api.getArticleDetail(id).then(function(res) {
                commit('SETDETAIL', res.data.message);
               // document.body.scrollTop = 0;
            });
        },
        getRecommendedList({commit}) {
            api.getArticleRecommend().then(function(res) {
                commit('SETRECOMMENDEDLIST', res.data.message);
            });
        },
        getList({commit}) {
            api.getArticleList().then(function(res) {
                commit('SETSEARCHLIST', res.data.message);
            });
        }
    }
}