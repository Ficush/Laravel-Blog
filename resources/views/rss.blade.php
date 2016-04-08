<?xml version='1.0' encoding='UTF-8'?>
<rss version="2.0">
<channel>
@foreach($articles as $article)
<item>
    <title>{{$article->title}}</title>
    <author>{{$article->user->name}}</author>
    <pubDate>{{$article->created_at}}</pubDate>
    <link>{{route('view.show',[$article->id])}}</link>
    <description>{{$article->content}}</description>
    <category></category>
</item>
@endforeach
</channel>
</rss>