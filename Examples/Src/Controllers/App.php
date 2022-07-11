<?php

namespace Src\Controllers;

class App
{
    public function home(): void
    {
        echo <<<TPL
        <main>
            <h1>Home</h1>
            <p>Welcome home!</p>
        </main>
TPL;
    }

    public function about(): void
    {
        echo <<<TPL
        <main>
            <h1>About</h1>
            <p>About us page!</p>
        </main>
TPL;
    }

    public function blog(array $data): void
    {
        print_r($data);
        echo '<p>Lorem ipsum dolor sit amet.</p>';
    }

    public function register(): void
    {
        echo <<<FORM
        <form method="post" action="/signup">
            <label>Email: <input type="email" name="email"></label>
            <label>Password: <input type="password" name="password"></label>
            <button type="submit">Register</button>
        </form>
FORM;
    }

    public function login(): void
    {
        echo <<<FORM
        <form method="post" action="/sign-in">
            <label>Email: <input type="email" name="email"></label>
            <label>Password: <input type="password" name="password"></label>
            <button type="submit">Login</button>
        </form>
FORM;
    }
}
