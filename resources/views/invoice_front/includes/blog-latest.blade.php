@if ($latestBlogs->isNotEmpty())
    <aside class="jewel-latest-posts">
        <div class="jewel-sidebar-heading">
            <h3>Latest Posts</h3>
            <span></span>
        </div>

        @foreach ($latestBlogs as $latestBlog)
            <a href="{{ route('blogdetails.show', $latestBlog) }}" class="jewel-latest-item">
                <div class="jewel-latest-img">
                    <img src="{{ asset($latestBlog->image) }}" alt="{{ $latestBlog->heading }}">
                </div>
                <div class="jewel-latest-content">
                    <h4>{{ $latestBlog->heading }}</h4>
                    <span>
                        <i class="bi bi-calendar-fill"></i>
                        {{ $latestBlog->date->format('d M Y') }}
                    </span>
                    <span>
                        <i class="bi bi-person-fill"></i>
                        {{ $latestBlog->admin }}
                    </span>
                </div>
            </a>
        @endforeach
    </aside>
@endif
