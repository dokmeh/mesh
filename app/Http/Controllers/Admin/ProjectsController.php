<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Projects;
use App\Http\Models\PrjCategory;
use App\Http\Models\PrjStatus;
use App\Http\Models\PrjExtras;
use App\Http\Models\PrjAwards;
use App\Http\Models\PrjPress;
use App\Http\Models\PrjLinks;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect;
use Image;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::orderBy('prj_sort', 'desc')->get();
        for($i = 0 ; $i < count($projects) ; $i++)
        {
            $thumb = glob('img/projects/' . $projects[$i]['prj_url'] . '/thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $projects[$i]['prj_thumb'] = $thumb[0];
        }
        return view('admin.projects.main', compact('projects'));
    }

    public function cats_get()
    {
        return PrjCategory::all();
    }

    public function cats_set(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prjc_title' => 'required|string|min:3',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        if(PrjCategory::where(['prjc_title' => $request->only('prjc_title')])->count() > 0)
        {
            return "Category is exist!";
        }
        if(PrjCategory::create($request->all()))
        {
            return "Saved.";
        }
        else
        {
            return "Error!";
        }
    }

    public function statuses_get()
    {
        return PrjStatus::all();
    }

    public function statuses_set(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prjs_title' => 'required|string|min:3',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        if(PrjStatus::where(['prjs_title' => $request->only('prjs_title')])->count() > 0)
        {
            return "Status is exist!";
        }
        if(PrjStatus::create($request->all()))
        {
            return "Saved.";
        }
        else
        {
            return "Error!";
        }
    }

    public function create()
    {
        $cats = $this->cats_get();
        $statuses = $this->statuses_get();
        return view('admin.projects.new', compact('cats', 'statuses'));
    }

    public function create_res(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prj_name' => 'required|string|min:3',
            'prj_category' => 'required|integer',
            'prj_location' => 'string|min:3',
            'prj_client' => 'string|min:3',
            'prj_status' => 'required|integer',
            'prj_sarea' => 'integer|min:1',
            'prj_farea' => 'integer|min:1',
            'prj_ddate' => 'integer|min:2000',
            'prj_cdate' => 'integer|min:2000',
            'prj_desc' => 'string|min:3',
            'prj_thumb' => 'required|image',
            'prj_images.*' => 'image',
            'prje_title.*' => 'string',
            'prje_content.*' => 'string|min:3',
            'prja_title.*' => 'string|min:3',
            'prjp_title.*' => 'string|min:3',
            'prjl_title.*' => 'string|min:3',
            'prjl_url.*' => 'url'
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $input = $request->all();
        $input['prj_url'] = str_slug($input['prj_name']);
        if(Projects::where(["prj_url" => $input['prj_url']])->count() > 0)
        {
            return "Project is exist!";
        }
        $last = Projects::orderBy('prj_id', 'desc')->first();
        if(count($last) > 0)
        {
            $last = $last['prj_id'];
        }
        else
        {
            $last = 0;
        }
        $input['prj_sort'] = $last + 1;
        if(Projects::create($input))
        {
            $last = Projects::orderBy('prj_id', 'desc')->first();
            $last = $last['prj_id'];
            $path = 'img/projects/' . $input['prj_url'];
            File::makeDirectory($path);
            File::makeDirectory($path . '/thumb');
            $ext = img_ext($request->file('prj_thumb'));
            if($ext)
            {
                $request->file('prj_thumb')->move($path . '/thumb', "thumb." . $ext);
            }
            if($request->hasFile('prj_images'))
            {
                $images = $request->file('prj_images');
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
            if($request->has('prje_title') && $request->has('prje_content'))
            {
                for($i = 0 ; $i < count($input['prje_title']) ; $i++)
                {
                    PrjExtras::create(['prje_title' => $input['prje_title'][$i], 'prje_content' => $input['prje_content'][$i], 'prj_id' => $last]);
                }
            }
            if($request->has('prja_title'))
            {
                for($i = 0 ; $i < count($input['prja_title']) ; $i++)
                {
                    PrjAwards::create(['prja_title' => $input['prja_title'][$i], 'prj_id' => $last]);
                }
            }
            if($request->has('prjp_title'))
            {
                for($i = 0 ; $i < count($input['prjp_title']) ; $i++)
                {
                    PrjPress::create(['prjp_title' => $input['prjp_title'][$i], 'prj_id' => $last]);
                }
            }
            if($request->has('prjl_title') && $request->has('prjl_url'))
            {
                for($i = 0 ; $i < count($input['prjl_title']) ; $i++)
                {
                    PrjLinks::create(['prjl_title' => $input['prjl_title'][$i], 'prjl_url' => $input['prjl_url'][$i], 'prj_id' => $last]);
                }
            }
            return 'Saved.';
        }
        return 'Error!';
    }

    public function info($url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $cats = $this->cats_get();
            $statuses = $this->statuses_get();
            return view('admin.projects.info', compact('project', 'cats', 'statuses'));
        }
        return redirect()->route('prjmain');
    }

    public function info_res(Request $request, $url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $validator = Validator::make($request->all(), [
                'prj_name' => 'required|string|min:3',
                'prj_category' => 'required|integer',
                'prj_location' => 'string|min:3',
                'prj_client' => 'string|min:3',
                'prj_status' => 'required|integer',
                'prj_sarea' => 'integer|min:1',
                'prj_farea' => 'integer|min:1',
                'prj_ddate' => 'integer|min:2000',
                'prj_cdate' => 'integer|min:2000',
                'prj_desc' => 'string|min:3',
                'prje_title.*' => 'string',
                'prje_content.*' => 'string|min:3',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $input = $request->all();
            $input['prj_url'] = str_slug($input['prj_name']);
            if($project['prj_url'] != $input['prj_url'] && Projects::where(["prj_url" => $input['prj_url']])->count() > 0)
            {
                return "The name entered belongs to another project!";
            }
            if($project->update($input))
            {
                if(!file_exists('img/projects/' . $input['prj_url']))
                {
                    rename('img/projects/' . $url, 'img/projects/' . $input['prj_url']);
                }
                $extras = $project->extras;
                if($request->has('prje_title') && $request->has('prje_content'))
                {
                    $count = count($input['prje_content']) > count($extras) ? count($input['prje_content']) : count($extras);
                    for($i = 0 ; $i < $count ; $i++)
                    {
                        if(isset($input['prje_content'][$i]) && isset($extras[$i]))
                        {
                            $extras[$i]->update(['prje_title' => $input['prje_title'][$i], 'prje_content' => $input['prje_content'][$i]]);
                        }
                        elseif(isset($input['prje_content'][$i]))
                        {
                            $project->extras()->create(['prje_title' => $input['prje_title'][$i], 'prje_content' => $input['prje_content'][$i]]);
                        }
                        elseif(isset($extras[$i]))
                        {
                            $extras[$i]->delete();
                        }
                    }
                }
                elseif(count($extras) > 0)
                {
                    $count = count($extras);
                    for($i = 0 ; $i < $count ; $i++)
                    {
                        $extras[$i]->delete();
                    }
                }
                return "Saved.";
            }
            return "Error!";
        }
        return redirect()->route('prjmain');
    }

    public function awards($url)
    {
        $project = Projects::where(['prj_url' => $url])->with('awards')->first();
        if($project)
        {
            return view('admin.projects.awards', compact('project'));
        }
        return redirect()->route('prjmain');
    }

    public function awards_res(Request $request, $url)
    {
        $project = Projects::where(['prj_url' => $url])->with('awards')->first();
        if($project)
        {
            $validator = Validator::make($request->all(), [
                'prja_title.*' => 'string|min:3'
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $input = $request->all();
            $awards = $project->awards;
            if($request->has('prja_title'))
            {
                $count = count($input['prja_title']) > count($awards) ? count($input['prja_title']) : count($awards);
                for($i = 0 ; $i < $count ; $i++)
                {
                    if(isset($input['prja_title']) && isset($awards[$i]))
                    {
                        $awards[$i]->update(['prja_title' => $input['prja_title'][$i]]);
                    }
                    elseif(isset($input['prja_title'][$i]))
                    {
                        $project->awards()->create(['prja_title' => $input['prja_title'][$i]]);
                    }
                    elseif(isset($awards[$i]))
                    {
                        $awards[$i]->delete();
                    }
                }
            }
            elseif(count($awards) > 0)
            {
                $count = count($awards);
                for($i = 0 ; $i < $count ; $i++)
                {
                    $awards[$i]->delete();
                }
            }
            return "Saved.";
        }
        return redirect()->route('prjmain');
    }

    public function press($url)
    {
        $project = Projects::where(['prj_url' => $url])->with('press')->first();
        if($project)
        {
            return view('admin.projects.press', compact('project'));
        }
        return redirect()->route('prjmain');
    }

    public function press_res(Request $request, $url)
    {
        $project = Projects::where(['prj_url' => $url])->with('press')->first();
        if($project)
        {
            $validator = Validator::make($request->all(), [
                'prjp_title.*' => 'string|min:3'
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $input = $request->all();
            $press = $project->press;
            if($request->has('prjp_title'))
            {
                $count = count($input['prjp_title']) > count($press) ? count($input['prjp_title']) : count($press);
                for($i = 0 ; $i < $count ; $i++)
                {
                    if(isset($input['prjp_title']) && isset($press[$i]))
                    {
                        $press[$i]->update(['prjp_title' => $input['prjp_title'][$i]]);
                    }
                    elseif(isset($input['prjp_title'][$i]))
                    {
                        $project->press()->create(['prjp_title' => $input['prjp_title'][$i]]);
                    }
                    elseif(isset($press[$i]))
                    {
                        $press[$i]->delete();
                    }
                }
            }
            elseif(count($press) > 0)
            {
                $count = count($press);
                for($i = 0 ; $i < $count ; $i++)
                {
                    $press[$i]->delete();
                }
            }
            return "Saved.";
        }
        return redirect()->route('prjmain');
    }

    public function links($url)
    {
        $project = Projects::where(['prj_url' => $url])->with('links')->first();
        if($project)
        {
            return view('admin.projects.links', compact('project'));
        }
        return redirect()->route('prjmain');
    }

    public function links_res(Request $request, $url)
    {
        $project = Projects::where(['prj_url' => $url])->with('awards')->first();
        if($project)
        {
            $validator = Validator::make($request->all(), [
                'prjl_title.*' => 'string|min:3',
                'prjl_url.*' => 'url'
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $input = $request->all();
            $links = $project->links;
            if($request->has('prjl_title') && $request->has('prjl_url'))
            {
                $count = count($input['prjl_title']) > count($links) ? count($input['prjl_title']) : count($links);
                for($i = 0 ; $i < $count ; $i++)
                {
                    if(isset($input['prjl_title']) && isset($links[$i]))
                    {
                        $links[$i]->update(['prjl_title' => $input['prjl_title'][$i], 'prjl_url' => $input['prjl_url'][$i]]);
                    }
                    elseif(isset($input['prjl_title'][$i]))
                    {
                        $project->links()->create(['prjl_title' => $input['prjl_title'][$i], 'prjl_url' => $input['prjl_url'][$i]]);
                    }
                    elseif(isset($awards[$i]))
                    {
                        $links[$i]->delete();
                    }
                }
            }
            elseif(count($links) > 0)
            {
                $count = count($links);
                for($i = 0 ; $i < $count ; $i++)
                {
                    $links[$i]->delete();
                }
            }
            return "Saved.";
        }
        return redirect()->route('prjmain');
    }

    public function images($url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $path = 'img/projects/' . $url . '/';
            $thumb = glob($path . 'thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $thumb = $thumb[0];
            $images = glob($path . '[0-9][0-9]{thumb.{jpg,png,gif},.{bmp,svg}}', GLOB_BRACE);
            foreach($images as $i => $image)
            {
                $images[$i] = str_replace($path, "", $image);
            }
            return view('admin.projects.images', compact('project', 'thumb', 'images'));
        }
        return redirect()->route('prjmain');
    }

    public function thumb_res(Request $request, $url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $validator = Validator::make($request->all(), [
                'prj_thumb' => 'required|image',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $path = 'img/projects/' . $url . '/thumb';
            File::cleanDirectory($path);
            $ext = img_ext($request->file('prj_thumb'));
            if($ext)
            {
                $request->file('prj_thumb')->move($path, "thumb." . $ext);
            }
            return "Saved.";
        }
        return redirect()->route('prjmain');
    }

    public function newimg_res(Request $request, $url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $validator = Validator::make($request->all(), [
                'prj_images.*' => 'required|image',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $path = 'img/projects/' . $url;
            $imgnum = 0;
            $limages = glob($path . '/[0-9][0-9].{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            if(is_array($limages) && count($limages) > 0)
            {
                $imgnum = count($limages);
            }
            $images = $request->file('prj_images');
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
        return redirect()->route('prjmain');
    }

    public function orderimg_res(Request $request, $url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $validator = Validator::make($request->all(), [
                'img_url.*' => 'string|min:3',
            ]);
            if($validator->fails())
            {
                return $validator->errors();
            }
            $path = 'img/projects/' . $url . '/';
            $pathtemp = 'img/projects/' . $url . 'temp/';
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
        return redirect()->route('prjmain');
    }

    public function delete($url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $thumb = glob('img/projects/' . $url . '/thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $thumb = $thumb[0];
            return view('admin.projects.delete', compact('project', 'thumb'));
        }
        return redirect()->route('prjmain');
    }

    public function delete_res($url)
    {
        $project = Projects::where(['prj_url' => $url])->first();
        if($project)
        {
            $project->delete();
            $directory = 'img/projects/' . $url . '/';
            File::deleteDirectory($directory);
            return "Deleted.";
        }
        return redirect()->route('prjmain');
    }

    public function order()
    {
        $projects = Projects::orderBy('prj_sort', 'desc')->get();
        for($i = 0 ; $i < count($projects) ; $i++)
        {
            $thumb = glob('img/projects/' . $projects[$i]['prj_url'] . '/thumb/thumb.{jpg,png,bmp,gif,svg}', GLOB_BRACE);
            $projects[$i]['prj_thumb'] = $thumb[0];
        }
        return view('admin.projects.order', compact('projects'));
    }

    public function order_res(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prj_url.*' => 'string|min:3',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $input = $request->all();
        if(count($input['prj_url']) != Projects::all()->count())
        {
            return "Error!";
        }
        $co = count($input['prj_url']);
        $sort = 0;
        for($i = ($co - 1) ; $i >= 0 ; $i--)
        {
            $sort++;
            Projects::where(['prj_url' => $input['prj_url'][$i]])->update(['prj_sort' => $sort]);
        }
        return "Saved.";
    }
}
