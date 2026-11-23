<?php

namespace App\Http\Controllers;

use App\Models\TutorialVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\ValidationException;
use Illuminate\Validation\Rule;

class TutorialVideoController extends Controller
{
    public function index()
    {
        $videos = TutorialVideo::orderBy('id')->paginate(15);

        return view('SuperAdmin.cms.videos.index', [
            'videos' => $videos,
            'categories' => TutorialVideo::CATEGORIES,
        ]);
    }

    public function create()
    {
        return view('SuperAdmin.cms.videos.create', [
            'categories' => TutorialVideo::CATEGORIES,
        ]);
    }

    public function store(Request $request)
    {
        TutorialVideo::create($this->validatedData($request));

        return redirect()->route('superadmin.cms.videos.index')
            ->with('success', 'Video added successfully.');
    }

    public function edit(TutorialVideo $video)
    {
        return view('SuperAdmin.cms.videos.edit', [
            'video' => $video,
            'categories' => TutorialVideo::CATEGORIES,
        ]);
    }

    public function update(Request $request, TutorialVideo $video)
    {
        $video->update($this->validatedData($request));

        return redirect()->route('superadmin.cms.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(TutorialVideo $video)
    {
        $video->delete();

        return redirect()->route('superadmin.cms.videos.index')
            ->with('success', 'Video deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'category' => ['required', Rule::in(array_keys(TutorialVideo::CATEGORIES))],
            'title' => ['required', 'string', 'max:255'],
            't2_label' => ['required', 'string', 'max:100'],
            'video_url' => ['required', 'url', 'max:2048'],
        ]);

        $videoId = $this->extractYoutubeId($data['video_url']);
        if ($videoId === null) {
            throw ValidationException::withMessages([
                'video_url' => 'Enter a valid YouTube video URL.',
            ]);
        }

        unset($data['video_url']);
        $data['video_id'] = $videoId;

        return $data;
    }

    private function extractYoutubeId(string $url): ?string
    {
        $parts = parse_url($url);
        if (!is_array($parts)) {
            return null;
        }

        $host = strtolower($parts['host'] ?? '');
        $path = $parts['path'] ?? '';

        if (in_array($host, ['youtu.be', 'www.youtu.be'], true)) {
            $videoId = trim($path, '/');
        } elseif (in_array($host, [
            'youtube.com',
            'www.youtube.com',
            'm.youtube.com',
            'music.youtube.com',
            'youtube-nocookie.com',
            'www.youtube-nocookie.com',
        ], true)) {
            parse_str($parts['query'] ?? '', $query);
            $videoId = $query['v'] ?? '';

            if ($videoId === '' && preg_match('~^/(?:embed|shorts|live)/([^/?]+)~', $path, $matches)) {
                $videoId = $matches[1];
            }
        } else {
            return null;
        }

        return is_string($videoId) && preg_match('/\A[A-Za-z0-9_-]{11}\z/', $videoId)
            ? $videoId
            : null;
    }
}
