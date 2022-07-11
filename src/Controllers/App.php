<?php

namespace Route\Controllers;

class App
{

    public function home(?array $data = [])
    {
        print_r($data);
        echo <<<form
        <form method="post" action="http://localhost/login">
            <input type="email" name="a" id="">
            <input type="password" name="b" id="">
            <button>OK</button>
        </form>
form;
    }
    public function blog(array $data): void
    {
        print_r($data);
        echo <<<TPL
        <article style="font-family: verdana, arial, sans-serif;">
            <h1>Blog</h1>
            <p>Lorem ipsum dolor sit amet consectetur...</p>
            <p>Bla, bla, bla...</p>
        </article>
TPL;
    }

    public function about()
    {
        echo <<<TPL
        <div style="font-family: verdana, arial, sans-serif;">
            <h1>Sobre nós</h1>
            <p>Esta aplicação é <em>supimpa!</em></p>
        </div>
TPL;
    }

    public function login()
    {
        $post = filter_input_array(INPUT_POST);
        if ($post) {
            print_r($post);
        }
    }
}
