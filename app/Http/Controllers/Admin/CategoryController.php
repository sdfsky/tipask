<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;

class CategoryController extends AdminController
{

    /*权限验证规则*/
    protected $validateRules = [
        'name' => 'required|max:255',
        'slug' => 'required|max:255|unique:categories',
        'sort' => 'required|integer'
    ];


    /**
     * 分类列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parentId = $request->input("parent_id",0);
        $parentCategoies = Category::getParentCategories($parentId);
        $categories = Category::where("parent_id","=",$parentId)->orderBy('sort','asc')->orderBy('created_at','asc')->paginate(config('tipask.admin.page_size'));
        return view("admin.category.index")->with(compact('categories','parentCategoies','parentId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parentId = $request->input("parent_id",0);
        $parentCategory['id'] = $parentId ;
        $parentCategory['name'] = '无' ;
        if($parentId){
            $category =  Category::findOrFail($parentId);
            $parentCategory['name'] = $category->name;
        }
        return view('admin.category.create')->with(compact('parentCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,$this->validateRules);
        $parentId = $request->input("parent_id",0);
        $types = $request->input("types",[]);
        $formData = $request->all();
        $formData['type'] = implode(",",$types);
        $formData['grade'] = 1;
        if($parentId){
            $parentCategory =  Category::findOrFail($parentId);
            $formData['grade'] = $parentCategory->grade + 1;
        }
        Category::create($formData);
        Artisan::call('cache:clear');
        return $this->success(route('admin.category.index',['parent_id'=>$parentId]),'分类添加成功');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category){
            return $this->error(route('admin.category.index'),'分类不存在，请核实');
        }
        return view('admin.category.edit')->with(compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if(!$category){
            return $this->error(route('admin.category.index'),'分类不存在，请核实');
        }

        $this->validateRules['slug'] = "required|max:255|unique:categories,slug,".$category->id;

        $this->validate($request,$this->validateRules);
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->sort = $request->input('sort');
        $category->status = $request->input('status');
        $category->type = implode(",",$request->input('types'));
        $category->save();
        Artisan::call('cache:clear');
        return $this->success(route('admin.category.index',['parent_id'=>$category->parent_id]),'分类添加成功');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::destroy($request->input('ids'));
        Artisan::call('cache:clear');
        return $this->success(route('admin.category.index'),'分类删除成功');
    }
}
