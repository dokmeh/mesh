<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect;
use Image;

class EventsController extends Controller
{
    public function index()
    {
        $events = Events::orderBy('eve_sort', 'desc')->get();
        for($i = 0 ; $i < count($events) ; $i++)
        {
            $thumb = glob('img/events/' . $events[$i]['eve_url'] . '/thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $events[$i]['eve_thumb'] = $thumb[0];
        }
        return view('admin.events.main', compact('events'));
    }

    public function create()
    {
        return view('admin.events.new');
    }

    public function create_res(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eve_title' => 'required|string|min:3',
            'eve_text' => 'required|string|min:3',
            'eve_thumb' => 'required|image',
            'eve_images.*' => 'image'
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $input = $request->all();
        $input['eve_url'] = str_slug($input['eve_title']);
        $input['eve_date'] = time();
        if(Events::where(["eve_url" => $input['eve_url']])->count() > 0)
        {
            return "Event/News is exist!";
        }
        $last = Events::orderBy('eve_id', 'desc')->first();
        if(count($last) > 0)
        {
            $last = $last['eve_id'];
        }
        else
        {
            $last = 0;
        }
        $input['eve_sort'] = $last + 1;
        if(Events::create($input))
        {
            $path = 'img/events/' . $input['eve_url'];
            File::makeDirectory($path);
            File::makeDirectory($path . '/thumb');
            $ext = img_ext($request->file('eve_thumb'));
            if($ext)
            {
                $request->file('eve_thumb')->move($path . '/thumb', "thumb." . $ext);
            }
            if($request->hasFile('eve_images'))
            {
                $images = $request->file('eve_images');
                foreach($images as $index => $image)
                {
                    $imgnum = $index + 1;
                    $ext = img_ext($image);
                    if($ext)
                    {
                        $image->move($path, ($imgnum > 9 ? $imgnum : ("0" . $imgnum)) . "." . $ext);
                        if($ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                        {
                            Image::make($path . '/' . ($imgnum > 9 ? $imgnum : ("0" . $imgnum)) . "." . $ext)->fit(200, 200)->save($path . '/' . ($imgnum > 9 ? $imgnum : ("0" . $imgnum)) . "thumb." . $ext)->destroy();
                        }
                    }
                }
            }
            return 'Saved.';
        }
        return 'Error!';
    }

    public function info($url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            return view('admin.events.info', compact('event'));
        }
        return redirect()->route('evemain');
    }

    public function info_res(Request $request, $url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            $validator = Validator::make($request->all(), [
                'eve_title' => 'required|string|min:3',
                'eve_text' => 'required|string|min:3'
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $input = $request->all();
            $input['eve_url'] = str_slug($input['eve_title']);
            if($event['eve_url'] != $input['eve_url'] && Events::where(["eve_url" => $input['eve_url']])->count() > 0)
            {
                return "The title entered belongs to another event/news!";
            }
            if($event->update($input))
            {
                if(!file_exists('img/events/' . $input['eve_url']))
                {
                    rename('img/events/' . $url, 'img/events/' . $input['eve_url']);
                }
                return "Saved.";
            }
            return "Error!";
        }
        return redirect()->route('evemain');
    }

    public function images($url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            $path = 'img/events/' . $url . '/';
            $thumb = glob($path . 'thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $thumb = $thumb[0];
            $images = glob($path . '[0-9][0-9]{thumb.{jpg,png,gif},.{bmp,svg}}', GLOB_BRACE);
            foreach($images as $i => $image)
            {
                $images[$i] = str_replace($path, "", $image);
            }
            return view('admin.events.images', compact('event', 'thumb', 'images'));
        }
        return redirect()->route('evemain');
    }

    public function thumb_res(Request $request, $url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            $validator = Validator::make($request->all(), [
                'eve_thumb' => 'required|image',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $path = 'img/events/' . $url . '/thumb';
            File::cleanDirectory($path);
            $ext = img_ext($request->file('eve_thumb'));
            if($ext)
            {
                $request->file('eve_thumb')->move($path, "thumb." . $ext);
            }
            return "Saved.";
        }
        return redirect()->route('evemain');
    }

    public function newimg_res(Request $request, $url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            $validator = Validator::make($request->all(), [
                'eve_images.*' => 'required|image',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $path = 'img/events/' . $url;
            $imgnum = 0;
            $limages = glob($path . '/[0-9][0-9].{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            if(is_array($limages) && count($limages) > 0)
            {
                $imgnum = count($limages);
            }
            $images = $request->file('eve_images');
            foreach($images as $index => $image)
            {
                $imgnum++;
                $ext = img_ext($image);
                if ($ext)
                {
                    $image->move($path, ($imgnum > 9 ? $imgnum : ("0" . $imgnum)) . "." . $ext);
                    if($ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                    {
                        Image::make($path . '/' . ($imgnum > 9 ? $imgnum : ("0" . $imgnum)) . "." . $ext)->fit(200, 200)->save($path . '/' . ($imgnum > 9 ? $imgnum : ("0" . $imgnum)) . "thumb." . $ext)->destroy();
                    }
                }
            }
            return "Saved.";
        }
        return redirect()->route('evemain');
    }

    public function orderimg_res(Request $request, $url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            $validator = Validator::make($request->all(), [
                'img_url.*' => 'string|min:3',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $path = 'img/events/' . $url . '/';
            $pathtemp = 'img/events/' . $url . 'temp/';
            rename($path, $pathtemp);
            if(!file_exists($path))
            {
                mkdir($path);
            }
            rename($pathtemp . "thumb", $path . "thumb");
            if($request->has('img_url'))
            {
                $img_urls = $request->only('img_url');
                $img_urls = $img_urls['img_url'];
                foreach($img_urls as $i => $img_url)
                {
                    $img_name = $i + 1;
                    if($img_name < 10)
                    {
                        $img_name = "0" . $img_name;
                    }
                    $ext = File::extension($pathtemp . $img_url);
                    if ($ext == "jpeg")
                    {
                        $ext = "jpg";
                    }
                    rename($pathtemp . $img_url, $path . $img_name . '.' . $ext);
                    if($ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                    {
                        rename($pathtemp . str_replace(".", "thumb.", $img_url), $path . $img_name . 'thumb.' . $ext);
                    }
                }
            }
            File::deleteDirectory($pathtemp);
            return "Saved.";
        }
        return redirect()->route('evemain');
    }

    public function delete($url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            $thumb = glob('img/events/' . $url . '/thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $thumb = $thumb[0];
            return view('admin.events.delete', compact('event', 'thumb'));
        }
        return redirect()->route('evemain');
    }

    public function delete_res($url)
    {
        $event = Events::where(['eve_url' => $url])->first();
        if($event)
        {
            $event->delete();
            $directory = 'img/events/' . $url . '/';
            File::deleteDirectory($directory);
            return "Deleted.";
        }
        return redirect()->route('evemain');
    }

    public function order()
    {
        $events = Events::orderBy('eve_sort', 'desc')->get();
        for($i = 0 ; $i < count($events) ; $i++)
        {
            $thumb = glob('img/events/' . $events[$i]['eve_url'] . '/thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $events[$i]['eve_thumb'] = $thumb[0];
        }
        return view('admin.events.order', compact('events'));
    }

    public function order_res(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eve_url.*' => 'string|min:3',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $input = $request->all();
        if(count($input['eve_url']) != Events::all()->count())
        {
            return "Error!";
        }
        $co = count($input['eve_url']);
        $sort = 0;
        for($i = ($co - 1) ; $i >= 0 ; $i--)
        {
            $sort++;
            Events::where(['eve_url' => $input['eve_url'][$i]])->update(['eve_sort' => $sort]);
        }
        return "Saved.";
    }
}
