<?php 
namespace App\Controllers;

use App\Models\NewsModels;

class Pages extends BaseController
{
    public function index()
    {
        // return view('welcome_message'); 
        $model = new NewsModels();
        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header',$data)
            . view('news/overview')
            . view('templates/footer');
    }
    public function view($slug = 'home')
    {
        
            $model = model(NewsModels::class);
    
            $data['news'] = $model->getNews($slug);
    
            if (empty($data['news'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
            }
    
            $data['title'] = $data['news']['title'];
    
            return view('templates/header', $data)
                . view('news/view')
                . view('templates/footer');
        
    }
}
?>