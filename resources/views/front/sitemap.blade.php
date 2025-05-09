<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://easyjob.az</loc>
        <priority>1.0</priority>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
    </url>
    <url>
        <loc>https://easyjob.az/en</loc>
        <priority>1.0</priority>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
    </url>
    <url>
        <loc>https://easyjob.az/ru</loc>
        <priority>1.0</priority>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
    </url>

    @foreach($singles as $single)
        @if($single->type !== 'home_page')
            {{-- Exclude if type is home_page --}}
            @foreach($single->translations as $key => $translation)
                <url>
                    <loc>{{ url('/') . ($key > 0 ? '/' . $translation->locale : '') . '/' . $translation->slug }}</loc>
                    <priority>1.0</priority>
                    <lastmod>{{ $single->created_at->tz('UTC')->toAtomString() }}</lastmod>
                </url>
            @endforeach
        @endif
    @endforeach

    @foreach($blogs as $single)
        @foreach($single->translations as $key => $translation)
            <url>
                <loc>{{ url('/') . ($key>0 ? '/' . $translation->locale : '') . '/' . $translation->slug }}</loc>
                <priority>1.0</priority>
                <lastmod>{{ $single->created_at->tz('UTC')->toAtomString() }}</lastmod>
            </url>
        @endforeach
    @endforeach
    @foreach($vacancies as $key => $single)
        <url>
            <loc>{{ url('/')  . '/' . $single->slug }}</loc>
            <priority>1.0</priority>
            <lastmod>{{ $single->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach
</urlset>
