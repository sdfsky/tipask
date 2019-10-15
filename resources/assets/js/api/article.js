import axios from 'axios'
export default {
    // 首页推荐接口
    getArticleRecommend: function (params) {
        return axios.get('api/article/recommend', {
            params: params
        })
    },
    // 列表接口
    getArticleList: function (params) {
        return axios.get('api/article/index', {
            params: params
        })
    },
    // 详情接口
    getArticleDetail: function (id) {
        return axios.get('api/article/' + id)
    }
}