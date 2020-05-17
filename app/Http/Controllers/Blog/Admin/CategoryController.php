<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Model\BlogCategories;
use App\Http\Requests\BlogCategoriesUpdateRequest;
use App\Http\Requests\BlogCategoriesCreateRequest;
use App\Repositories\BlogCategoryRepository;

use Illuminate\Http\Request;



class CategoryController extends BaseController
{

    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->$blogCategoryRepository = app(BlogCategoryRepository::class);    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategories;
        $categoryList = BlogCategories::all();
        
        return view('blog.admin.categories.edit', 
        compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoriesCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Создаст объект и добавит в БД
        $item = (new BlogCategories())->create($data);
        $item->save();

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        }
        else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategories::find($id);

        $categoryList = BlogCategories::all();

        return view('blog.admin.categories.edit', 
        compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoriesUpdateRequest $request, $id)
    {
        

        


        $item = BlogCategories::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item
            ->fill($data)
            ->save();
    

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
    
}
