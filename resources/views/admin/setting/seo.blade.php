@extends('admin/public/layout')
@section('title')SEO设置@endsection
@section('content')
    <section class="content-header">
        <h1>SEO设置</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form role="form" name="addForm" id="register_form" method="POST" action="{{ route('admin.setting.seo') }}">
                    {{ csrf_field() }}
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">SEO设置规则</h3>
                    </div>
                    <div class="box-body">
                        <ol>
                            <li>网站名称:wzmc（应用范围：所有位置）</li>
                            <li>网站口号:wzkh（应用范围：所有位置）</li>
                            <li>话题列表:htlb（应用范围：问题、文章 查看页）</li>
                            <li>问题标题:wtbt（应用范围：问题查看页）</li>
                            <li>问题描述:wtms（应用范围：问题查看页）</li>
                            <li>问题状态:wtzt（应用范围：问题查看页）</li>
                            <li>文章标题:wzbt（应用范围：文章查看页）</li>
                            <li>文章摘要:wzzy（应用范围：文章查看页）</li>
                            <li>话题名称:htmc（应用范围：话题查看页）</li>
                            <li>话题名称:htmc（应用范围：话题查看页）</li>
                            <li>话题简介:htjj（应用范围：话题查看页）</li>
                        </ol>
                        <p>以上标签（必须包含大括号"{}"）可以通过添加在下面来优化页面SEO设置，多个标签之间可以用半角连字符"-"、半角","或半角空格隔开。
                            <br />留空为默认SEO设置，如果标签不再应用范围内则不显示此标签。</p>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">首页</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="seo_index_title">Title</label>
                            <span class="text-muted">(关键字将包含在每一个页面的title里面)</span>
                            <input type="text" class="form-control" name="seo_index_title" placeholder="Title" value="{{ old('seo_index_title',Setting()->get('seo_index_title')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_index_keyword">Meta keywords</label>
                            <span class="text-muted">(给搜索引擎看的keywords)</span>
                            <input type="text" class="form-control" name="seo_index_keyword" placeholder="Meta keywords" value="{{ old('seo_index_keyword',Setting()->get('seo_index_keyword')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_index_description">Meta Description</label>
                            <span class="text-muted">(给搜索引擎看的Description)</span>
                            <input type="text" class="form-control" name="seo_index_description" placeholder="Meta Description" value="{{ old('seo_index_description',Setting()->get('seo_index_description')) }}"  />
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">问题</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="seo_question_title">Title</label>
                            <span class="text-muted">(关键字将包含在每一个页面的title里面)</span>
                            <input type="text" class="form-control" name="seo_question_title" placeholder="Title" value="{{ old('seo_question_title',Setting()->get('seo_question_title')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_question_keyword">Meta keywords</label>
                            <span class="text-muted">(给搜索引擎看的keywords)</span>
                            <input type="text" class="form-control" name="seo_question_keyword" placeholder="Meta keywords" value="{{ old('seo_question_keyword',Setting()->get('seo_question_keyword')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_question_description">Meta Description</label>
                            <span class="text-muted">(给搜索引擎看的Description)</span>
                            <input type="text" class="form-control" name="seo_question_description" placeholder="Meta Description" value="{{ old('seo_question_description',Setting()->get('seo_question_description')) }}"  />
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="seo_article_title">Title</label>
                            <span class="text-muted">(关键字将包含在每一个页面的title里面)</span>
                            <input type="text" class="form-control" name="seo_article_title" placeholder="Title" value="{{ old('seo_article_title',Setting()->get('seo_article_title')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_article_keyword">Meta keywords</label>
                            <span class="text-muted">(给搜索引擎看的keywords)</span>
                            <input type="text" class="form-control" name="seo_article_keyword" placeholder="Meta keywords" value="{{ old('seo_article_keyword',Setting()->get('seo_article_keyword')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_article_description">Meta Description</label>
                            <span class="text-muted">(给搜索引擎看的Description)</span>
                            <input type="text" class="form-control" name="seo_article_description" placeholder="Meta Description" value="{{ old('seo_article_description',Setting()->get('seo_article_description')) }}"  />
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">话题</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label for="seo_topic_title">Title</label>
                            <span class="text-muted">(关键字将包含在每一个页面的title里面)</span>
                            <input type="text" class="form-control" name="seo_topic_title" placeholder="Title" value="{{ old('seo_topic_title',Setting()->get('seo_topic_title')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_topic_keyword">Meta keywords</label>
                            <span class="text-muted">(给搜索引擎看的keywords)</span>
                            <input type="text" class="form-control" name="seo_topic_keyword" placeholder="Meta Keywords" value="{{ old('seo_topic_keyword',Setting()->get('seo_topic_keyword')) }}"  />
                        </div>

                        <div class="form-group">
                            <label for="seo_topic_description">Meta Description</label>
                            <span class="text-muted">(给搜索引擎看的Description)</span>
                            <input type="text" class="form-control" name="seo_topic_description" placeholder="Meta Description" value="{{ old('seo_topic_description',Setting()->get('seo_topic_description')) }}"  />
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary editor-submit">保存</button>
                    <button type="reset" class="btn btn-success">重置</button>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            set_active_menu('global',"{{ route('admin.setting.seo') }}");
        });
    </script>
@endsection