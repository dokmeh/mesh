<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home()
    {
        $data = $this->home_ajax();
        return view('master', compact('data'));
    }

    public function home_ajax()
    {
        $data = ['title' => 'Mesh Studio', 'page' => 'home', 'content' => view('home')->render()];
        return $data;
    }

    public function works()
    {
        $data = $this->works_ajax();
        return view('master', compact('data'));
    }

    public function works_ajax()
    {
        $data = ['title' => 'Mesh Studio-Works', 'page' => 'projects', 'content' => view('works')->render()];
        return $data;
    }

    public function work($url)
    {
        $data = $this->work_ajax($url);
        return view('master', compact('data'));
    }

    public function work_ajax($url)
    {
        $data = ['title' => 'Mesh Studio-Works', 'page' => 'project', 'content' => view('work')->render()];
        return $data;
    }

    public function studio()
    {
        $data = $this->studio_ajax();
        return view('master', compact('data'));
    }

    public function studio_ajax()
    {
        $data = ['title' => 'Mesh Studio-Studio', 'page' => 'studio', 'content' => view('studio')->render()];
        return $data;
    }

    public function research()
    {
        $data = $this->research_ajax();
        return view('master', compact('data'));
    }

    public function research_ajax()
    {
        $data = ['title' => 'Mesh Studio-Research', 'page' => 'research', 'content' => view('research')->render()];
        return $data;
    }

    public function events()
    {
        $data = $this->events_ajax();
        return view('master', compact('data'));
    }

    public function events_ajax()
    {
        $data = ['title' => 'Mesh Studio-News / Events', 'page' => 'events', 'content' => view('events')->render()];
        return $data;
    }

    public function event($url)
    {
        $data = $this->event_ajax($url);
        return view('master', compact('data'));
    }

    public function event_ajax($url)
    {
        $data = ['title' => 'Mesh Studio-News / Events', 'page' => 'event', 'content' => view('event')->render()];
        return $data;
    }
    public function contact()
    {
        $data = $this->contact_ajax();
        return view('master', compact('data'));
    }

    public function contact_ajax()
    {
        $data = ['title' => 'Mesh Studio', 'page' => 'contact', 'content' => view('contact')->render()];
        return $data;
    }
}
