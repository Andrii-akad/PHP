<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    //Відправка даних про пост на view
    public function Index(Request $request)
    {
        //Дістаєм з бази даних теги та пости
        //та відправляємо їх на view
        $tags = Tag::query()->get();
        $posts = Post::query()->get();
        return view('index', ['tags' => $tags, 'posts' => $posts]);
    }

    //Створення поста
    public function CreatePost(Request $request)
    {
        //валідація полів
        $this->validate(request(), [
            'title' => 'required'
        ],
            [
                'title.required' => "Заголовок обовязкове поле"
            ]
        );
        //Створюємо пост прицьому зберігаючи його id в поле
        $id = Post::query()->insertGetId([
            'title' => $request->title,
            'description' => $request->description,
            'description_short' => $request->short_description,
            'id_category' => $request->id_category]);
        //Дістаєм масив вибраних checkbox'ів
        $checkbox = $request->check;
        if ($checkbox != null) {
            //Якщо не null заповнєм теги в проміжну таблицю
            foreach ($checkbox as $tag) {
                $tag_id = $tag;
                TagPost::query()->create(['id_tag' => $tag_id, 'id_post' => $id]);
            }
        }
        return redirect()->to('/');
    }

    //Відправка даних про пост на view
    public function AddPost(Request $request)
    {
        //Дістаєм з бази даних теги та категорії
        //та відправляємо їх на view
        $categories = Category::query()->get();
        $tags = Tag::query()->get();
        return view('addPost', ['categories' => $categories, 'tags' => $tags]);
    }

    //Відправка даних про пост на view
    public function ShowPost($id)
    {
        $post = Post::query()->find($id);
        return view('showPost', ['post' => $post]);
    }

    //Відправка даних про пост на view
    public function ChangePost($id)
    {
        $categories = Category::query()->get();
        $tags = Tag::query()->get();
        $post = Post::query()->find($id);
        return view('updatePost', ['post' => $post, 'tags' => $tags, 'categories' => $categories]);
    }

    //Зміна поста
    public function UpdatePost(Request $request)
    {
        //Валідація
        $this->validate(request(), [
            'title' => 'required'
        ],
            [
                'title.required' => "Заголовок обовязкове поле"
            ]
        );
        //Змінюємо пост за id, який прийшов із запиту
        Post::query()->where('id', '=', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'description_short' => $request->description_short,
            'id_category' => $request->id_category,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //Видаляємо всі теги у цього поста в проміжній таблиці
        TagPost::query()->where("id_post", '=', $request->id)->delete();

        //Заповняєм уже новими тегами
        $checkbox = $request->check;
        if ($checkbox != null) {
            foreach ($checkbox as $tag) {
                $tag_id = $tag;
                TagPost::query()->create(['id_tag' => $tag_id, 'id_post' => $request->id]);
            }
        }
        return redirect()->to('/');
    }

    //Загрузка картинки на текстовий редактор
    // та її зберігання в storage
    public function UploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            //  Let's do everything here
            if ($request->file('file')->isValid()) {
                //
//                $validated = $request->validate([
//                    'name' => 'string|max:40',
//                    'file' => 'mimes:jpeg,png|max:1024',
//                ]);
                $extension = $request->file->extension();
                $name = sha1(microtime()) . "." . $extension;
                $request->file('file')->storeAs('/public', $name);

                $url = Storage::url($name);
                return response()->json(['link' => $url]);
            }
        }
    }
}
